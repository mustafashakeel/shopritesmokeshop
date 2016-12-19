<?php 
	/*** IMPORTS FOR THE MAILLER FUNCTIONS ***/
include_once 'PHP-Mailler/class.phpmailer.php';
include_once 'PHP-Mailler/class.smtp.php';
	/** 									**/
	

	if($_POST) {

		$to = "info@shopritesmokeshop.ca"; // Your email here
		$subject = 'ShopRite Smoke Shop - Contact'; // Subject message here

	}

	//Send mail function
	function send_mail($to,$subject,$message,$headers){
	
		if(@mail($to,$subject, $message, $headers)){
			echo json_encode(array('info' => 'success', 'msg' => "Your message has been sent. Thank you!"));
		} else {
			echo json_encode(array('info' => 'error', 'msg' => "Error, your message hasn't been sent"));
		}
	}

	//Check e-mail validation
	function check_email($email){
		if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			return false;
		} else {
			return true;
		}
	}
	
	
	//Get post data
	if(isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['comment'])){
		$name 	 = $_POST['name'];
		$mail 	 = $_POST['mail'];
		//$subject  = $_POST['subject'];
		$comment = $_POST['comment'];

		if($name == '') {
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
			exit();
		} else if($mail == '' or check_email($mail) == false){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
			exit();
		} else if($comment == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your message."));
			exit();
		} else {


			/*
			$MailBoxServerName = 'ShopRite Smoke Shop';
			$MailBoxServerMail = 'info@shopritesmokeshop.ca';
			$password = 'amazing';*/
			
			/*** FIM - DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/ 
			/*$mail = new PHPMailer();
			$mail->IsMail();
			$mail->SMTPAuth  = true;
			$mail->SMTPSecure = "tls";
			$mail->Charset   = 'utf8_decode()';
			$mail->Host  = 'smtp.1and1.com';
			$mail->Port  = 587;
			$mail->Username  = $MailBoxServerMail;
			$mail->Password  = $password;
			$mail->From  = $mail;
			$mail->FromName  = $name . "<".$mail.">";
			$mail->IsHTML(true);
			//$mail->AddBCC('trdvelho@yahoo.com.br', 'Thiago'); // Cópia Oculta
			
			$SendTo = 'info@shopritesmokeshop.ca';
			$mail->Body  = utf8_decode($_POST['comment']);
			 
			$mail->AddAddress($SendTo,utf8_decode("ShopRite Smoke Shop"));
			$mail->Subject  = utf8_decode("ShopRite Smoke Shop Contact - ".$subject);
			 
			//$mail->Send();*/
			
			
			//Send Mail
			$headers = 'From: ' . $mail .''. "\r\n".
			'Reply-To: '.$mail.'' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
			send_mail($to, $subject, $comment . "\r\n\n"  .'Name: '.$name. "\r\n" .'Email: '.$mail, $headers);
		}


	} 
	
	else {
		echo json_encode(array('info' => 'error', 'msg' => "Please fill out all fields"));
	}
 ?>