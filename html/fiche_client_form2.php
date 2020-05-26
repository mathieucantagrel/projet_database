<?php
session_start();
include '../php/conn.php';

$client= isset($_POST['client']) ? $_POST['client'] : NULL;

$sql = "SELECT * FROM `client` WHERE `Id_client` = $client";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$sql2 = "SELECT `description`, `Date` FROM `profession`
        INNER JOIN `profession_client`
        ON profession.Id_profession = profession_client.Id_profession
        WHERE Id_client='$client' ";
$result2 = mysqli_query($conn, $sql2);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/fiche_client.css">
    <title>Fiche patient</title>
</head>
<body>
<form action="../html/Historique_client.php" method="post">
    <table>
        <tr>
            <td>
                <label>Nom :</label>
            </td>
            <td>
                <?php echo $row['Nom'] ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Prénom :</label>
            </td>
            <td>
                <?php echo $row['Prenom'] ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label>Email :</label>
            </td>
            <td>
                <?php echo $row['Email'] ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Date de naissance :</label>
            </td>
            <td>
                <?php echo $row['DoB'] ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Genre :</label>
            </td>
            <td>
                <?php if ($row['Genre']=='enfant'){echo "Enfant (entre 5 et 13 ans)";}?>
                <?php if ($row['Genre']=='ado'){echo "Adolescent (entre 14 et 18 ans)";}?>
                <?php if ($row['Genre']=='femme'){echo "Femme";}?>
                <?php if ($row['Genre']=='homme'){echo "Homme";}?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Moyen connu :</label>
            </td>
            <td>
                <?php echo $row['Moyen_connu'] ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">En couple ?</label>
            </td>
            <td>
                <?php if ($row['Situation']=='oui'){echo "Oui";}?>
                <?php if ($row['Situation']=='non'){echo "Non";}?>
            </td>
            <td>
            </td>
        </tr>

        <tr>
            <?php if ($row['Couple_avec']!=0)
            {
                $id_couple = $row['Couple_avec'];
                $sql = "SELECT * FROM `client` WHERE `Id_client` = '$id_couple'";
                $result = mysqli_query($conn, $sql);
                $donnes = mysqli_fetch_array($result);

                echo"<td> <label>Partenaire :</label> </td>  <td> <label>";
                echo $donnes['Nom']." ".$donnes['Prenom'];
                echo " </label> </td> <td> </td> </tr>";
            }?>
        <tr>

               <?php
                $ab = 0;
               while ($donnees = $result2->fetch_array()){
                   echo"<tr>";
                   if ($ab === 3)
                   {
                       echo "<td></td><td>".$donnees["description"]."</td> <td>".$donnees["Date"]."</td> </tr>";
                   }
                   if ($ab === 0)
                   {
                       echo " <td><label>Profession(s) :</label></td>";
                       echo "<td>".$donnees["description"]."</td> <td>".$donnees["Date"]."</td> </tr>";
                       $ab = 3;
                   }
               }
             ?>
        </tr>
        <tr>
            <td>
                <a href="<?php echo "modification_client_psy.php?var1=".$client?>"><input class="buuton" type="button" value="Modifier la fiche"></a>
            </td>
            <td>

                    <input type="text" name="id_client" value="<?php echo $client?>" style="display: none">
                    <input class="buuton" type="submit" value="historique des rendez-vous">

            </td>
            <td>
                <a href="fiche_client_form.php"><input class="buuton" type="button" value="Retour"></a>
            </td>
        </tr>
    </table>
</form>
</form>


</body>
</html>