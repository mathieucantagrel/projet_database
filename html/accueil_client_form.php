
<?php
    session_start();
    echo 'Bonjour ' . $_SESSION['prenom'];
    echo "<br>". $_SESSION['id_client']; ?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/accueil_client.css">
    <title>Accueil</title>
</head>
<body>
<a href="../php/logout.php"><input type="submit" value="Déconnexion"></a>


<h1> Accueil client</h1>

<a href="rdv_form.php"><input type="submit" name="" value="Une autre page"></a>






</body>
</html>


