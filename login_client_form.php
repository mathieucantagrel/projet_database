<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion patient</title>
    <link rel="stylesheet" type="text/css" href="login1.css">
</head>
<body>

    <div class="loginbox">

        <IMG src="avatar.png" class="avatar">

        <h1>Connexion</h1>
        <form method="post">
            <p>Email</p>
            <label>
                <input type="email" name="email" placeholder="Votre email">
            </label>

            <p>Mot de passe</p>
            <label>
                <input type="password" name="password" placeholder="Votre mot de passe">
            </label>

            <input class="create" type="submit" name="login_btn" value="Connexion">
            <a href="register_form.php">Tu n'as pas de compte ? Clique ici !</a>
            <br> <a href="login_psy_form.php">Tu es le psy ?</a>
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
    $email = ($_POST['email']);
    $Password = ($_POST['password']);


    $sql = "SELECT Email, Mdp FROM client WHERE Email='$email' AND Mdp = '$Password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)==1)
    {
        header("location: ajout_client_form.php"); //redirect
    }
}
?>

</html>

