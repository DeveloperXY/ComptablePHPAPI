<?php
require('connect.php');

$response = array();
if (!empty($_POST['Libelle']) && !empty($_POST['PrixHT']) && !empty($_POST['PrixTTC']) && !empty($_POST['CodeBar']) && !empty($_POST['Local']) && !empty($_POST['Photo'])) {

    $libelle = $_POST['Libelle'];
    $prixHT = $_POST['PrixHT'];
    $prixTTC = $_POST['PrixTTC'];

    $codeBar = $_POST['CodeBar'];
    $qte = $_POST['Qte'];
    $local = $_POST['Local'];


    define('UPLOAD_DIR', 'produits/');
    $img = $_POST['Photo'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    //$trimmed = trim($libelle);
    $trimmed = str_replace(' ', '', $libelle);
    $photo = $trimmed . '_' . rand() . '.png';
    $file = UPLOAD_DIR . $photo;
    $success = file_put_contents($file, $data);

    $sql = "insert into c_produit (`Libelle`, `PrixHT`, `PrixTTC`, `CodeBar`, `Photo`, `Qte`, `Locale_ID`) values ('$libelle','$prixHT','$prixTTC','$codeBar','$photo','$qte','$local')";
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