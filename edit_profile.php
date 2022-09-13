<?php
include "db_connect.php";

if(!$_SESSION['USER_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}


$user_id = $_SESSION['USER_ID']; ; 
if(isset($_POST['submit'])) {
    extract($_POST);

    $name=   mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $phone =  mysqli_real_escape_string($conn, $_POST['phone']);
    $password =base64_encode(mysqli_real_escape_string($conn, $_POST['password']));

        $sql = "update tbl_users SET name='$name' ,  email='$email', phone='$phone', password='$password' where id='$user_id'";
        $query = mysqli_query($conn, $sql);
        //$msg = '<div class="alert alert-success"> car Detail Updated SuccessFully</div>';
        if( $query){
            
            $msg = '<div class="alert alert-success"> Car Added Successfull</div>';
             
              header('location:profile.php');
              $_SESSION['success-msg']='<div class="alert alert-success">Update Successfully</div>';
              
          }else{
       
          header('location:edit_profile.php');
              $_SESSION['success-msg']='<div class="alert alert-danger"> Not Update, Please Try again</div>';
            $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
          }
 
   
}


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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Update Profile</li>
                    </ol>
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <form method="post" action="edit_profile.php">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="<?php echo $row['name'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="<?php echo $row['email'] ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="<?php echo $row['phone'] ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password"
                                        value="<?php echo base64_decode($row['password']); ?>">
                                </div>
                            
                               
                                <div class="form-group col-md-6">
                                    <button type="submit" name="submit" class="btn btn-primary">Update profile</button>
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