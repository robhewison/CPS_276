<?php
require_once "../classes/Pdo_methods.php";

$response = array();

//clears the table without deleting it (truncate)
$pdo = new PdoMethods();
$sql = "TRUNCATE TABLE names";
$result = $pdo->otherNotBinded($sql);

if ($result === 'noerror') {
    $response['masterstatus'] = 'success';
    $response['msg'] = 'All names were deleted';
} else {
    $response['masterstatus'] = 'error';
    $response['msg'] = 'Failed to delete names';
}

echo json_encode($response);
?>