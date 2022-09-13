<?php
error_reporting(0);
include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>On Demand Garage Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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


.navbar-toggle .icon-bar {
    display: block;
    width: 22px;
    height: 2px;
    border-radius: 1px;
    color: black;
    background: black;
}
   

    body {
        margin: 0px;
        padding: 0px;
        background-image: url('img/banner.png');
        background-size: cover;
        height: 700px;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    
     #form {
        
        font-size: 14px;
        background:#fff;
        padding: 15px;
        margin-top:10%;
    }

    </style>
</head>
<body>
    <!-- A grey horizontal navbar that becomes vertical on small screens -->
    <nav class="navbar navbar-expand-sm bg-light justify-content-center">
          <div class="container">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
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
                           <ul class="navbar-nav me-auto ">
                            
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
                                <li class="nav-item">  <a class="nav-link" href="profile.php"> <?php  echo  ucwords( $_SESSION['USERNAME']) ?></a> </li>
                                <?php if ($_SESSION['USER_TYPE'] == 'garage') { ?>
                                  <li class="nav-item">  <a class="nav-link" href="garage-enquiry.php">My Booking</a> </li>
                                  <?php } else { ?>
                                    <li class="nav-item">  <a class="nav-link" href="my-enquiry.php">My Booking</a> </li>
                                  <?php } ?>
                               
                                <li class="nav-item">  <a  class="nav-link" href="logout.php">Logout</a> </li>
                                <?php }?>
                              </ul>
                    </div>
                </div>
            </div>
          </div>
        </nav>

          <div class="container">
             <div class="row">
                 <div class="col-sm-3"></div>
                 <div class="col-sm-6">
                     <form action="get-location.php" method="get" id="form">
                        <div class="row">
                             <div class="col-sm-12">
                                <h3 class="text-center"> Book Garage Services</h3>
                                <hr>
                            </div>
                           
                        
                              <div class="form-check mb-3 col-sm-6">
                                <label class="form-check-label">Vehicle </label>
                                   <input type="text" class="form-control" id="vehicle" placeholder="Enter Vehicle" name="vehicle" required>
                                
                              </div>                             
                              <div class="form-check mb-3 col-sm-6">
                                <label class="form-check-label">Vehicle No</label>
                                   <input type="text" class="form-control" id="vehicle_no" placeholder="Enter vehicle no" name="vehicle_no" required>
                                
                              </div> 
                               <div class="form-check mb-3 col-sm-6">
                                <label for="services" class="form-label">Select Service :</label>
                                <select name="services" required class="form-select" required>
                                    <option>Maintenance</option>
                                    <option>Repair</option>
                                    <option>Breakdown rescue plus specified basic service</option>
                                </select>
                             </div>
                              <div class="form-check mb-3 col-sm-6">
                                <label class="form-label">Booking Date</label>
                                   <input type="date" class="form-control" id="date" placeholder="Enter date no" name="date" required>
                                
                              </div>
                           
                              <div class="form-check col-sm-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-block" style="width:100%">Book Now</button>
                                
                              </div>
                        </div>
                        </form>
                 </div>
                 
             </div>
            </div>
</body>
</html>