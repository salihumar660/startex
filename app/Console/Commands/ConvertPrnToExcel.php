<?php

namespace App\Console\Commands;

use App\Models\DtnBol;
use App\Models\Dtn_Fuel;
use App\Models\DtnEft; // Import the DtnEft model
use Illuminate\Console\Command;

class ConvertPrnToExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-prn-to-excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process PRN files and FTP XML files, save them into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Process PRN file for `ftp_price`
        $prnFilePath = storage_path('app/ftp_price_export.prn');
        if (file_exists($prnFilePath)) {
            $this->processPrnFile($prnFilePath);
        } else {
            $this->error("PRN file not found at {$prnFilePath}");
        }

        // Process XML files for `ftp_bol`
        $bolDirectory = storage_path('app/ftp_bol_' . now()->subDay()->format('Ymd'));
        if (is_dir($bolDirectory)) {
            $this->processBolFiles($bolDirectory);
        } else {
            $this->warn("No BOL directory found for yesterday: {$bolDirectory}");
        }

        // Process EFT XML files for `ftp_data`
        $eftDirectory = storage_path('app/eft');
        if (is_dir($eftDirectory)) {
            $this->processEftFiles($eftDirectory);
        } else {
            $this->warn("No EFT directory found at: {$eftDirectory}");
        }

        return Command::SUCCESS;
    }


    private function processPrnFile($filePath)
    {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (empty($lines)) {
            $this->error("The PRN file is empty.");
            return;
        }

        $insertedCount = 0;
        foreach ($lines as $index => $line) {
            $exists = Dtn_Fuel::where('file_content', $line)->exists();

            if (!$exists) {
                Dtn_Fuel::insert([
                    'line_number' => $index + 1,
                    'file_content' => $line,
                    'created_at' => now(),
                ]);
                $insertedCount++;
            }
        }

        if ($insertedCount > 0) {
            $this->info("Successfully inserted {$insertedCount} new records into the Dtn_Fuel table.");
        } else {
            $this->info("No new records were inserted into the Dtn_Fuel table. All data already exists.");
        }
    }

    private function processBolFiles($directory)
    {
        // Fetch all files ending with _BOL.XML
        $files = glob("{$directory}/*_BOL.XML");

        // Display all fetched file names
        if (empty($files)) {
            $this->info("No BOL XML files found in the directory.");
            return;
        }

        $this->info("Files found in the directory:");
        foreach ($files as $filePath) {
            $this->info(basename($filePath));
        }

        $insertedCount = 0;
        foreach ($files as $filePath) {
            $xmlContent = file_get_contents($filePath);
            $xml = simplexml_load_string($xmlContent);

            if (!$xml || !$xml->BillOfLading) {
                $this->warn("Invalid or empty XML content in file: " . basename($filePath));
                continue;
            }

            // Extract the required data
            $bolNo = (string) $xml->BillOfLading->BillOfLadingNumber ?? null;
            $terminalControlNumber = (string) $xml->BillOfLading->Terminal->TerminalControlNumber ?? null;
            $terminalName = (string) $xml->BillOfLading->Terminal->Name ?? null;
            $fuelProductQty = (string) $xml->BillOfLading->Destination->LineItem[0]->FuelProductQty ?? null;
            $totalFuelProductQty = (string) $xml->BillOfLading->FuelProductSummary->TotalFuelProductQty ?? null;

            // Check for duplicates
            $exists = DtnBol::where('bol_no', $bolNo)
                ->where('terminal_control_number', $terminalControlNumber)
                ->exists();

            if (!$exists) {
                DtnBol::insert([
                    'bol_no' => $bolNo,
                    'terminal_control_number' => $terminalControlNumber,
                    'terminal_name' => $terminalName,
                    'fuel_product_qty' => $fuelProductQty,
                    'total_fuel_product_qty' => $totalFuelProductQty,
                    'created_at' => now(),
                ]);
                $insertedCount++;
            }
        }

        // Log results
        if ($insertedCount > 0) {
            $this->info("Successfully inserted {$insertedCount} new records into the Dtn_Bol table.");
        } else {
            $this->info("No new records were inserted into the Dtn_Bol table. All data already exists.");
        }
    }
    private function processEftFiles($directory)
    {
        // Fetch all files ending with _EFT.XML
        $files = glob("{$directory}/*_EFT.XML");

        if (empty($files)) {
            $this->info("No EFT XML files found in the directory.");
            return;
        }

        $this->info("Processing EFT files found in the directory:");

        $insertedCount = 0;
        foreach ($files as $filePath) {
            $this->info("Processing file: " . basename($filePath));

            $xmlContent = file_get_contents($filePath);
            $xml = simplexml_load_string($xmlContent);

            if (!$xml) {
                $this->warn("Invalid XML content in file: " . basename($filePath));
                continue;
            }

            // Extract required data
            $brand = (string) $xml->TransmissionHeader->TransmissionSender ?? null;
            $eft = (string) $xml->TransmissionHeader->TransmissionId ?? null;
            $date = (string) $xml->CreditCardsPreDraft->InvoiceReconciliation->InvoiceDue[0]->InvoiceDate ?? null;
            $eftAmount = (string) $xml->CreditCardsPreDraft->InvoiceReconciliation->TotalInvoicesNetAmt['amount'] ?? null;

            // Gather all InvoiceNumbers
            $invoiceNumbers = [];
            foreach ($xml->CreditCardsPreDraft->InvoiceReconciliation->InvoiceDue as $invoiceDue) {
                $invoiceNumbers[] = (string) $invoiceDue->InvoiceNumber;
            }

            $invoiceNumbersString = implode(',', $invoiceNumbers);

            if (!$brand || !$eft || !$date || !$eftAmount || empty($invoiceNumbers)) {
                $this->warn("Missing required fields in file: " . basename($filePath));
                continue;
            }

            // Check for duplicates
            $exists = DtnEft::where('brand', $brand)
                ->where('eft', $eft)
                ->exists();

            if (!$exists) {
                DtnEft::insert([
                    'brand' => $brand,
                    'eft' => $eft,
                    'date' => $date,
                    'eft_amount' => $eftAmount,
                    'invoice_numbers' => $invoiceNumbersString, // Storing concatenated InvoiceNumbers
                    'created_at' => now(),
                ]);
                $insertedCount++;
            }
        }

        if ($insertedCount > 0) {
            $this->info("Successfully inserted {$insertedCount} new records into the DtnEft table.");
        } else {
            $this->info("No new records were inserted into the DtnEft table. All data already exists.");
        }
    }
 
}
