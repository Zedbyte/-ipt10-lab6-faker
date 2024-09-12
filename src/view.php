<?php

require 'FileUtility.php';

// Initialize FileUtility with the path to the CSV file
$fileUtility = new FileUtility('persons.csv');

try {
    // Read data from the file
    $data = $fileUtility->readFile();
} catch (\RuntimeException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}   

// Check if data is not empty
if (empty($data)) {
    echo 'No data available.';
    exit;
}

// Extract header and rows
$header = array_shift($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Data Viewer</title>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    >
</head>
<body>
    <h1>CSV Data Viewer</h1>
    <table>
        <thead data-theme="light">
            <tr>
                <?php foreach ($header as $column): ?>
                    <th><?php echo htmlspecialchars($column); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?php echo htmlspecialchars($cell); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>