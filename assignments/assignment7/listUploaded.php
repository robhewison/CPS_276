<?php
require_once("ListFilesProc.php");
$listFiles = new ListFilesProc();
$filesList = $listFiles->listFiles();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Uploaded Files</title>
</head>
<body>
    <h1>Uploaded Files</h1>
    <?php
    echo $filesList;
    ?>
</body>
</html