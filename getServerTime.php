<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')") or die(mysql_error());
if (mysqli_num_rows($result) > 0) {
    $response["date"] = mysqli_fetch_array($result)[0];
} else {
    $response["date"] = "error";
}

echo json_encode($response);
mysqli_close($con);
?>