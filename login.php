<?php 
include 'db_connect.php';include('function.php') ;
$msg="";
if (isset($_POST['email']) && isset($_POST['password'])){
    if(($_POST['email'] != '') && ($_POST['password'] !='')){
            $email= mysqli_real_escape_string($conn,$_POST['email']);
            $password= base64_encode(mysqli_real_escape_string($conn, $_POST['password']));
            $sql="select * from tbl_users where email='$email' and password='$password'";
            $query=mysqli_query($conn,$sql);
            $row_count=mysqli_num_rows($query);
            if($row_count>0){
                $row=mysqli_fetch_assoc($query);
               
                $email = $_SESSION['user']['user_email']=$row['email'];
                $_SESSION['user']['user_id']=$row['id'];
                $email_otp = email_otp($email , $row['id']) ; 
                include('email-otp-to-user.php') ; 
                $msg = '<div class="alert alert-success"> User Registred Succsessfully</div>';
                header("Location: email-verification-page.php");
                
            }else{
                  
                  $msg="Please enter correct details";
             }
    }else{
        
        $msg="Please enter required details";
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
    <title>User  Login</title>
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
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"> Login Dashboard</h3>
                                </div>
                                <div class="card-body">
                                    <p style="color:red">
                                          <?php 
                        
                                    if(isset($_SESSION['success-msg'])){
                                        echo $_SESSION['success-msg'];
                                        unset($_SESSION['success-msg']);
                                    }
                                    
                                    ?>
                                    </p>
                                  
                                    <form method="post" action="login.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  type="email" name="email"  required/>
                                            <label for="inputEmail">Email address*</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  type="password" name="password"  id="newPassword"  required/>
                                            <label for="inputPassword">Password*</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button type="submit" name="submit" class="btn btn-primary" >Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
  
</body>
<script>
    function validatePassword() {
    var p = document.getElementById('newPassword').value,
        errors = [];
    if (p.length < 8) {
        errors.push("Your password must be at least 8 characters"); 
    }
    if (p.search(/[!@#\$%\^&\*_]/) < 0) {
        errors.push("Your password must contain at least special char from -[ ! @ # $ % ^ & * _ ]"); 
    }
    if (p.search(/[a-z]/i) < 0) {
        errors.push("Your password must contain at least one letter.");
    }
    if (p.search(/[0-9]/) < 0) {
        errors.push("Your password must contain at least one digit."); 
    }
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
    return true;
}
</script>
</html>