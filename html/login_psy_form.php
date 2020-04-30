<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion psychologue</title>
    <link rel="stylesheet" type="text/css" href="../style/login1.css">
</head>
<body>

<div class="loginbox">

    <IMG src="../avatar.png" class="avatar">

    <h1>Connexion</h1>
    <form method="post" action="../php/login_psy.php">
        <label>
            <input type="email" name="email" placeholder="Votre email">
            <input type="password" name="password" placeholder="Votre mot de passe">
        </label>

        <input class="create" type="submit" name="login_btn" value="Connexion">
        <a href="login_client_form.php"> <- Revenir en arrière</a>
    </form>
</div>
</body>


</html>
