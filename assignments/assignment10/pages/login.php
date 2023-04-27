<?php
require_once "Pdo_methods.php";
require_once "Validation.php";

session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] === 'loggedin') {
    header("Location: index.php?page=welcome");
    //header("Location: welcome.php");
    exit;
}

$validator = new Validation();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $emailError = $validator->checkFormat($email, "email");
    $passwordError = $validator->checkFormat($password, "password");

    if ($emailError === '' && $passwordError === '') {
        $pdo = new PdoMethods();
        $sql = "SELECT id, name, status, password FROM admins WHERE email = :email";
        $bindings = [
            [':email', $email, "str"],
        ];
        $result = $pdo->selectBinded($sql, $bindings);

        if ($result != 'error' && !empty($result)) {
            $record = $result[0];
            if (password_verify($password, $record['password'])) {
                $_SESSION['status'] = 'loggedin';
                $_SESSION['name'] = $record['name'];
                $_SESSION['user_status'] = $record['status'];
                header("Location: welcome.php");
                exit;
            } else {
                $message = "Invalid email or password.";
            }
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Invalid email or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form action="login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>" required><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>