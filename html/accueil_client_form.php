
<?php
    session_start();
    $dernier_lundi = date("Y-m-d", strtotime("previous monday"));
?>

<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../style/accueil_psy.css">
    <title>Accueil</title>
</head>

<body>
<div id="main_content">
    <table>
        <tr>
            <td>
                <h1> Accueil client</h1>
                <h3><?php echo 'Bonjour ' . $_SESSION['prenom'];?></h3>
            </td>
        </tr>
        <tr>
            <td>
                <a href="rdv_form.php"><input type="submit" name="" value="Une autre page"></a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo "calendrier.php?date=".$dernier_lundi?>"><input type="submit" name="" value="voir rdv"></a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="../php/logout.php"><input type="submit" value="Déconnexion"></a>
            </td>
        </tr>
    </table>
</div>

</body>
</html>


