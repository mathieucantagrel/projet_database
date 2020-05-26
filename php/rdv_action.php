<?php
session_start();
include "conn.php";

$id_premier = isset($_SESSION['id_client']) ? $_SESSION['id_client'] : NULL;

if ($id_premier==NULL){
    $id_premier = isset($_POST['Id_client1']) ? $_POST['Id_client1'] : NULL;

}

$id_deuxieme = isset($_POST['Id_client2']) ? $_POST['Id_client2'] : NULL;
if ($id_deuxieme=="NULL"){
    $id_deuxieme=NULL;
}

$id_troisieme = isset($_POST['Id_client3']) ? $_POST['Id_client3'] : NULL;
if($id_troisieme=="NULL"){
    $id_troisieme=NULL;
}

$date = $_POST['date'];

$heure = isset($_POST['heure']) ? $_POST['heure'] : NULL;
$minute = isset($_POST['minute']) ? $_POST['minute'] : NULL;

echo $date."<br>";
echo $heure." ".$minute."<br>";

$nbr_client = 1;

if ($id_deuxieme!=NULL){
    $nbr_client+=1;

    if ($id_troisieme!=NULL){
        $nbr_client+=1;
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
    die("<script>alert(\"Horraire déjà pris\")</script><script>window.history.back()</script>");
}

$sql = "SELECT * FROM `seance` WHERE `Date`='$date'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (mysqli_num_rows($result)>=20){
    die("<script>alert(\"Impossible de prendre un rendez-vous\")</script><script>window.history.back()</script>");
}

$sql = "INSERT INTO `seance` (`Date`, `Heure`, `Prix`, `Moyen_paiement`, `Remarques`, `Nombre_client`, `Note_anxiete`, `Id_client1`, `Id_client2`, `Id_client3`)
        VALUES 
        ('$date', '$heure_rdv', NULL, NULL, NULL, '$nbr_client', NULL, '$id_premier', NULL, NULL)";

echo "<br>".$id_premier;

if (!mysqli_query($conn, $sql)) {
    die("<br>Error : " . mysqli_error($conn));
}else {

    if (($id_deuxieme!=NULL) && ($id_deuxieme!=$id_premier)) {
        $sql = "UPDATE `seance`
            SET `Id_client2` = '$id_deuxieme'
            order by Id_seance desc
            limit 1";
        if (!mysqli_query($conn, $sql)) {
            die("<br>Error : " . mysqli_error($conn));
        }else {
            if (($id_troisieme!=NULL) && ($id_deuxieme!=$id_troisieme) && ($id_premier!=$id_troisieme)) {
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
$dernier_lundi = date("Y-m-d", strtotime("previous monday"));

die("<script>window.location.href='../html/calendrier.php?date=$dernier_lundi'</script>");