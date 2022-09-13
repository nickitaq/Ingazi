<?php
include "db_connect.php";

if(!$_SESSION['USER_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}

if($_SESSION['USER_TYPE'] != 'garage'){  
    header('location:index.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}


$user_id = $_SESSION['USER_ID']; ; 
$result_garage = mysqli_query($conn, "select id from  tbl_garage where user_id='$user_id' " );
$garageId=mysqli_fetch_assoc($result_garage)['id'];

$sql = "select * from tbl_garage_booking  where garage_id = '$garageId' order by id desc";
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
                                    <th>Vehicle</th>
                                    <th>Vehicle no</th>
                                    <th>Services</th>
                                    <th>Address</th>
                                    
                                    <th>Request Status</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Date </th>
                                    <th>Action</th>
                                </tr>
                                <?php $i=1; foreach($result as $row){ ?>
                                <tr>
                                    <td>
                                        <?php echo $i;?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'vehicle']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'vehicle_no']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'services']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'route']; ?>
                                        <?php echo $row[ 'sublocality']; ?>
                                        <?php echo $row[ 'city']; ?>
                                        <br>
                                        <?php echo $row[ 'state']; ?>,
                                        <?php echo $row[ 'country']; ?>
                                        <br>
                                        <?php echo $row[ 'postcode']; ?>
                                    </td>
                                  
                                   
                                    <td>
                                        <?php echo $row[ 'request']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'order_status']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'payment_status']; ?>
                                    </td>
                                     <td>
                                        <?php echo $row[ 'date']; ?>
                                    </td>
                                    <td>
                                    <a href="change-status.php?id=<?php echo$row['id'] ; ?>" >Change Status </a> 
                               
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