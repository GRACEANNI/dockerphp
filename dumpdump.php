<?php

$rootPath = realpath('./');
$zipcreated = 'dumpdump.zip'; 
// Initialize archive object
$zip = new ZipArchive();
$zip->open($zipcreated, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir() && $file!=$zipcreated)
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();


if(file_exists($zipcreated)) {
	// push to download the zip
	header('Content-type: application/zip');
	header('Content-Disposition: attachment; filename=dump.zip');
	header('Content-Length: ' . filesize($zipcreated));
	
	readfile($zipcreated);
	
	// remove zip file is exists in temp path
	unlink($zipcreated);
	exit;
} else {
	exit("Error zip file.");
    }
  
