<?php 
session_start();
unset($_SESSION['ADMIN_ID']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USERNAME']);
unset($_SESSION['USER_TYPE']);
header('Location:login.php');

?>