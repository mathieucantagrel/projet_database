<?php

session_start();

if ($_SESSION['Login']=='psy'){
    $id='all';
}elseif ($_SESSION['Login']=='client'){
    $id=$_SESSION['id_client'];
}

include '../php/affichage_calendrier_psy.php';
$dernier_lundi = $_GET['date'];

$prochain_lundi = date('Y-m-d', strtotime($dernier_lundi. ' + 1 weeks'));
$precedent_lundi = date('Y-m-d', strtotime($dernier_lundi. ' - 1 weeks'));

$prochain_mois = date('Y-m-d', strtotime($dernier_lundi. ' + 1 months'));
$prochain_mois = date("Y-m-d", strtotime("previous monday", strtotime($prochain_mois)));

$precedent_mois = date('Y-m-d', strtotime($dernier_lundi. ' - 1 months'));
$precedent_mois = date("Y-m-d", strtotime("previous monday", strtotime($precedent_mois)));

$prochaine_annee = date('Y-m-d', strtotime($dernier_lundi. ' + 1 years'));
$prochaine_annee = date("Y-m-d", strtotime("previous monday", strtotime($prochaine_annee)));

$precedente_annee = date('Y-m-d', strtotime($dernier_lundi. ' - 1 years'));
$precedente_annee = date("Y-m-d", strtotime("previous monday", strtotime($precedente_annee)));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/Calendrier_style.css">
    <title>Calendrier</title>
</head>
<body>

<br>

<div class="selections">
    <div class="buuton">
        <a href="<?php echo "calendrier.php?date=".$precedente_annee?>"><input class="couleur" type="submit" value="&lt;"></a>
        <span>Année : <?php echo date('Y', strtotime($dernier_lundi))?></span>
        <a href="<?php echo "calendrier.php?date=".$prochaine_annee?>"><input class="couleur" type="submit" value="&gt;"></a>
    </div>
</div>

<div class="selections">
    <div class="buuton">
        <a href="<?php echo "calendrier.php?date=".$precedent_mois?>"><input class="couleur" type="submit" value="&lt;"></a>
        <span>Mois : <?php echo date('m', strtotime($dernier_lundi))?></span>
        <a href="<?php echo "calendrier.php?date=".$prochain_mois?>"><input class="couleur" type="submit" value="&gt;"></a>
    </div>
</div>

<div class="selections">
    <div class="buuton">
        <a href="<?php echo "calendrier.php?date=".$precedent_lundi?>"><input class="couleur" type="submit" value="&lt;"></a>
        <span>Semaine</span>
        <a href="<?php echo "calendrier.php?date=".$prochain_lundi?>"><input class="couleur" type="submit" value="&gt;"></a>
    </div>
</div>

<br>

<div class="milieu">
    <table>
        <?php
            affichage($dernier_lundi, $id);
        ?>
    </table>
</div>

<div class="selections">
    <div class="buuton">
        <a href="<?php echo "../php/pdfgenerator.php?date=".$dernier_lundi ?>"><input type="submit" value="Générer en PDF" class="retour"></a>
    </div>
</div>

<div class="selections">
    <div class="buuton">
        <?php if ($_SESSION['Login']=='psy'){
            echo "<a href=\"accueil_psy_form.php\"><input type=\"submit\" value=\"Retour\" class=\"retour\"></a>";
        }else{
            echo "<a href=\"accueil_client_form.php\"><input type=\"submit\" value=\"Retour\" class=\"retour\"></a>";
        }?>
    </div>
</div>

</body>
</html>
