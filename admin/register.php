<?php 

include 'db_connect.php';

if(isset($_POST['submit'])) {
    
    extract($_POST);
    $name =   mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $phone =  mysqli_real_escape_string($conn, $_POST['phone']);
     $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $res =    mysqli_query($conn,"select * from  tbl_admin where email = '$email'"  );
    $row_count=mysqli_num_rows($res);
    if($row_count>0){
        
          $msg = '<div class="alert alert-danger"> Email  Already Exist</div>';
		 $error  = True ;
    }

    if( $error == FALSE){
    
        $sql = "insert into  tbl_admin( `name`, `email`,  `phone`,  `password`,`role` )  values ('$name','$email','$phone','$password','operator')";
        $query = mysqli_query($conn, $sql);
        if( $query){
            $insert_id =mysqli_insert_id($conn) ; 
            $query = mysqli_query($conn,"select * from tbl_admin where id='$insert_id'") ;
            $row_count=mysqli_num_rows($query);
            if($row_count>0){
                $row=mysqli_fetch_assoc($query);
                $_SESSION['ADMIN_ID']=$row['id'];
                $_SESSION['USERNAME']=$row['name'];
                $_SESSION['ROLE']=$row['role'];
                header('location:dashboard.php');
                die();
            }
            $msg = '<div class="alert alert-success"> Garage Operator Registered Succsessfully</div>';
            
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
        <title>Garage Operator Interface Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Garage Operator Interface Register</h3></div>
                                    <div class="card-body">
                                                <p style="color:red">
                                          <?php 
                        
                                    if(isset($_SESSION['success-msg'])){
                                        echo $_SESSION['success-msg'];
                                        unset($_SESSION['success-msg']);
                                    }
                                    
                                    ?>
                                    </p>
                                        <form method="post" >
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="name"  type="text" placeholder="Enter your  name" required />
                                                        <label> Garage Operator  Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  name="email" type="email" placeholder="Enter your Email" required />
                                                        <label>Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                          

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="phone" type="text" placeholder="Enter your  Phone No" required/>
                                                        <label>Phone No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  name="password" type="password" id="newPassword" placeholder="Enter your Password" required/>
                                                        <label>Password</label>
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
                                        <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                                    </div>
                                    <div>
                                        <center>
                                            <a href="/index.php"> Back To Home </a>
                                        </center>
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
    </body>
</html>
