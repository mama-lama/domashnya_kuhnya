<?php

namespace App\Services;

use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class MenuPdfService
{
    public function getMenuData(): array
    {
        $settings = Setting::all()->pluck('value', 'key');
        $items = MenuItem::query()
            ->orderBy('id')
            ->get()
            ->map(function (MenuItem $item): MenuItem {
                $item->pdf_image_url = $this->resolvePdfImageUrl($item->image_url);

                return $item;
            });

        $sectionTitles = Category::orderBy('sort_order')->pluck('name', 'slug');

        $menuSections = collect($sectionTitles)
            ->map(function (string $title, string $key) use ($items): array {
                return [
                    'key' => $key,
                    'title' => $title,
                    'items' => $items
                        ->filter(fn (MenuItem $item): bool => in_array($key, $this->resolvePdfSections($item), true))
                        ->values(),
                ];
            })
            ->filter(fn (array $section): bool => $section['items']->isNotEmpty())
            ->values();

        return compact('settings', 'menuSections');
    }

    public function generatePdfContent(): string
    {
        $data = $this->getMenuData();

        $pdf = Pdf::loadView('pdf.menu', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'defaultMediaType' => 'print',
            ]);

        return $pdf->output();
    }

    public function savePdfToFile(string $path): bool
    {
        $content = $this->generatePdfContent();
        return file_put_contents($path, $content) !== false;
    }

    // A dish can belong to several categories, so it may appear in several
    // PDF sections at once. Tag/name-based rules add extra sections.
    private function resolvePdfSections(MenuItem $item): array
    {
        $sections = $item->categorySlugs();
        $tag = Str::lower($item->tag ?? '');

        if (Str::contains($tag, 'под заказ') && !in_array('order', $sections, true)) {
            $sections[] = 'order';
        }

        if (Str::contains($tag, 'дополнительно') && !in_array('extra', $sections, true)) {
            $sections[] = 'extra';
        }

        if (in_array($item->name, ['Хлеб белый', 'Хлеб черный', 'Лаваш'], true) && !in_array('bread', $sections, true)) {
            $sections[] = 'bread';
        }

        return $sections;
    }

    private function resolvePdfImageUrl(?string $imageUrl): ?string
    {
        if (!$imageUrl) {
            return null;
        }

        if (Str::startsWith($imageUrl, ['http://', 'https://', 'file://'])) {
            return $imageUrl;
        }

        $resolvedPath = null;

        if (Str::startsWith($imageUrl, '/')) {
            $resolvedPath = public_path(ltrim($imageUrl, '/'));
        } elseif (is_file($imageUrl)) {
            $resolvedPath = $imageUrl;
        } else {
            $resolvedPath = public_path($imageUrl);
        }

        if (!is_file($resolvedPath)) {
            return $resolvedPath;
        }

        $pdfImagePath = $this->createPdfImageVariant($resolvedPath) ?? $resolvedPath;
        $imageContents = @file_get_contents($pdfImagePath);
        $mimeType = @mime_content_type($pdfImagePath);

        if ($imageContents === false || !is_string($mimeType) || !str_starts_with($mimeType, 'image/')) {
            return null;
        }

        return 'data:'.$mimeType.';base64,'.base64_encode($imageContents);
    }

    private function createPdfImageVariant(string $sourcePath): ?string
    {
        $imageInfo = @getimagesize($sourcePath);

        if ($imageInfo === false) {
            return null;
        }

        [$width, $height] = $imageInfo;

        if (app()->runningUnitTests()) {
            return $sourcePath;
        }

        if ($width === $height && $width <= 640 && filesize($sourcePath) <= 400000) {
            return $sourcePath;
        }

        $cacheDirectory = storage_path('framework/cache/pdf-menu');

        if (!is_dir($cacheDirectory) && !mkdir($cacheDirectory, 0755, true) && !is_dir($cacheDirectory)) {
            $cacheDirectory = sys_get_temp_dir().DIRECTORY_SEPARATOR.'homekitchen-pdf-menu-cache';
        }

        if ((!is_dir($cacheDirectory) && !mkdir($cacheDirectory, 0755, true) && !is_dir($cacheDirectory)) || !is_writable($cacheDirectory)) {
            return null;
        }

        $cacheKey = md5($sourcePath.'|'.filemtime($sourcePath).'|640x640-cover');
        $cachedPath = $cacheDirectory.DIRECTORY_SEPARATOR.$cacheKey.'.jpg';

        if (is_file($cachedPath)) {
            return $cachedPath;
        }

        $sourceImage = @imagecreatefromstring((string) file_get_contents($sourcePath));

        if ($sourceImage === false) {
            return null;
        }

        $targetSize = 640;
        $sourceSize = min($width, $height);
        $sourceX = (int) floor(($width - $sourceSize) / 2);
        $sourceY = (int) floor(($height - $sourceSize) / 2);

        $canvas = imagecreatetruecolor($targetSize, $targetSize);

        if ($canvas === false) {
            imagedestroy($sourceImage);

            return null;
        }

        $background = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $background);

        imagecopyresampled(
            $canvas,
            $sourceImage,
            0,
            0,
            $sourceX,
            $sourceY,
            $targetSize,
            $targetSize,
            $sourceSize,
            $sourceSize
        );

        imageinterlace($canvas, true);
        $written = imagejpeg($canvas, $cachedPath, 84);

        imagedestroy($canvas);
        imagedestroy($sourceImage);

        return $written ? $cachedPath : null;
    }
}
