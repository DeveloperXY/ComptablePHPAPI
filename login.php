<?php
require('connect.php');

$response = array();

if (!empty($_POST['Username']) && !empty($_POST['Password'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $pwd = md5($password);

    $result = mysqli_query($con, "SELECT * FROM c_utilisateur WHERE UserName='$username' AND Password='$pwd'") or die(mysql_error());
    if (mysqli_num_rows($result) > 0) {
        $response["success"] = 1;
        $response["user"] = array();
        while ($row = mysqli_fetch_array($result)) {

            $Facts = array();
            $Facts["iduser"] = $row[0];
            $Facts["nom"] = $row[1];
            $Facts["prenom"] = $row[2];
            $Facts["type"] = $row[3];
            $Facts["dateCreation"] = $row[4];
            $Facts["dateExpiration"] = $row[5];
            $Facts["Username"] = $row[6];
            $Facts["Password"] = $row[7];
            $Facts["SocieteID"] = $row[8];

            array_push($response["user"], $Facts);

        }
    } else {
        $response["success"] = 0;
    }

} else {
    $response["erreur"] = "Login or password invalid !";
    $response["success"] = 0;
}
echo json_encode($response);
mysqli_close($con);
?>