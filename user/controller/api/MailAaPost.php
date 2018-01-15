<?php
class ControllerApiMailAaPost extends Controller {
        public function index(){
        $log=new Log("ManualMailAaPost".date('dmy').".log");
        $this->load->library('PHPMailer/PHPMailerAutoload');
        
        //*****************************MAIL FUNCTION START*********************************************//
        function MsgToMail($to,$cc,$sub,$msg){
            $log=new Log("ManualMailAaPost".date('dmy').".log");
            $log->write($to.'/'.$cc.'/'.$sub.'/'.$msg);
            echo $to.'/'.$cc.'/'.$sub.'/'.$msg;
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
                        $mail->AddCC($cc);
			$mail->AddBCC('aasit.kumar@aspltech.com','Aasit');
			//$mail->send();
			
        }
//*****************************MAIL FUNCTION END***********************************************//
//**********************************SEND SMS FUNCTION START*************************************//
        function MailToSms($ramob,$ramsg){
        $msg=urlencode($ramsg);//"You are not  Registered with us!");
        $log=new Log("ManualMailAaPost".date('dmy').".log");
        $log->write($ramob.'/'.$ramsg);
        echo $ramob.'/'.$ramsg;
        //$surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&mobilenumber=".$ramob."&message=".$msg;
        $log->write($surl);
                $curl_handle=curl_init();
                curl_setopt($curl_handle,CURLOPT_URL,$surl);
                curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                $buffer = curl_exec($curl_handle);
                if($buffer === false)
                {
                        echo 'Curl error: ' . curl_error($curl_handle);
                }
                else
                {

                    print_r($buffer);
                    return true;
                }	
                curl_close($curl_handle);
        }
        //**********************************SEND SMS FUNCTION END*************************************//  

$this->load->model('api/MailAaPost');
$CompData= $this->model_api_MailAaPost->checkComplain();
$log->write($CompData);
if($CompData){
    
    foreach($CompData as $CD){
        $raday=$CD['AA_DAY'];
        if(($raday==1)||($raday==3)||($raday==5))// One Day Befor AA Date
        {
            $caseid=$CD['CASE_ID'];
            $aamail=$CD['AA_MAIL'];
            $aamob=$CD['AA_MOB'];
            $aaname=$CD['AA_NAME'];
            
            $url= 'zuari.akshapp.com';
            $cc='asad.ahmed@adventz.com';
            
            $sub="Reminder for complaint  ".$caseid.": Approval date expires";
            $msg="Dear ".$aaname.", <br><br><br>
            Complaint ".$caseid." is past its approval deadline. <br><br>
            The resolution can be accessed at ".$url." <br><br>
            Kindly review asap and provide approval. <br><br> <br><br>
            Thanks and Regards, <br>
            Support- Adventz Agri CRM";
            
            MsgToMail($aamail,$cc,$sub,$msg);
            $aamsg="Resolution ".$caseid." is past its approval deadline. Kindly review through app or web and provide closure. -Support- Adventz Agri CRM";
            MailToSms($aamob,$aamsg);
        }
    }
}

}  
}
