<?php

include "conn.php";

if (!isset($_POST['nom_premier'])){
    echo "ici";
}

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

$sql = "SELECT `Id_seance` FROM `seance`
        WHERE `Date` LIKE '$date' AND 
        `Heure` LIKE '$heure_rdv'";

$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
if ($row['Id_seance']!=NULL){
    echo "<br>ici<br>";
    echo $row['Id_seance'];
    die("<script>alert(\"horraire deja pris\")</script><script>window.history.back()</script>");
}

$sql = "INSERT INTO `seance` (`Date`, `Heure`, `Prix`, `Moyen_paiement`, `Remarques`, `Nombre_client`, `Note_anxiete`, `Id_client1`, `Id_client2`, `Id_client3`)
        VALUES 
        ('$date', '$heure_rdv', NULL, NULL, NULL, '$nbr_client', NULL, '$id_premier', NULL, NULL)";

echo "<br>".$id_premier;

if (!mysqli_query($conn, $sql)) {
    die("<br>Error : " . mysqli_error($conn));
}else {

    if ($id_deuxieme!=NULL) {
        $sql = "UPDATE `seance`
            SET `Id_client2` = '$id_deuxieme'
            order by Id_seance desc
            limit 1";
        if (!mysqli_query($conn, $sql)) {
            die("<br>Error : " . mysqli_error($conn));
        }else {
            if ($id_troisieme!=NULL) {
                $sql = "UPDATE `seance`
            SET `Id_client3` = '$id_troisieme'
            order by Id_seance desc
            limit 1";
                if (!mysqli_query($conn, $sql)) {
                    die("<br>Error : " . mysqli_error($conn));
                }else {
                    echo "<br>ajout effectué";
                }
            }
        }
    }
}
