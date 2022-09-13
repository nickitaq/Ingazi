<?php
include "db_connect.php";

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}


$admin_id = $_SESSION['ADMIN_ID']; ; 
if(isset($_POST['submit'])) {
    extract($_POST);

    $name=   mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $phone =  mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "update tbl_admin SET name='$name' ,  email='$email', phone='$phone' where id='$admin_id'";
    $query = mysqli_query($conn, $sql);
    if( $query){
        
        $msg = '<div class="alert alert-success"> Profile Updated</div>';
          $_SESSION['USERNAME']=$name;
          $_SESSION['success-msg']='<div class="alert alert-success">Update Successfully</div>';
          
      }else{
   
   
          $_SESSION['success-msg']='<div class="alert alert-danger"> Not Update, Please Try again</div>';
        $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
      }
 
    $_SESSION['success-msg']=$msg;
}

$result = mysqli_query($conn, "select * from  tbl_admin where  id='$admin_id'" );
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
    <title>Edit Profile</title>
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
                    <h1 class="mt-4">Update Profile</h1>
                   
                    <div class="row">
                        <div class="col-md-6 m-auto">
                              <?php 
       
                        if(isset($_SESSION['success-msg'])){
                            echo $_SESSION['success-msg'];
                            unset($_SESSION['success-msg']);
                        }
                        
                        ?>
                            <form method="post" action="edit_profile.php">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo $row['name'] ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="<?php echo $row['email'] ?>">
                                    </div>
                               
                                    <div class="form-group col-md-12">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="<?php echo $row['phone'] ?>">
                                    </div>
                                  
                                   
                                    <div class="form-group col-md-12">
                                        <center>
                                            <button type="submit" name="submit" class="btn btn-primary">Update profile</button>
                                        </center>
                                        
                                    </div>
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