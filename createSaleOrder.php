<?php
require('connect.php');

$response = array();
if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $obj = json_decode($data);
    $response = [];
    $total = 0;

    // Calculate the total price of this sale order
    foreach ($obj as $product) {
        // priceTTC represents the product's priceTTC multiplied by its quantity
        $total += (floatval($product->priceTTC));
    }

    $sql = "INSERT INTO c_commandevente VALUES (NULL, NOW(), 1, 'test', $total)";
    if (mysqli_query($con, $sql)) {
        $order_id = $con->insert_id;
        $response["success"] = 1;

        foreach ($obj as $product) {
            $product_id = $product->productID;
            $product_quantity = $product->quantity;
            $product_ht = 0;
            $product_ttc = 0;
            $total = $product->priceTTC;

            $sql = "INSERT INTO c_produit_has_commandevente VALUES ($product_id, $order_id, $product_quantity, $product_ht, $product_ttc, $total)";
            if (mysqli_query($con, $sql)) {
                // Empty for now
            }
            else
                $response["success"] = -1; // -1: for debugging, different error code
        }
    }
    else
        $response["success"] = 0;

    echo json_encode($response);
}
?>