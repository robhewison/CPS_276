<?php
// Include the PdoMethods class
require_once "classes/Pdo_methods.php";

// Initialize variables for the form fields
$name = "";
$email = "";
$password = "";
$status = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data from the POST request
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $status = $_POST["status"];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create an instance of the PdoMethods class
    $pdo = new PdoMethods();

    // Create SQL query to insert the new admin into the database
    $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

    // Create bindings array for the SQL query
    $bindings = [
        [":name", $name, "str"],
        [":email", $email, "str"],
        [":password", $hashed_password, "str"],
        [":status", $status, "str"],
    ];

    // Execute the SQL query using the PdoMethods class
    $result = $pdo->otherBinded($sql, $bindings);

    // Check the result of the SQL query
    if ($result == "noerror") {
        echo "Admin has been added successfully!";
    } else {
        echo "There was an error adding the admin.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Add Admin</h1>
        <form action="addAdmin.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="staff" <?php echo ($status == "staff") ? "selected" : ""; ?>>Staff</option>
                    <option value="admin" <?php echo ($status == "admin") ? "selected" : ""; ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Admin</button>
        </form>
    </div>
</body>
</html>