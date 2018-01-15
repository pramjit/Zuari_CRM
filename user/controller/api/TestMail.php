<?php
class ControllerApiTestMail extends Controller {
        public function index(){
        $this->load->library('PHPMailer/PHPMailerAutoload');
        //*****************************MAIL FUNCTION START*********************************************//
function MsgToMail($to,$cc,$sub,$msg){
			$mail = new PHPMailer;
			$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in', 'ZUARI CRM');   
			$mail->addAddress($to);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from ZUARI CRM';
			//$mail->AddAttachment($attach);
			$mail->AddCC($cc);
			//$mail->AddCC('aasit.kumar@aspltech.com','Aasit');
			//$mail->AddCC('pragya.singh@aspltech.com','Pragya');
			$mail->send();
			/*if(!$mail->send())	{
    								echo 'Message could not be sent.';
    								echo 'Mailer Error: ' . $mail->ErrorInfo;
								}
								else
								{
    								echo 'Message has been sent';
								}
			*/
}
//*****************************MAIL FUNCTION END***********************************************//
	$to='aasit.kumar@aspltech.com';
	$cc='anamika.arora@aspltech.com';
							$sub='Advisory ID : '.$adv_pin.' awaiting call back';
							$msg="Dear Sir,<br><br>
									Advisory <id> has been logged in for you.<br><br>
									You may reach the caller by dialing 0120-4398901 followed by the above mentioned advisory ID.<br><br>
									Request you to please call the concerned farmer within 1 working day.<br><br>

									Best Regards,<br>
									Support- Adventz Agri CRM";
    MsgToMail($to,$cc,$sub,$msg);    
        
    }  
}
