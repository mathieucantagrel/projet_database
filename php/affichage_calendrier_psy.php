<?php

function affichage($dernier_lundi, $id){

    include '../php/conn.php';

    $sql = "SELECT * FROM `seance`";

    if ($id!='all'){
        $sql=$sql." WHERE `Id_client1`=$id";
    }

    $result = mysqli_query($conn, $sql);

    echo "<tr>
                <td class='jour'></td>
                <td class='jour'>Lundi ".date('d', strtotime($dernier_lundi))."</td>
                <td class='jour'>mardi ".date('d', strtotime($dernier_lundi. ' + 1 days'))."</td>
                <td class='jour'>Mercredi ".date('d', strtotime($dernier_lundi. ' + 2 days'))."</td>
                <td class='jour'>Jeudi ".date('d', strtotime($dernier_lundi. ' + 3 days'))."</td>
                <td class='jour'>Vendredi ".date('d', strtotime($dernier_lundi. ' + 4 days'))."</td>
                <td class='jour'>Samedi ".date('d', strtotime($dernier_lundi. ' + 5 days'))."</td>
                <td class='jour'>Dimanche ".date('d', strtotime($dernier_lundi. ' + 6 days'))."</td>
        </tr>";

    $h = date('H:i:s', strtotime("08:00:00"));

    while ($h!= "20:30:00"){
        echo "<tr> <td>".$h."</td>";

        for ($i=0; $i<=6; $i++){
            echo "<td>";
            $date = date('Y-m-d', strtotime($dernier_lundi. ' + '.$i.' days'));
            while ($rows = mysqli_fetch_array($result)){
                if (($rows['Date']==$date)&&("$h"==$rows['Heure'])) {
                    if ($rows['Id_client1'] != NULL){
                        $Id_Client1 = $rows['Id_client1'];
                        $sql = "SELECT Prenom,Nom FROM client WHERE `Id_client`= $Id_Client1 LIMIT 1";
                        $rdv = mysqli_query($conn, $sql);
                        $donnees = $rdv->fetch_array();
                        echo $donnees[0] . " " . $donnees[1]."<br>";
                    }
                    if ($rows['Id_client2'] != NULL){
                        $Id_Client2 = $rows['Id_client2'];
                        $sql = "SELECT Prenom,Nom FROM client WHERE `Id_client`= $Id_Client2 LIMIT 1";
                        $rdv = mysqli_query($conn, $sql);
                        $donnees = $rdv->fetch_array();
                        echo $donnees[0] . " " . $donnees[1]."<br>";
                    }
                    if ($rows['Id_client3'] != NULL){
                        $Id_Client3 = $rows['Id_client3'];
                        $sql = "SELECT Prenom,Nom FROM client WHERE `Id_client`= $Id_Client3 LIMIT 1";
                        $rdv = mysqli_query($conn, $sql);
                        $donnees = $rdv->fetch_array();
                        echo $donnees[0] . " " . $donnees[1]."<br>";
                    }
                    echo "<a href='../html/Edition_rdv.php?id=".$rows['Id_seance']."'>Editer</a>";
                }
            }
            echo "</td>";

            mysqli_data_seek($result, 0);
        }

        $h = date('H:i:s', strtotime('+ 30 minutes', strtotime($h)));
    }
}
