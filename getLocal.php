<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT * from c_locale ORDER BY id DESC") or die(mysql_error());
$response["success"] = 1;
if (mysqli_num_rows($result) > 0) {
    $response["local"] = array();
    while ($row = mysqli_fetch_array($result)) {
        $Facts = array();
        $Facts["idlocal"] = $row[0];
        $Facts["adresse"] = $row[1];
        $Facts["ville"] = $row[2];
        $Facts["pays"] = $row[3];
        $Facts["tel"] = $row[4];
        $Facts["fix"] = $row[5];
        $Facts["fax"] = $row[6];
        $Facts["email"] = $row[7];
        $Facts["activite"] = $row[8];
        $Facts["ids"] = $row[9];

        array_push($response["local"], $Facts);
    }
} else {
    $response["success"] = 0;
}


echo json_encode($response);
mysqli_close($con);
?>