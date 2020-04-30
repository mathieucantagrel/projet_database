<?php
$conn=mysqli_connect("localhost", "root", "", "psychologue");

//Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

if (isset($_POST['register_btn']) && !empty($_POST))
{
    session_start();
    $Email = ($_POST['email']);
    $Password = ($_POST['password']);
    $Password2 = ($_POST['password2']);

    $check_duplicate_email = "SELECT Email FROM client WHERE Email ='$Email' ";
    $result = mysqli_query($conn,$check_duplicate_email);

    $cl = "SELECT Mdp FROM client WHERE Email ='$Email' ";
    $result2 = mysqli_query($conn,$cl);


    $count = mysqli_num_rows($result);

    if ($count > 0)
    {
        if ($Email =='' || empty($Email))
        {
            echo"Email can't be void";
            sleep(5);
            header("location:register_form.php");
            exit;
        }
        elseif ($Password =='' || empty($Password))
        {
            echo"Password can't be void";
            sleep(5);
            header("location:register_form.php");
            exit;
        }
        elseif ($Password == $Password2 && empty($result2))
        {
            $sql="UPDATE client SET Mdp = '$Password' WHERE Email ='$Email'";
            mysqli_query($conn,$sql);
            header("location:login_client_form.php"); //redirect
        }
        else
        {
            echo"User can't be create";
            sleep(5);
            header("location:register_form.php"); //redirect
        }
    }
    else
    {

    }
}
?>