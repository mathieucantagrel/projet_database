<?php
include '../php/conn.php';
include '../php/Affichage_select_client.php';
session_start();

$id_client = isset($_SESSION['id_client']) ? $_SESSION['id_client'] : NULL;
$sql = "SELECT Nom, Prenom FROM `client` WHERE `Id_client` = '$id_client'";
$result = mysqli_query($conn, $sql);
$nom = NULL;
$prenom = NULL;
while ($donnees = $result->fetch_array())
    {
       $nom = $donnees[0];
       $prenom = $donnees[1];
    }
$datetime = date("Y-m-d");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../style/rdv_form_style.css">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../php/rdv_action.php">
        <table>

            <tr>
                <td>
                    <label>Client 1 :</label>
                </td>
                <td>
                    <label>
                        <select name="Id_client1">
                            <?php affichage_select();?>
                        </select>
                    </label>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Client 2 :</label>
                </td>
                <td>
                    <label>
                        <select name="Id_client2">
                            <option value="NULL"> </option>
                            <?php affichage_select();?>
                        </select>
                    </label>
                </td>
            </tr>

            <tr>
                <td>
                    <label>Client 3 :</label>
                </td>
                <td>
                    <label>
                        <select name="Id_client3">
                            <option value="NULL"> </option>
                            <?php affichage_select();?>
                        </select>
                    </label>
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
            <tr>
                <td>
                    <input type="submit" value="prendre rendz-vous">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>