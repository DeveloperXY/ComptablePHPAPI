<?php
require('connect.php');

$response = array();

if(!empty($_POST['serial'])){
    $code = $_POST['serial'];
    
    $result = mysqli_query($con, "SELECT * from c_activation WHERE code LIKE '$code'") or die(mysql_error());
    if (mysqli_num_rows($result) > 0) {
        $response["success"] = 1;
        while ($row = mysqli_fetch_array($result)) {
            $status = $row[2];
            $response["activationStatus"] = $status == "oui" ? 1 : 0;
        }
    } else {
        $response["success"] = 0;
    }

}else{
    $response["error"] = "You need to provide a serial parameter.";
    $response["success"] = -1;
}


echo json_encode($response);
mysqli_close($con);
?>