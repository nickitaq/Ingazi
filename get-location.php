<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>On Demand Garage Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyA-KTNsETiaNQdf7SSiL94BooOG_c2L2sU"></script>
     
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
    <section style="margin-top:30px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12"><h3 style="color:#fff"><div class="text-center" > Your Location</div></h3></div>
                <div class="col-sm-2"> </div>
                <div class="col-sm-8"> 
                <div id="webkulMap" style="height: 500px;"></div>
                <bR><form method="get" action="garage-listing.php" id="myForm">
                     <div class="row">
                        
                        <div class="col-sm-9">
                             
                                <input type="hidden"  class="form-control" name="vehicle" value="<?php echo $_GET['vehicle'] ; ?>"  required/>
                                <input type="hidden"  class="form-control" name="vehicle_no" value="<?php echo $_GET['vehicle_no'] ; ?>" required/>
                                <input type="hidden"  class="form-control" name="services" value="<?php echo $_GET['services'] ; ?>" required/>
                                <input type="hidden"  class="form-control" name="date" value="<?php echo $_GET['date'] ; ?>" required/>
                                <input type="hidden"  class="form-control" name="country" value="" placeholder="country" id="input-country" required/>
                                <input type="hidden"  class="form-control" name="state" value="" placeholder="state" id="input-state" required/>
                                <input type="hidden"  class="form-control" name="city" value="" placeholder="City" id="input-city" required/>
                                <input type="hidden"  class="form-control" name="postcode" value="" placeholder="Post Code" id="input-postcode" required/>
                                <input type=""  class="form-control" name="formatted_address" value="" placeholder="Post Code" id="input-formatted_address" required/>
                                <input type="hidden" class="form-control" name="longitude" value="" placeholder="longitude" id="longitude" required>
                                <input type="hidden" class="form-control" name="latitude" value="" placeholder="latitude" id="latitude" required>
                                <input type="hidden"  class="form-control" name="sublocality" value="" placeholder="sublocality" id="input-sublocality"/>
                                <input type="hidden"  class="form-control" name="route" value="" placeholder="Post Code" id="input-route"/>
                                
                            
        
                        </div>
                        <div class="col-sm-3">
                            <input type="submit"  class="form-control btn btn-primary" name="submit_form" value="Find Near Garage" />
                        </div>
                    </div>
                    </form>
                </div>
            </div>
           
        </div>
    </section>
   
                              
    <script type="text/javascript">
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
                        // document.getElementById("myForm").submit();
                       
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