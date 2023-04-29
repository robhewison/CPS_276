<?php
// Include the PdoMethods class
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";

// Initialize variables for the form fields
$name = "";
$email = "";
$password = "";
$status = "";

$nameError = "";
$emailError = "";
$passwordError = "";
$statusError = "";

function emailExists($email, $pdo) {
    $sql = "SELECT COUNT(*) as count FROM admins WHERE email = :email";
    $bindings = [
        [':email', $email, 'str']
    ];
    $result = $pdo->otherBinded($sql, $bindings);

    if (is_string($result)) {
        // If there is an error with the query, return an empty string
        return "";
    } elseif ($result[0]['count'] > 0) {
        return "This email address is already in use.";
    } else {
        return "";
    }
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data from the POST request
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $status = $_POST["status"];

    $validate = new Validation();
    $pdo = new PdoMethods();

    $nameError = $validate->checkFormat($name, "name");
    $emailError = $validate->checkFormat($email, "email") ?: emailExists($email, $pdo);
    $passwordError = $validate->checkFormat($password, "password");

    if (!$nameError && !$emailError && !$passwordError) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $pdo = new PdoMethods();

        $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

        $bindings = [
            [":name", $name, "str"],
            [":email", $email, "str"],
            [":password", $hashed_password, "str"],
            [":status", $status, "str"],
        ];

        $result = $pdo->otherBinded($sql, $bindings);

            // Check the result of the SQL query
        if ($result == "noerror") {
            //echo "Admin has been added successfully!";
            $successMessage = "Admin has been added successfully!";
        } else {
        echo "There was an error adding the admin.";
        }
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
        <?php echo get_nav(); ?>
        <h1>Add Admin</h1>

        <?php if (isset($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <form action="index.php?page=addAdmin" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                <span class="text-danger"><?php echo $passwordError; ?></span>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="staff" <?php echo ($status == "staff") ? "selected" : ""; ?>>Staff</option>
                    <option value="admin" <?php echo ($status == "admin") ? "selected" : ""; ?>>Admin</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add Admin</button>
        </form>
    </div>
</body>
</html>