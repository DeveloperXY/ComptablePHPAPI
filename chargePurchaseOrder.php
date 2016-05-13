<?php
require('connect.php');

$response = array();
if (!empty($_POST['factureID'])) {
    $facture_id = $_POST['factureID'];

    $sql = "UPDATE `c_commandeachat` SET `facture`=1 WHERE ID=$facture_id";
    if (mysqli_query($con, $sql)) {
        $response["success"] = 1;
    } else {
        $response["success"] = 0;
    }

} else {
    $response["erreur"] = "tous les champs sont obligatoire !";
    $response["success"] = -1;
}
echo json_encode($response);
mysqli_close($con);
?>