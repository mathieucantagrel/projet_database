<?php
include "conn.php";

$nom = isset($_POST["nom"] ) ? $_POST["nom"] : NULL;
$prenom  = isset($_POST["prenom"] ) ? $_POST["prenom"] : NULL;
$age = isset($_POST["age"]) ? $_POST["age"] : NUll;
$genre = isset($_POST["genre"]) ? $_POST["genre"] : NULL;
$couple = isset($_POST["couple"]) ? $_POST["couple"] : NULL;
$couple_avec_nom = NULL;
$couple_avec_prenom = NULL;
if ($couple==="oui"){
    $couple_avec_nom = isset($_POST["couple_avec_nom"]) ? $_POST["couple_avec_nom"] : NULL;
    $couple_avec_prenom = isset($_POST["couple_avec_prenom"]) ? $_POST["couple_avec_prenom"] : NULL;
}

echo $nom."</br>";
echo $prenom."</br>";
echo $age."</br>";
echo $genre."</br>";
echo $couple."</br>";
echo $couple_avec_nom."</br>";
echo $couple_avec_prenom."</br>";

$sql = "INSERT INTO `client` (`Id_Client`, `Nom`, `Prenom`, `Genre`, `Email`, `Mdp`, `Age`, `Situation`, `Couple_avec`, `Moyen_connu`) 
        VALUES 
        (NULL, '$nom', '$prenom', '$genre', '', '', '$age', '$couple', '', '')";

if (!mysqli_query($conn, $sql)) {
    die("Error : " . mysqli_error($conn));
}else{
    echo "valide";
}
