<?php
require('connect.php');

$response = array();

if (!empty($_POST['orderID'])) {
    $order_id = $_POST['orderID'];

    $result = mysqli_query($con, "SELECT * FROM c_produit_has_commandevente WHERE CommandeVente_ID = $order_id") or die(mysql_error());
    $response["success"] = 1;
    $response["orderDetails"] = array();

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $Facts = array();
            $product_id = $row[0];
            $Facts["productID"] = $product_id;
            $Facts["quantity"] = $row[2];
            $Facts["priceTTC"] = $row[4];

            $res = mysqli_query($con, "SELECT Libelle, Photo FROM c_produit WHERE ID = $product_id") or die(mysql_error());
            if (mysqli_num_rows($res) > 0) {
                while ($r = mysqli_fetch_array($res)) {

                    $Facts["productName"] = $r[0];
                    $Facts["productImage"] = $r[1];
                }
            }

            array_push($response["orderDetails"], $Facts);
        }
    }

} else {
    $response["erreur"] = "Missing request params !";
    $response["success"] = -1;
}

echo json_encode($response);
mysqli_close($con);
?>