<?php include( 'db_connect.php'); 
if(!$_SESSION[ 'ADMIN_ID']){
// check panel Login
header( 'location:login.php'); 
$_SESSION[ 'invalid_login']="Please Try With Login Details" ;
} 

$admin_id=$_SESSION[ 'ADMIN_ID'] ; 
$role = $_SESSION['ROLE'] ;
if($role == 'operator'){ 
header( 'location:booking.php'); 
}

$result=mysqli_query($conn, "select * from tbl_garage_booking order by id desc"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
   <style>
        .btn-group-sm>.btn, .btn-sm {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
    width: 120px;
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
                    <h1 class="mt-4">All Booking</h1>
                    <div class="card mb-4">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Booking-Id</th>
                                    <th>Vehicle</th>
                                    <th>Garage</th>
                                    <th>Request </th>
                                    <th>Order </th>
                                    <th>Payment Amt </th>
                                    <th>Payment </th>
                                    <th>Invoice </th>
                                    <th>Booking Date </th>
                                    <th>Reg Date </th>
                                    <th>Action</th>
                                </tr>
                                <?php $i=1; foreach($result as $row){ ?>
                                <?php
                                    $garage_id = $row['garage_id'];
                                    $result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
                                    $row2=mysqli_fetch_assoc($result_garage);
                                        
                                ?>
                                 <?php
                                        $user_id = $row['user_id'];
                                        $result_user = mysqli_query($conn, "select * from  tbl_users where id='$user_id' " );
                                        $row3=mysqli_fetch_assoc($result_user);
                                        ?>
                                <tr>
                                    <td>
                                        <?php echo $i;?>
                                    </td>
                                    <td>
                                        ODGS-<?php echo $row[ 'id']; ?>
                                      
                                    </td>
                                    <td>
                                       <strong> <?php echo $row[ 'vehicle']; ?>-<?php echo $row[ 'vehicle_no']; ?></strong>
                                       <bR>
                                        <a href="map-address.php?id=<?php echo $row['id'] ; ?>" target="_blank"> <?php echo $row[ 'sublocality']; ?>
                                        <?php echo $row[ 'city']; ?>
                                        <br>
                                        <?php echo $row[ 'state']; ?>,
                                        <?php echo $row[ 'country']; ?>
                                        <br>
                                        <?php echo $row[ 'postcode']; ?></a>
                                        <br>
                                        <a href="tel:<?php echo $row[ 'phone']; ?>">Call: <strong> <?php echo $row3[ 'phone']; ?></strong> </a> 
                                        
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
                                        <?php if($row[ 'invoice'] == 'Unsend'){  ?>
                                            <p style="color:red"><?php echo $row[ 'invoice']; ?> </p>
                                        <?php } else{ ?>
                                           <p style="color:green"><?php echo $row[ 'invoice']; ?> </p>
                                        <?php }?>
                                           
                                       
                                    </td>
                                     <td>
                                          <?php echo date('d-M-Y' , strtotime($row[ 'date'])); ?>
                                    </td>
                                      <td>
                                        <?php echo date('d-M-Y' , strtotime($row[ 'create_date'])); ?>
                                    </td>
                       
                                    <td>
                                    <a href="view-booking.php?id=<?php echo$row['id'] ; ?>" class="btn btn-primary btn-sm" > View Details</a> </bR>
                                    <a href="change-request.php?id=<?php echo$row['id'] ; ?>" class="btn btn-warning btn-sm" > Change  Status</a> </bR>
           
                                    <a href="send-invoice.php?id=<?php echo$row['id'] ; ?>" class="btn btn-danger btn-sm" > Send Invoice</a></br> 

                                    </td>
                                </tr>
                            
                                <?php $i++ ; } ?> </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                       
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            function myConfirm() {
                var result = confirm("Are you sure you want to delete?");
                if (result == true) {
                    return true;
                } else {
                    return false;
                }
            }

        </script>
</body>
</html>
