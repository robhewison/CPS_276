<?php
require_once "classes/Pdo_methods.php";
require_once "classes/Validation.php";

//session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] === 'loggedin') {
    header("Location: index.php?page=welcome");
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
                header("Location: index.php?page=welcome"); 
                exit;
            } else {
                $_SESSION['message'] = "Invalid email or password.";
            }
        } else {
            $_SESSION['message'] = "Invalid email or password.";
        }
    } else {
        $_SESSION['message'] = "Invalid email or password.";
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
    <div class="container">
    <h1>Login</h1>
    <?php if (isset($_SESSION['message'])) echo "<p>" . $_SESSION['message'] . "</p>"; ?>
    <form action="index.php?page=login" method="post">
        <label for="email" class="form-label">Email</label><br>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo isset($email) ? $email : 'rwhewison@admin.com'; ?>" required><br>
        <label for="password" class="form-label">Password</label><br>
        <input type="password" name="password" class="form-control" id="password" value="<?php echo isset($password) ? $password : 'password'; ?>" required><br>
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
    </div>
</body>
</html>