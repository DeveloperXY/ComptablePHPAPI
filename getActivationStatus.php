<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT * from c_activation") or die(mysql_error());
if (mysqli_num_rows($result) > 0) {
    $response["success"] = 1;
    $response["activation"] = array();
    while ($row = mysqli_fetch_array($result)) {
        $Facts = array();
        $Facts["id"] = $row[0];
        $Facts["code"] = $row[1];
        $Facts["status"] = $row[2];
        $Facts["companyID"] = $row[3];

        array_push($response["activation"], $Facts);
    }
} else {
    $response["success"] = 0;
}


echo json_encode($response);
mysqli_close($con);
?>