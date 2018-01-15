<?php
class ControllerApiivrcall extends Controller {
     
        public function index(){
        $this->load->library('PHPMailer/PHPMailerAutoload');
        $log=new Log("ApiIvrCall".date('d_m_Y').".log");
        $log->write($this->request->get);
        //$mcrypt = new MCrypt(); 
        $mob=$this->request->get['mob'];        //Farmer Mobile Callfrom
        $log->write($mob);
        $code=$this->request->get['code'];      //Key Press 1/2 InCase Of Type 2
        $log->write($code);
        $type=$this->request->get['type'];      // 2-(Advisory/Complaint Call) 3-
        $log->write($type);
        
        //*****************************MAIL FUNCTION START********************//
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
		$mail->AltBody = 'Agri CRM Adventz';
                //$mail->AddAttachment($attach);
		$mail->AddCC($cc);
		$mail->send();
			
            }
        //*****************************MAIL FUNCTION END**********************//
        //**********************************SEND SMS FUNCTION START*************************************//
        function sendadvsms($mob,$msg){
        $umsg=urlencode($msg);
        $log=new Log("ApiIvrSms".date('d_m_Y').".log");
        
        
        $surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&DR=Y&mobilenumber=".$mob."&message=".$umsg;
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

                   // print_r($buffer);
                    return true;
                }	
                curl_close($curl_handle);
        }
        //**********************************SEND SMS FUNCTION END*************************************// 
        //**********************************SEND SMS FUNCTION START*************************************//
        function sendsms($mob,$msg){
        //$msg=urlencode($msg);//"You are not  Registered with us!");
        $log=new Log("ApiIvrSms".date('d_m_Y').".log");
        $cr_date=date('Y-m-d');
        $umsg = str_replace('%u','',utf8_to_unicode($msg));
        //echo $umsg;
        $surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&DR=Y&Mtype=OL&mobilenumber=".$mob."&message=".$umsg;
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

                    //print_r($buffer);
                    return true;
                }	
                curl_close($curl_handle);
        }
        //**********************************SEND SMS FUNCTION END*************************************//  
        //********************************* UNICODE TO UTF8 START*************************************//
        function utf8_to_unicode($str) {
	$unicode = array();
        $values = array();
        $lookingFor = 1;
        for ($i = 0; $i < strlen($str); $i++) {
        	$thisValue = ord($str[$i]);
            	if($thisValue < 128){
	                $number = dechex($thisValue);
        	        $unicode[] = (strlen($number) == 1) ? '%u000' . $number : "%u00" . $number;
            	} else {
                	if (count($values) == 0)
                    	$lookingFor = ( $thisValue < 224 ) ? 2 : 3;
                	$values[] = $thisValue;
                	if (count($values) == $lookingFor) {
                    	$number = ( $lookingFor == 3 ) ?
                            ( ( $values[0] % 16 ) * 4096 ) + ( ( $values[1] % 64 ) * 64 ) + ( $values[2] % 64 ) :
                            ( ( $values[0] % 32 ) * 64 ) + ( $values[1] % 64
                            );
	                    $number = dechex($number);
        	            $unicode[] = (strlen($number) == 3) ? "%u0" . $number : "%u" . $number;
	                    $values = array();
        	            $lookingFor = 1;
        	        } // if
        	    } // else
        	}//for
        return implode("", $unicode);
        }//function
        //*********************************** UNICODE TO UTF8 END ***************************************//
        
        
        
        
        
        $this->load->model('api/ivrcall');
        
        if($type==2){// IVR KEY PRESS 1 & 2 CALL
        
            $MyCallData= $this->model_api_ivrcall->checkRec($mob,$code);
            if($MyCallData){
                $UpdateCcall= $this->model_api_ivrcall->updateRec($mob,$code);
                $stid = $UpdateCcall['stid'];
                $success= $UpdateCcall['msg'];
                $land_line= $UpdateCcall['land_line'];
                $pin=$UpdateCcall['pin'];
		$log->write("Adv.No:: ".$land_line." Pin::".$pin);
                if($success==1){
                    //echo 'MESSAGE SEND UPDATE';
                   // echo $land_line;
                    if(($stid==16) && $code==1){
                    $msg="हैलो जय किसान मध्ये कॅल केल्या बद्दल धन्यवाद ! आमचे कृषि तज्ञ लवकरच आपल्याशी संपर्क करतील";
                    }
                    if(($stid==16) && $code==2){
                    $msg="हैलो जय किसान मध्ये कॅल केल्या बद्दल धन्यवाद ! आमचे ग्राहक प्रतिनिधी लवकरच आपल्याशी संपर्क करतील";
                    }
                    if(($stid==13) && $code==1){
                        $msg="ಹಲೋ ಜಯಾ ಕಿಸಾನ್ಗೆ ಕರೆ ಮಾಡಿದ್ದಕ್ಕಾಗಿ ನಿಮಗೆ ಧನ್ಯವಾದಗಳು. ನಮ್ಮ ಕೃಷಿ ತಜ್ಞರು ನಿಮಗೆ ಕೂಡಲೇ ಕರೆಮಾಡುತ್ತರೆ";
                    }
                    if(($stid==13) && $code==2){
                        $msg="ಹಲೋಜಯಾಕಿಸಾನ್ಗೆ ಕರೆ ಮಾಡಿದ್ದಕ್ಕೆ ಧನ್ಯವಾದಗಳು, ನಮ್ಮ ಗ್ರಾಹಕ ಪ್ರತಿನಿಧಿಯೊಬ್ಬರು ಕೂಡಲೆ ನಿಮಗೆ ಕರೆಮಾಡುತ್ತರೆ";
                    }
                    if(($stid==652 || $stid==26 || $stid==1) && $code==1){
                        $msg="హలో హాలో జై కిషన్ మె కాల్ కర్నే కె లియే ధన్యవాద్ హమారే క్రిషి విశేషాగ్య జల్ద్ హి అప్కో కాల్ కరెంగే";
                    }
                    if(($stid==652 || $stid==26 || $stid==1) && $code==2){
                        $msg="హలో హాలో జై కిషన్ మె కాల్ కర్నే కె లియే ధన్యవాద్ హమారే గ్రహక్ ప్రతినిధి జల్ద్ హి ఆప్కో కాల్ కరెంగే";
                    }
                    if(($stid!=652 && $stid!=26 && $stid!=1 && $stid!=13 && $stid!=16) && $code==1){
                        $msg="हैलो जय किसान में कॉल करने के लिए धन्यवाद, हमारे कृषि विशेषज्ञ जल्द ही आपको कॉल करेंगे।";
                    }
                    if(($stid!=652 && $stid!=26 && $stid!=1 && $stid!=13 && $stid!=16) && $code==2){
                        $msg="हैलो जय किसान में कॉल करने के लिए धन्यवाद, हमारे ग्राहक प्रतनिधि जल्द ही आपको कॉल करेंगे।";
                    }
                    $InsertMsg= $this->model_api_ivrcall->IvrMsg($mob,$msg,$code);
                    if($InsertMsg==1){
                        sendsms($mob,$msg);//SMS for Farmer
                       /* if($code==1){
                            $InsertMsg= $this->model_api_ivrcall->AdvDtls($mob);
                            $log->write("Update: ".$InsertMsg);
                            if($InsertMsg){
                            $adv_id=$InsertMsg['ADV_ID'];
                            $adv_pin=$InsertMsg['ADV_PIN'];
                            $adv_mob=$InsertMsg['ADV_MOB'];
                            $msgadv="Advisory ".$adv_pin." has been logged in for you. Kindly contact the caller at 01204398901 and enter the advisory Id. You can view details through web and app.";
                            sendadvsms($adv_mob,$msgadv);//SMS for Advisory
                            MsgToMail($to,$cc,$sub,$msg);
                            }
                        }*/
                    }
                    $resp=$land_line."-".$pin;
                    $this->response->setOutput($resp);
                }
                else{
                    echo 'ERROR UPDATE';
                }
            } 
            else {//NEW RECORD INSERT
                $InsertCcall= $this->model_api_ivrcall->insertRec($mob,$code);
                $stid = $InsertCcall['stid'];
                $success= $InsertCcall['msg'];
                $land_line= $InsertCcall['land_line'];
                $pin=$InsertCcall['pin'];
				$log->write("Adv.No:: ".$land_line." Pin::".$pin);
                if($success==1){
                     if(($stid==13) && $code==1){
                        $msg="ಹಲೋ ಜಯಾ ಕಿಸಾನ್ಗೆ ಕರೆ ಮಾಡಿದ್ದಕ್ಕಾಗಿ ನಿಮಗೆ ಧನ್ಯವಾದಗಳು. ನಮ್ಮ ಕೃಷಿ ತಜ್ಞರು ನಿಮಗೆ ಕೂಡಲೇ ಕರೆಮಾಡುತ್ತರೆ";
                    }
                    if(($stid==13) && $code==2){
                        $msg="ಹಲೋಜಯಾಕಿಸಾನ್ಗೆ ಕರೆ ಮಾಡಿದ್ದಕ್ಕೆ ಧನ್ಯವಾದಗಳು, ನಮ್ಮ ಗ್ರಾಹಕ ಪ್ರತಿನಿಧಿಯೊಬ್ಬರು ಕೂಡಲೆ ನಿಮಗೆ ಕರೆಮಾಡುತ್ತರೆ";
                    }
                    if(($stid==652 || $stid==26 || $stid==1) && $code==1){
                        $msg="హలో హాలో జై కిషన్ మె కాల్ కర్నే కె లియే ధన్యవాద్ హమారే క్రిషి విశేషాగ్య జల్ద్ హి అప్కో కాల్ కరెంగే";
                    }
                    if(($stid==652 || $stid==26 || $stid==1) && $code==2){
                        $msg="హలో హాలో జై కిషన్ మె కాల్ కర్నే కె లియే ధన్యవాద్ హమారే గ్రహక్ ప్రతినిధి జల్ద్ హి ఆప్కో కాల్ కరెంగే";
                    }
                    if(($stid!=652 && $stid!=26 && $stid!=1 && $stid!=13) && $code==1){
                        $msg="हैलो जय किसान में कॉल करने के लिए धन्यवाद, हमारे कृषि विशेषज्ञ जल्द ही आपको कॉल करेंगे।";
                    }
                    if(($stid!=652 && $stid!=26 && $stid!=1 && $stid!=13) && $code==2){
                        $msg="हैलो जय किसान में कॉल करने के लिए धन्यवाद, हमारे ग्राहक प्रतनिधि जल्द ही आपको कॉल करेंगे।";
                    }
                    $InsertMsg= $this->model_api_ivrcall->IvrMsg($mob,$msg,$code);
                    if($InsertMsg==1){
                        sendsms($mob,$msg);//SMS for Farmer
                       /* if($code==1){
                            $InsertMsg= $this->model_api_ivrcall->AdvDtls($mob);
                            $log->write("Insert: ".$InsertMsg);
                            if($InsertMsg){
                            $adv_id=$InsertMsg['ADV_ID'];
                            $adv_pin=$InsertMsg['ADV_PIN'];
                            $adv_mob=$InsertMsg['ADV_MOB'];
                            $msgadv="Advisory ".$adv_pin." has been logged in for you. Kindly contact the caller at 01204398901 and enter the advisory Id. You can view details through web and app.";
                            sendadvsms($adv_mob,$msgadv);//SMS for Advisory
                            }
                        }*/
                    }
                    $resp=$land_line."-".$pin;
                    $this->response->setOutput($resp);
                }
                else{
                    echo 'ERROR INSERT';
                }
            }
        }//KEY PRESS 1 & 2 END
        if($type==3){//RETAILER CALL ADDED ON 24 AUG
            $MyCallData= $this->model_api_ivrcall->checkRtlrRec($mob,$type);
            if($MyCallData){
                $UpdateCcall= $this->model_api_ivrcall->updateRtlrRec($mob,$type);
                $stid = $UpdateCcall['stid'];
                $success= $UpdateCcall['msg'];
                $msg="Youhave already registered your interest in the scheme. Our customer executiveswill be getting in touch with you, if not already done.";
                sendadvsms($mob,$msg);
            }
            else {//NEW RECORD INSERT
                $InsertCcall= $this->model_api_ivrcall->insertRtlrRec($mob,$code);
                $stid = $InsertCcall['stid'];
                $success= $InsertCcall['msg'];
                $msg="Thankyou for showing interest in the Zuari Retailer Scheme 2017. Our customerexecutive will get back to u shortly.";
                
                sendadvsms($mob,$msg);
            }
        }
        
           
    }
	//******************************** DIRECT OR INDIRECT CALL ********************************//
    public function CallResponse(){//Call Picked Directly Or Indirectly
        $this->load->model('api/ivrcall');
        $log=new Log("CallResponse".date('d_m_Y').".log");
        $log->write($this->request->get);
        //$mcrypt = new MCrypt(); 
		//**********************************SEND SMS FUNCTION START*************************************//
        function MsgToAdv($mob,$msg){
        $umsg=urlencode($msg);
        $log=new Log("MsgToAdv".date('d_m_Y').".log");
        $cr_date=date('Y-m-d');
        
        $surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&DR=Y&mobilenumber=".$mob."&message=".$umsg;
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

                   // print_r($buffer);
                    return true;
                }	
                curl_close($curl_handle);
        }
        //**********************************SEND SMS FUNCTION END*************************************// 
        $fmob=$this->request->get['fmob'];
        $log->write('Farmer Mobile:'.$fmob);
        $tmob=$this->request->get['tmob'];
        $log->write('ADV Mobile:'.$tmob);
        $res=$this->request->get['res'];
        $log->write('ADV Picked Response:'.$res);
		
		//Send
		
        $UpdateAdvResponse= $this->model_api_ivrcall->UpdateAdvResponse($fmob,$tmob,$res);
		if($res=='ANSWER'){
			$log->write('Message To Adv: Not Sent');
		}
        else{
                    $InsertMsg= $this->model_api_ivrcall->AdvMsgDtls($fmob);
                    $log->write('Message To Adv: Sent');
                    $log->write("Insert: ".$InsertMsg);
                    if($InsertMsg){
                        $adv_id=$InsertMsg['ADV_ID'];
                        $adv_pin=$InsertMsg['ADV_PIN'];
                        $adv_mob=$InsertMsg['ADV_MOB'];
                        $msgadv="Advisory ".$adv_pin." has been logged in for you. Kindly contact the caller at 01204398901 and enter the advisory Id. You can view details through web and app.";
                        $log->write("Msg Sent: ".$msgadv);
                        MsgToAdv($adv_mob,$msgadv);//SMS for Advisory
                        }
		}
        $log->write('Database Update Status:'.$UpdateAdvResponse);
    }
  
}