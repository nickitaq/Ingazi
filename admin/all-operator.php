<?php include( 'db_connect.php'); 
if(!$_SESSION[ 'ADMIN_ID']){
// check panel Login
header( 'location:login.php'); 
$_SESSION[ 'invalid_login']="Please Try With Login Details" ;
} 

$admin_id=$_SESSION[ 'ADMIN_ID'] ; 
$role = $_SESSION['ROLE'] ;
if(isset($_GET['approval_status'])){
  $operator_id= mysqli_real_escape_string($conn,$_GET['operator_id']);
  $approval_status= mysqli_real_escape_string($conn,$_GET['approval_status']);
  $sql = "update tbl_admin SET approval_status='$approval_status' where id='$operator_id'";
  $query = mysqli_query($conn, $sql);
  $_SESSION['success-msg']='<div class="alert alert-success">Updated Successfully</div>';
 header( 'location:all-operator.php'); 
}

if($role == 'operator'){ 
header( 'location:booking.php'); 
}

$result=mysqli_query($conn, "select * from tbl_admin  where role ='operator' order by id desc"); 
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
                    <h1 class="mt-4">All Operator</h1>
                    <div class="card mb-4">
                        <?php 
       
                        if(isset($_SESSION['success-msg'])){
                            echo $_SESSION['success-msg'];
                            unset($_SESSION['success-msg']);
                        }
                        
                        ?>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered" style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Reg Date </th>
                                    <th>Action</th>
                                </tr>
                                <?php $i=1; foreach($result as $row){ ?>
                                
                                <tr>
                                    <td>
                                        <?php echo $i;?>
                                    </td>
                                   
                                    <td>
                                       <strong> <?php echo $row[ 'name']; ?></strong>
                                    </td>
                                    <td>
                                        <?php echo $row[ 'email']; ?>
                                    </td>
                                    <td>
                                      <?php echo $row[ 'phone']; ?>
                                    </td>
                                    <th>
                                        <?php if($row['approval_status'] == '1'){ ?>
                                            <a  href="all-operator.php?operator_id=<?php echo$row['id'] ; ?>&approval_status=0" style="color:green" >Approved </a>
                                        <?php } else{ ?>
                                            <a  href="all-operator.php?operator_id=<?php echo$row['id'] ; ?>&approval_status=1" style="color:red" >Not Approved </a>
                                        <?php } ?>
                                    </th>
                                   
                                      <td>
                                        <?php echo date('d-M-Y' , strtotime($row[ 'create_date'])); ?>
                                    </td>
                       
                                    <td>
                            
                                    <a href="all-garage.php?operator_id=<?php echo$row['id'] ; ?>" class="btn btn-primary btn-sm" > View All Garage</a></br> 

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
