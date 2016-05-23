<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT * from c_fournisseur ORDER BY ID DESC") or die(mysql_error());

$response["success"] = 1;
$response["fournisseur"] = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $Facts = array();
        $Facts["idfournisseur"] = $row[0];
        $Facts["nom"] = $row[1];
        $Facts["adresse"] = $row[2];
        $Facts["tel"] = $row[3];
        $Facts["fix"] = $row[4];
        $Facts["fax"] = $row[5];
        $Facts["email"] = $row[6];

        array_push($response["fournisseur"], $Facts);
    }
}


echo json_encode($response);
mysqli_close($con);
?>