<?php
session_start();
$dernier_lundi = date("Y-m-d", strtotime("previous monday"));
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style/accueil_psy.css">
    <title>Accueil</title>
</head>
<body>

<div id="main_content">
    <table>
        <tr>
            <td>
                <h1>Bonjour docteur,</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Que voulez-vous faire ?</h2>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="ajout_client_form.php"><input type="submit" name="" value="Ajouter un nouveau patient"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="fiche_client_form.php"><input type="submit" name="" value="Voir la fiche d'un patient"></a>
            </td>
        </tr>
        <tr>
            <td class = "buuton">
                <a href="rdv_psy_form.php"><input type="submit" name="" value="Ajouter un rendez-vous"></a><br>
            </td>

        </tr>
        <tr>
            <td class = "buuton">
                <a href="<?php echo "calendrier.php?date=".$dernier_lundi?>"><input type="submit" name="" value="Voir les rendez-vous"></a>
            </td>
        </tr>
        <tr>
            <td id="deco" class = "buuton">
                <a href="../php/logout.php"><input type="submit" value="Déconnexion"></a>
            </td>
        </tr>
    </table>

</div>
</body>
</html>


