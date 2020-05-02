<?php
include '../php/conn.php';
$id_seance = $_GET['id'];
$sql = "SELECT * FROM `seance` WHERE `Id_seance`= $id_seance LIMIT 1";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_array($result);
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
    <table>
        <tr>
            <td>
                Date :
            </td>
            <td>
                <?php echo $rows['Date']?>
            </td>
        </tr>
        <tr>
            <td>
                Heure :
            </td>
            <td>
                <?php echo $rows['Heure']?>
            </td>
        </tr>
        <tr>
            <td>
                Prix :
            </td>
            <td>
                <?php echo $rows['Prix']?>
            </td>
        </tr>
        <tr>
            <td>
                Moyen de paiement :
            </td>
            <td>
                <?php echo $rows['Moyen_paiement']?>
            </td>
        </tr>
        <tr>
            <td>
                Remarques :
            </td>
            <td>
                <?php echo $rows['Remarques']?>
            </td>
        </tr>
    </table>
</body>
</html>
