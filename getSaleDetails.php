<?php
require('connect.php');

$response = array();

if (!empty($_POST['orderID'])) {
    $order_id = $_POST['orderID'];

    $result = mysqli_query($con, "SELECT * FROM c_produit_has_commandevente WHERE CommandeVente_ID = $order_id") or die(mysql_error());
    $response["success"] = 1;
    $response["sale"] = array();

    if (mysqli_num_rows($result) > 0) {
        $response["sale"] = array();

        while ($row = mysqli_fetch_array($result)) {
            $Facts = array();
            $Facts["productID"] = $row[0];
            $Facts["orderID"] = $row[1];
            $Facts["quantity"] = $row[2];
            $Facts["priceTTC"] = $row[4];

            array_push($response["sale"], $Facts);
        }
    }

} else {
    $response["erreur"] = "Missing request params !";
    $response["success"] = -1;
}

echo json_encode($response);
mysqli_close($con);
?>