
<?php  
include 'db_connect.php';
$_SESSION['booking']['garage'] = $_POST['garage_id'] ; 
if(!$_SESSION['USER_ID']){  
    $_SESSION['redirect_url'] = 'booking-submit.php' ; 
    header("Location: login.php");
} else{
    header("Location: booking-submit.php");
}             
?>
