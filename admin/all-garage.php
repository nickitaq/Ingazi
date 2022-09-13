<?php

include('db_connect.php');

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
$admin_id  = $_SESSION['ADMIN_ID'] ; 
$operator_id = $_GET['operator_id'] ;
if(isset($_GET['approval_status'])){
  $garage_id= mysqli_real_escape_string($conn,$_GET['garage_id']);
  $approval_status= mysqli_real_escape_string($conn,$_GET['approval_status']);
  $sql = "update tbl_garage SET approval_status='$approval_status' where id='$garage_id'";
  $query = mysqli_query($conn, $sql);
  $_SESSION['success-msg']='<div class="alert alert-success">Updated Successfully</div>';
  header( 'location:all-garage.php?operator_id='.$operator_id); 
}

 
$sql = "select tbl_garage.*from tbl_garage  where tbl_garage.delete_flag = 0 and tbl_garage.admin_id = '$operator_id' order by tbl_garage.id desc";    
$result = mysqli_query($conn, $sql);

$operator = mysqli_query($conn, "select * from  tbl_admin where   id='$operator_id'"); 
$operator_row =mysqli_fetch_assoc($operator);

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

</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
        <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">All Garage Of Operator</h1>
                   
                    <div class="card mb-4">
                     <table class="table table-bordered" >
                        <tr>
                            <td>Operator Name </td>
                            <td> Operator Email </td>
                            <td>Operator Phone Number  </td>
                            
                        </tr>
                        <tr>
                            <td <td><h4><?php echo $operator_row['name'] ?> </h4></td>
                            <td <td><h4><?php echo $operator_row['email'] ?> </h4></td>
                            <td <td><h4><?php echo $operator_row['phone'] ?> </h4></td>
                            
                        </tr>
                    </table>
                    <hr>
                    <div >
                            <?php 
                            
                            if(isset($_SESSION['success-msg'])){
                                echo $_SESSION['success-msg'];
                                unset($_SESSION['success-msg']);
                            }
                            
                            ?>
                         
                            <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Added By </th>
                                   <th>Garage Name</th>
                                   <th></th>
                                   <th>Country</th>
                                   <th>State</th>
                                   <th>City</th>
                                   <th>Status</th>
                                <th>Action</th>
                                </tr>
                                <?php  $i=1; 
                                  foreach($result as $row){
                                      ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                     <td><?php echo $row['insert_by'] ;?></td>
                                    <td><strong>
                                        <?php echo $row['title']; ?>
                                    </strong> <br> <?php echo $row['email']; ?><br> <?php echo $row['phone_no']; ?></td>
                                    <td>
                                        <center><img src="images/<?php echo $row['image']; ?>" alt=""
                                                style="width:50px; height:50px;"></center>
                                    </td>
                                    <td><?php echo $row['country']; ?></td>

                                    <td><?php echo $row['state']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                     <th>
                                        <?php if($row['approval_status'] == '1'){ ?>
                                            <a  href="all-garage.php?operator_id=<?php echo$row['admin_id'] ; ?>&garage_id=<?php echo$row['id'] ; ?>&approval_status=0" style="color:green" >Approved </a>
                                        <?php } else{ ?>
                                            <a  href="all-garage.php?operator_id=<?php echo$row['admin_id'] ; ?>&garage_id=<?php echo$row['id'] ; ?>&approval_status=1" style="color:red" >Not Approved </a>
                                        <?php } ?>
                                    </th>
                                   
                                    <td> <a href="edit-garage.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                                            Edit</a>
                                         
                                    </td>

                                </tr>
                                <?php $i++  ;        }  ?>
                            </table>
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

    function approveConfirm() {
        var result = confirm("Are you sure you want to approve?");
        if (result == true) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>

</html>