<?php
session_start();
$dernier_lundi = date("Y-m-d", strtotime("previous monday"));
echo 'Bonjour docteur';
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/accueil_client.css">
    <title>Accueil</title>
</head>
<body>
<a href="../php/logout.php"><input type="submit" value="Déconnexion"></a>


<h1>Accueil Psychologue</h1>

<a href="ajout_client_form.php"><input type="submit" name="" value="Ajouter un nouveau patient"></a>
<a href="rdv_form.php"><input type="submit" name="" value="Ajouter un rdv"></a>
<a href="<?php echo "calendrier.php?date=".$dernier_lundi?>"><input type="submit" name="" value="voir rdv"></a>






</body>
</html>


