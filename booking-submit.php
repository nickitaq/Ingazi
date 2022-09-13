<?php 
include 'db_connect.php';
if(isset($_SESSION['booking'])) {
    $services =   mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data']['services']);
    $vehicle  = mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data']['vehicle']);
    $vehicle_no =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['vehicle_no']);
    $date =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['date']);
    $country =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['country']);
    $state =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['state']);
    $city =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['city']);
    $postcode =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['postcode']);
    $formatted_address =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['formatted_address']);
    $longitude =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['longitude']);
    $latitude =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['latitude']);
    $sublocality =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['sublocality']);
    $route =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'booking_data'] ['route']);
    $garage_id =  mysqli_real_escape_string($conn, $_SESSION['booking'][ 'garage'] );
    $user_id =$_SESSION['USER_ID'];
    $query = mysqli_query($conn,"INSERT INTO tbl_garage_booking (`services`, `vehicle`,  `vehicle_no`,  `date`,`user_id`,`garage_id`,  `longitude`,  `latitude`, `country`, `state`, `city`,`route`,`sublocality`, `postcode`,`formatted_address`)
    VALUES ('$services','$vehicle','$vehicle_no','$date','$user_id','$garage_id','$longitude','$latitude','$country','$state','$city','$route','$sublocality','$postcode','$formatted_address')") or die(mysqli_error($conn));
    if( $query){
            $insert_id =  mysqli_insert_id($conn) ; 
            $_SESSION['booking_enquiry_id'] = $insert_id ;     
            unset($_SESSION['booking']) ; 
            include('email-booking-details-to-garage.php');
            include('email-booking-details-to-user.php');
            echo "<script> location.replace('thank-you.php')</script>" ; 
        //   echo "<script> location.replace('paypal-request.php?booking_enquiry_id=$insert_id')</script>" ; 
    }else{
         echo "<script> alert('Server Error, Please again book.') ; </script>" ; 
         echo "<script> location.replace('index.php')</script>" ; 
    }
}
 echo "<script> location.replace('index.php')</script>" ; 
?>

