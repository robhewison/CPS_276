<?php
session_start();

if (!isset($_SESSION["email"]) || $_SESSION["status"] !== "admin") {
    header("Location: index.php?page=login");
    exit();
}

require_once "classes/Pdo_methods.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $idsToDelete = $_POST["delete"];
        $pdo = new PdoMethods();
        $error = false;

        foreach ($idsToDelete as $id) {
            $sql = "DELETE FROM admins WHERE id = :id";
            $bindings = [
                [":id", $id, "int"],
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result == "error") {
                $error = true;
            }
        }

        if ($error) {
            echo "Could not delete the admin(s)";
        } else {
            echo "Admin(s) deleted";
        }
    }
}

$pdo = new PdoMethods();
$admins = $pdo->selectNotBinded("SELECT * FROM admins");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Delete Admins</h1>
        <form action="deleteAdmins.php" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo $admin["name"]; ?></td>
                            <td><?php echo $admin["email"]; ?></td>
                            <td><?php echo $admin["status"]; ?></td>
                            <td>
                                <?php if ($admin["email"] !== $_SESSION["email"]): ?>
                                    <input type="checkbox" name="delete[]" value="<?php echo $admin["id"]; ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger">Delete Selected Admin(s)</button>
        </form>
    </div>
</body>
</html>