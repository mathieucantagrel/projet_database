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
        $nom1 = isset($_POST['nom1']) ? $_POST['nom1'] : NULL;
        $prenom1 = isset($_POST['prenom1']) ? $_POST['prenom1'] : NULL;
        $nom2 = isset($_POST['nom2']) ? $_POST['nom2'] : NULL;
        $prenom2 = isset($_POST['prenom2']) ? $_POST['prenom2'] : NULL;
        $nom3 = isset($_POST['nom3']) ? $_POST['nom3'] : NULL;
        $prenom3 = isset($_POST['prenom3']) ? $_POST['prenom3'] : NULL;

        $nbr_client = 1;
        $id_client2 = NULL;
        $id_client3 = NULL;

        $sql = "SELECT Id_client FROM `client` WHERE Nom='$nom1' AND Prenom='$prenom1'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $id_client1 = $row['Id_client'];
        if ($id_client1 == NULL) {
            die("<script>window.history.back()</script>");
        }

        echo $id_client1;

        if ($nom2 != NULL && $prenom2 != NULL) {
            $sql = "SELECT Id_client FROM `client` WHERE Nom='$nom2' AND Prenom='$prenom2'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $id_client2 = $row['Id_client'];
            if ($id_client2 == NULL) {
                die("<script>alert(\"le client $nom2 $prenom2 n'existe pas\")</script><script>window.history.back()</script>");
            }
            $nbr_client += 1;
            echo $id_client2;
        }

        if ($nom3 != NULL && $prenom3 != NULL) {
            $sql = "SELECT Id_client FROM `client` WHERE Nom='$nom3' AND Prenom='$prenom3'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $id_client3 = $row['Id_client'];
            if ($id_client3 == NULL) {
                die("<script>alert(\"le client $nom3 $prenom3 n'existe pas\")</script><script>window.history.back()</script>");
            }
            $nbr_client += 1;
            echo $id_client3;
        }

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



        if ($id_client2 == NULL && $id_client3 == NULL) {
            $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv',
            `Prix`='$prix',
            `Moyen_paiement`='$moyen_paiement',
            `Remarques`='$remarques',
            `Nombre_client`='$nbr_client',
            `Note_anxiete`='$note_anxiete',
            `Id_client1`='$id_client1',
            `Id_client2`=NULL,
            `Id_client3`=NULL
            WHERE `Id_seance`='$id_seance'";
        } elseif ($id_client2 != NULL && $id_client3 == NULL) {
            $sql = "UPDATE `seance`
            SET `Date`='$date',
            `Heure`='$heure_rdv',
            `Prix`='$prix',
            `Moyen_paiement`='$moyen_paiement',
            `Remarques`='$remarques',
            `Nombre_client`='$nbr_client',
            `Note_anxiete`='$note_anxiete',
            `Id_client1`='$id_client1',
            `Id_client2`=$id_client2,
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
            `Id_client1`='$id_client1',
            `Id_client2`='$id_client2',
            `Id_client3`='$id_client3'
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
