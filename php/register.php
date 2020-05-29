<?php
include "conn.php";

if (isset($_POST['register_btn']) && !empty($_POST))
{
    $Email = ($_POST['email']);
    $Password = ($_POST['password']);
    $Password2 = ($_POST['password2']);

    $check_duplicate_email = "SELECT Email FROM client WHERE Email ='$Email' ";
    $result = mysqli_query($conn,$check_duplicate_email);

    $cl = "SELECT Mdp FROM client WHERE Email ='$Email' ";
    $result2 = mysqli_query($conn,$cl);


    $count = mysqli_num_rows($result);
    $count2 = mysqli_num_rows($result2);

    while ($donnees = $result2->fetch_array())
    {
        $stock = $donnees[0];
    }

    if ($count == 1 && $stock == '0')
    {
        if ($Email =='' || empty($Email))
        {
            echo"Email can't be void";
            sleep(1);
            header("location:../html/register_form.php");
            exit;
        }
        if ($Password =='' || empty($Password))
        {
            echo"Password can't be void";
            sleep(1);
            header("location:../html/register_form.php");
            exit;
        }
        if ($Password != $Password2)
        {
            echo"Vos mots de passe doivent être similaire";
            exit;
        }
        if ($Password == $Password2)
        {
            if ($count2 == 1)
            {
                $Password_hashed = password_hash($Password, PASSWORD_DEFAULT);
                $sql="UPDATE client SET Mdp = '$Password_hashed' WHERE Email ='$Email'";
                mysqli_query($conn,$sql);
                header("location:../html/login_client_form.php");
            }

        }
    }
    else
    {
        //   sleep(2);
        //   header("location:../html/register_form.php");
        echo"User can't be create";
    }
}
