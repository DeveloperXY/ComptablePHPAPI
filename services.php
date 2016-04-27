<h1>Login :</h1>
<ul>
	<li>Service : login.php</li>
	<li>Parametres Post :  Username - Password </li>
</ul>

<h1>Client :</h1>
<ul>
	<li>Services : addClient.php -  getClient.php</li>
	<li>Parametres Post :  NomPrenom - Tel - Adresse </li>
</ul>

<h1>Fournisseur :</h1>
<ul>
	<li>Services : addFournisseur.php -  getFournisseur.php</li>
	<li>Parametres Post :  Nom - Tel - Adresse - Fix - Fax - Email</li>
</ul>

<h1>Societe :</h1>
<ul>
	<li>Services : addSociete.php -  getSociete.php</li>
	<li>Parametres Post :  Nom - Logo </li>
</ul>

<h1>Local :</h1>
<ul>
	<li>Services : addLocal.php -  getLocal.php</li>
	<li>Parametres Post :  Adresse - Ville - Pays -Tel -Fix - Fax - Email - Activite  - Societe</li>
</ul>

<h1>Produit :</h1>
<ul>
	<li>Services : addProduit.php -  getProduit.php  - removeProduit.php - getProduitByID.php - editProduit.php</li>
	<li>Parametres Post ADD:  Libelle - PrixHT - PrixTTC -CodeBar -Photo - Qte - Local </li>
	<li>Parametres Post Remove:  ID </li>
	<li>Parametres Post Edit:  ID </li>
	<li>Parametres Post EDIT:  ID - Libelle - PrixHT - PrixTTC -CodeBar -Photo - Qte - Local </li>
</ul>

<h1>Charge :</h1>
<ul>
	<li>Services : addCharge.php -  getCharge.php</li>
	<li>Parametres Post :  Description - Prix - Local </li>
</ul>

<h1>User :</h1>
<ul>
	<li>Services : addUser.php -  getUser.php</li>
	<li>Parametres Post :  Nom - Prenom - Type -UserName -Password - Societe  </li>
</ul>