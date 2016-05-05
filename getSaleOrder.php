<?php
require('connect.php');

$response = array();

	$result = mysqli_query($con,"SELECT * from c_commandevente ORDER BY ID DESC") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		 $response["success"] = 1;
		$response["sales"] = array();
		while ($row = mysqli_fetch_array($result)) {
		
			$Facts = array();
			$Facts["id"] = $row[0];
			$Facts["date"] = $row[1];
			$Facts["facture"] = $row[2];
			$Facts["factureID"] = $row[3];
			$Facts["total"] = $row[4];
			
			array_push($response["sales"], $Facts);
		
			}
	  }
	  else{
		$response["success"] = 0;
	  }


  echo json_encode($response);
  mysqli_close($con);
?>