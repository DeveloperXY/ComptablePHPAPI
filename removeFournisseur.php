<?php
require('connect.php');

$response = array();
if(!empty($_POST['ID'])){

	$id = $_POST['ID'];

	  $sql = "DELETE FROM `c_fournisseur` WHERE ID=$id";
	  if(mysqli_query($con,$sql)){
			$response["success"] = 1;
	  }
	  else{
		$response["success"] = 0;
		}
 	
}else{
	$response["erreur"] = "tous les champs  sont obligatoire !";
	$response["success"] = 0;
}
  echo json_encode($response);
  mysqli_close($con);
?>