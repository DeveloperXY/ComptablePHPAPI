<?php
require('connect.php');

$response = array();
if (!empty($_POST['Description']) && !empty($_POST['Prix']) && !empty($_POST['Local'])) {

    $description = $_POST['Description'];
    $prix = $_POST['Prix'];
    //$date=$_POST['Date'];
    $local = $_POST['Local'];

    $sql = "insert into c_charge (`Description`, `Prix`, `Date`, `Locale_ID`) values ('$description','$prix',now(),'$local')";
    if (mysqli_query($con, $sql))
        $response["success"] = 1;
    else
        $response["success"] = 0;

} else {
    $response["erreur"] = "tous les champs sont obligatoire !";
    $response["success"] = 0;
}
echo json_encode($response);
mysqli_close($con);
?>