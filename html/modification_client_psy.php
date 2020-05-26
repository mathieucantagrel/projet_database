<?php
    session_start();
    include '../php/conn.php';
    include '../php/Affichage_select_client.php';
    $client=$_GET["var1"];

    $sql = "SELECT * FROM `client` WHERE `Id_client` = $client";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row['Couple_avec']!=0)
    {
        $id_couple = $row['Couple_avec'];
        $sql = "SELECT * FROM `client` WHERE `Id_client` = '$id_couple'";
        $result = mysqli_query($conn, $sql);
        $donnes = mysqli_fetch_array($result);
    }

    $sql = "SELECT `description` FROM `profession`
                INNER JOIN `profession_client`
                ON profession.Id_profession = profession_client.Id_profession
                WHERE profession_client.Date=(
                SELECT MAX(Date) FROM `profession_client` WHERE Id_client='$client' 
                )";
    $result = mysqli_query($conn, $sql);
    while ($profession = $result->fetch_array()){
        $desciption = $profession[0];
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/fiche_client.css">
    <title>Modification fiche patient</title>
</head>
<body>
<form action="../php/modification_client_psy_action.php" method="post">
    <table>
        <tr>
            <td>
                <label>Nom :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="nom" value="<?php echo $row['Nom'] ?>" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Prénom :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="prenom" value="<?php echo $row['Prenom'] ?>" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label>Email :</label>
            </td>
            <td>
                <label>
                    <input type="email" name="email" value="<?php echo $row['Email'] ?>" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Date de naissance :</label>
            </td>
            <td>
                <label>
                    <input type="date" name="date_naissance" value="<?php echo $row['DoB'] ?>" required>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Genre :</label>
            </td>
            <td>
                <select name="genre" required>
                    <option value="enfant" id='E' <?php if ($row['Genre']=='enfant'){echo "selected";}?>>Enfant (entre 5 et 13 ans)</option>
                    <option value="ado" id='A' <?php if ($row['Genre']=='ado'){echo "selected";}?>>Adolescent (entre 14 et 18 ans)</option>
                    <option value="femme" id='F' <?php if ($row['Genre']=='femme'){echo "selected";}?>>Femme</option>
                    <option value="homme" id='H' <?php if ($row['Genre']=='homme'){echo "selected";}?>>Homme</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Moyen connu :</label>
            </td>
            <td>
                <label>
                    <input type="text" name="moyen_connu" value="<?php echo $row['Moyen_connu'] ?>">
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">En couple ?</label>
            </td>
            <td>
                <input type="radio" id="Oui" name="couple" value="oui" <?php if ($row['Situation']=='oui'){echo "checked";}?> onclick="affiche('1','2')">
                <label for="Oui">Oui</label>
                <input type="radio" id="non" name="couple" value="non" <?php if ($row['Situation']=='non'){echo "checked";}?> onclick="pasaffiche('1','2') ">
                <label for="non">Non</label>
            </td>
        </tr>

        <tr>
            <td>
                <label id='1'>Partenaire :</label>
            </td>
            <td>
                <label id='2'>
                    <select name="couple_avec">
                        <?php affichage_select();?>
                    </select>
                </label>
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Profession :</label>
            </td>
            <td>
                <input type="text" name="profession" value="<?php echo $desciption?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <input class="buuton" type="submit" value="Modifier">
            </td>
            <td>
            </td>
            <td>
                <a href="fiche_client_form.php"><input class="buuton" type="button" value="Retour"></a>
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
    <?php
        if ($row['Couple_avec']==0){
            echo "<script type=\"text/javascript\">pasaffiche('1','2')</script>";
        }
    ?>
</form>


</body>
</html>