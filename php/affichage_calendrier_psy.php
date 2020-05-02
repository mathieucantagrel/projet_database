<?php

function affichage($dernier_lundi){

    include '../php/conn.php';

    $sql = "SELECT * FROM `seance`";
    $result = mysqli_query($conn, $sql);

    echo "<tr>
                <td class='jour'></td>
                <td class='jour'>Lundi ".$dernier_lundi."</td>
                <td class='jour'>mardi ".date('Y-m-d', strtotime($dernier_lundi. ' + 1 days'))."</td>
                <td class='jour'>Mercredi ".date('Y-m-d', strtotime($dernier_lundi. ' + 2 days'))."</td>
                <td class='jour'>Jeudi ".date('Y-m-d', strtotime($dernier_lundi. ' + 3 days'))."</td>
                <td class='jour'>Vendredi ".date('Y-m-d', strtotime($dernier_lundi. ' + 4 days'))."</td>
                <td class='jour'>Samedi ".date('Y-m-d', strtotime($dernier_lundi. ' + 5 days'))."</td>
                <td class='jour'>Dimanche ".date('Y-m-d', strtotime($dernier_lundi. ' + 6 days'))."</td>
        </tr>";

    $h = date('H:i:s', strtotime("08:00:00"));

    while ($h!= "20:30:00"){
        echo "<tr> <td>".$h."</td>";

        for ($i=0; $i<=6; $i++){
            echo "<td>";
            $date = date('Y-m-d', strtotime($dernier_lundi. ' + '.$i.' days'));
            while ($rows = mysqli_fetch_array($result)){
                if (($rows['Date']==$date)&&("$h"==$rows['Heure'])){
                    echo "coucou";
                }
            }
            echo "</td>";

            mysqli_data_seek($result, 0);
        }

        $h = date('H:i:s', strtotime('+ 30 minutes', strtotime($h)));
    }
}
