<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/ajout_client.css">
    <title>Ajouter un client</title>
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
                <label for="">Age :</label>
            </td>
            <td>
                <label>
                    <input type="number" name="age" min="5" max="99">
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
                <input type="radio" id="Oui" name="couple" value="oui" onclick="affiche('1','2','3','4')">
                <label for="Oui">Oui</label>
                <input type="radio" id="non" name="couple" value="non" onclick="pasaffiche('1','2','3','4')">
                <label for="non">Non</label>
            </td>
        </tr>


        <tr>
            <td>
                <label id='1'>Nom du partenaire :</label>
            </td>
            <td>
                <label>
                    <input type="text" id='2' name="couple_avec_nom">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label id='3'>Prénom du partenaire :</label>
            </td>
            <td>
                <label>
                    <input type="text"  id='4' name="couple_avec_prenom">
                </label>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <input type="submit">
            </td>
        </tr>
    </table>





    <script type="text/javascript">
        function affiche(div1, div2, div3, div4)
        {
            document.getElementById(div2).style.display = '';
            document.getElementById(div1).style.display = '';
            document.getElementById(div3).style.display = '';
            document.getElementById(div4).style.display = '';
        }

        function pasaffiche(div1, div2, div3, div4)
        {
            document.getElementById(div2).style.display = 'none';
            document.getElementById(div1).style.display = 'none';
            document.getElementById(div3).style.display = 'none';
            document.getElementById(div4).style.display = 'none';
        }


    </script>
</form>
</body>
</html>
