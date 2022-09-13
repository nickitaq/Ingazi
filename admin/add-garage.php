<?php 

include 'db_connect.php';

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
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
                    <h1 class="mt-4">Add Garage</h1>
                   

                    <div class="row">
                        <div class="col-md-10 m-auto">
                            <?php 
       
                        if(isset($_SESSION['success-msg'])){
                            echo $_SESSION['success-msg'];
                            unset($_SESSION['success-msg']);
                        }
                        
                        ?>
                    <form  method="post" action="add-garage-process.php" id="garage-form" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Garage Name</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>About Garage</label>
                                <input type="text" class="form-control" name="description" required>
                            </div> 
                            <div class="form-group col-md-6">
                                <label>Garage Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Garage Phone Number</label>
                                <input type="phone_no" class="form-control" name="phone_no" required>
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
                               
                                <input type="text"  class="form-control" name="country" value="Rwanda" placeholder="country" id="input-country"/>
                              </div>  
                             <div class="form-group col-md-3">
                                <label>State</label>
                                <input type="text"  class="form-control" name="state" value="" placeholder="state" id="input-state"/>
                               
                            </div>
                            <div class="form-group col-md-3">
                                <label>City</label>
                                <input type="text"  class="form-control" name="city" value="" placeholder="City" id="input-city"/>
                               
                            </div> 
                           
                            <div class="form-group col-md-3">
                                <label>sublocality</label>
                                <input type="text"  class="form-control" name="sublocality" value="" placeholder="sublocality" id="input-sublocality"/>
                               
                            </div> 
                             <div class="form-group col-md-3">
                                <label>Route</label>
                               
                                <input type="text"  class="form-control" name="route" value="" placeholder="Post Code" id="input-route"/>
                               
                            </div>  
                            <div class="form-group col-md-3">
                                <label>Post Code</label>
                               
                                <input type="text"  class="form-control" name="postcode" value="" placeholder="Post Code" id="input-postcode"/>
                               
                            </div> 
                            <div class="form-group col-md-12">
                                <label>Formatted Address</label>
                               
                                <input type="text"  class="form-control" name="formatted_address" value="" placeholder="" id="input-formatted_address"/>
                               
                            </div>
                             <div class="form-group col-md-6">
                              
                                <input type="hidden" class="form-control" name="longitude" value="" placeholder="longitude" id="longitude">
                            </div>
                            <div class="form-group col-md-6">
                          
                                <input type="hidden" class="form-control" name="latitude" value="" placeholder="latitude" id="latitude" required>
                            </div> 
                             <div class="form-group col-md-12">
                                <label>Garage Image</label>
                                <input type="file" class="form-control" name="image" accept="image/png, image/jpeg,image/png,image/JPEG,image/JPG,image/PNG" required>
                            </div>
                        </div>
                       
                      <div class="form-group col-md-6">
                        <button type="submit" name="submit" class="btn btn-primary" id="garageButton">Add garage</button>
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
        <script>
         getLocation() ; 
        
         function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        
        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
            var latitude = Number(document.getElementById("latitude").value);
            var longitude = Number(document.getElementById("longitude").value);
            var map;
            var marker;
            var myLatlng = new google.maps.LatLng(latitude, longitude);
            var geocoder = new google.maps.Geocoder();
            var infowindow = new google.maps.InfoWindow();
    
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
        
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results) ; 
                    if (results[1]) {
                        var address_components = results[1].address_components;
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
                        $('#input-formatted_address').val(results[0].formatted_address);
                        $('#latitude').val(position.coords.latitude);
                        $('#longitude').val(position.coords.longitude);
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                       
                    }
                }
            });
        }
    </script>
<script type="text/javascript">
 
    function initialize() {
        var latitude = Number(document.getElementById("latitude").value);
        var longitude = Number(document.getElementById("longitude").value);
        var map;
        var marker;
        var myLatlng = new google.maps.LatLng(latitude, longitude);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

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
                    console.log(results) ; 
                    if (results[0]) {
                        var address_components = results[0].address_components;
                         console.log(address_components) ;
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