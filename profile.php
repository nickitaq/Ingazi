<?php
include "db_connect.php";

if(!$_SESSION['USER_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
$user_id = $_SESSION['USER_ID']; ; 


$result = mysqli_query($conn, "select * from  tbl_users where   id='$user_id' " );
$row=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Profile</title>
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="form-row">
                            <?php 
                            
                            if(isset($_SESSION['success-msg'])){
                                echo $_SESSION['success-msg'];
                                unset($_SESSION['success-msg']);
                            }
                            
                            ?>
                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" readonly
                                        value="<?php echo $row['name'] ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" readonly
                                        value="<?php echo $row['email'] ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" readonly
                                    value="<?php echo $row['phone'] ?>">
                            </div>
                          
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