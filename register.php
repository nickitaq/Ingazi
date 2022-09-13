<?php 

include 'db_connect.php';
include('function.php') ;
if(isset($_POST['submit'])) {
    extract($_POST);
    $status = 1;
    if ($_POST['user_type'] == 'garage') {
        $status = 0;
        $admin_id = 0;
        $phone_no =   mysqli_real_escape_string($conn, $_POST['phone_no']);
        $title=   mysqli_real_escape_string($conn, $_POST['title']);
        $description  = mysqli_real_escape_string($conn, $_POST['description']);
        $longitude =  mysqli_real_escape_string($conn, $_POST['longitude']);
        $latitude =mysqli_real_escape_string($conn, $_POST['latitude']);
        $country =mysqli_real_escape_string($conn, $_POST['country']);
        $state =mysqli_real_escape_string($conn, $_POST['state']);
        $city =mysqli_real_escape_string($conn, $_POST['city']);
        $postcode =mysqli_real_escape_string($conn, $_POST['postcode']);
        $sublocality =mysqli_real_escape_string($conn, $_POST['sublocality']);
        $route =mysqli_real_escape_string($conn, $_POST['route']);
        $formatted_address =mysqli_real_escape_string($conn, $_POST['formatted_address']);
        
        $image = 'image.png';
    }

    $name =   mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $phone =  mysqli_real_escape_string($conn, $_POST['phone']);
    $password=  base64_encode(mysqli_real_escape_string($conn, $_POST['password'])); 
    $res =    mysqli_query($conn,"select * from  tbl_users where email = '$email'"  );
    $row_count=mysqli_num_rows($res);
    if($row_count>0){
        
          $msg = '<div class="alert alert-danger"> Email  Already Exist, Change Your email Id</div>';
         
		  $error  = True ;
    }
    if( $error == FALSE){
    
        $sql = "insert into  tbl_users( `name`, `email`,  `phone`,  `password` )  values ('$name','$email','$phone','$password')";
        $query = mysqli_query($conn, $sql);
        if( $query){
            $insert_id =  mysqli_insert_id($conn) ;
            
            $_SESSION['user']['user_email']=$email;
            $_SESSION['user']['user_id']=$insert_id;
            $email_otp = email_otp($email , $insert_id) ; 
            include('email-reg-details-to-user.php') ; 
            $msg = '<div class="alert alert-success"> User Registred Succsessfully</div>';
            header("Location: email-verification-page.php");
          
        }else{
          $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
          
        }
    }
    
     $_SESSION['success-msg']=$msg;
   
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Registation</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="css/styles.css" rel="stylesheet" />
             <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .nav-link {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                font-size: 24px;
                font-weight: 700;
            }
            .nav-link:hover {
                background-color: #ddd;
            }
            body {
                margin: 0px;
                padding: 0px;
               
                height: 700px;
                background: #46747e;
                
            }
            #form {
                font-size: 14px;
                background: #fff;
                padding: 15px;
                margin-top: 10%;
            }
            .garage{
                    background: #fff;
                    border: 1px solid #f6f2e8;
                    padding: 15px;
                    margin-bottom: 20px;
                }
    
        </style>
    </head>
<body >
      <nav class="navbar navbar-expand-sm bg-light justify-content-center">
          <div class="container">
           
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <div class="row" style="width:100%">
                    <div class="col-sm-6">
                           <ul class="navbar-nav me-auto pull-right">
                                <li class="nav-item">
                                  <a class="nav-link" href="index.php">Home</a>
                                </li>
                            </ul>  
                    </div>
                    <div class="col-sm-6">
                           <ul class="navbar-nav me-auto pull-right">
                            
                              <?php  if(!$_SESSION['USER_ID']){  ?>
                                  <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Garage Operator
                                  </a>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="admin/index.php" class="admin-btn">  Login</a>
                                      <a class="dropdown-item" href="admin/register.php" class="admin-btn">  Register</a>
                                  
                                  </div>
                                </li>
                                 <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    User
                                  </a>
                                  <div class="dropdown-menu">
                                     <a class="dropdown-item" href="login.php" class="admin-btn">  Login</a>
                                      <a class="dropdown-item" href="register.php" class="admin-btn">  Register</a>
                                  </div>
                                </li>
    
                                <?php } else{  ?>
                                <li class="nav-item">  <a class="nav-link" href="profile.php">Hello <?php  echo  ucwords( $_SESSION['USERNAME']) ?></a> </li>
                                <li class="nav-item">  <a class="nav-link" href="my-enquiry.php">My Booking</a> </li>
                                <li class="nav-item">  <a  class="nav-link" href="logout.php">Logout</a> </li>
                                <?php }?>
                              </ul>
                    </div>
                </div>
            </div>
          </div>
        </nav> 
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    
                                    <div class="card-body">
                                                   <p style="color:red">
                                          <?php 
                        
                                    if(isset($_SESSION['success-msg'])){
                                        echo $_SESSION['success-msg'];
                                        unset($_SESSION['success-msg']);
                                    }
                                    
                                    ?>
                                    </p>
                                  
                                        <form method="post" action="register.php">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0"> 
                                                        <input class="form-control" name="name"  type="text" placeholder="Enter your  name"  required/>
                                                        <label> Name*</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  name="email" type="email" placeholder="Enter your Email"  required/>
                                                        <label>Email*</label>
                                                    </div>
                                                </div>
                                            </div>
                                          

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="phone" type="text" placeholder="Enter your  Phone No" required/>
                                                        <label>Phone No*</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  name="password" id="newPassword"  onchange="validatePassword() " type="password" placeholder="Enter your Password" autocomplete="off" required/>
                                                        <label>Password*</label>
                                                    </div>
                                                </div>
                                            </div>
  

                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">

                                                <button class="btn btn-primary btn-block"  type="submit" name="submit">Create Account</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                     <div class="card-footer text-center py-3">
                                    <div class="small"><a href="admin/register.php">Register Your Garage </a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA-KTNsETiaNQdf7SSiL94BooOG_c2L2sU"></script>


<script>
    function validatePassword() {
    var p = document.getElementById('newPassword').value,
        errors = [];
    if (p.length < 8) {
        errors.push("Your password must be at least 8 characters"); 
        document.getElementById('newPassword').value = '' ; 
    }
    if (p.search(/[!@#\$%\^&\*_]/) < 0) {
        errors.push("Your password must contain at least special char from -[ ! @ # $ % ^ & * _ ]"); 
        document.getElementById('newPassword').value = '' ; 
    }
    if (p.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");
        document.getElementById('newPassword').value = '' ; 
    }
    if (p.search(/[0-9]/) < 0) {
        errors.push("Your password must contain at least one digit."); 
        document.getElementById('newPassword').value = '' ; 
    }
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
    return true;
}
</script>
    </body>
</html>
