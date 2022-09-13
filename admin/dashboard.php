<?php include 'db_connect.php'; 
if(!$_SESSION[ 'ADMIN_ID']){ 
// check panel Login
header( 'location:index.php'); 
$_SESSION[ 'invalid_login']="Please Try With Login Details" ; 
}
$admin_id=$_SESSION[ 'ADMIN_ID'] ;
$sql="SELECT * FROM `tbl_garage_booking` where admin_id = '$admin_id'" ;
$query=mysqli_query($conn, $sql); $booked_vehicle_count=mysqli_num_rows($query);
$sql="SELECT * FROM `tbl_garage` where delete_flag = 0 and admin_id = '$admin_id'" ;
$query=mysqli_query($conn, $sql); $total_vehicles=mysqli_num_rows($query);
$result=mysqli_query($conn, "select * from  tbl_admin  where   id='$admin_id' " );
$row=mysqli_fetch_assoc($result); ?>
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
                    <h1 class="mt-4">  Dashboard</h1>
                    <ol class="breadcrumb mb-4"> </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-3">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total vehicle </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p>
                                        <?php echo $total_vehicles; ?>
                                    </p>
                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Booked vehicle </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <p>
                                        <?php echo $booked_vehicle_count ?>
                                    </p>
                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" readonly value="<?php echo $row['name'] ?>"> </div>
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" readonly value="<?php echo $row['email'] ?>"> </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" readonly value="<?php echo $row['phone'] ?>"> </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto"> </footer>
        </div>
    </div>
   
</body>

</html>
