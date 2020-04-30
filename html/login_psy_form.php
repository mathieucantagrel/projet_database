<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion patient</title>
    <link rel="stylesheet" type="text/css" href="../style/login1.css">
</head>
<body>

<div class="loginbox">

    <IMG src="../avatar.png" class="avatar">

    <h1>Connexion</h1>
    <form method="post">
        <label>
            <input type="text" name="nom" placeholder="Votre nom">
            <input type="text" name="prenom" placeholder="Votre prénom">
            <input type="password" name="password" placeholder="Votre mot de passe">
        </label>

        <input class="create" type="submit" name="login_btn" value="Connexion">
        <a href="login_client_form.php"> <- Revenir en arrière</a>
    </form>
</div>
</body>

<?php
$conn=mysqli_connect("localhost", "root", "", "psychologue");

//Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

if (isset($_POST['login_btn']))
{
    session_start();
    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $Password = ($_POST['password']);


    $sql = "SELECT * FROM psy WHERE Nom ='$nom' AND Mdp = '$Password' AND Prenom = '$prenom'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)==1)
    {
        header("location: ajout_client_form.php"); //redirect
    }
}
?>

</html>
