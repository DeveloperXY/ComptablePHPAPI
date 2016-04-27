<h1>Login</h1>
<form id="" action="login.php" method="post" enctype="multipart/form-data">
<input type="text" name="Username" placeholder="Username"/>
<input type="text" name="Password" placeholder="Password"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addClient</h1>
<form id="" action="addClient.php" method="post">
<input type="text" name="NomPrenom" placeholder="Nom Complet"/>
<input type="text" name="Tel" placeholder="Tel"/>
<input type="text" name="Adresse" placeholder="Adresse"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addFournisseur</h1>
<form id="" action="addFournisseur.php" method="post">
<input type="text" name="Nom" placeholder="Nom Complet"/>
<input type="text" name="Tel" placeholder="Tel"/>
<input type="text" name="Adresse" placeholder="Adresse"/>
<input type="text" name="Fix" placeholder="Fix"/>
<input type="text" name="Fax" placeholder="Fax"/>
<input type="text" name="Email" placeholder="Email"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addSociete</h1>
<form id="" action="addSociete.php" method="post" enctype="multipart/form-data">
<input type="text" name="Nom" placeholder="Nom S"/>
<input type="file" name="Logo" placeholder="Logo"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addLocal</h1>
<form id="" action="addLocal.php" method="post" enctype="multipart/form-data">
<input type="text" name="Adresse" placeholder="Adresse"/>
<input type="text" name="Ville" placeholder="Ville"/>
<input type="text" name="Pays" placeholder="Pays"/>
<input type="text" name="Tel" placeholder="Tel"/>
<input type="text" name="Fix" placeholder="Fix"/>
<input type="text" name="Fax" placeholder="Fax"/>
<input type="text" name="Email" placeholder="Email"/>
<input type="text" name="Activite" placeholder="Activite"/>
<input type="text" name="Societe" placeholder="Societe" value="1"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addProduit</h1>
<form id="" action="addProduit.php" method="post" enctype="multipart/form-data">
<input type="text" name="Libelle" placeholder="Libelle"/>
<input type="text" name="PrixHT" placeholder="PrixHT"/>
<input type="text" name="PrixTTC" placeholder="PrixTTC"/>
<input type="text" name="CodeBar" placeholder="Code Bar"/>
<input type="file" name="Photo" placeholder="Photo"/>
<input type="text" name="Qte" placeholder="Qte"/>
<input type="text" name="Local" placeholder="" value="1"/>
<input type="submit" name="ok" value="send"/>
</form>
<h1>--------------------- get by ID</h1>
<form id="" action="getProduitByID.php" method="post" enctype="multipart/form-data">
<input type="text" name="ID" placeholder="ID Produit"/>
<input type="submit" name="ok" value="send"/>
</form>
<h1>--------------------- Remove</h1>
<form id="" action="removeProduit.php" method="post" enctype="multipart/form-data">
<input type="text" name="ID" placeholder="ID Produit"/>
<input type="submit" name="ok" value="send"/>
</form>

<h1>addCharge</h1>
<form id="" action="addCharge.php" method="post" enctype="multipart/form-data">
<input type="text" name="Description" placeholder="Description"/>
<input type="text" name="Prix" placeholder="Prix"/>
<input type="text" name="Local" placeholder="" value="1"/>
<input type="submit" name="ok" value="send"/>
</form>


<h1>addUser</h1>
<form id="" action="addUser.php" method="post" enctype="multipart/form-data">
<input type="text" name="Nom" placeholder="Nom"/>
<input type="text" name="Prenom" placeholder="Prenom"/>
<input type="text" name="Type" placeholder="Type" />
<input type="text" name="UserName" placeholder="Username" />
<input type="text" name="Password" placeholder="password" />
<input type="text" name="Societe" placeholder="" value="1" />
<input type="submit" name="ok" value="send"/>
</form>