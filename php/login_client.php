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


    $sql = "SELECT Prenom,Email, Mdp FROM client WHERE Email='$email' AND Mdp = '$Password'";
    $result = mysqli_query($conn, $sql);

    while ($donnees = $result->fetch_array())
    {
        $stock = $donnees[0];
    }
    if (mysqli_num_rows($result) == 1 && $Password != '0') {

        $_SESSION['prenom'] = $stock;
        header("location: ../html/accueil_client_form.php");
    }
}
