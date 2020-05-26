<?php

session_start();

include 'conn.php';

$id_seance = $_GET['id'];

if (isset($_POST['retour'])){
    die("<script>window.history.go(-2)</script>");
}


if (isset($_POST['changement'])) {

    if ($_SESSION['Login'] == 'client') {

        $date = isset($_POST['date']) ? $_POST['date'] : NULL;
        $heure = isset($_POST['heure']) ? $_POST['heure'] : NULL;
        $minutes = isset($_POST['minute']) ? $_POST['minute'] : NULL;

        $heure_rdv = date('H:i:s', strtotime("$heure:$minutes:00"));

        $sql = "SELECT Id_seance FROM `seance` WHERE DATE='$date' AND Heure='$heure_rdv'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['Id_seance'] != $id_seance && $row['Id_seance'] != NULL) {
            die("<script>alert(\"le crénau horaire est deja pris\")</script><script>window.history.back()</script>");
        }

        $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv'
            WHERE `Id_seance` = $id_seance";

        if (!mysqli_query($conn, $sql)) {
            echo mysqli_error($conn);
        }

        $dernier_lundi = date("Y-m-d", strtotime("previous monday"));
        header("location: ../html/calendrier.php?date=$dernier_lundi");

    } else{
        $date = isset($_POST['date']) ? $_POST['date'] : NULL;
        $heure = isset($_POST['heure']) ? $_POST['heure'] : NULL;
        $minutes = isset($_POST['minute']) ? $_POST['minute'] : NULL;
        $prix = isset($_POST['prix']) ? $_POST['prix'] : NULL;
        $moyen_paiement = isset($_POST['moyen_paiement']) ? $_POST['moyen_paiement'] : NULL;
        $remarques = isset($_POST['remarques']) ? $_POST['remarques'] : NULL;
        $note_anxiete = isset($_POST['note_axiete']) ? $_POST['note_axiete'] : NULL;

        $nbr_client = 1;

        $id_premier = isset($_POST['Id_client1']) ? $_POST['Id_client1'] : NULL;

        $id_deuxieme = isset($_POST['Id_client2']) ? $_POST['Id_client2'] : NULL;
        if ($id_deuxieme=="NULL"){
            $id_deuxieme=NULL;
            $nbr_client += 1;
        }

        $id_troisieme = isset($_POST['Id_client3']) ? $_POST['Id_client3'] : NULL;
        if($id_troisieme=="NULL"){
            $id_troisieme=NULL;
            $nbr_client += 1;
        }

        echo "premier : $id_premier <br> deuxieme : $id_deuxieme <br> troisieme : $id_troisieme <br>nb client : $nbr_client <br>";


        $heure_rdv = date('H:i:s', strtotime("$heure:$minutes:00"));

        $sql = "SELECT Id_seance FROM `seance` WHERE Date='$date' AND Heure='$heure_rdv'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['Id_seance'] != $id_seance && $row['Id_seance'] != NULL) {
            die("<script>alert(\"le crénau horaire est deja pris\")</script><script>window.history.back()</script>");
        }

        $sql = "SELECT * FROM `seance` WHERE `Date`='$date'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)>=20){
            die("<script>alert(\"impossible de modifier le rendez-vous à ce jour\")</script><script>window.history.back()</script>");
        }

        if ($id_deuxieme == NULL && $id_troisieme == NULL) {
            $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv',
            `Prix`='$prix',
            `Moyen_paiement`='$moyen_paiement',
            `Remarques`='$remarques',
            `Nombre_client`='$nbr_client',
            `Note_anxiete`='$note_anxiete',
            `Id_client1`='$id_premier',
            `Id_client2`=NULL,
            `Id_client3`=NULL
            WHERE `Id_seance`='$id_seance'";
        } elseif ($id_deuxieme != NULL && $id_troisieme == NULL) {
            $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv',
            `Prix`='$prix',
            `Moyen_paiement`='$moyen_paiement',
            `Remarques`='$remarques',
            `Nombre_client`='$nbr_client',
            `Note_anxiete`='$note_anxiete',
            `Id_client1`='$id_premier',
            `Id_client2`='$id_deuxieme',
            `Id_client3`=NULL
            WHERE `Id_seance`='$id_seance'";
        } else {
            $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv',
            `Prix`='$prix',
            `Moyen_paiement`='$moyen_paiement',
            `Remarques`='$remarques',
            `Nombre_client`='$nbr_client',
            `Note_anxiete`='$note_anxiete',
            `Id_client1`='$id_premier',
            `Id_client2`='$id_deuxieme',
            `Id_client3`='$id_troisieme'
            WHERE `Id_seance`='$id_seance'";
        }


        if (!mysqli_query($conn, $sql)) {
            echo mysqli_error($conn);
        }


        $dernier_lundi = date("Y-m-d", strtotime("previous monday"));
        header("location: ../html/calendrier.php?date=$dernier_lundi");
    }
}

if (isset($_POST['supprimer'])){
    $sql = "DELETE FROM `seance` WHERE `Id_seance`='$id_seance'";

    if (!mysqli_query($conn, $sql)){
        echo mysqli_error($conn);
    }

    $dernier_lundi = date("Y-m-d", strtotime("previous monday"));
    header("location: ../html/calendrier.php?date=$dernier_lundi");
}
