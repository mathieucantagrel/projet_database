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
    <title>Document</title>
</head>
<body>
<div class="selections">
    <?php if ($_SESSION['Login']=='psy'){
        echo "<a href=\"accueil_psy_form.php\"><input type=\"submit\" value=\"retour\" class=\"retour\"></a>";
    }else{
        echo "<a href=\"accueil_client_form.php\"><input type=\"submit\" value=\"retour\" class=\"retour\"></a>";
    }?>

</div>
<div class="selections">
    <a href="<?php echo "calendrier.php?date=".$precedente_annee?>"><input type="submit" value="&lt;"></a>
    <span>annee: <?php echo date('Y', strtotime($dernier_lundi))?></span>
    <a href="<?php echo "calendrier.php?date=".$prochaine_annee?>"><input type="submit" value="&gt;"></a>
</div>

<div class="selections">
    <a href="<?php echo "calendrier.php?date=".$precedent_mois?>"><input type="submit" value="&lt;"></a>
    <span>mois: <?php echo date('m', strtotime($dernier_lundi))?></span>
    <a href="<?php echo "calendrier.php?date=".$prochain_mois?>"><input type="submit" value="&gt;"></a>
</div>

<div class="selections">
    <a href="<?php echo "calendrier.php?date=".$precedent_lundi?>"><input type="submit" value="&lt;"></a>
    <span>semaine:</span>
    <a href="<?php echo "calendrier.php?date=".$prochain_lundi?>"><input type="submit" value="&gt;"></a>
</div>
<div class="selections">
    <a href="<?php echo "../php/pdfgenerator.php?date=".$dernier_lundi ?>"><input type="submit" value="générer en pdf" class="retour"></a>
</div>

<table>
    <?php
        affichage($dernier_lundi, $id);
    ?>
</table>

</body>
</html>
