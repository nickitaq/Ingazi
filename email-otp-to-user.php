<?php 
    $email = $row['email'];
    $msg = '<html>
        <head>
        <title>  Email Verification </title>
        <style>
        table {
          border-collapse: collapse;
        }
        table, th, td {
          border: 1px solid black;
        }
        td{
            padding :5px;
            font-size: 18px;
        }
        </style>
        </head>
        <body>
            <div style="margin: auto;background: whitesmoke;padding: 25px;max-width: 900px;border: 1px solid #c1adad;">
                <h3 style="text-align:center"> Email Verification OTP  </h3>
                <p> 
				Please verify your email id , use this email OTP
				<br>
				Your Email OTP: <b>'.$email_otp .'</b> <br> </p>
            
            </div>
        </body>
        </html>';
        // Make sure to escape quotes
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Email Verification <info@gogange.online/>' . "\r\n";	
        mail($email, 'Email Verification', $msg, $headers);
      
