<?php
require('connect.php');

$response = array();

if (!empty($_POST['orderID']) && !empty($_POST['orderType'])) {
    $order_id = $_POST['orderID'];

    $result = mysqli_query($con, "SELECT * FROM 'c_produit_has_commandeachat' WHERE CommandeAchat_ID = $order_id") or die(mysql_error());
    $response["success"] = 1;
    $response["purchase"] = array();

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $Facts = array();
            $Facts["productID"] = $row[0];
            $Facts["orderID"] = $row[1];
            $Facts["supplierID"] = $row[2];
            $Facts["quantity"] = $row[3];
            $Facts["priceTTC"] = $row[5];

            array_push($response["purchase"], $Facts);
        }
    }

} else {
    $response["erreur"] = "Missing request params !";
    $response["success"] = -1;
}

echo json_encode($response);
mysqli_close($con);
?>