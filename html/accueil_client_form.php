
<?php
    session_start();
    $dernier_lundi = date("Y-m-d", strtotime("previous monday"));

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/accueil_client.css">
    <title>Accueil</title>
</head>

<body>
<div id="main_content">
    <table>
        <tr>
            <td>
                <h1><?php echo 'Bonjour ' . $_SESSION['prenom'].",";?></h1>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="rdv_client_form.php"><input type="submit" name="" value="Prendre un rendez-vous"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="<?php echo "calendrier.php?date=".$dernier_lundi?>"><input type="submit" name="" value="Voir les rendez-vous"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="Historique_client.php"><input type="submit" name="" value="Historique des rendez-vous"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="modification_client.php"><input type="submit" name="" value="Modifier mon profil"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="../php/logout.php"><input type="submit" value="Déconnexion"></a>
            </td>
        </tr>
    </table>
</div>

</body>
</html>


