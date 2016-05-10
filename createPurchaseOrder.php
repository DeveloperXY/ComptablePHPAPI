<?php
require('connect.php');

$response = array();
if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $obj = json_decode($data);
    $response = array();
    $total = 0;

    // Calculate the total price of this sale order
    foreach ($obj as $product) {
        // priceTTC represents the product's priceTTC multiplied by its quantity
        $total += (floatval($product->priceTTC));
    }

    $sql = "INSERT INTO c_commandeachat VALUES (NULL, NOW(), 0, '', $total)";
    if (mysqli_query($con, $sql)) {
        $order_id = $con->insert_id;

        $facture_id = "FA" .$order_id ."PU";
        $sql = "UPDATE c_commandeachat SET IDFacture = '$facture_id' WHERE ID = $order_id";
        if (mysqli_query($con, $sql)) {
            $response["success"] = 1;

            foreach ($obj as $product) {
                $product_id = $product->productID;
                $product_quantity = $product->quantity;
                $product_ht = 0;
                $product_ttc = $product->priceTTC;
                $product_supplier = $product->supplier;
                $total = 0;

                $sql = "INSERT INTO c_produit_has_commandeachat VALUES ($product_id, $order_id, $product_supplier, $product_quantity, $product_ht, $product_ttc, $total)";
                if (mysqli_query($con, $sql)) {
                    // Empty for now
                }
                else
                    echo mysqli_error($con);
//                    $response["success"] = -1; // -1: for debugging, different error code
            }
        }
        else
//            $response["success"] = -2; // -2: for debugging, different error code
            echo mysqli_error($con);
    }
    else
        $response["success"] = 0;

    echo json_encode($response);
}
?>