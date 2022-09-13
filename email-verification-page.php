<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Order OTP </title>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
	<style type="text/css">
body{

    background: #f5f5f5;
}

.height-100 {
    height: 100vh
}

.card {
    width: 400px;
    border: none;
    height: 370px;
      box-shadow: 0px 5px 20px 0px #d6d6d6;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
}

.card h6 {
    color: #6F1667;
    font-size: 12px
}

.inputs input {
    width: 40px;
    height: 40px
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0
}

.form-control:focus {
    box-shadow: none;
    border: 2px solid #6F1667
}

.validate {
    border-radius: 20px;
    height: 40px;
    background-color: #e00d21;
    border: 1px solid #e00d21;
    width: 100%
}

.content a {
    color: #D64F4F;
    transition: all 0.5s
}

.content a:hover {
    color: #6F1667
}

@media screen and (min-width: 480px) {
 .height-100 {
    height: 70vh
}
}
	</style>
</head>
<body>


<div id="app">
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
            	<h3>Email verification</h3>
                <h6>Enter the code we just send on your email <br> </h6>
                <div> <small><?php echo $_SESSION['user']['user_email'] ?></small> </div>
                <form id="email-otp-form" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                	<div id="otp" class="inputs d-flex flex-row justify-content-center mt-1">
		                <input name="inputOne" class="m-1 text-center form-control rounded" type="text" id="input1" v-on:keyup="inputenter(1)" maxlength="1" />
		                <input name="inputTwo" class="m-1 text-center form-control rounded" v-on:keyup="inputenter(2)" type="text" id="input2" maxlength="1" />
		                <input name="inputThree" class="m-1 text-center form-control rounded" v-on:keyup="inputenter(3)" type="text" id="input3" maxlength="1" />
		                <input name="inputFour" class="m-1 text-center form-control rounded" v-on:keyup="inputenter(4)" type="text" id="input4" maxlength="1" />
	                </div>
                <div class="mt-2"> <input class="btn btn-danger px-4 validate" type="submit" name="Validate"  id="otpButton" Value="Validate"> </div>
                </form>	
                <br>
              <div id="otp-box-msg" style="color:red"></div>
                               
                <!--<div class="mt-3 content d-flex justify-content-center align-items-center"> <span>Didn't get the code?  </span>   <a href="resend_email_otp.php" class="text-decoration-none ms-3">  Resend</a> </div>-->
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var app = new Vue({
el: '#app',
methods: {
inputenter(id) {

const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) { 
    inputs[i].addEventListener('keydown', function(event) {
        if (event.key==="Backspace" ) {
             inputs[i].value='' ; 
             if (i !==0) inputs[i - 1].focus();
        } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } } });

    $('#input1').change(function() {
           $('#input2').focus();
    });
   
    $('#input1').keyup(function() {
           $('#input2').focus();
    });
   
      
      
</script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
    $('#email-otp-form').submit(function () {  
        
          $('.otp-box-msg').html('');
    $('#otpButton').val('Processing....') ;  
      $.ajax({
            url: "email_otp_process.php",
            type: "POST",     
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#otpButton').val('Validate') ;  
                if(response.status == 1){
                    $('#otp-box-msg').html(response.message);
                      window.location.replace(response.url);
   
                }else{
                     $('#otp-box-msg').html(response.message);
                }
            }
        
          });
      return false;
    });
}); 
 </script>
    </body>

</html>


