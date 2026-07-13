<?php

namespace App\Services;

use Mpdf\Mpdf;

class MpdfService
{
    private $menuService;

    public function __construct(MenuPdfService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function generatePdfContent(): string
    {
        ini_set('pcre.backtrack_limit', '10000000');

        $data = $this->menuService->getMenuData();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
            'default_font' => 'dejavusans',
            'tempDir' => storage_path('framework/cache/pdf-menu'),
            'percentSubset' => 0, // Embed whole font for rendering speed
        ]);

        $mpdf->simpleTables = true;
        $mpdf->useSubstitutions = false;

        $html = view('pdf.menu', $data)->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('', 'S');
    }

    public function savePdfToFile(string $path): bool
    {
        $content = $this->generatePdfContent();
        return file_put_contents($path, $content) !== false;
    }
}
