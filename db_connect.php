<?php 
session_start();
$servername="localhost";
$username="ingazi_db";
$password="ODGservice";
$databse="ingazi_db";
// creating datbase connection
$conn=mysqli_connect($servername,$username,$password,$databse);
// checck connnection
if(!$conn ){
    die("Failed To connect".mysqli_connect_error());
}

?>