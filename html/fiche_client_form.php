<?php
session_start();
include '../php/conn.php';
include '../php/Affichage_select_client.php';
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/fiche_client.css">
    <title>Fiche patient</title>
</head>
<body>
<form action="fiche_client_form2.php" method="post">
    <table>
        <tr>
            <td>
                <label>Quel patient recherchez-vous ?</label>
            </td>
            <td>
                <label>
                    <select name="client">
                        <?php affichage_select();?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <a href="accueil_psy_form.php"><input class="buuton" type="button" value="Retour"></a>
            </td>
            <td>
                <input class="buuton" type="submit" value="Chercher">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
