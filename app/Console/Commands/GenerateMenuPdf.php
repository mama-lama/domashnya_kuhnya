<?php

namespace App\Console\Commands;

use App\Services\MenuPdfService;
use App\Services\SnappyPdfService;
use App\Services\MpdfService;
use App\Services\PythonPdfService;
use Illuminate\Console\Command;

class GenerateMenuPdf extends Command
{
    protected $signature = 'menu:generate-pdf';
    protected $description = 'Generate the menu PDF and save it to public/menu.pdf';

    public function handle(
        MenuPdfService $dompdfService,
        SnappyPdfService $snappyService,
        MpdfService $mpdfService,
        PythonPdfService $pythonService
    ) {
        $this->info('Starting menu PDF generation...');
        $outputPath = public_path('menu.pdf');

        $generator = env('PDF_GENERATOR', 'dompdf');
        $this->info("Using generator: {$generator}");

        if ($generator === 'snappy') {
            $success = $snappyService->savePdfToFile($outputPath);
        } elseif ($generator === 'mpdf') {
            $success = $mpdfService->savePdfToFile($outputPath);
        } elseif ($generator === 'python') {
            $success = $pythonService->savePdfToFile($outputPath);
        } else {
            $success = $dompdfService->savePdfToFile($outputPath);
        }

        if ($success) {
            $this->info("Menu PDF successfully generated and saved to: {$outputPath}");
            return Command::SUCCESS;
        }

        $this->error('Failed to generate menu PDF.');
        return Command::FAILURE;
    }
}
