<?php
class ControllerApiMail extends Controller {
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
    $url= 'zuari.akshapp.com';
    $to='sdrm@mangalorechemicals.com';
    $cc='aasit.kumar@aspltech.com';
    $sub='Complaint 1113741592: Resolution required';
    $msg='Dear Sidram Reddy, <br><br><br>
          Complaint 1113741592 has been registered. <br><br>
          The complaint can be accessed through  '.$url.'<br><br>
          The expected Resolution date for this complaint is 9 working  days post complaint logging date.<br><br><br>
          Thanks and Regards,<br>
          Support- Adventz Agri CRM';
    
    //MsgToMail($to,$cc,$sub,$msg);    
        
    }  
}
