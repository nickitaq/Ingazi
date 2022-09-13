<?php 
session_start();
unset($_SESSION['ADMIN_ID']);
unset($_SESSION['USERNAME']);
header('Location:index.php');

?>