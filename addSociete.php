<?php
require('connect.php');

$response = array();
if(!empty($_POST['Nom']) && !empty($_POST['Logo'])){

	$nom = $_POST['Nom'];

	define('UPLOAD_DIR', 'logo_s/');
	$img = $_POST['Logo'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$photo='logo_'.rand().'.png';
	$file = UPLOAD_DIR .$photo;
	$success = file_put_contents($file, $data);


	  $sql = "insert into société (Nom_S,Logo) values ('$nom','$photo')";
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