<?php
require('connect.php');

$response = array();

if (isset($_POST["localeID"])) {
    $locale_id = $_POST["localeID"];
    $result = mysqli_query($con, "SELECT * from c_charge WHERE locale_id = $locale_id ORDER BY date DESC") or die(mysql_error());
    $response["success"] = 1;
    $response["charge"] = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $Facts = array();
            $Facts["idcharge"] = $row[0];
            $Facts["description"] = $row[1];
            $Facts["prix"] = $row[2];
            $Facts["date"] = $row[3];
            $Facts["local"] = $row[4];
            array_push($response["charge"], $Facts);
        }
    }
}
else
    $response["success"] = 0;

echo json_encode($response);
mysqli_close($con);
?>