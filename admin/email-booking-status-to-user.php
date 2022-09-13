<?php include 'db_connect.php'; ?>
<?php 

$booking_enquiry_id = $booking_enquiry_id ; 
$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
$row=mysqli_fetch_assoc($result);
$vehicle_no = $row['vehicle_no'];
$vehicle = $row['vehicle'];
$services = $row['services'];
$request = $row['request'];
$order_status = $row['order_status'];
$payment = $row['payment'];
$payment_status = $row['payment_status'];
$message = $row['message'];
$date = $row['date'];
$garage_id = $row['garage_id'];
$user_id = $row['user_id'];
$formatted_address =$row['formatted_address'];
$city =$row['city'];
$country =$row['country'];
$state =$row['state'];

$result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
$row2=mysqli_fetch_assoc($result_garage);
$title = $row2['title'];
$garage_email = $row2['email'];
$garage_phone_no = $row2['phone_no'];
$garage_formatted_address =$row2['formatted_address'];


$result_user = mysqli_query($conn, "select * from  tbl_users where id='$user_id' " );
$row3=mysqli_fetch_assoc($result_user);
$name = $row3['name'];
$email = $row3['email'];
$phone = $row3['phone'];


     $msg = '<html>
        <head>
        <title>  Booking Details </title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <style>
        table {
          border-collapse: collapse;
        }
        table, th, td {
          border: 1px solid black;
        }
        td{
            padding :5px;
            font-size: 18px;
        }
        </style>
        </head>
        <body>
            <div style="margin: auto;background: #f4f4f4;padding: 25px;max-width: 900px;border: 1px solid #c1adad;">
            <center> <h3> Booking Notification </h3> </center>
            <hr>
            <p>
            '. $message .'
            <p>
            <hr>
            <h3> Order Details</h3>
            <table class="table table-bordered" style="color:#000">
                    <tr>
                        <th style="width:200px">
                            Booking Id 
                        </th>
                        <th>
                            ODGS-'.$booking_enquiry_id.'
                        </th>
                    </tr>
                    <tr>
                        <th>
                           Payment
                        </th>
                        <th>
                            '. $payment .'
                        </th>
                    </tr>
                    <tr>
                        <th>
                           Payment status
                        </th>
                        <th>
                            '. $payment_status .'
                        </th>
                    </tr>
                     <tr>
                        <th>
                           Order status
                        </th>
                        <th>
                            '. $order_status .'
                        </th>
                    </tr>
                     <tr>
                        <th>
                           Request status
                        </th>
                        <th>
                            '. $request .'
                        </th>
                    </tr>
                </table>
                <hr>
                <h3> Booking Details</h3>
                <table class="table table-bordered" style="color:#000">
                    <tr>
                        <th style="width:200px">
                            Vehicle No
                        </th>
                        <th>
                            '. $vehicle_no .'
                        </th>
                    </tr>
                    <tr>
                         <th>
                            Vehicle 
                        </th>
                        <th>
                            '. $vehicle.'
                        </th>
                     </tr>
                    <tr>
                         <th>
                           Services
                        </th>
                        <th>
                            '. $services .'
                        </th>
                    </tr>
                    <tr>
                         <th>
                           Booking Date
                        </th>
                        <th>
                            '. $date.'
                        </th>
                    </tr>
                    
                </table>
                <hr>
                <h3> Garage Details</h3>
                <table class="table table-bordered" style="color:#000">
                    <tr>
                        <th  style="width:200px">
                           Garge Name
                        </th>
                        <th>
                            '.$title.'
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Garge Email
                        </th>
                        <th>
                            '. $garage_email.'
                        </th>
                    </tr>
                    <tr>
                         <th>
                            Garge Phone No 
                        </th>
                        <th>
                            '. $garage_phone_no.'
                        </th>
                     </tr>
                    <tr>
                         <th>
                           Garage Address
                        </th>
                        <th>
                            '. $garage_formatted_address .'
                        </th>
                    </tr>
                 
                </table>
                
                <h3>User Details</h3>  <br>
                 <table class="table table-bordered" style="color:#000">
                  
                    <tr>
                        <th  style="width:200px">
                           Name
                        </th>
                        <th>
                            '.$name  .'
                        </th>
                    </tr>
                    <tr>
                         <th>
                            Email 
                        </th>
                        <th>
                            '. $email  .'
                        </th>
                     </tr>
                    <tr>
                         <th>
                           phone
                        </th>
                        <th>
                           '. $phone   .'
                        </th>
                    </tr>
                   
                </table>
                <br>
                 <h3>User Location</h3>  <br>
                 <table class="table table-bordered" style="color:#000">
                    <tr>
                        <th  style="width:200px">
                            City
                        </th>
                        <th>
                           '. $city  .'
                        </th>
                    </tr>
                    <tr>
                        <th>
                            State
                        </th>
                        <th>
                           '. $state  .'
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Country
                        </th>
                        <th>
                            '. $country   .'
                        </th>
                    </tr>
                       <tr>
                         <th>
                           Address
                        </th>
                        <th>
                            '. $formatted_address  .'
                        </th>
                    </tr>
                    
                    
                </table>
                       
            </div>
        </body>
        </html>';
        // Make sure to escape quotes
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Booking Status <info@gogange.online/>' . "\r\n";		
        mail($email , ' Booking Status', $msg, $headers);