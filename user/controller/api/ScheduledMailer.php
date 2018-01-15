<?php
class ControllerApiScheduledMailer extends Controller {
        public function index(){
        $this->load->library('PHPMailer/PHPMailerAutoload');
        //*****************************MAIL FUNCTION START*********************************************//
        function MsgToMail($to,$cc,$sub,$msg){
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in', 'Agri CRM Adventz');    
			$mail->addAddress($to);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Agri CRM Adventz';
			//$mail->AddAttachment($attach);
			$mail->AddBCC($cc);
			//$mail->AddCC('aasit.kumar@aspltech.com','Aasit');
			
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
    //$url= 'zuari.akshapp.com';
    $to='aasit.kumar@aspltech.com';
    $cc='aasit.kumar@aspltech.com';
    $sub='Test Scheduler';
    $msg='This is a test Scheduled Message';
    
    MsgToMail($to,$cc,$sub,$msg);    
        
    }  
}
