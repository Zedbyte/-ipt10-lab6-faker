<?php 

require_once "FileUtility.php";
require_once "Random.php";

$file = new FileUtility("persons.csv");
$file->openFile();

$random = new Random();
$data = $random->generateRandom(300);

if ($file->openFile()) {
    foreach ($data as $row) {
        // Write each row of data to the file
        if (!$file->writeFile($row)) {
            echo "Failed to write data.";
            break;
        }
    }

    $file->closeFile();

    echo "Data written successfully.";
} else {
    echo "Failed to open the file.";
}