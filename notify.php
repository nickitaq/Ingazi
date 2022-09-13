<?php include 'db_connect.php'; ?>
<?php 
    $booking_enquiry_id =  $_REQUEST['item_number'];
    $result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
    $row=mysqli_fetch_assoc($result);
    $garage_id = $row['garage_id'];
    $result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
    $row2=mysqli_fetch_assoc($result_garage);

    $sql = "update `tbl_garage_booking` set payment_status = 'Paid' WHERE id = $booking_enquiry_id";
    $result = mysqli_query($conn, $sql);

    include('email-booking-details-to-garage.php');
    include('email-booking-details-to-user.php');
?>

