<?php
require('connect.php');

$response = array();
if(!empty($_POST['ID'])){
	
	$id = $_POST['ID'];
	$result = mysqli_query($con,"SELECT * from c_produit WHERE ID =$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		 $response["success"] = 1;
		$response["produit"] = array();
		while ($row = mysqli_fetch_array($result)) {
		
			$Facts = array();
			$Facts["idp"] = $row[0];
			$Facts["libelle"] = $row[1];
			$Facts["prixHT"] = $row[2];
			$Facts["prixTTC"] = $row[3];
			$Facts["codeBar"] = $row[4];
			$Facts["photo"] = $row[5];
			$Facts["qte"] = $row[6];
			$Facts["local"] = $row[7];
			array_push($response["produit"], $Facts);
		
			}
	  }
	  else{
		$response["success"] = 0;
	  }

}else{
	$response["erreur"] = "aucun produit trouvé!";
	$response["success"] = 0;
}
  echo json_encode($response);
  mysqli_close($con);
?>