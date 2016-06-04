<?php
require('connect.php');

if (isset($_POST['data']) && isset($_POST['localeID'])) {
    $data = $_POST['data'];
    $id = $_POST['localeID'];

    // Remove all trailing backslashes
    $obj = json_decode(str_replace("\\", "", $data));

    $response = array();
    $order_total = 0;
    // Calculate the total price of this sale order
    for ($i = 0; $i < count($obj); $i++) {
        // priceTTC represents the product's priceTTC multiplied by its quantity
        $order_total += (floatval($obj[$i]->priceTTC));
    }

    $sql = "INSERT INTO c_commandeachat VALUES (NULL, NOW(), 0, '', $order_total, $id)";
    if (mysqli_query($con, $sql)) {
        $order_id = $con->insert_id;

        $facture_id = "FA" . $order_id . "PU";
        $sql = "UPDATE c_commandeachat SET IDFacture = '$facture_id' WHERE ID = $order_id";
        if (mysqli_query($con, $sql)) {
            $response["success"] = 1;

            for ($i = 0; $i < count($obj); $i++) {
                $product_id = $obj[$i]->productID;
                $product_quantity = $obj[$i]->quantity;
                $product_ht = 0;
                $product_ttc = $obj[$i]->priceTTC;
                $product_supplier = $obj[$i]->supplier;
                $total = 0;
                $sql = "INSERT INTO c_produit_has_commandeachat VALUES (NULL, $product_id, $order_id, $product_supplier, $product_quantity, $product_ht, $product_ttc, $total)";
                if (mysqli_query($con, $sql)) {
                    $sql = "UPDATE c_produit SET qte = qte + $product_quantity WHERE ID = $product_id";
                    if (mysqli_query($con, $sql)) {
                        $sql = "INSERT INTO c_facture_fournisseur VALUES ($order_id, $product_supplier, 'Especes', $order_total, NOW())";
                        if (mysqli_query($con, $sql)) {

                        } else {
                            $response["success"] = -2;
                        }
                    } else {
                        echo mysqli_error($con);
                        $response["success"] = -1;
                    }
                } else {
                    $response["success"] = -2;
                }
            }
        } else {
            $response["success"] = -3;
        }
    } else {
        $response["success"] = 0;
    }

    echo json_encode($response);
    mysqli_close($con);
}
?>