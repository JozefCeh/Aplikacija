<?php 
//počinjanje sesije
session_start();
unset($_SESSION['sess_user']);
//uništavanje sesije
session_destroy();
header("location:login.php");
?>
