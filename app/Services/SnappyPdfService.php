<?php

namespace App\Services;

use Illuminate\Support\Str;
use Barryvdh\Snappy\Facade\SnappyPdf;

class SnappyPdfService
{
    private $menuService;

    public function __construct(MenuPdfService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function generatePdfContent(): string
    {
        $data = $this->menuService->getMenuData();

        $pdf = SnappyPdf::loadView('pdf.menu', $data)
            ->setPaper('a4')
            ->setOption('margin-left', 15)
            ->setOption('margin-right', 15)
            ->setOption('margin-top', 15)
            ->setOption('margin-bottom', 15)
            ->setOption('enable-local-file-access', true);

        return $pdf->output();
    }

    public function savePdfToFile(string $path): bool
    {
        $content = $this->generatePdfContent();
        return file_put_contents($path, $content) !== false;
    }
}
