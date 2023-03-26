<?php




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Add Names</h1>
        <form action="" method="post">
            <input type="submit" class="btn btn-primary" name="add_name" value="Add Name">
            <input type="submit" class="btn btn-primary" name="clear_names" value="Clear Names">
            <br>
            <label for="name" class="form-label">Enter Name</label>
            <br>
            <input type="text" class="form-control" name="name">
            <br>
        </form>
        <label for="namelist" class="form-label">List of Names</label>
        <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php if(isset($output)) { echo $output; } ?></textarea>
    </div>
</body>
</html>