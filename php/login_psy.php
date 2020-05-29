<?php
session_start();

$conn=mysqli_connect("localhost", "root", "", "psychologue");

//Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

if (isset($_POST['login_btn']))
{
    $email = ($_POST['email']);
    $Password = ($_POST['password']);

    $sql = "SELECT * FROM admin WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)==1)
    {
        while ($donnees = $result->fetch_array())
        {
            $Password_psy = $donnees[2];
        }
        if (!password_verify($Password, $Password_psy)){
            die("<script>alert(\"Mauvais identifiant ou mot de passe\")</script><script>window.history.back()</script>");
        }
        $_SESSION['Login'] = 'psy';
        header("location: ../html/accueil_psy_form.php"); //redirect
    }
}