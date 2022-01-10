<?php
    $fileTypes = array('txt', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'png', 'mp3', 'mp4', 'pdf', 'rar', 'zip');
    $fileLimit = 524288000; //500 MB = 524288000 Bytes

    $uploadFolder = './uploads';
    if (!file_exists($uploadFolder)) {
       mkdir($uploadFolder);
    }
    
    if (empty($_POST['page'])) {   
        die('Can not sent response');
    } else {
        $previousPage = $_POST['page'];
    }

    if (empty($_POST['upload-name'])) {
        die("Please select the file name");
    } else if (empty($_FILES['upload-file'])) {
        die("Please select the file to upload");
    } else if ($_FILES["upload-file"]['error'] != 0) {
        die("An error occured while uploading file");
    } else {
        $name = basename($_FILES["upload-file"]["name"]);
        $uploadFilePath = "$uploadFolder/$name";

        $uploadFileType = pathinfo($uploadFilePath, PATHINFO_EXTENSION);
        if (file_exists($uploadFilePath)) {
            die("This file already exists");
        } else if ($_FILES["upload-file"]['size']>$fileLimit) {
            die("File exceeds the maximum allowed size");
        } else if (!in_array($uploadFileType, $fileTypes)) {
            die("This file type is not allowed");
            exit;
        }

        $name = $_POST['upload-name'];
        $oldNameFilePath = $uploadFilePath;
        $newNameFilePath = "$uploadFolder/$name";
        
        $file_extension = pathinfo($oldNameFilePath, PATHINFO_EXTENSION);
        $newfile = "$newNameFilePath" . "." . "$file_extension";
        if (file_exists($newfile)) {
            die("This file name already exists");
        }
        move_uploaded_file($_FILES["upload-file"]["tmp_name"], $uploadFilePath);
        rename("$oldNameFilePath", "$newNameFilePath.$file_extension");
        die("Upload successful");
    }
?>