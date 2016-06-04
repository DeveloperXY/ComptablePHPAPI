<?php
require('connect.php');

$response = array();

if (isset($_POST['data']) && isset($_POST['qteData']) && isset($_POST['localeID'])) {
    $data = $_POST['data'];
    $qteData = $_POST['qteData'];
    $id = $_POST['localeID'];
    $PRODUCTS_QTE_IS_OK = true;

    // Remove all trailing backslashes
    $obj = json_decode(str_replace("\\", "", $data));
    $qte_obj = json_decode(str_replace("\\", "", $qteData));

    $response["message"] = array();

    for ($i = 0; $i < count($qte_obj); $i++) {
        $product_id = $qte_obj[$i]->productID;
        $result = mysqli_query($con,
            "SELECT qte from c_produit WHERE ID = $product_id") or die(mysql_error());

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $actual_qte = $row[0];

                if ($actual_qte < $qte_obj[$i]->quantity) {
                    $data = array();
                    $data["text"] = "Product: " .$qte_obj[$i]->label ." - Actual quantity: "
                        .$actual_qte ." - Desired quantity: " .$qte_obj[$i]->quantity;
                    array_push($response["message"], $data);

                    $PRODUCTS_QTE_IS_OK = false;
                }
            }
        }
    }

    // If there was no problem with the required product quantities
    if ($PRODUCTS_QTE_IS_OK) {
        $order_total = 0;

        // Calculate the total price of this sale order
        foreach ($obj as $product) {
            // priceTTC represents the product's priceTTC multiplied by its quantity
            $order_total += (floatval($product->priceTTC));
        }

        $sql = "INSERT INTO c_commandevente VALUES (NULL, NOW(), 0, '', $order_total, $id)";
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
                        $sql = "UPDATE c_produit SET qte = qte - $product_quantity WHERE ID = $product_id";
                        if (mysqli_query($con, $sql)) {
                            $sql = "INSERT INTO c_payement_client VALUES ($order_id, 0, 'Especes', $order_total, NOW())";
                            if (mysqli_query($con, $sql)) {

                            }
                            else
                                $response["success"] = -5;
                        } else {
                            echo mysqli_error($con);
                            $response["success"] = -1;
                        }
                    }
                    else
                        $response["success"] = -2;
                }
            }
            else
                $response["success"] = -3;
        }
        else
            $response["success"] = 0;
    }
    else
        $response["success"] = -4;

    echo json_encode($response);
    mysqli_close($con);
}
?>