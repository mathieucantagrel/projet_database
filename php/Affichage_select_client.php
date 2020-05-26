<?php

function affichage_select(){

    session_start();
    include 'conn.php';
    $id_client = $_SESSION['id_client'];

    $sql = "SELECT Couple_avec FROM `client` WHERE `Id_client`='$id_client'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        $id_couple = $row['Couple_avec'];
    }

    $sql = "SELECT Id_client, Nom, Prenom FROM `client` ORDER BY Nom";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)){
        $couple = false;
        $id = $row['Id_client'];
        if ($id==$id_client){
            continue;
        }
        if ($id==$id_couple){
            $couple = true;
        }
        $nom = $row['Nom'];
        $prenom = $row['Prenom'];
        if (!$couple) {
            echo "<option value='$id'>$nom $prenom</option>";
        }else{
            echo "<option value='$id' selected>$nom $prenom</option>";
        }
    }
}

function affichage_select_psy($id_client_rdv){

    include 'conn.php';

    $sql = "SELECT Id_client, Nom, Prenom FROM `client` ORDER BY Nom";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($result)){
        $id = $row['Id_client'];
        $nom = $row['Nom'];
        $prenom = $row['Prenom'];
        if ($id!=$id_client_rdv) {
            echo "<option value='$id'>$nom $prenom</option>";
        }else{
            echo "<option value='$id' selected>$nom $prenom</option>";
        }
    }
}