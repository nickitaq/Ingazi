<?php

include 'db_connect.php';
$admin_id  = $_SESSION['ADMIN_ID'] ; 
if(isset($_POST['submit'])) {
    
    extract($_POST);
    $email=   mysqli_real_escape_string($conn, $_POST['email']);
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
    if($_SESSION['ROLE'] == 'operator'){
      $approval_status = '0' ; 
      $insert_by = 'operator' ;
    }else{
         $approval_status = '1' ;  
         $insert_by = 'admin' ;
    }


    
    $image = '';

    if($_FILES['image']['name']){
			$image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/'.$image;
         move_uploaded_file($image_tmp_name,$image_folder);
	}

        $sql = "insert into  tbl_garage( `email`, `phone_no`,  `title`, `description`, `longitude`,  `latitude`, `country`, `state`, `city`,`route`,`sublocality`, `postcode`,`formatted_address`,`image` ,`admin_id`,`approval_status`,`insert_by`) 
         values ('$email','$phone_no','$title','$description','$longitude','$latitude','$country','$state','$city','$route','$sublocality','$postcode','$formatted_address','$image','$admin_id','$approval_status','$insert_by')"; 
        $query = mysqli_query($conn, $sql);
        if( $query){
                move_uploaded_file($image_tmp_name, $image_folder);
                $msg = '<div class="alert alert-success"> Garage Added Successfull</div>';
                $_SESSION['success-msg']=$msg ;
                 header('location:listing.php');
        }else{
                $_SESSION['success-msg']='<div class="alert alert-danger"> Not Added, Please Try again</div>';
                $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
                
                  
        }
    }
header('location:add-garage.php');
 ?>