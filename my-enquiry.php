<?php
include "db_connect.php";

if(!$_SESSION['USER_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}

$user_id = $_SESSION['USER_ID']; ; 
 
$sql = "select * from tbl_garage_booking  where user_id = '$user_id' order by id desc";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Enquiry</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .btn-group-sm>.btn, .btn-sm {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    width: 75px;
    margin-bottom: 5px;
}
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Booking</h1>
                  
                    <div class="card-body">
                   
                              <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Booking ID</th>
                                    <th>Vehicle</th>
                                    <th>Garage</th>
                                    <th>Request </th>
                                    <th>Order </th>
                                    <th>Payment Amt </th>
                                    <th>Payment </th>
                                    <th>Booking Date </th>
                                    <th>Reg Date</th>
                                    <th>Action</th>
                                </tr>
                                <?php $i=1; foreach($result as $row){ ?>
                                  <?php
                                        $garage_id = $row['garage_id'];
                                        $result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
                                        $row2=mysqli_fetch_assoc($result_garage);
                                  ?>
                                <tr>
                                    <td>
                                        <?php echo $i;?>
                                    </td>
                                      <td>
                                        ODGS-<?php echo $row[ 'id']; ?>
                                      
                                    </td>
                                    <td>
                                        <?php echo $row[ 'vehicle']; ?>
                                        <bR>
                                        <?php echo $row[ 'vehicle_no']; ?>    
                                    </td>
                     
                                    <td>
                                        <strong><?php echo $row2[ 'title']; ?>  <br> </strong>
                                        <a href="map-address.php?id=<?php echo$row['id'] ; ?>" target="_blank"> <?php echo $row2[ 'sublocality']; ?>
                                        <?php echo $row2[ 'city']; ?>
                                        <br>
                                        <?php echo $row2[ 'state']; ?>,
                                        <?php echo $row2[ 'country']; ?>
                                        <br>
                                        <?php echo $row2[ 'postcode']; ?></a>
                                        <br>
                                        <a href="tel:<?php echo $row2[ 'phone_no']; ?>">Call: <strong> <?php echo $row2[ 'phone_no']; ?></strong> </a>   <br>
                                    </td>
                                  
                                    <td>
                                        <?php echo $row[ 'request']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'order_status']; ?>
                                    </td>
                                    <td>
                                       <?php if($row[ 'payment']){ ?>
                                         <p style="color:green">  $ <?php echo $row[ 'payment']; ?> USD </p>
                                       <?php }else { ?>
                                         <p style="color:red">Payment amt<br> not generated</p>
                                       <?php } ?>
                                    </td>
                                    <td>
                                         <?php if($row[ 'payment_status'] == 'Unpaid'){  ?>
                                            <p style="color:red"><?php echo $row[ 'payment_status']; ?> </p>
                                        <?php } else{ ?>
                                           <p style="color:green"><?php echo $row[ 'payment_status']; ?> </p>
                                        <?php }?>
                                     
                                    </td>
                                     <td>
                                          <?php echo date('d-M-Y' , strtotime($row[ 'date'])); ?>
                                    </td>
                                      <td>
                                        <?php echo date('d-M-Y' , strtotime($row[ 'create_date'])); ?>
                                    </td>
                       
                                    <td>
                                    <a href="view-booking.php?id=<?php echo$row['id'] ; ?>" class="btn btn-primary btn-sm"> View </a> </bR>
                                     <a href="give-review.php?id=<?php echo$row['id'] ; ?>" class="btn btn-warning btn-sm">  Review</a> <br>
                                    <?php if( $row['payment']){ ?>
                                        <?php if($row[ 'payment_status'] == 'Unpaid'){  ?>
                                             <a href="paypal-request.php?booking_enquiry_id=<?php echo$row['id'] ; ?>" class="btn btn-danger btn-sm"> Pay Now</a> 
                                        <?php }?>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++ ; } ?> </table>
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