<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "psychologue");

//Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['login_btn'])) {
    $email = ($_POST['email']);
    $Password = ($_POST['password']);


    $sql = "SELECT Prenom,Email,Mdp,Id_client FROM client WHERE Email='$email' AND Mdp = '$Password'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM admin WHERE Mdp = '$Password' AND Email = '$email'";
    $result1 = mysqli_query($conn, $sql1);

    while ($donnees = $result->fetch_array())
    {
        $stock = $donnees[0];
        $id_client = $donnees[3];
    }

    if (mysqli_num_rows($result) == 1 && $Password != '0') {

        $_SESSION['prenom'] = $stock;
        $_SESSION['id_client'] = $id_client;
        $_SESSION['Login'] = 'client';
        header("location: ../html/accueil_client_form.php");
    }
    if (mysqli_num_rows($result1)==1)
    {
        $_SESSION['Login'] = 'psy';
        header("location: ../html/accueil_psy_form.php"); //redirect
    }
    else{
        die("<script>alert(\"Mauvais identifiant ou mot de passe\")</script><script>window.history.back()</script>");
    }




}
