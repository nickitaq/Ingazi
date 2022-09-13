<?php 
include 'db_connect.php';
if($_SESSION['ADMIN_ID']){  // check panel Login
    header('location:dashboard.php');
}

$msg="";
if (isset($_POST['email']) && isset($_POST['password'])){
    if($_POST['email'] && $_POST['password']){
            $email= mysqli_real_escape_string($conn,$_POST['email']);
            $password=  md5(mysqli_real_escape_string($conn, $_POST['password']));
            $query = mysqli_query($conn,"select * from tbl_admin where email='$email' and password='$password'") or die(mysqli_error($conn));
            $row_count=mysqli_num_rows($query);
            if($row_count>0){
                $row=mysqli_fetch_assoc($query);
                $_SESSION['ADMIN_ID']=$row['id'];
                $_SESSION['ADMINNAME']=$row['name'];
                $_SESSION['ROLE']=$row['role'];
                header('location:dashboard.php');
                die();
            }
            else{
                $msg="please enter correct details";
            }
    }else{
         $msg="Please Enter Email And Pasword";
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
    <title>Customer Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">


                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Garage Operator Interface Login</h3>
                                </div>
                                <div class="card-body">
                                    <?php 
       
                                    if(isset($_SESSION['success-msg'])){
                                        echo $_SESSION['success-msg'];
                                        unset($_SESSION['success-msg']);
                                    }
                                    
                                    ?>
                                    <?php 
                                    if(isset(  $_SESSION['invalid_login'])){
                                        echo  $_SESSION['invalid_login'];
                                        unset(  $_SESSION['invalid_login']);
                                    }
                                    
                                    ?>
                                    <form method="post" action="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" name="email"
                                                placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password"
                                                name="password" placeholder="Password" id="newPassword"  required/>
                                            <label for="inputPassword">Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button class="btn btn-primary" type="submit" name="submit">Login</button>
                                        </div>
                                    </form>
                                    <div>
                                        <center>
                                            <a href="/index.php"> Back To Home </a>
                                        </center>
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
   
</body>

</html>