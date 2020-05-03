<?php
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
    <title>Document</title>
</head>
<body>
<table>
    <?php
        affichage($dernier_lundi);
    ?>
</table>
<p>semaine:</p>
<a href="<?php echo "calendrier.php?date=".$precedent_lundi?>"><input type="submit" value="<-"></a>
<a href="<?php echo "calendrier.php?date=".$prochain_lundi?>"><input type="submit" value="->"></a>
<p>mois:</p>
<a href="<?php echo "calendrier.php?date=".$precedent_mois?>"><input type="submit" value="<-"></a>
<a href="<?php echo "calendrier.php?date=".$prochain_mois?>"><input type="submit" value="->"></a>
<p>annee:</p>
<a href="<?php echo "calendrier.php?date=".$precedent_lundi?>"><input type="submit" value="<-"></a>
<a href="<?php echo "calendrier.php?date=".$prochain_lundi?>"><input type="submit" value="->"></a>
</body>
</html>
