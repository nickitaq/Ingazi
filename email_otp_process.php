 <?php 
        include 'db_connect.php';
		$user_id =  $_SESSION['user']['user_id'];
		$redirect_url = '';
		$response['status'] = 0;
		$response['message'] = '';
		if(isset($_POST['inputOne']))
		{
			$_session_otp = $_SESSION['email_verification']['otp'];
			$post_otp = $_POST['inputOne'].$_POST['inputTwo'].$_POST['inputThree'].$_POST['inputFour'];
			if($_session_otp != $post_otp)
			{
				  $response['message'] = '<p>Enter Correct OTP </p>'; 
			}
			else
			{
				$sql = "update tbl_users SET email_verify='1' where id='$user_id'";
                $query = mysqli_query($conn, $sql);
				$response['status'] = '1'; 
 				$response['message'] = '<div class="alert alert-success">Email Verified successfully.</div>'; 
 				unset($_SESSION['email_verification']) ;
 
                $query=mysqli_query($conn,"SELECT * FROM `tbl_users`  WHERE id='$user_id'");
 				$row=mysqli_fetch_assoc($query);
			
					$_SESSION['USER_ID']=$row['id'];
					$_SESSION['USERNAME']=$row['name'];
					$_SESSION['USER_TYPE']=$row['user_type'];
					if($_SESSION['redirect_url']){  
						$response['url']=$_SESSION['redirect_url'];
						unset($_SESSION['redirect_url']) ;
					}else{
						$response['url']='index.php' ; 
					}
			
			}
		}
		echo json_encode($response);
		die;
?>