<?php
class ControllerApiappService extends Controller {
        public function index(){
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
              //**************************** Sen Response Back To Client **************************//
              $json['Res']=1;
              $json['Msg']="Data have been recived for mobile: ".$AppData['Mobile']." with State Id: ".$AppData['StateId']." and Service Type: ".$AppData['ServiceType'];
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
		$this->response->addHeader('Content-Type: application/json');
		echo $this->response->setOutput(json_encode($json));
        
      }  
}