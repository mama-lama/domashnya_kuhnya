<?php

namespace App\Services;

use RuntimeException;

class PythonPdfService
{
    private $menuService;

    public function __construct(MenuPdfService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function generatePdfContent(): string
    {
        $data = $this->menuService->getMenuData();
        $html = view('pdf.menu', $data)->render();

        return $this->runPythonGenerator($html, '-');
    }

    public function savePdfToFile(string $path): bool
    {
        $data = $this->menuService->getMenuData();
        $html = view('pdf.menu', $data)->render();

        try {
            $this->runPythonGenerator($html, $path);
            return true;
        } catch (RuntimeException $e) {
            logger()->error("Python PDF Service error: " . $e->getMessage());
            return false;
        }
    }

    private function runPythonGenerator(string $html, string $outputPath): string
    {
        $scriptPath = base_path('scripts/generate_pdf.py');
        
        $descriptorspec = [
            0 => ["pipe", "r"], // stdin
            1 => ["pipe", "w"], // stdout
            2 => ["pipe", "w"]  // stderr
        ];

        $command = "python3 " . escapeshellarg($scriptPath) . " " . escapeshellarg($outputPath);
        
        $process = proc_open($command, $descriptorspec, $pipes);

        if (!is_resource($process)) {
            throw new RuntimeException("Failed to open process for Python PDF generator command: {$command}");
        }

        // Send HTML to stdin
        fwrite($pipes[0], $html);
        fclose($pipes[0]);

        // Read stdout (PDF content or status messages)
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        // Read stderr (errors or logs)
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            throw new RuntimeException("Python script failed with exit code {$exitCode}. Stderr: {$stderr}");
        }

        return $stdout;
    }
}
