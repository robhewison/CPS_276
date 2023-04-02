<?php
require_once '../classes/Pdo_methods.php';

$response = [];

// Retrieve all names from the database
$pdo = new PdoMethods();
$sql = 'SELECT name FROM names ORDER BY name ASC';
$records = $pdo->selectNotBinded($sql);

if ($records == 'error') {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Failed to retrieve names.';
} else {
    $response['masterstatus'] = 'success';
    $response['names'] = '<p>' . implode('</p><p>', array_column($records, 'name')) . '</p>';
}

echo json_encode($response);