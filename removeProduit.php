<?php
require('connect.php');

$response = array();
if (!empty($_POST['ID'])) {

    $id = $_POST['ID'];
    $rq = mysqli_query($con, "SELECT Photo FROM c_produit WHERE ID=$id");
    $file = "";
    while ($row = mysqli_fetch_array($rq)) {
        $file = $row[0];
    }

    // Remove product from order history, we can use ON CASCADE instead
    $sql = "DELETE FROM `c_produit_has_commandeachat` WHERE Produit_ID = $id";
    if (mysqli_query($con, $sql)) {
        $sql = "DELETE FROM `c_produit_has_commandevente` WHERE ID = $id";
        if (mysqli_query($con, $sql)) {
            $sql = "DELETE FROM c_produit WHERE ID = $id";
            if (mysqli_query($con, $sql)) {
                unlink("produits/" . $file);
                $response["success"] = 1;
            } else {
                $response["success"] = -1;
            }
        } else {
            $response["success"] = -2;
        }
    } else {
        $response["success"] = -3;
    }

} else {
    $response["erreur"] = "tous les champs  sont obligatoire !";
    $response["success"] = -4;
}
echo json_encode($response);
mysqli_close($con);
?>