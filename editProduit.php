<?php
require('connect.php');

$response = array();
if (!empty($_POST['ID']) && !empty($_POST['Libelle']) && !empty($_POST['PrixHT']) && !empty($_POST['PrixTTC']) && !empty($_POST['CodeBar']) && !empty($_POST['Local']) && isset($_POST['Photo'])) {

    $id = $_POST['ID'];
    $libelle = $_POST['Libelle'];
    $prixHT = $_POST['PrixHT'];
    $prixTTC = $_POST['PrixTTC'];

    $codeBar = $_POST['CodeBar'];
    $qte = $_POST['Qte'];
    $local = $_POST['Local'];
    $img = $_POST['Photo'];

    $rq = mysqli_query($con, "SELECT Photo FROM c_produit WHERE ID=$id");
    $fil = "";
    while ($row = mysqli_fetch_array($rq)) {
        $fil = $row[0];
    }

    $sql = "0";
    if ($img != "") {
        define('UPLOAD_DIR', 'produits/');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $trimmed = str_replace(' ', '', $libelle);
        $photo = $trimmed . '_' . rand() . '.png';
        $file = UPLOAD_DIR . $photo;
        $success = file_put_contents($file, $data);
        unlink("produits/" . $fil);
        $sql = "UPDATE `c_produit` SET `Libelle`='$libelle',`PrixHT`='$prixHT',`PrixTTC`='$prixTTC',`CodeBar`='$codeBar',`Photo`='$photo',`Qte`='$qte',`Locale_ID`='$local' WHERE ID=$id";
    }
    else {
        $sql = "UPDATE `c_produit` SET `Libelle`='$libelle',`PrixHT`='$prixHT',`PrixTTC`='$prixTTC',`CodeBar`='$codeBar',`Qte`='$qte',`Locale_ID`='$local' WHERE ID=$id";
    }

    if (mysqli_query($con, $sql)) {
        $response["success"] = 1;
    } else {
        $response["success"] = 0;
    }

} else {
    $response["erreur"] = "tous les champs  sont obligatoire !";
    $response["success"] = 0;
}
echo json_encode($response);
mysqli_close($con);
?>