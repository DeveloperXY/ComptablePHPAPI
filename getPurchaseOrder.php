<?php
require('connect.php');

$response = array();

$result = mysqli_query($con, "SELECT * from c_commandeachat ORDER BY ID DESC") or die(mysql_error());

$response["success"] = 1;
$response["orders"] = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {

        $Facts = array();
        $Facts["id"] = $row[0];
        $Facts["date"] = $row[1];
        $Facts["facture"] = $row[2];
        $Facts["factureID"] = $row[3];
        $Facts["total"] = $row[4];

        array_push($response["orders"], $Facts);
    }
}

echo json_encode($response);
mysqli_close($con);
?>