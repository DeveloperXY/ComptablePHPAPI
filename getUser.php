<?php
require('connect.php');

$response = array();

	$result = mysqli_query($con,"SELECT * from utilisateur ORDER BY id DESC") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$response["user"] = array();
		while ($row = mysqli_fetch_array($result)) {
		
			$Facts = array();
			$Facts["iduser"] = $row[0];
			$Facts["nom"] = $row[1];
			$Facts["prenom"] = $row[2];
			$Facts["type"] = $row[3];
			$Facts["dateCreation"] = $row[4];
			$Facts["dateExpiration"] = $row[5];
			$Facts["Usename"] = $row[6];
			$Facts["Password"] = $row[7];
			$Facts["SocieteID"] = $row[8];
			
			array_push($response["user"], $Facts);
		
			}
	  }
	  else{
		$response["success"] = 0;
	  }


  echo json_encode($response);
  mysqli_close($con);
?>