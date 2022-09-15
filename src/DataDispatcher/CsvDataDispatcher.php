<?php

namespace FormRelay\Csv\DataDispatcher;

use FormRelay\Core\DataDispatcher\DataDispatcher;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CsvDataDispatcher extends DataDispatcher
{
    /**
     * @var string
     */
    private string $file;

    /**
     * @var string
     */
    private string $delimiter;

    /**
     * @var string
     */
    private string $enclosure;

    /**
     * @param string $file
     * @return void
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * @param string $delimiter
     * @return void
     */
    public function setDelimiter(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * @param string $enclosure
     * @return void
     */
    public function setEnclosure(string $enclosure)
    {
        $this->enclosure = $enclosure;
    }


    public function send(array $data)
    {
        $result = true;

        $this->logger->debug('CSV send() data', $data);

        $filePath = \TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $this->file;

        // Safety check: make sure file ends with .csv
        $path_parts = pathinfo($filePath);
        if ($path_parts['extension'] !== 'csv') {
            $filePath .= '.csv';
        }

        // Make sure upload folder exists
        $dirPath = $path_parts['dirname'];
        if (!file_exists($dirPath)) {
            GeneralUtility::mkdir_deep($dirPath);
            $this->logger->debug('Created upload folder for CSV on: ' . $dirPath);
        }

        if ($csvFile = fopen($filePath, 'a')) {
            if (filesize($filePath) == 0) {
                // Excel needs BOM to understand utf-8 encoding
                fprintf($csvFile, chr(0xEF).chr(0xBB).chr(0xBF));
                // Add Header row
                fputcsv($csvFile, array_keys($data), $this->delimiter, $this->enclosure);
            }
            // Add content row
            fputcsv($csvFile, array_values($data), $this->delimiter, $this->enclosure);
            fclose($csvFile);
        } else {
            if (!is_writable($filePath)) {
                $this->logger->error('CSV file is not writeable on: ' . $filePath);
            }
            $this->logger->error('Error writing CSV file on: ' . error_get_last());
            $result = false;
        }
        return $result;
    }
}
