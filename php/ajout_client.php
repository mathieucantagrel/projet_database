<?php

include 'conn.php';

$nom = isset($_POST["nom"]) ? $_POST["nom"] : NULL;
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : NULL;
$age = isset($_POST["age"]) ? $_POST["age"] : NUll;
$email = isset($_POST["email"]) ? $_POST["email"] : NUll;
$moyen_connu = isset($_POST["moyen_connu"]) ? $_POST["moyen_connu"] : NULL;
$genre = isset($_POST["genre"]) ? $_POST["genre"] : NULL;
$couple = isset($_POST["couple"]) ? $_POST["couple"] : NULL;
$couple_avec_nom = NULL;
$couple_avec_prenom = NULL;
$id_couple_avec = NULL;

if ($couple === "oui")
{
    $couple_avec_nom = isset($_POST["couple_avec_nom"]) ? $_POST["couple_avec_nom"] : NULL;
    $couple_avec_prenom = isset($_POST["couple_avec_prenom"]) ? $_POST["couple_avec_prenom"] : NULL;
    $query = "SELECT Id_Client FROM client WHERE Nom = '$couple_avec_nom' AND Prenom = '$couple_avec_prenom'";
    $id_couple = mysqli_query($conn, $query);
    while ($donnees = $id_couple->fetch_array()) {
        $id_couple_avec = $donnees[0];
    }
}

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
$check_duplicate_email = "SELECT Email FROM client WHERE Email ='$email' ";
$result = mysqli_query($conn,$check_duplicate_email);
$count = mysqli_num_rows($result);
if ($count === 0)
{
    $verif2 = TRUE;
}


if (($verif === TRUE) && ($verif2 === TRUE))
{
    $sql = "INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Genre`, `Email`, `Age`, `Situation`, `Couple_avec`, `Moyen_connu`) 
        VALUES (NULL, '$nom', '$prenom', '$genre', '$email', '$age', '$couple', '$id_couple_avec', '$moyen_connu')";
    mysqli_query($conn, $sql);


    if ($id_couple_avec != NULL)
    {
        $query = "SELECT MAX(Id_Client) FROM client";
        $id_couple = mysqli_query($conn, $query);
        while ($donnees = $id_couple->fetch_array())
        {
            $id_couple_avec1 = $donnees[0];
        }
        $sql="UPDATE client SET Situation = 'oui' WHERE Id_Client = '$id_couple_avec'";
        $sql="UPDATE client SET Couple_avec = '$id_couple_avec1' WHERE Id_Client = '$id_couple_avec'";
        mysqli_query($conn, $sql);
    }

    header("location:../html/ajout_client_form.php");
}
header("location:../html/ajout_client_form.php");
