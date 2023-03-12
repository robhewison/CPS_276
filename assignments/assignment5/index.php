<?php

 // include the Directories class
require_once('Directories.php');

 // initialize variables
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
<html>
    <head>
        <title>Assignment 5</title>
    </head>
    <body>
        <h1>File and Directory Assignment</h1>

        <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
        <?php } ?>

        <form method="post">
            <label for="dirname">Folder Name</label>
            <input type="text" id="dirname" name="dirname" value="<?php echo htmlspecialchars($dirname); ?>" required>
            <br>
            <label for="content">File Content</label>
            <textarea id="content" name="content" rows="5" cols="30"><?php echo htmlspecialchars($content); ?></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>

    <?php if (!empty($filepath)) { ?>
        <p><a href="<?php echo $filepath; ?>" target="_blank">Path where file is located</a></p>
    <?php } ?>

    </body>
</html>

