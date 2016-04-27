<?php
require('connect.php');

$response = array();
if(!empty($_POST['ID']) && !empty($_POST['NomPrenom']) && !empty($_POST['Tel']) && !empty($_POST['Adresse'])){
	$id=$_POST['ID'];
	$nom = $_POST['NomPrenom'];
	$tel=$_POST['Tel'];
	$adresse=$_POST['Adresse'];
	$email=$_POST['Email'];
	$sql="UPDATE `c_client` SET `NomPrenom`='$nom',`Tel`='$tel',`Adresse`='$adresse',`Email`='$email' WHERE ID=$id";
	  if(mysqli_query($con,$sql)){
			
			$response["success"] = 1;
	  }
	  else{
		$response["success"] = 0;
	  }
 	
}else{
	$response["erreur"] = "tous les champs sont obligatoire !";
	$response["success"] = 0;
}
  echo json_encode($response);
  mysqli_close($con);
?>