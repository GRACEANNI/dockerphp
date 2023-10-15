<?php

$pathdir = "/app";
  
// Enter the name to creating zipped directory 
$zipcreated = "dumpdump.zip"; 
  
// Create new zip class 
$zip = new ZipArchive; 
   
if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) { 
      
    // Store the path into the variable 
    $dir = opendir($pathdir); 
       
    while($file = readdir($dir)) { 
        if(is_file($pathdir.$file)) { 
          if($pathdir.$file=="dumpdump.zip")continue;
            $zip -> addFile($pathdir.$file, $file); 
        } 
    } 
    $zip ->close(); 
} 

    if(file_exists($zipcreated)) {
        // push to download the zip
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename=file.zip');
        header('Content-Length: ' . filesize($tmpFile));
        readfile($zipcreated);
        // remove zip file is exists in temp path
        unlink($zipcreated);
    } else {
        exit("Error finding file.");
    }
  
