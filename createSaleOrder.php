<?php
require('connect.php');

if (isset($_POST['data']) && isset($_POST['localeID'])) {
    $data = $_POST['data'];
    $id = $_POST['localeID'];

    // Remove all trailing backslashes
    $obj = json_decode(str_replace("\\", "", $data));

    $response = array();
    $total = 0;

    // Calculate the total price of this sale order
    foreach ($obj as $product) {
        // priceTTC represents the product's priceTTC multiplied by its quantity
        $total += (floatval($product->priceTTC));
    }

    $sql = "INSERT INTO c_commandevente VALUES (NULL, NOW(), 0, '', $total, $id)";
    if (mysqli_query($con, $sql)) {
        $order_id = $con->insert_id;

        $facture_id = "FA" .$order_id ."SA";
        $sql = "UPDATE c_commandevente SET IDFacture = '$facture_id' WHERE ID = $order_id";
        if (mysqli_query($con, $sql)) {
            $response["success"] = 1;

            foreach ($obj as $product) {
                $product_id = $product->productID;
                $product_quantity = $product->quantity;
                $product_ht = 0;
                $product_ttc = $product->priceTTC;
                $total = 0;

                $sql = "INSERT INTO c_produit_has_commandevente VALUES (NULL, $product_id, $order_id, $product_quantity, $product_ht, $product_ttc, $total)";
                if (mysqli_query($con, $sql)) {
                    // Empty for now
                }
                else
                    $response["success"] = -1; // -1: for debugging, different error code
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