<?php
require_once "Pdo_methods.php";

class FileUploadProc extends PdoMethods {
    public function uploadFile($fileName, $fileTmpName, $fileSize) {
        if ($fileSize <= 100000 && mime_content_type($fileTmpName) === "application/pdf") {
            $fileDestination = "/home/r/w/rwhewison/public_html/CPS_276/assignments/assignment7/uploads/" . $fileName;
            $sql = "INSERT INTO pdf_files (file_name, file_path) VALUES (:file_name, :file_path)";
            $bindings = [
                [':file_name', $fileName, 'str'],
                [':file_path', $fileDestination, 'str']
            ];
            $result = $this->otherBinded($sql, $bindings);

            if ($result === 'error') {
                return 'There was an error uploading the file.';
            } else {
                move_uploaded_file($fileTmpName, $fileDestination);
                return 'File uploaded successfully.';
            }
        } else {
            return 'The file must be a PDF and its size should be under 100000 bytes.';
        }
    }
}