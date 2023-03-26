<?php
require_once('FileUploadProc.php');
$upload = new FileUploadProc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['pdf'];
    $fileName = $_POST['file_name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];

    $message = $upload->uploadFile($fileName, $fileTmpName, $fileSize);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <!-- should it be... <form action="" method="post" enctype="application/pdf"> -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="file_name" placeholder="Enter file name" required><br>
        <input type="file" name="pdf" required><br>
        <input type="submit" value="Upload PDF">
    </form>
    <?php
    if (isset($message)) {
        echo "<p>{$message}</p>";
    }
    ?>
</body>
</html>