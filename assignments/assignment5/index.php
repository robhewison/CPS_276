<?php

require_once('Directories.php');

$dirname = '';
$content = '';
$message = '';
$filepath = '';

 // check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the directory name and file content from the form
    $dirname = $_POST['dirname'];
    $content = $_POST['content'];

    // create a new Directories object
    $dir = new Directories();

    // create the directory and file
    $result = $dir->createDirectoryAndFile($dirname, $content);

    // check the result of the createDirectoryAndFile method
    if ($result === true) {
        // success message and link to the file
        $message = 'Directory and file created successfully.';
        $filepath = 'directories/' . $dirname . '/readme.txt';
    } elseif ($result === 'exists') {
        // directory already exists message
        $message = 'A directory already exists with that name.';
    } else {
        // error message
        $message = 'An error occurred while creating the directory and file.';
     }
 }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment 5</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>File and Directory Assignment</h1>
            <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>

            <?php if (!empty($message)) { ?>
            <p><?php echo $message; ?></p>
            <?php } ?>

            <?php if (!empty($filepath)) { ?>
            <p><a href="<?php echo $filepath; ?>" target="_blank">Path where file is located</a></p>
            <?php } ?>

            <form method="post">
                <label for="dirname" class="form-label">Folder Name</label>
                <input type="text" id="dirname" name="dirname" class="form-control" value="<?php echo htmlspecialchars($dirname); ?>" required>
                <br>
                <label for="content" class="form-label">File Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" cols="30"><?php echo htmlspecialchars($content); ?></textarea>
                <br>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </body>
</html>

