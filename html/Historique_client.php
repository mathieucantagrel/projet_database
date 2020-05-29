<?php

session_start();
include '../php/conn.php';

$id_client = NULL;
$log = NULL;

if (isset($_SESSION['id_client'])) {
    $id_client = $_SESSION['id_client'];
    $log = 'client';
}
if (isset($_POST['id_client'])){
    $id_client = $_POST['id_client'];
    $log = 'psy';
}

$sql = "SELECT * FROM `seance` WHERE ( Id_client1=$id_client OR Id_client2=$id_client OR Id_client3=$id_client )";
$result = mysqli_query($conn, $sql);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/fiche_client.css">
    <title>Séance</title>
</head>
<body>
<div id="main_content">

    <table>

        <?php

        while($rows = mysqli_fetch_array($result)){
            echo "<tr>
                    <td>
                        ".$rows['Date']."
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td>
                        ".$rows['Heure']."
                    </td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                  <td></td>";
                if ($log=="psy")
                {
                echo "<td>
                        Remarques :
                    </td>
                    <td>
                    ".$rows['Remarques']."
                    </td>
                  </tr>
                  <tr>
                  <td></td>
                    <td>
                        Anxiété :
                    </td>
                    <td>
                    ".$rows['Note_anxiete']."
                    </td>
                  </tr>
                  <tr>
                  <td></td>";
                }
                echo "                    
                    <td>
                        Moyen de paiement :
                    </td>
                    
                    <td>
                    ".$rows['Moyen_paiement']."
                    </td>
                  </tr>
                  <tr>
                  <td></td>
                    <td>
                        Prix : 
                    </td>
                   
                    <td>
                    ".$rows['Prix']."€
                    </td>
                  </tr>";

        }

        ?>
        <tr>
            <td>
                <a href="<?php if ($log=="client"){echo "accueil_client_form.php";}else{echo"fiche_client_form.php";}?>"><input class = "buuton" type="button" value="Retour" ></a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>

