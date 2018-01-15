<?php
class ControllerApiMailRa extends Controller {
        public function index(){
        $log=new Log("ManualRACompMail".date('dmy').".log");
        $this->load->library('PHPMailer/PHPMailerAutoload');
        
        //*****************************MAIL FUNCTION START*********************************************//
        function MsgToMail($to,$cc,$sub,$msg){
            $log=new Log("ManualRACompMail".date('dmy').".log");
            $log->write($to.'/'.$cc.'/'.$sub.'/'.$msg);
            //echo $to.'/'.$cc.'/'.$sub.'/'.$msg;
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
			$mail->send();
			
        }
//*****************************MAIL FUNCTION END***********************************************//
//**********************************SEND SMS FUNCTION START*************************************//
        function MailToSms($ramob,$ramsg){
        $msg=urlencode($ramsg);//"You are not  Registered with us!");
        $log=new Log("ManualRACompMail".date('dmy').".log");
        $log->write($ramob.'/'.$ramsg);
        $surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&mobilenumber=".$ramob."&message=".$msg;
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

$this->load->model('api/MailRa');
$CompData= $this->model_api_MailRa->checkComplain();
$log->write($CompData);
if($CompData){
    
    foreach($CompData as $CD){
        $caseid=$CD['CASE_ID'];
        $ramail=$CD['RA_MAIL'];
        $ramob=$CD['RA_MOB'];
        $raname=$CD['RA_NAME'];
        $raday=$CD['RA_DAY'];
        $url= 'zuari.akshapp.com';
        $cc='asad.ahmed@adventz.com';

        $sub='Complaint '.$caseid.': Resolution required';
        $msg='Dear '.$raname.', <br><br><br>
              Complaint '.$caseid.' has been registered. <br><br>
              The complaint can be accessed through  '.$url.'<br><br>
              The expected Resolution date for this complaint is '.$raday.' working  days post complaint logging date.<br><br><br>
              Thanks and Regards,<br>
              Support- Adventz Agri CRM';
        
        MsgToMail($ramail,$cc,$sub,$msg);
        $ramsg="Complaint ".$caseid." has been registered. Please login through app or web to review the same. -Support- Adventz Agri CRM ";
        MailToSms($ramob,$ramsg);
    }
}

}  
}
