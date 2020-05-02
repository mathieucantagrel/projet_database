<?php
include '../php/affichage_calendrier_psy.php';
$dernier_lundi = $_GET['date'];
$prochain_lundi = date('Y-m-d', strtotime($dernier_lundi. ' + 1 weeks'));
$precedent_lundi = date('Y-m-d', strtotime($dernier_lundi. ' - 1 weeks'));
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
<a href="<?php echo "calendrier.php?date=".$precedent_lundi?>"><input type="submit" value="<-"></a>
<a href="<?php echo "calendrier.php?date=".$prochain_lundi?>"><input type="submit" value="->"></a>
</body>
</html>
