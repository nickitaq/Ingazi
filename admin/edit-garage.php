<?php
include "db_connect.php";

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
$admin_id  = $_SESSION['ADMIN_ID'] ; 
$garage_id = $_GET['id'] ; 
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
    if($_FILES['image']['name']){
		$image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/'.$image;
     move_uploaded_file($image_tmp_name,$image_folder);
	}else{
	    
	    $image = $_POST['image_old'];
	}
   
    $sql = "update tbl_garage SET  email='$email' , phone_no='$phone_no', title='$title', description='$description',
    longitude='$longitude', latitude='$latitude',country='$country',state='$state',sublocality='$sublocality'
    ,route='$route',city='$city',postcode='$postcode',formatted_address='$formatted_address',image ='$image' where id='$garage_id'"; 
    $query = mysqli_query($conn, $sql);
    if( $query){
        
           $msg = '<div class="alert alert-success"> Garage Edited Successfull</div>';
          $_SESSION['success-msg']='<div class="alert alert-success">Update Successfully</div>';
          
      }else{
          $_SESSION['success-msg']='<div class="alert alert-danger"> Not Update, Please Try again</div>';
          $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
      }
 
   
}


$result = mysqli_query($conn, "select * from  tbl_garage where   id='$garage_id'"); 
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
    <title>Dashboard</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyA-KTNsETiaNQdf7SSiL94BooOG_c2L2sU"></script>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Update Garage</h1>
                    
                      <?php 
       
                        if(isset($_SESSION['success-msg'])){
                            echo $_SESSION['success-msg'];
                            unset($_SESSION['success-msg']);
                        }
                        
                        ?>
                    <div class="row">
                        <div class="col-md-10 m-auto">
                            <form  method="post"  id="garage-form" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Garage Name</label>
                                        <input type="text" class="form-control" value="<?php echo $row['title'] ?>" name="title" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>About Garage</label>
                                        <input type="text" class="form-control" value="<?php echo $row['description'] ?>" name="description" required>
                                    </div>
                                      <div class="form-group col-md-6">
                                        <label>Garage Email</label>
                                        <input type="email" class="form-control" name="email" required value="<?php echo $row['email'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Garage Phone Number</label>
                                        <input type="phone_no" class="form-control" name="phone_no" required value="<?php echo $row['phone_no'] ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">    
                                   <div class="form-group col-md-12">
                                       <h3> Map Address</h3>
                                    </div>
                                    <p>Click the button to get your coordinates.</p>
        
                                      
                                   
                                    <div class="form-group col-md-12">
                                       <div id="webkulMap" style="height: 500px;"></div>
                                    </div>
                                  
                                    <div class="form-group col-md-3">
                                        <label>Country</label>
                                       
                                        <input type="text"  class="form-control" name="country" value="<?php echo $row['country'] ?>" placeholder="country" id="input-country"/>
                                      </div>  
                                     <div class="form-group col-md-3">
                                        <label>State</label>
                                        <input type="text"  class="form-control" name="state" value="<?php echo $row['state'] ?>" placeholder="state" id="input-state"/>
                                       
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>City</label>
                                        <input type="text"  class="form-control" name="city" value="<?php echo $row['city'] ?>" placeholder="City" id="input-city"/>
                                       
                                    </div> 
                                    <div class="form-group col-md-3">
                                        <label>Post Code</label>
                                       
                                        <input type="text"  class="form-control" name="postcode" value="<?php echo $row['postcode'] ?>" placeholder="Post Code" id="input-postcode"/>
                                       
                                    </div>
                                      <div class="form-group col-md-3">
                                        <label>Route</label>
                                       
                                        <input type="text"  class="form-control" name="route" value="<?php echo $row['route'] ?>" placeholder="Post Code" id="input-route"/>
                                       
                                    </div>  
                                    <div class="form-group col-md-3">
                                        <label>sublocality</label>
                                        <input type="text"  class="form-control" name="sublocality" value="<?php echo $row['sublocality'] ?>" placeholder="sublocality" id="input-sublocality"/>
                                       
                                    </div> 
                                    <div class="form-group col-md-12">
                                        <label>Formatted Address</label>
                                        <input type="text"  class="form-control" name="formatted_address" value="<?php echo $row['formatted_address'] ?>" placeholder="sublocality" id="input-formatted_address"/>
                                       
                                    </div> 
                                     <div class="form-group col-md-6">
                                      
                                        <input type="hidden" class="form-control" name="longitude" value="<?php echo $row['longitude'] ?>" placeholder="longitude" id="longitude">
                                    </div>
                                    <div class="form-group col-md-6">
                                  
                                        <input type="hidden" class="form-control" name="latitude" value="<?php echo $row['latitude'] ?>" placeholder="latitude" id="latitude" required>
                                    </div> 
                                     <div class="form-group col-md-12">
                                        <label>Garage Image</label>
                                        <input type="file" class="form-control" name="image" accept="image/png, image/jpeg,image/png,image/JPEG,image/JPG,image/PNG" >
                                        
                                    <?php if($row['image']) { ?>
                                    <img src="images/<?php echo $row['image']; ?>" alt="" style="width:50px; height:50px; "> 
                                     <input type="hidden" class="form-control" name="image_old" value="<?php echo $row['image']; ?>">
                                    <?php } ?>
                                    </div>
                                </div>
                               
                              <div class="form-group col-md-6">
                                <button type="submit" name="submit" class="btn btn-primary" id="garageButton">Edit garage</button>
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
  <script type="text/javascript">
    var latitude = Number(document.getElementById("latitude").value);
    var longitude = Number(document.getElementById("longitude").value);
    var map;
    var marker;
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    var geocoder = new google.maps.Geocoder();
    var infowindow = new google.maps.InfoWindow();
    function initialize() {
        var mapOptions = {
        zoom: 15,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        map = new google.maps.Map(document.getElementById("webkulMap"), mapOptions);
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });
        
       

        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var address_components = results[0].address_components;
                        var components={};
                        jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});});
                        var city;
                        var postal_code;
                        var state;
                        var country;
                         var route;
                        var sublocality;

                      
                       if(components.route) {
                            route = components.route;
                        }
                         if(components.sublocality) {
                            sublocality = components.sublocality;
                        }
                        if(!sublocality) {
                            sublocality = components.sublocality_level_1;
                        }
                        
                        if(components.locality) {
                            city = components.locality;
                        }

                        if(!city) {
                            city = components.administrative_area_level_1;
                        }

                        if(components.postal_code) {
                            postal_code = components.postal_code;
                        }

                        if(components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }

                        if(components.country) {
                            country = components.country;
                        }
                        $('#input-sublocality').val(sublocality);
                        $('#input-route').val(route);
                        $('#input-city').val(city);
                        $('#input-postcode').val(postal_code);
                        $('#input-state').val(state);
                        $('#input-country').val(country);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                          $('#input-formatted_address').val(results[0].formatted_address);
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    
    
</script>

</body>

</html>