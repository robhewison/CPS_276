<?php
require_once "../classes/Pdo_methods.php";

$response = array();

$pdo = new PdoMethods();
$sql = "TRUNCATE TABLE names";
$result = $pdo->otherNotBinded($sql);

if ($result === 'noerror') {
    $response['masterstatus'] = 'success';
    $response['msg'] = 'All names cleared successfully';
} else {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Failed to clear names';
}

echo json_encode($response);
?>