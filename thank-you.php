<?php include 'db_connect.php'; ?>
<?php 
 $booking_enquiry_id = $_SESSION['booking_enquiry_id'] ; 
$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
$row=mysqli_fetch_assoc($result);
$garage_id = $row['garage_id'];
$result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
$row2=mysqli_fetch_assoc($result_garage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>On Demand Garage Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
<body>
    <!-- A grey horizontal navbar that becomes vertical on small screens -->
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
                                <li class="nav-item"> <a class="nav-link" href="register.php" class="admin-btn"> User Register</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="login.php" class="user-btn"  >User Login</a> </li>
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
    <section style="margin-top:30px">
         <div class="container">
      
        <div class="row">
            <div class="col-sm-2"> </div>
            <div class="col-sm-8"> 
                <center style="color:#fff">
                    <img src="img/Thank-new-yellow-transparent.svg.png" style="width:200px">
                    <br>
                    <h2>
                        Thank you for book our services, we will reach you soon.
                    </h2>
                  
                </center>
                
            </div>
        </div>
      
        <br>
        <div class="row" style="color:#fff">
            <div class="col-sm-6"> 
                <h3>Booking Details</h3>  <br>
                <table class="table table-bordered" style="color:#fff">
                      <tr>
                        <th>
                            Booking Id 
                        </th>
                        <th>
                            ODGS-<?php echo $_SESSION['booking_enquiry_id']  ; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Vehicle No
                        </th>
                        <th>
                            <?php echo $row['vehicle_no']  ; ?>
                        </th>
                    </tr>
                    <tr>
                         <th>
                            Vehicle 
                        </th>
                        <th>
                            <?php echo $row['vehicle']  ; ?>
                        </th>
                     </tr>
                    <tr>
                         <th>
                           Services
                        </th>
                        <th>
                            <?php echo $row['services']  ; ?>
                        </th>
                    </tr>
                    <tr>
                         <th>
                           Booking Date
                        </th>
                        <th>
                            <?php echo $row['date']  ; ?>
                        </th>
                    </tr>
                    
                </table>
            </div>
            <div class="col-sm-6">
                 <h3>Service Center Details</h3>  <br>
                <table class="table table-bordered" style="color:#fff">
                      <tr>
                        <th>
                            Garage
                        </th>
                        <th>
                           <?php echo $row2['title']  ; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            About us
                        </th>
                        <th>
                            <?php echo $row2['description']  ; ?>
                        </th>
                    </tr>
                      <tr>
                        <th>
                            Email
                        </th>
                        <th>
                            <?php echo $row2['email']  ; ?>
                        </th>
                    </tr>
                      <tr>
                        <th>
                            Phone no
                        </th>
                        <th>
                            <?php echo $row2['phone_no']  ; ?>
                        </th>
                    </tr>
                    <tr>
                         <th>
                            Location 
                        </th>
                        <th>
                            <?php echo $row2[ 'formatted_address']; ?> 
                        </th>
                     </tr>
                  
                    
                </table>
            </div>
        </div>
    </div>
    </section>
   
</body>

</html>