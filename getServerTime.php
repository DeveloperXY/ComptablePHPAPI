<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')") or die(mysql_error());
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $response["date"] = $row[0];
    $response["success"] = 1;
} else {
    $response["date"] = "error";
    $response["success"] = 0;
}

echo json_encode($response);
mysqli_close($con);
?>