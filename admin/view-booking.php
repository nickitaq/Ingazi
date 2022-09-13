<?php

include('db_connect.php');

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
if(isset($_GET['type']) && $_GET['type']=='delete' &&  ($_GET['id'])){
  $id= mysqli_real_escape_string($conn,$_GET['id']);
   $sql = "update tbl_garage SET delete_flag='1' where id='$id'";
    $query = mysqli_query($conn, $sql);
 
}

$admin_id  = $_SESSION['ADMIN_ID'] ; 
$booking_enquiry_id = $_GET['id'];  
$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
$row=mysqli_fetch_assoc($result);
if(count($row) == 0 ){
    header('my-enquiry.php');
}
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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .link {
        margin: 15px 0;
    }
    .available{
        background:green;
        padding:3px;
        border-radius:5px;
        color:#fff;
    }
    .booked{
        background:red;
        padding:3px;
        border-radius:5px;
        color:#fff;  
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
                    <h1 class="mt-4">Booking id:  ODGS-<?php echo $row['id']  ; ?></h1>
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
                                        <tr>
                                         <th>
                                          Invoice Status 
                                        </th>
                                        <th>
                                            <?php echo $row['invoice']  ; ?>
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
                                            <?php echo $row2['formatted_address']  ; ?>
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
                                 <h3>User Rating And Review</h3>  <br>
                                <table class="table table-bordered" >
                                    <tr>
                                        <td>1. Your overall experience with us ?</td>
                                        <td><?php echo$row['rating1'] ; ?></td>
                                    </tr>
                                     <tr>
                                        <td>2. Friendliness and courtesy shown to you while recieving your vehicle</td>
                                        <td><?php echo$row['rating2'] ; ?></td>
                                    </tr>
                                     <tr>
                                        <td>3. Any Other suggestions:</td>
                                        <td><?php echo$row['commentText'] ; ?></td>
                                    </tr>
                                     
                                    
                                </table>
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