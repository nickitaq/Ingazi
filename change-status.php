<?php
include "db_connect.php";

if(!$_SESSION['USER_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}

$booking_enquiry_id = $_GET['id'];  
$user_id = $_SESSION['USER_ID']; ; 

if(isset($_POST['order_status'])){
    $order_status =mysqli_real_escape_string($conn, $_POST['order_status']);
    $request =mysqli_real_escape_string($conn, $_POST['request']);
    $message =mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "update tbl_garage_booking SET  order_status='$order_status' , request='$request', message='$message',notification_flag='1' where id='$booking_enquiry_id'"; 
    $query = mysqli_query($conn, $sql);
    if( $query){
        include('email-booking-status-to-user.php') ;
          $_SESSION['success-msg']='<div class="alert alert-success">Update Successfully</div>';
          
      }else{
          $_SESSION['success-msg']='<div class="alert alert-danger"> Not Update, Please Try again</div>';
  
      }
}

$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id'" );
$row=mysqli_fetch_assoc($result);

$garage_id = $row['garage_id'];
$result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
$row2=mysqli_fetch_assoc($result_garage);

$user_id = $row['user_id'];
$result_user = mysqli_query($conn, "select * from  tbl_users where id='$user_id' " );
$row3=mysqli_fetch_assoc($result_user);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Booking Details</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Booking id:  ODGS-<?php echo $row['id']  ; ?></h1>
                    <?php 
                        
                        if(isset($_SESSION['success-msg'])){
                            echo $_SESSION['success-msg'];
                            unset($_SESSION['success-msg']);
                        }
                    ?>
                     <div class="row" >
                            <div class="col-sm-6"> 
                                <h3>Booking Details</h3>  <br>
                                 <table class="table table-bordered" >
                                   <tr>
                                        <th>
                                            Booking Id 
                                        </th>
                                        <th>
                                            ODGS-<?php echo $row['id']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Vehicle No
                                        </th>
                                        <th>
                                            <?php echo $row['vehicle_no']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                         <th>
                                            Vehicle 
                                        </th>
                                        <th>
                                            <?php echo $row['vehicle']  ; ?>
                                        </th>
                                     </tr>
                                    <tr>
                                         <th>
                                           Services
                                        </th>
                                        <th>
                                            <?php echo $row['services']  ; ?>
                                        </th>
                                    </tr>
                                      <tr>
                                         <th>
                                           Booking Date
                                        </th>
                                        <th>
                                            <?php echo $row['date']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                         <th>
                                          Request Status
                                        </th>
                                        <th>
                                            <?php echo $row['request']  ; ?>
                                        </th>
                                    </tr>
                                     <tr>
                                         <th>
                                           Order Status
                                        </th>
                                        <th>
                                            <?php echo $row['order_status']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                         <th>
                                           Payment
                                        </th>
                                        <th>
                                            <?php echo $row['payment']  ; ?>
                                        </th>
                                    </tr>
                                    
                                     <tr>
                                         <th>
                                          Payment Status 
                                        </th>
                                        <th>
                                            <?php echo $row['payment_status']  ; ?>
                                        </th>
                                    </tr>
                                 
                                  
                                </table>
                            </div>
                            
                            <div class="col-sm-6">
                                 <h3>Service Center Details</h3>  <br>
                                <table class="table table-bordered" >
                                      <tr>
                                        <th>
                                            Garage
                                        </th>
                                        <th>
                                           <?php echo $row2['title']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            About 
                                        </th>
                                        <th>
                                            <?php echo $row2['description']  ; ?>
                                        </th>
                                    </tr>
                                      <tr>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            <?php echo $row2['email']  ; ?>
                                        </th>
                                    </tr>
                                      <tr>
                                        <th>
                                            Phone no
                                        </th>
                                        <th>
                                            <?php echo $row2['phone_no']  ; ?>
                                        </th>
                                    </tr>
                                      <tr>
                                        <th>
                                            City
                                        </th>
                                        <th>
                                           <?php echo $row2['city']  ; ?>
                                        </th>
                                    </tr> 
                                    <tr>
                                        <th>
                                            State
                                        </th>
                                        <th>
                                           <?php echo $row2['state']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Country
                                        </th>
                                        <th>
                                            <?php echo $row2['country']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                         <th>
                                            Location 
                                        </th>
                                        <th>
                                            <?php echo $row2[ 'formatted_address']; ?> 
                                        </th>
                                     </tr>
                                          <tr>
                                         <th>
                                            Map Address 
                                        </th>
                                        <th>
                                             <a href="map-address.php?id=<?php echo$row['id'] ; ?>" target="_blank"> View On Map</a>
                                        </th>
                                     </tr>
                                </table>
                            </div> 
                            <div class="col-sm-6"> 
                                <h3>User Details</h3>  <br>
                                <table class="table table-bordered" >
                                  
                                    <tr>
                                        <th>
                                           Name
                                        </th>
                                        <th>
                                            <?php echo $row3['name']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                         <th>
                                            Email 
                                        </th>
                                        <th>
                                            <?php echo $row3['email']  ; ?>
                                        </th>
                                     </tr>
                                    <tr>
                                         <th>
                                           phone
                                        </th>
                                        <th>
                                            <?php echo $row3['phone']  ; ?>
                                        </th>
                                    </tr>
                                     <tr>
                                        <th>
                                            City
                                        </th>
                                        <th>
                                           <?php echo $row2['city']  ; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            State
                                        </th>
                                        <th>
                                           <?php echo $row2['state']  ; ?>
                                        </th>
                                    </tr>
                                  
                                  
                                    <tr>
                                        <th>
                                            Country
                                        </th>
                                        <th>
                                            <?php echo $row2['country']  ; ?>
                                        </th>
                                    </tr>
                                       <tr>
                                         <th>
                                           Address
                                        </th>
                                        <th>
                                            <?php echo $row['formatted_address']  ; ?>
                                        </th>
                                    </tr>
                                      <tr>
                                         <th>
                                            Map Address 
                                        </th>
                                        <th>
                                              <a href="map-address.php?id=<?php echo$row['id'] ; ?>" target="_blank"> View On Map</a>
                                        </th>
                                     </tr>
                                    
                                   
                                </table>
                            </div>
                            <div class="col-sm-6">
                                 <h3>Update Status</h3>  <br>
                                 <form  method="post"  id="garage-form" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Request Status</label>
                                        <select name="request" class="form-control" required>
                                            <option value="">--Select---</option>
                                            <option <?php echo ($row['request'] == 'Received')?"Selected": "" ; ?> >Received</option>
                                            <option <?php echo ($row['request'] == 'Acceptance')?"Selected": "" ;?>  >Acceptance</option>
                                            <option <?php echo ($row['request'] == 'Rejection')?"Selected": "" ; ?> >Rejection</option>
                                        </select>
                                       
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Order Status</label>
                                        <select name="order_status" class="form-control" required>
                                            <option value="">--Select---</option>
                                            <option <?php echo ($row['order_status'] == 'Pending')?"Selected": "" ;?>  >Pending</option>
                                            <option <?php echo ($row['order_status'] == 'Processing')?"Selected": "" ;?>  >Processing</option>
                                            <option <?php echo ($row['order_status'] == 'Processed')?"Selected": "" ; ?> >Processed</option>
                                        </select>
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Message</label>
                                        <textarea name="message" class="form-control" required rows="5"> <?php echo $row['message']  ; ?></textarea>
                                       
                                    </div>
                                    
                                </div>
                                
                               
                              <div class="form-group col-md-6">
                                <button type="submit" name="submit" class="btn btn-primary" id="garageButton">Change Status</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

</body>

</html>