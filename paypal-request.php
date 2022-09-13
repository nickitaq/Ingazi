<?php include 'db_connect.php'; ?>
<?php 
$booking_enquiry_id = $_REQUEST['booking_enquiry_id'] ?? $_SESSION['booking_enquiry_id'] ; 
$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
$row=mysqli_fetch_assoc($result);
$garage_id = $row['garage_id'];
$result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
$row2=mysqli_fetch_assoc($result_garage);

$garage_charges = mysqli_query($conn, "SELECT * FROM `tbl_my_config` WHERE `kay` = 'garage_charges'" );
$amount=$row['payment'] ; 

$sendbox = mysqli_query($conn, "SELECT * FROM `tbl_my_config` WHERE `kay` = 'paypal_sendbox'" );
$paypal_sendbox=mysqli_fetch_assoc($sendbox)['value'];

if ($paypal_sendbox == '1') {
    $business_email = mysqli_query($conn, "SELECT * FROM `tbl_my_config` WHERE `kay` = 'paypal_sendbox_account'" );
    $business=mysqli_fetch_assoc($business_email)['value'];
    $action  = "https://www.sandbox.paypal.com/cgi-bin/webscr";

} else {
    $business_email = mysqli_query($conn, "SELECT * FROM `tbl_my_config` WHERE `kay` = 'paypal_account'" );
    $business=mysqli_fetch_assoc($business_email)['value'];
    $action  = "https://www.paypal.com/cgi-bin/webscr";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>On Demand Garage Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <section style="margin-top:30px">
         <div class="container">
        <div>
            <form id ="paypal" name="paypal" action="<?php echo $action; ?>" method="post">
            <input type="hidden" value="_xclick" name="cmd">
            <input type="hidden" value="<?php echo $business;?>" name="business">
            <input type="hidden" value="<?php echo $row2['title']; ?>" name="item_name">
            <input type="hidden" value="<?php echo $amount;?>" name="amount">
            <input type="hidden" value="https://ingazi.com/thank-you.php" name="return">
            <input type="hidden" name="notify_url" value="https://ingazi.com/notify.php" />
            <input type="hidden" name="item_number" value="<?php echo $_SESSION['booking_enquiry_id']; ?>">
            <input type="hidden" name="currency_code" value="USD">
                        
            <center style="color:#fff; display:none;"><input type="image" name="submit" border="0"
            src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif"
            alt="PayPal - The safer, easier way to pay online"></center>
            </form>
        </div>
    </div>
    </section>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
             $("#paypal").submit();
        });
    </script>     
</script>
</body>

</html>