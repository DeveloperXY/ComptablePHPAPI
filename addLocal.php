<?php
require('connect.php');

$response = array();
if (!empty($_POST['Adresse']) && !empty($_POST['Tel']) && !empty($_POST['Societe'])) {

    $adresse = $_POST['Adresse'];
    $ville = $_POST['Ville'];
    $pays = $_POST['Pays'];

    $tel = $_POST['Tel'];
    $fix = $_POST['Fix'];
    $fax = $_POST['Fax'];
    $email = $_POST['Email'];
    $activite = $_POST['Activite'];
    $ids = $_POST['Societe'];

    $sql = "insert into locale (`Adresse`, `Ville`, `Pays`, `Tel`, `Fix`, `Fax`, `Email`, `Activite`, `Société_ID`) values ('$adresse','$ville','$pays','$tel','$fix','$fax','$email','$activite','$ids')";
    if (mysqli_query($con, $sql)) {

        $response["success"] = 1;
    } else {
        $response["success"] = 0;
    }

} else {
    $response["erreur"] = "Adresse et Tel  sont obligatoire !";
    $response["success"] = 0;
}
echo json_encode($response);
mysqli_close($con);
?>