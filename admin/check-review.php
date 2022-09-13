<?php

include('db_connect.php');

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
if(isset($_GET['type']) && $_GET['type']=='delete' &&  ($_GET['id'])){
  $id= mysqli_real_escape_string($conn,$_GET['id']);
   $sql = "update tbl_garage SET delete_flag='1' where id='$id'";
    $query = mysqli_query($conn, $sql);
 
}

$admin_id  = $_SESSION['ADMIN_ID'] ; 
$booking_enquiry_id = $_GET['id'];  
$result = mysqli_query($conn, "select * from  tbl_garage_booking where id='$booking_enquiry_id' " );
$row=mysqli_fetch_assoc($result);
if(count($row) == 0 ){
    header('my-enquiry.php');
}
$garage_id = $row['garage_id'];
$result_garage = mysqli_query($conn, "select * from  tbl_garage where id='$garage_id' " );
$row2=mysqli_fetch_assoc($result_garage);

$user_id = $row['user_id'];
$result_user = mysqli_query($conn, "select * from  tbl_users where id='$user_id' " );
$row3=mysqli_fetch_assoc($result_user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Feedback Form  </title>

    <meta name="author" content="Codeconvey" />
    
    <link rel="stylesheet" href="rating-review-css/style.css">
    <!--Only for demo purpose - no need to add.-->
    <link rel="stylesheet" href="rating-review-css/demo.css" />
    <style>
    .feedback {
    width: 100%;
    max-width: 780px;
    background: #fff;
    margin: 0 auto;
    padding: 15px;
    box-shadow: 1px 1px 16px rgb(0 0 0 / 30%);
    min-height: 500px;
}
        button{
            background: #0095ff;
    padding: 15px 20px;
    color: #fff;
    font-size: 20px;
    font-weight: bold;
    border: 1px solid #0095ff;
        }
    </style>
	
</head>
<body>
<header class="ScriptHeader">
    <div class="rt-container">
    	<div class="col-rt-12">
        	<div class="rt-heading">
            	<h1>Feedback Form   </h1>
               
            </div>
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
         <div class="col-rt-12">
            <div class="Scriptcontent">
                <div class="feedback">
            
                
                    <div class="">
                        <p>Dear Customer,<br>
                        Thank you for getting your <?php echo $row['vehicle']; ?> services at our workshop. We would like to know how we performed. Please spare some moments to give us your valuable feedback as it will help us in improving our service.</p>
                        
                        <h4>Please rate your service experience for the following parameters</h4>

                        <form method="post" >
                        <label>1. Your overall experience with us ?</label><br>
                          
                        <span class="star-rating">
                          <input type="radio" name="rating1" value="1"><i></i>
                          <input type="radio" name="rating1" value="2"><i></i>
                          <input type="radio" name="rating1" value="3"><i></i>
                          <input type="radio" name="rating1" value="4"><i></i>
                          <input type="radio" name="rating1" value="5"><i></i>
                        </span>
                        
                          <div class="clear"></div> 
                          <hr class="survey-hr">
                        <label>2. Friendliness and courtesy shown to you while recieving your vehicle</label><br>
                        <span class="star-rating">
                          <input type="radio" name="rating2" value="1"><i></i>
                          <input type="radio" name="rating2" value="2"><i></i>
                          <input type="radio" name="rating2" value="3"><i></i>
                          <input type="radio" name="rating2" value="4"><i></i>
                          <input type="radio" name="rating2" value="5"><i></i>
                        </span>
                        
                        
                         
                          <div class="clear"></div> 
                          <hr class="survey-hr"> 
                        <label for="m_3189847521540640526commentText">4. Any Other suggestions:</label><br/><br/>
                        <textarea cols="75" name="commentText" rows="5" style="100%"></textarea><br>
                        <br>
                          <div class="clear"></div> 
                        <input style="background:#43a7d5;color:#fff;padding:12px;border:0" type="submit" value="Submit your review">&nbsp;
                        </form>
                  </div>
              
                <hr>
                        <div>
                            <center>
                                <a style="" href="my-enquiry.php"> <button> Back To Page </button></a>
                            </center>
                        </div>
                </div>
              
    		</div>
		</div>
    </div>
</section>
</body>
</html>