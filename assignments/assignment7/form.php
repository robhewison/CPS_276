<?php
require_once('FileUploadProc.php');

$upload = new FileUploadProc();
$message = $upload->handleUpload();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <h1>File Upload</h1>
        
        <p><a href="listUploaded.php">Show File List</a></p>

        <?php
            if (isset($message)) {
            echo "<p>{$message}</p>";
            }
        ?>

        <!-- should it be... <form action="" method="post" enctype="application/pdf"> -->
        <form action="" method="post" enctype="multipart/form-data">
            <label for="file_name" class="form-label">File Name</label>
            <br>
            <input class="form-control" type="text" name="file_name" placeholder="Enter file name" required>
            <br>
            <input class="form-control" type="file" name="pdf" required>
            <br>
            <input class="btn btn-primary" type="submit" value="Upload File">
        </form>

    </div>
</body>
</html>