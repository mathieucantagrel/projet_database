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
    <title>Rendez-vous</title>
</head>
<body>
<form method="post" action="../php/rdv_action.php">
    <table>
        <tr>
            <td colspan="2">
                <label>Je suis :  <?php echo $prenom." ".$nom?>. <br><br>Je souhaite prendre un rendez-vous à cette date et à cette heure :</label>
                <input type="hidden" name="Id_client1" value="NULL">
            </td>
        </tr>

        <tr>
            <td>
                <label for="">Date</label>
            </td>
            <td>
                <label>
                    <input type="date" min="<?php echo $datetime ?>" required name="date">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Heure</label>
            </td>
            <td>
                <label>
                    <input type="number" min="8" max="20" required name="heure"> h :
                </label>
                <label>
                    <select required name="minute">
                        <option value="00">00</option>
                        <option value="30">30</option>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <input class="buuton" type="submit" value="Soumettre le rendez-vous">
            </td>
            <td>
                <a href="accueil_client_form.php"><input class="buuton" type="button" value="Retour"></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>