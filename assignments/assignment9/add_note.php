<?php
require_once 'Date_time.php';
$dt = new Date_time();
$message = $dt->checkSubmit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <h1>Add Note</h1>
    <?php echo $message; ?>
    <br>
    <a href="display_notes.php">Display Notes</a>
    <br>
    <br>
    <form method="post" action="add_note.php">
        <label for="dateTime">Date and Time</label>
        <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
        <br>
        <label for="note">Note</label>
        <textarea class="form-control" style="height: 500px;" id="note" name="note"></textarea>
        <br>
        <input class="btn btn-primary" type="submit" name="addNote" value="Add Note">
    </form>
    </div>
</body>
</html>