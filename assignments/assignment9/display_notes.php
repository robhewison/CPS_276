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
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <h1>Display Notes</h1>
    <a href="add_note.php">Add Note</a>
    <form method="post" action="display_notes.php">
        <label for="begDate">Beginning Date</label>
        <input type="date" class="form-control" id="begDate" name="begDate">
        <br>
        <label for="endDate">Ending Date</label>
        <input type="date" class="form-control" id="endDate" name="endDate">
        <br>
        <input class="btn btn-primary" type="submit" name="getNotes" value="Get Notes">
    </form>
    <br>
    <?php echo $message; ?>
    </div>
</body>
</html>