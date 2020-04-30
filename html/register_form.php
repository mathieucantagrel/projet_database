<!DOCTYPE html>
<html lang="en">
<head>
    <title>Créer un compte</title>
    <link rel="stylesheet" type="text/css" href="../style/register.css">
</head>
<body>
<div class="loginbox">

    <IMG src="../avatar.png" class="avatar">

    <h1>Créer un compte</h1>
    <form method="post" action="../php/register.php">
        <label>
            <input type="email" name="email" placeholder="Votre adresse mail">
            <input type="password" name="password" placeholder="Votre mot de passe">
            <input type="password" name="password2" placeholder="Encore votre mot de passe">
        </label>
        <input class="create" type="submit" name="register_btn" value="Valider">
        <a href="login_client_form.php"> <- Revenir en arrière</a>
    </form>
</div>

</body>
</html>
