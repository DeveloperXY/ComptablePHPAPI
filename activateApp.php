<?php
require('connect.php');

$response = array();
if (isset($_POST['serial'])) {
    $serial = $_POST['serial'];

    $result = mysqli_query($con, "SELECT * from c_activation WHERE code LIKE '$serial'")
    or die(mysql_error());

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $status = $row[2];

        // Check if this serial key is already used & activated
        if ($status == "oui") {
            $response["success"] = -1;
            $response["message"] = "This serial key is already in use.";
        }
        else {
            $sql = "UPDATE `c_activation` SET `active`='oui' WHERE code LIKE '$serial'";
            if (mysqli_query($con, $sql)) {
                $response["success"] = 1;
                $response["message"] = "The application has been successfully activated.";
                
                $result = mysqli_query($con, "SELECT * from c_activation") or die(mysql_error());
                if (mysqli_num_rows($result) > 0) {
                    $response["activation"] = array();
                    while ($row = mysqli_fetch_array($result)) {
                        $Facts = array();
                        $Facts["id"] = $row[0];
                        $Facts["code"] = $row[1];
                        $Facts["status"] = $row[2];
                        $Facts["companyID"] = $row[3];

                        array_push($response["activation"], $Facts);
                    }
                } 
                
            } else {
                $response["success"] = -2;
                $response["message"] = "Query error.";
            }
        }
    } else {
        $response["success"] = 0;
        $response["message"] = "Your activation code is invalid.";
    }
} else {
    $response["success"] = -3;
    $response["message"] = "You need to provide a 'serial' parameter.";
}

echo json_encode($response);

?>