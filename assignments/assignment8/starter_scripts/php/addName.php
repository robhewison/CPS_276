<?php
require_once "../classes/Pdo_methods.php";

$response = array();

if (isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);
    if (isset($data['name'])) {
        $fullName = $data['name'];
        $nameParts = explode(" ", $fullName);
        $formattedName = $nameParts[1] . ", " . $nameParts[0];

        // Insert into database
        $pdo = new PdoMethods();
        $sql = "INSERT INTO names (name) VALUES (:name)";
        $bindings = array(
            array(':name', $formattedName, 'str')
        );
        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'noerror') {
            $response['masterstatus'] = 'success';
            $response['msg'] = 'Name added successfully';
        } else {
            $response['masterstatus'] = 'error';
            $response['msg'] = 'Failed to add name';
        }
    } else {
        $response['masterstatus'] = 'error';
        $response['msg'] = 'Name is missing';
    }
} else {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Invalid request';
}

echo json_encode($response);

?>