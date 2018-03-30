<?php
class ControllerApiappService extends Controller {
        public function index(){
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
        $log=new Log("AppService".DATE('d_m_Y').".log");
        $json=array();
        $log->write($this->request);
        $jsonStr = file_get_contents("php://input"); //read the HTTP body.
		$log->write($jsonStr);
        $AppData=json_decode($jsonStr, true);
        $log->write($AppData);
        if($AppData){
          if(empty($AppData['ServiceType'])||empty($AppData['StateId'])||empty($AppData['Mobile'])){
              $json['Res']=0;
              $json['Msg']='Missing mandatory pararmeters either ServiceType or StateId or Mobile';
          }
          else{
                //**************************** Data Inserttion Started *******************************//
                $this->load->model('api/appService');
		$InsertData= $this->model_api_appService->InsAppData($AppData);
                //**************************** Sen Response Back To Client **************************//
                if($InsertData==1){           
                    $json['Res']=1;
                    $json['Msg']="Data have been recived for mobile: ".$AppData['Mobile']." with State: ".$AppData['StateId']." and Service Type: ".$AppData['ServiceType'];
                }
                else if($InsertData==1){
                    $json['Res']=0;
                    $json['Msg']='Sorry Check your data and try again';
                }
                else{
                        $ADL= explode(",", $InsertData);
                        $ADL_CASE=$ADL[0];
                        $ADL_CASE_PIN=$ADL[1];
                        $ADL_ID=$ADL[2];
                        $ADL_NAME=$ADL[3];
                        $ADL_MOB=$ADL[4];
                        $ADL_EMAIL=$ADL[5];
                        $ADL_STATE=$ADL[6];
                        $msgadv="Advisory ".$ADL_CASE_PIN." has been logged in for you. Kindly contact the caller at 01204398901 and enter the advisory Id. You can view details through web and app.";
                        //$log->write("Msg Sent: ".$msgadv);
                        MsgToAdv($ADL_MOB,$msgadv);
                        $json['Res']=1;
                        $json['Msg']="Data have been recived for mobile: ".$AppData['Mobile']." with State: ".$AppData['StateId']." and Service Type: ".$AppData['ServiceType'];
                        
                }
            }
        }
        else{
            $json['Res']=0;
            $json['Msg']='No Data Received';
        }
    
        
        
        /*
		$RCV_JSON=$this->request->post['AppData'];
		//echo $RCV_JSON .'<br />';
		$RCV_JSON=stripcslashes(html_entity_decode($RCV_JSON));
		$RES=json_decode($RCV_JSON,TRUE);
		//print_r($RES);
		
		$postData=count($this->request->post);
		$this->load->model('api/appService');
		if($postData==0){
			$json['Error']='No data received';
		}else{
			$json['Success']='Data Received for Mobile Number: '.$RES['Mobile'];
		}
         * 
         */
		$log->write(json_encode($json));
		$this->response->addHeader('Content-Type: application/json');
		
		echo $this->response->setOutput(json_encode($json));
        
      }  
}