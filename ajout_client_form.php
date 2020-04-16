<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="ajout_client.php" method="post">

    <table>
        <tr>
            <td>
                <label>nom:</label>
            </td>
            <td>
                <input type="text" name="nom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="">prenom</label>
            </td>
            <td>
                <input type="text" name="prenom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="">age</label>
            </td>
            <td>
                <input type="number" name="age" min="5" max="99">
            </td>
        </tr>
        <tr>
            <td>
                <label for="">genre</label>
            </td>
            <td>
                <select name="genre" id="">
                    <option value="femme">femme</option>
                    <option value="homme">homme</option>
                    <option value="non_binaire">non binaire</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">en couple</label>
            </td>
            <td>
                <select name="couple" id="">
                    <option value="non">non</option>
                    <option value="oui">oui</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">en couple avec (nom):</label>
            </td>
            <td>
                <input type="text" name="couple_avec_nom">
            </td>
        </tr>
        <tr>
            <td>
                <label for="">en couple avec (prenom):</label>
            </td>
            <td>
                <input type="text" name="couple_avec_prenom">
            </td>
        </tr>
    </table>


    <input type="submit">
</form>
</body>
</html>
