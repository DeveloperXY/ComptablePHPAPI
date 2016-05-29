<?php
require('connect.php');

$response = array();
$id=$_GET['localeID'];
$idSociete=$_GET['companyID'];
$response["comptabilite"] = array();
$response["success"] = 1;
$Facts=array();
//************************ nombre marque dans le local ***************
	$result = mysqli_query($con,"SELECT COUNT(*) from c_produit WHERE Locale_ID=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['NbrMarque']=$row[0];
	  }
	  else{
		$Facts['NbrMarque']=0;
	  }

	  //************************ nombre de produit par marque dans le local ***************
	$result = mysqli_query($con,"SELECT SUM(Qte) from c_produit WHERE Locale_ID=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['QteProduit']=$row[0];
		if($row[0]==null){
			$Facts['QteProduit']=0;
		}
	  }
	  else{
		$Facts['QteProduit']=0;
	  }
	  
	  	  //************************ nombre de fournisseur ***************
	$result = mysqli_query($con,"SELECT COUNT(*) from c_fournisseur WHERE idsociete=$idSociete") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['NbrFournisseur']=$row[0];
	  }
	  else{
		$Facts['NbrFournisseur']=0;
	  }

	    	  //************************ nombre de client ***************
	$result = mysqli_query($con,"SELECT COUNT(*) from c_client WHERE idsociete=$idSociete") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['NbrClient']=$row[0];
	  }
	  else{
		$Facts['NbrClient']=0;
	  }
	  
	     	  //************************ nombre operation vente ***************
	$result = mysqli_query($con,"SELECT COUNT(*) from c_commandevente WHERE idlocale=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['NbrOperationVente']=$row[0];
	  }
	  else{
		$Facts['NbrOperationVente']=0;
	  }
	  
	     	  //************************ nombre operation achat ***************
	$result = mysqli_query($con,"SELECT COUNT(*) from c_commandeachat WHERE idlocale=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['NbrOperationAchat']=$row[0];
	  }
	  else{
		$Facts['NbrOperationAchat']=0;
	  }
	  
	  	    	  //************************ Total Vente ***************
	$result = mysqli_query($con,"SELECT SUM(PrixTotal) from c_commandevente WHERE idlocale=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['TotalVente']=$row[0];
		if($row[0]==null){
			$Facts['TotalVente']=0;
		}
	  }
	  else{
		$Facts['TotalVente']=0;
	  }
	  
	   	    	  //************************ Total Achat ***************
	$result = mysqli_query($con,"SELECT SUM(PrixTotal) from c_commandeachat WHERE idlocale=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['TotalAchat']=$row[0];
		if($row[0]==null){
			$Facts['TotalAchat']=0;
		}
	  }
	  else{
		$Facts['TotalAchat']=0;
	  }
	  
	     	    	  //************************ Total charge ***************
	$result = mysqli_query($con,"SELECT SUM(Prix) from c_charge WHERE Locale_ID=$id") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_array($result);
		$Facts['TotalCharge']=$row[0];
		if($row[0]==null){
			$Facts['TotalCharge']=0;
		}
		
	  }
	  else{
		$Facts['TotalCharge']=0;
	  }
	  $charge=$Facts['TotalCharge']+$Facts['TotalAchat'];
	  $Facts['Profit']=$Facts['TotalVente']- $charge;
	  
	  //**************************** All Locale ****************
	  $totalcharges=0;
	  $totalachats=0;
	  $totalventes=0;
	  $result = mysqli_query($con,"SELECT * from c_locale WHERE Société_ID=$idSociete") or die(mysql_error());
	 if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$idl=$row[0];
			//****************** all charge **********************
			$rc= mysqli_query($con,"SELECT SUM(Prix) from c_charge WHERE Locale_ID=$idl") or die(mysql_error());
			$rch = mysqli_fetch_array($rc);
			if($rch[0]==null){
				$totalcharges= $totalcharges+0;
			}else{
				$totalcharges= $totalcharges+$rch[0];
			}
			 
			 //****************** all achat **********************
			$rc= mysqli_query($con,"SELECT SUM(PrixTotal) from c_commandeachat WHERE idlocale=$idl") or die(mysql_error());
			$rch = mysqli_fetch_array($rc);
			if($rch[0]==null){
				$totalachats= $totalachats+0;
			}else{
				$totalachats= $totalachats+$rch[0];
			}
			
			 //****************** all vente **********************
			$rc= mysqli_query($con,"SELECT SUM(PrixTotal) from c_commandevente WHERE idlocale=$idl") or die(mysql_error());
			$rch = mysqli_fetch_array($rc);
			if($rch[0]==null){
				$totalventes= $totalventes+0;
			}else{
				$totalventes= $totalventes+$rch[0];
			}
		}	
	  }
	  $chargeso=$totalcharges+$totalachats;
	$Facts['ProfitTotalSociete']=$totalventes - $chargeso;
	  
	  
array_push($response["comptabilite"], $Facts);
  echo json_encode($response);
  mysqli_close($con);
?>