<?php
include '../php/conn.php';
$id_seance = $_GET['id'];
$sql = "SELECT * FROM `seance` WHERE `Id_seance`= $id_seance LIMIT 1";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_array($result);
$datetime = date("Y-m-d");
$h = date('H', strtotime($rows['Heure']));
$min = date('i', strtotime($rows['Heure']));
$id_client1 = isset($rows['Id_client1']) ? $rows['Id_client1'] : "";
$id_client2 = isset($rows['Id_client2']) ? $rows['Id_client2'] : NULL;
$id_client3 = isset($rows['Id_client3']) ? $rows['Id_client3'] : NULL;

$sql = "SELECT Nom, Prenom From `client` WHERE Id_client = $id_client1 LIMIT 1";
$result_client1 = mysqli_query($conn, $sql);
$donnees_client1 = mysqli_fetch_array($result_client1);

if ($id_client2!=NULL){
    $sql = "SELECT Nom, Prenom From `client` WHERE Id_client = $id_client2 LIMIT 1";
    $result_client2 = mysqli_query($conn, $sql);
    $donnees_client2 = mysqli_fetch_array($result_client2);

    if ($id_client3!=NULL){
        $sql = "SELECT Nom, Prenom From `client` WHERE Id_client = $id_client3 LIMIT 1";
        $result_client3 = mysqli_query($conn, $sql);
        $donnees_client3 = mysqli_fetch_array($result_client3);
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/rdv_form_style.css">
    <title>Document</title>
</head>
<body>
    <form action="../php/edit_rdv_action.php?id=<?php echo $id_seance?>" method="post">
        <table>
            <tr>
                <td>
                    Date :
                </td>
                <td>
                    <input type="date" value="<?php echo $rows['Date']?>" min="<?php echo $datetime ?>" name="date" required>
                </td>
            </tr>
            <tr>
                <td>
                    Heure :
                </td>
                <td>
                    <input type="number" min="8" max="20" required name="heure" value="<?php echo $h?>">:
                    <select required name="minute">
                        <option value="00"<?php if ($min==00){echo "selected";}?>>00</option>
                        <option value="30"<?php if ($min==30){echo "selected";}?>>30</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Prix :
                </td>
                <td>
                    <input type="number" value="<?php echo $rows['Prix']?>" name="prix">
                </td>
            </tr>
            <tr>
                <td>
                    Moyen de paiement :
                </td>
                <td>
                    <input type="text" value="<?php echo $rows['Moyen_paiement']?>" name="moyen_paiement">
                </td>
            </tr>
            <tr>
                <td>
                    Remarques :
                </td>
                <td colspan="3">
                    <textarea name="remarques"><?php echo $rows['Remarques']?></textarea>

                </td>
            </tr>
            <tr>
                <td>
                    Note d'anxiete:
                </td>
                <td>
                    <input type="number" min="0" max="10" value="<?php echo $rows['Note_anxiete']?>" name="note_anxiete">
                </td>
            </tr>
            <tr>
                <td>
                    client 1:
                </td>
                <td>
                    <input type="text" value="<?php echo $donnees_client1['Nom']?>" name="nom1" required>
                </td>
                <td>
                    <input type="text" value="<?php echo $donnees_client1['Prenom']?>" name="prenom1" required>
                </td>
            </tr>
            <tr>
                <td>
                    client 2:
                </td>
                <td>
                    <input type="text" value="<?php if ($id_client2!=NULL){echo $donnees_client2['Nom'];}?>" name="nom2">
                </td>
                <td>
                    <input type="text" value="<?php if ($id_client2!=NULL){echo $donnees_client2['Prenom'];}?>" name="prenom2">
                </td>
            </tr>
            <tr>
                <td>
                    client 3:
                </td>
                <td>
                    <input type="text" value="<?php if ($id_client3!=NULL){echo $donnees_client3['Nom'];}?>" name="nom3">
                </td>
                <td>
                    <input type="text" value="<?php if ($id_client3!=NULL){echo $donnees_client3['Prenom'];}?>" name="prenom3">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="changement" value="modifier">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="supprimer" value="supprimer">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="retour" value="retour">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
