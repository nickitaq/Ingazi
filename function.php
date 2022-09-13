<?php 
   function generateNumericOTP($n) {
        
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }
    
    function email_otp($email, $user_id){
        $n = 4;
        $otp = generateNumericOTP($n);
        $_SESSION['email_verification'] = array('email'=> $email , 'otp'=>$otp, 'user_id'=>$user_id ) ; 
        return $otp ;
      
    }
    
    function phone_otp($phone, $user_id){
        $n = 4;
        $otp =  $this->generateNumericOTP($n);
        $_SESSION['phone_verification'] = array('phone'=> $phone , 'otp'=>$otp, 'user_id'=>$user_id ) ; 
        return $otp ;
      
    }
    
    function phone_verification(){
        $otp = $_SESSION['phone_verification']['otp'];
        if($otp){
             $data['RESULT'] = $this->cms_model->get_cms_by_id(15);
	            $this->load->view('front/user/phone-verification',$data);
        }else{
            redirect('user/login') ; 
        }
       
    }
    
    function phone_otp_process(){
        
		$user_id = $_SESSION['phone_verification']['user_id'];
		$redirect_url = '';
		$response['status'] = 0;
		$response['message'] = '';
		if(isset($_POST['inputOne']))
		{
			$_session_otp = $_SESSION['phone_verification']['otp'];
			$post_otp = $this->input->post('inputOne').$this->input->post('inputTwo').$this->input->post('inputThree').$this->input->post('inputFour');
			if($_session_otp != $post_otp)
			{
				  $response['message'] = '<p >Enter Correct OTP </p>'; 
			}
			else
			{

					$upd_data['phone_verify'] ="1";
					$this->user_model->update_user($user_id,$upd_data);
					$response['status'] = 1; 
 					$response['message'] = '<p >Phone No Verified successfully.</p>'; 
 					unset($_SESSION['phone_verification']) ;
					$response['url'] = base_url('login') ;
			
			}
		}
		echo json_encode($response);
    }
    
    function resend_email_otp(){
        	$link = $this->setting_model->get_all_setting();
        	$user_id = $_SESSION['email_verification']['user_id'];
            $user_data =  $this->user_model->get_user_by_id($user_id);
    		$this->load->library('email');	
    		$this->email->set_mailtype("html");
    		$this->email->set_newline("\r\n");				
    		$htmlContent = '<br>
    		                    <b>Resend Email OTP</b>
    					        <br>
    						Please verify your email id , use this email OTP
    						<br>
    						Your Email OTP: <b>'.$_SESSION['email_verification']['otp'] .'</b> <br>
    					<br><br><br>Thanks<br>'.$link[0]->title;;
    		$this->email->to(trim($user_data[0]->email));
    		$this->email->from($link[0]->from_email,$link[0]->title);
    		$this->email->subject($link[0]->title.':: Resend Email OTP');
    		$this->email->message($htmlContent);				
    		$this->email->send();
    		$this->session->set_flashdata('msg','<p>Email OTP has been resend your registered email id</p>');		
            redirect('user/email_verification') ; 
    }
    
    function resend_phone_otp(){
        	$link = $this->setting_model->get_all_setting();
        	$user_id = $_SESSION['phone_verification']['user_id'];
            $user_data =  $this->user_model->get_user_by_id($user_id);
    						
    		$htmlContent = '<br>
    		                    <b>Resend Email OTP</b>
    					        <br>
    						Please verify your email id , use this email OTP
    						<br>
    						Your Email OTP: <b>'.$_SESSION['phone_verification']['otp'] .'</b> <br>
    					<br><br><br>Thanks<br>'.$link[0]->title;;

    		$this->session->set_flashdata('msg','<p>Email OTP has been resend your registered phone number</p>');		
            redirect('user/phone_verification') ; 
    }
    
    
    ?>