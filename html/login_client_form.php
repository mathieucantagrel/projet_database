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
        <form method="post" action="../php/login_client.php">
            <p>Email</p>
            <label>
                <input type="email" name="email" placeholder="Votre email" required>
            </label>

            <p>Mot de passe</p>
            <label>
                <input type="password" name="password" placeholder="Votre mot de passe" required>
            </label>

            <input class="create" type="submit" name="login_btn" value="Connexion">
            <a href="register_form.php">Tu n'as pas de compte ? Clique ici !</a>
        </form>
    </div>
</body>
</html>

