<?php
require('connect.php');

$response = array();
if (!empty($_POST['companyID']) && !empty($_POST['NomPrenom']) && !empty($_POST['Tel']) && !empty($_POST['Adresse'])) {

    $nom = $_POST['NomPrenom'];
    $tel = $_POST['Tel'];
    $adresse = $_POST['Adresse'];
    $email = $_POST['Email'];
    $companyID = $_POST['companyID'];

    $sql = "insert into c_client (NomPrenom,Tel,Adresse,Email,idsociete) values ('$nom','$tel','$adresse','$email', $companyID)";
    if (mysqli_query($con, $sql)) {

        $response["success"] = 1;
    } else {
        $response["success"] = 0;
    }

} else {
    $response["erreur"] = "tous les champs sont obligatoire !";
    $response["success"] = 0;
}
echo json_encode($response);
mysqli_close($con);
?>