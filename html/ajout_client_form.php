<?php

include '../php/Affichage_select_client.php';

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/ajout_client.css">
    <title>Ajouter un patient</title>
</head>
<body>
<form action="../php/ajout_client.php" method="post">
    <table>
        <tr>
            <td>
                <label>Nom :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="nom">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Prénom :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="prenom">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Email :</label>
            </td>
            <td>
                <label>
                    <input type="email" name="email">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Date de naissance :</label>
            </td>
            <td>
                <label>
                    <input type="date" name="naissance">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Genre :</label>
            </td>
            <td>
                <select name="genre">
                    <option value="enfant" id='E'>Enfant (entre 5 et 13 ans)</option>
                    <option value="ado" id='A'>Adolescent (entre 14 et 18 ans)</option>
                    <option value="femme" id='F'>Femme</option>
                    <option value="homme" id='H'>Homme</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Moyen connu :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="moyen_connu">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">En couple ?</label>
            </td>
            <td>
                <input type="radio" id="Oui" name="couple" value="oui" onclick="affiche('1','2')" checked>
                <label for="Oui">Oui</label>
                <input type="radio" id="non" name="couple" value="non" onclick="pasaffiche('1','2')">
                <label for="non">Non</label>
            </td>
        </tr>


        <tr>
            <td>
                <label id='1'>partenaire (optionel):</label>
            </td>
            <td>
                <label>
                    <select name="id_partenaire" id="2">
                        <option value="NULL"> </option>
                        <?php affichage_select()?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Profession :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="profession" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input class="buuton" type="submit" value="Ajouter">
            </td>
            <td>
                <a href="accueil_psy_form.php"><input class="buuton" type="button" value="Retour"></a>
            </td>
        </tr>
    </table>


    <script type="text/javascript">
        function affiche(div1, div2)
        {
            document.getElementById(div2).style.display = '';
            document.getElementById(div1).style.display = '';

        }

        function pasaffiche(div1, div2)
        {
            document.getElementById(div2).style.display = 'none';
            document.getElementById(div1).style.display = 'none';
        }


    </script>
</form>
</body>
</html>
