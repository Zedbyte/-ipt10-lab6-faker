<?php

class FileUtility
{
    private $filePath;
    private $fileHandle;
    private $headerWritten = false;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function openFile()
    {
        // Open the file for reading and writing (create if not exists, and allow reading)
        $this->fileHandle = fopen($this->filePath, 'c+');
        return $this->fileHandle !== false;
    }

    private function headerExists()
    {
        if ($this->fileHandle === null) {
            throw new \RuntimeException('File is not open. Please open the file before checking for headers.');
        }

        // Move to the start of the file
        rewind($this->fileHandle);

        // Read the first line
        $headerLine = fgets($this->fileHandle);

        // Define the expected header
        $expectedHeader = [
            'UUID',
            'Title',
            'First Name',
            'Last Name',
            'Street Address',
            'Barangay',
            'Municipality',
            'Province',
            'Country',
            'Phone Number',
            'Mobile Number',
            'Company Name',
            'Company Website',
            'Job Title',
            'Favorite Color',
            'Birthdate',
            'Email Address',
            'Password',
        ];

        return trim($headerLine) === implode(',', $expectedHeader);
    }

    public function writeHeader()
    {
        if ($this->fileHandle === null) {
            throw new \RuntimeException('File is not open. Please open the file before writing.');
        }

        if ($this->headerExists()) {
            $this->headerWritten = true;
            return true; // Header already exists, no need to write
        }

        // Define the CSV header
        $header = [
            'UUID',
            'Title',
            'First Name',
            'Last Name',
            'Street Address',
            'Barangay',
            'Municipality',
            'Province',
            'Country',
            'Phone Number',
            'Mobile Number',
            'Company Name',
            'Company Website',
            'Job Title',
            'Favorite Color',
            'Birthdate',
            'Email Address',
            'Password',
        ];

        $this->headerWritten = true;
        return fputcsv($this->fileHandle, $header) !== false;
    }

    public function writeFile($data)
    {
        if ($this->fileHandle === null) {
            throw new \RuntimeException('File is not open. Please open the file before writing.');
        }

        if (!$this->headerWritten) {
            $this->writeHeader();
        }

        return fputcsv($this->fileHandle, $data) !== false;
    }

    public function closeFile()
    {
        if ($this->fileHandle === null) {
            throw new \RuntimeException('File is not open. Nothing to close.');
        }

        $result = fclose($this->fileHandle);
        $this->fileHandle = null;
        return $result;
    }

    public function readFile()
    {
        if (!file_exists($this->filePath)) {
            throw new \RuntimeException('File does not exist.');
        }

        $data = [];
        if (($handle = fopen($this->filePath, 'r')) !== false) {
            // Read header
            $header = fgetcsv($handle);
            $data[] = $header;

            // Read data rows
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = $row;
            }

            fclose($handle);
        }
        return $data;
    }
}