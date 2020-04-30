<?php
$datetime = date("Y-m-d");
?>

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
    <form method="post" action="../php/rdv_action.php">
        <table>
            <tr>
                <td>
                    <label for="">nom du premier patient :</label>
                </td>
                <td>
                    <input type="text" name="nom_premier" required>
                </td>
                <td>
                    <label for="">prenom du premier patient :</label>
                </td>
                <td>
                    <input type="text" name="prenom_premier" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">nom du deuxieme patient (optionel):</label>
                </td>
                <td>
                    <input type="text" name="nom_deuxieme">
                </td>
                <td>
                    <label for="">prenom du deuxieme patient (optionel):</label>
                </td>
                <td>
                    <input type="text" name="prenom_deuxieme">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">nom du troiseme patient (optionel):</label>
                </td>
                <td>
                    <input type="text" name="nom_troiseme">
                </td>
                <td>
                    <label for="">prenom du troiseme patient (optionel):</label>
                </td>
                <td>
                    <input type="text" name="prenom_troiseme">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">date</label>
                </td>
                <td>
                    <input type="date" min="<?php echo $datetime ?>" required name="date">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">heure</label>
                </td>
                <td>
                    <input type="number" min="8" max="20" required name="heure">h:
                    <select required name="minute">
                        <option value="00">00</option>
                        <option value="30">30</option>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit">
    </form>
</body>
</html>