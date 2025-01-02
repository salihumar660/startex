<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadFTPFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-f-t-p-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download files from FTP servers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->downloadFTPFiles();
        $this->info('FTP files downloaded successfully!');
    }

    private function downloadFTPFiles()
    {
        $this->downloadFileFromFTPPrice();
        $this->downloadFilesFromFTPBol();
        $this->downloadFilesFromFTPData(); // New function for ftp_data
    }

    private function downloadFileFromFTPPrice()
    {
        $connection = 'ftp_price';
        $disk = Storage::disk($connection);

        // Check and download export.prn
        if ($disk->exists('export.prn')) {
            $contents = $disk->get('export.prn');
            $localPath = storage_path("app/{$connection}_export.prn");
            file_put_contents($localPath, $contents);

            $this->info("File 'export.prn' downloaded from $connection and saved to $localPath");
        } else {
            $this->warn("File 'export.prn' not found on $connection root");
        }
    }

    private function downloadFilesFromFTPBol()
    {
        $connection = 'ftp_bol';
        $disk = Storage::disk($connection);
        $yesterday = now()->subDay()->format('Ymd');

        if ($disk->exists($yesterday)) {
            $files = $disk->files($yesterday);

            foreach ($files as $file) {
                if (str_ends_with($file, '_BOL.XML')) {
                    $fileContents = $disk->get($file);

                    $localDir = storage_path("app/{$connection}_{$yesterday}");
                    $localPath = "{$localDir}/" . basename($file);

                    if (!file_exists($localDir)) {
                        mkdir($localDir, 0755, true);
                    }

                    file_put_contents($localPath, $fileContents);

                    $this->info("File {$file} downloaded from {$connection}/{$yesterday} and saved to $localPath");
                }
            }

            $this->info("Completed downloading all _BOL.XML files from {$connection}/{$yesterday}");
        } else {
            $this->warn("Folder '{$yesterday}' not found on $connection");
        }
    }

    private function downloadFilesFromFTPData()
    {
        $connection = 'ftp_data';
        $disk = Storage::disk($connection);
        $yesterday = now()->subDay()->format('Ymd');

        if ($disk->exists($yesterday)) {
            $files = $disk->files($yesterday);

            foreach ($files as $file) {
                if (str_ends_with($file, '_EFT.XML')) {
                    $fileContents = $disk->get($file);

                    $localDir = storage_path('app/eft');
                    $localPath = "{$localDir}/" . basename($file);

                    if (!file_exists($localDir)) {
                        mkdir($localDir, 0755, true);
                    }

                    file_put_contents($localPath, $fileContents);

                    $this->info("File {$file} downloaded from {$connection}/{$yesterday} and saved to $localPath");
                }
            }

            $this->info("Completed downloading all _EFT.XML files from {$connection}/{$yesterday}");
        } else {
            $this->warn("Folder '{$yesterday}' not found on $connection");
        }
    }
}
