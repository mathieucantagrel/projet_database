<?php
include 'conn.php';
session_start();

$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$date_naissance = isset($_POST['date_naissance']) ? $_POST['date_naissance'] : NULL;
$genre = isset($_POST['genre']) ? $_POST['genre']: NULL;
$moyen_connu = isset($_POST['moyen_connu']) ? $_POST['moyen_connu'] : NULL;
$situation = isset($_POST['couple']) ? $_POST['couple'] : NULl;
$couple_avec = isset($_POST['couple_avec']) ? $_POST['couple_avec'] : NULL;
$profession = isset($_POST['profession']) ? $_POST['profession'] : NULL;

$date_naissance_date = new DateTime($date_naissance);
$now = new DateTime(date("Y-m-d"));
$dif = $now->diff($date_naissance_date);
$age = $dif->y;

$verif = FALSE;
if (($age <= 13) && ($genre === 'enfant'))
{
    $verif = TRUE;
}
if ((13 < $age) && ($age < 18) && ($genre === 'ado'))
{
    $verif = TRUE;
}
if (($age >= 18) && (($genre === 'femme') || ($genre === 'homme')))
{
    $verif = TRUE;
}

$verif2 = FALSE;
$check_duplicate_email = "SELECT Email, Id_client FROM client WHERE Email ='$email' ";
$result = mysqli_query($conn,$check_duplicate_email);
$count = mysqli_num_rows($result);
if ($count <= 1)
{
    $verif2 = TRUE;
}

$result = mysqli_query($conn, $check_duplicate_email);
while ($id = $result->fetch_array()){
    $id_client = $id["Id_client"];
}


if ($verif==false||$verif2==false){

    die("<script>alert(\"probleme dans la modification client\")</script><script>window.history.back()</script>");
}


$sql = "UPDATE `client`
        SET `Nom`='$nom', `Prenom`='$prenom', `Genre`='$genre', `Email`='$email', `DoB`='$date_naissance', `Situation`='$situation', `Moyen_connu`='$moyen_connu'
        WHERE `Id_client`='$id_client'";

if (!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
}

$sql = "SELECT `description` FROM `profession`
        INNER JOIN `profession_client`
        ON profession.Id_profession = profession_client.Id_profession
        WHERE profession_client.Date=(
        SELECT MAX(Date) FROM `profession_client` WHERE Id_client='$id_client' 
        )";
$result = mysqli_query($conn, $sql);
while ($donnees = $result->fetch_array()){
    $desciption = $donnees[0];
}

if ($desciption!=$profession){
    $sql = "SELECT `Id_profession` FROM `profession` WHERE `description` lIKE '%$profession%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $id_profession = $row['Id_profession'];
        echo "profession:".$id_profession;

        $date = date('Y-m-d');

        $sql = "INSERT INTO `profession_client` (`Id_profession`, `Id_client`, `Date`)
            VALUES 
            ('$id_profession', '$id_client', '$date')";

        if(!mysqli_query($conn, $sql)){
            echo "<br>".mysqli_error($conn);
        }
    }else{
        $sql = "INSERT INTO `profession` (`description`)
            VALUES 
            ('$profession')";
        mysqli_query($conn, $sql);

        $sql = "SELECT MAX(Id_profession) FROM `profession`";
        $result = mysqli_query($conn, $sql);
        while ($donnees = $result->fetch_array()){
            $id_nouvelle_profession = $donnees[0];
            echo $id_nouvelle_profession;
        }


        $date = date('Y-m-d');

        $sql = "INSERT INTO `profession_client` (`Id_profession`, `Id_client`, `Date`)
            VALUES 
            ('$id_nouvelle_profession', '$id_client', '$date')";

        if(!mysqli_query($conn, $sql)){
            echo "<br>".mysqli_error($conn);
        }
    }
}

if ($situation=='oui') {
    $sql = "UPDATE `client`
        SET Couple_avec='$couple_avec'
        WHERE `Id_client`='$id_client'";

    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn);
    }

    $sql = "UPDATE `client`
        SET Couple_avec='$id_client'
        WHERE `Id_client`='$couple_avec'";

    if (!mysqli_query($conn, $sql)) {
        echo "<br>" . mysqli_error($conn);
    }
}else{
    $sql = "SELECT `Couple_avec` FROM `client` WHERE `Id_client`='$id_client'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row['Couple_avec']!=0){
        $id_couple = $row['Couple_avec'];
        $sql = "UPDATE `client`
                SET Couple_avec=0
                WHERE Id_client='$id_client'";
        if (!mysqli_query($conn, $sql)) {
            echo "<br>" . mysqli_error($conn);
        }
        $sql = "UPDATE `client`
                SET Couple_avec=0
                WHERE Id_client='$id_couple'";
        if (!mysqli_query($conn, $sql)) {
            echo "<br>" . mysqli_error($conn);
        }
    }
}

header("location: ../html/fiche_client_form.php");