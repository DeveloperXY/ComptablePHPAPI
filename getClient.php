<?php
require('connect.php');

$response = array();

	$result = mysqli_query($con,"SELECT * from c_client ORDER BY ID DESC") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		 $response["success"] = 1;
		$response["client"] = array();
		while ($row = mysqli_fetch_array($result)) {
		
			$Facts = array();
			$Facts["idclient"] = $row[0];
			$Facts["nom"] = $row[1];
			$Facts["tel"] = $row[2];
			$Facts["adresse"] = $row[3];
			$Facts["email"] = $row[4];
			
			array_push($response["client"], $Facts);
		
			}
	  }
	  else{
		$response["success"] = 0;
	  }


  echo json_encode($response);
  mysqli_close($con);
?>