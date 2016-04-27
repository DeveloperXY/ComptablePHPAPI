<?php
require('connect.php');

$response = array();
if(!empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['Type']) && !empty($_POST['UserName']) && !empty($_POST['Password']) && !empty($_POST['Societe'])){

	$nom = $_POST['Nom'];
	$prenom=$_POST['Prenom'];
	$type=$_POST['Type'];
	$username = $_POST['UserName'];
	$password=$_POST['Password'];
	$ids=$_POST['Societe'];

	  $sql = "insert into c_utilisateur (`Nom`, `Prenom`, `Type`, `DateCreation`, `DateExpiration`, `UserName`, `Password`, `Société_ID`) values ('$nom','$prenom','$type',now(),'','$username',MD5('".$password."'),'$ids')";
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