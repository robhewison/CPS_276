<?php
//session_start();
require_once "classes/Pdo_methods.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"]) && !empty($_POST["selected_contacts"])) {
        $pdo = new PdoMethods();
        $contactsToDelete = $_POST["selected_contacts"];
        $errors = [];

        foreach ($contactsToDelete as $contactId) {
            $sql = "DELETE FROM contacts WHERE id = :id";
            $bindings = [
                [":id", $contactId, "int"],
            ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result == "error") {
                $errors[] = $contactId;
            }
        }

        if (count($errors) == 0) {
            echo "Contact(s) deleted successfully!";
        } else {
            echo "Could not delete the contacts with IDs: " . implode(", ", $errors);
        }
    }
}

$pdo = new PdoMethods();
$sql = "SELECT * FROM contacts";
$contacts = $pdo->selectNotBinded($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <?php echo get_nav(); ?>
        <h1>Delete Contact(s)</h1>
        <?php if (count($contacts) == 0): ?>
            <p>There are no records to display</p>
        <?php else: ?>
            <form action="deleteContacts.php" method="post">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo $contact["id"]; ?></td>
                                <td><?php echo $contact["name"]; ?></td>
                                <td><?php echo $contact["email"]; ?></td>
                                <td>
                                    <input type="checkbox" name="selected_contacts[]" value="<?php echo $contact["id"]; ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" name="delete" class="btn btn-danger">Delete Selected</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

