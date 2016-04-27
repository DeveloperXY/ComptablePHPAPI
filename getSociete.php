<?php
require('connect.php');

$response = array();

	$result = mysqli_query($con,"SELECT * from société ORDER BY id DESC") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$response["societe"] = array();
		while ($row = mysqli_fetch_array($result)) {
		
			$Facts = array();
			$Facts["ids"] = $row[0];
			$Facts["nom"] = $row[1];
			$Facts["logo"] = $row[2];
			
			array_push($response["societe"], $Facts);
		
			}
	  }
	  else{
		$response["success"] = 0;
	  }


  echo json_encode($response);
  mysqli_close($con);
?>