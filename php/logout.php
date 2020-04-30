<?php
session_start();
session_destroy();
unset($_SESSION['prenom']);
header("location:../html/logout_form.php");