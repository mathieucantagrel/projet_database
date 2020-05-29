<?php

session_start();

if ($_SESSION['Login']=='psy'){
    $id='all';
}elseif ($_SESSION['Login']=='client'){
    $id=$_SESSION['id_client'];
}

include('conn.php');
require('library/mc_table.php');

$lundi = $_GET['date'];
$mardi = date("Y-m-d",strtotime($lundi. "+1 days"));
$mercreci = date("Y-m-d",strtotime($lundi. "+2 days"));
$jeudi = date("Y-m-d",strtotime($lundi. "+3 days"));
$vendredi = date("Y-m-d",strtotime($lundi. "+4 days"));
$samedi = date("Y-m-d",strtotime($lundi. "+5 days"));
$dimanche = date("Y-m-d",strtotime($lundi. "+6 days"));

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->SetWidths(array(15, 38, 38, 38, 38, 38, 38, 38)); //array represente le nombre de colones et leurs dimentions
$pdf->Row(array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "vendredi", "samedi", "dimanche"));

$sql = "SELECT Date,Heure,Id_client1,Id_client2,Id_client3 FROM `seance`
        WHERE Date='$lundi' OR
        Date='$mardi' OR
        Date='$mercreci' OR
        DATE='$jeudi' OR
        Date='$vendredi' OR
        Date='$samedi' OR
        Date='$dimanche'";

$resultat_semaine = mysqli_query($conn, $sql);


$h = date('H:i:s', strtotime("08:00:00"));
while ($h!= "20:30:00"){

    $cell_lundi = generation_cell($lundi, $resultat_semaine, $h, $conn, $id);

    $cell_mardi = generation_cell($mardi, $resultat_semaine, $h, $conn, $id);

    $cell_mercredi = generation_cell($mercreci, $resultat_semaine, $h, $conn, $id);

    $cell_jeudi = generation_cell($jeudi, $resultat_semaine, $h, $conn, $id);

    $cell_vendredi = generation_cell($vendredi, $resultat_semaine, $h, $conn, $id);

    $cell_samedi = generation_cell($samedi, $resultat_semaine, $h, $conn, $id);

    $cell_dimanche = generation_cell($dimanche,$resultat_semaine, $h, $conn, $id);

    $h2 = date("H:i", strtotime($h));

    $pdf->Row(array($h2, $cell_lundi, $cell_mardi, $cell_mercredi, $cell_jeudi, $cell_vendredi, $cell_samedi, $cell_dimanche));
    mysqli_data_seek($resultat_semaine, 0);

    $h = date('H:i:s', strtotime('+ 30 minutes', strtotime($h)));
}

$pdf->Output();

function generation_cell($jour, $resultat_semaine, $h, $conn, $id){

    $cell = "";

    while($row=mysqli_fetch_array($resultat_semaine)){
        if (($row['Heure']==$h)&&($row['Date']==$jour)){
            $id_client1 = $row['Id_client1'];
            $id_client2 = $row['Id_client2'];
            $id_client3 = $row['Id_client3'];

            if ($id!='psy'){
                if ($id!=$id_client1&&$id!=$id_client2&&$id!=$id_client3){
                    $cell = "X";
                    return $cell;
                }
            }

            $sql = "SELECT Nom,Prenom FROM `client` 
                    WHERE Id_client='$id_client1' OR 
                    Id_client='$id_client2' OR 
                    Id_client='$id_client3'";
            $resultat_client = mysqli_query($conn, $sql);
            while ($donnes = mysqli_fetch_array($resultat_client)){
                $cell.=$donnes['Nom']." ".$donnes['Prenom']."\n";
            }
        }
    }

    mysqli_data_seek($resultat_semaine, 0);

    return $cell;
}