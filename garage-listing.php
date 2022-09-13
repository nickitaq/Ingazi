<?php include 'db_connect.php'; 

    if(!$_SESSION['USER_ID']){  
        $_SESSION['redirect_url'] = 'garage-listing.php?' . $_SERVER['QUERY_STRING'] ; 
        header("Location: login.php");
        exit;
    } 
?>

<?php $_SESSION['booking'][ 'booking_data']=  $_GET ; ?>

<?php $country=$_GET[ 'country']; 
$state=$_GET[ 'state']; 
$city=$_GET[ 'city']; 
$sublocality=$_GET[ 'sublocality']; 
$result=mysqli_query($conn, "select * from tbl_garage  where delete_flag = 0 and country='$country' and state = '$state' and city = '$city' or sublocality = '$sublocality' and approval_status = '1' ");
$count =  mysqli_num_rows ($result) ;
if($count == 0 ){
           $result = null;
        $result=mysqli_query($conn, "select * from tbl_garage  where delete_flag = 0 and country='$country' and state = '$state' and city = '$city'and approval_status = '1' ");
        $count =  mysqli_num_rows ($result) ;
        if($count == 0 ){
           $result = null;
           $result=mysqli_query($conn, "select * from tbl_garage  where delete_flag = 0 and country='$country' and state = '$state'and approval_status = '1'  ");
           $count2 =  mysqli_num_rows ($result) ;
           if($count2 == 0 ){
                 $result = null;
               $result=mysqli_query($conn, "select * from tbl_garage  where delete_flag = 0 and country='$country' and approval_status = '1'");
               $count3 =  mysqli_num_rows ($result) ;
               
               if($count3 == 0 ){
                    $result = null;
                   $result=mysqli_query($conn, "select * from tbl_garage  where delete_flag = 0 and approval_status = '1' ");
                
                }
            
            }
        
        }
}
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
                                  <a class="nav-link" href="javascript:void(0)">Home</a>
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
    <section style="margin-top:100px">
         <div class="container">
            <div>
                <center>
                    <h3 style="color: #fff;">
                        All Garage near : <?php echo $_GET['sublocality']; ?> <?php echo $_GET['city']; ?> <?php echo $_GET['state']; ?>, <?php echo $_GET['country']; ?>, <?php echo $_GET['postcode']; ?> 
                    </h3>
                </center>
                <br>
            </div>
        <div class="row">
            <?php $i=1; foreach($result as $row){ ?>
            <div class="col-sm-6">
                <div class="garage">
                     <div class="row">
                    <div class="col-sm-4">
                         <center>
                               <img src="admin/images/<?php echo $row['image']; ?>" alt=""style="width:100%;">
                            </center>
                    </div>
                    <div class="col-sm-8">
                         <h3>
                            <?php echo $row[ 'title']; ?>
                        </h3>
                        <p>
                             <?php echo $row[ 'description']; ?>
                        </p>
                        <p>
                            <strong> Location</strong> <?php echo $row[ 'formatted_address']; ?>
                        </p>
                        <form method="post" action="book-garage-process.php">
                            <input type="hidden" name="garage_id" value="<?php echo $row[ 'id']; ?>" >
                            <button class="btn btn-warning"> Book Now </button> 
                            
                        </form>
                       
                    </div>
                </div>
                </div>
               
               
            </div>
             <?php $i++ ; } ?>
        </div>
    </div>
    </section>
   
</body>

</html>