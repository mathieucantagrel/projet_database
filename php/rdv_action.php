<?php

include "conn.php";

$nom_premier = isset($_POST['nom_premier']) ? $_POST['nom_premier'] : NULL;
$prenom_premier = isset($_POST['prenom_premier']) ? $_POST['prenom_premier'] : NULL;

$nom_deuxieme = isset($_POST['nom_deuxieme']) ? $_POST['nom_deuxieme'] : NULL;
$prenom_deuxieme = isset($_POST['prenom_deuxieme']) ? $_POST['prenom_deuxieme'] : NULL;

$nom_troiseme = isset($_POST['nom_troiseme']) ? $_POST['nom_troiseme'] : NULL;
$prenom_troiseme = isset($_POST['prenom_troiseme']) ? $_POST['prenom_troiseme'] : NULL;

//$date = isset($_POST['date']) ? $_POST['date'] : NULL;
$date = $_POST['date'];

$heure = isset($_POST['heure']) ? $_POST['heure'] : NULL;
$minute = isset($_POST['minute']) ? $_POST['minute'] : NULL;

echo $nom_premier." ".$prenom_premier."<br>";
echo $nom_deuxieme." ".$prenom_deuxieme."<br>";
echo $nom_troiseme." ".$prenom_troiseme."<br>";
echo $date."<br>";
echo $heure." ".$minute."<br>";

$sql = "SELECT Id_client FROM `client` WHERE Nom LIKE '$nom_premier' AND Prenom LIKE '$prenom_premier'";

$result = mysqli_query($conn, $sql);

$id_premier=NULL;
$id_deuxieme=NULL;
$id_troisieme=NULL;

if ($result){
    $row=mysqli_fetch_array($result);
    $id_premier = $row['Id_client'];
}else{
    die("<script>window.history.back()</script>");
}

$nbr_client = 1;

if ($nom_deuxieme!=NULL&&$prenom_deuxieme!=NULL){
    $sql = "SELECT Id_client FROM `client` WHERE Nom LIKE '$nom_deuxieme' AND Prenom LIKE '$prenom_deuxieme'";

    $result = mysqli_query($conn, $sql);

    if ($result){
        $row=mysqli_fetch_array($result);
        $id_deuxieme = $row['Id_client'];
        $nbr_client+=1;

        if ($nom_troiseme!=NULL&&$prenom_troiseme!=NULL){
            $sql = "SELECT Id_client FROM `client` WHERE Nom LIKE '$nom_troiseme' AND Prenom LIKE '$prenom_troiseme'";

            $result = mysqli_query($conn, $sql);

            if ($result){
                $row=mysqli_fetch_array($result);
                $id_troisieme = $row['Id_client'];
                $nbr_client+=1;
            }else{
                die("<script>window.history.back()</script>");
            }
        }

    }else{
        die("<script>window.history.back()</script>");
    }
}

$heure_rdv = date('H:i:s', strtotime("$heure:$minute:00"));

echo "<br>".$heure_rdv;

if ($date!=NULL){
    echo "<br>".$date;
}

$sql = "INSERT INTO `seance` (`Date`, `Heure`, `Prix`, `Moyen_paiement`, `Remarques`, `Nombre_client`, `Note_anxiete`)
        VALUES 
        ('$date', '$heure_rdv', NULL, NULL, NULL, $nbr_client, NULL)";

echo $sql;

if (!mysqli_query($conn, $sql)) {
    die("Error : " . mysqli_error($conn));
}

$sql = "SELECT MAX(`Id_seance`) FROM `seance`";
$result = mysqli_query($conn, $sql);
$maxId=NULL;
while ($row = mysqli_fetch_array($result)){
    $maxId = $row[0];
}

$sql = "INSERT INTO `client_seance` (`Id_client`, `Id_seance`)
        VALUES 
        ('$id_premier', '$maxId')";

if (!mysqli_query($conn, $sql)) {
    die("<br>Error : " . mysqli_error($conn));
}

if ($nbr_client==2){
    $sql = "INSERT INTO `client_seance` (`Id_client`, `Id_seance`)
        VALUES 
        ('$id_deuxieme', '$maxId')";

    if (!mysqli_query($conn, $sql)) {
        die("<br>Error : " . mysqli_error($conn));
    }
}

if ($nbr_client==3){
    $sql = "INSERT INTO `client_seance` (`Id_client`, `Id_seance`)
        VALUES 
        ('$id_troisieme', '$maxId')";

    if (!mysqli_query($conn, $sql)) {
        die("<br>Error : " . mysqli_error($conn));
    }
}