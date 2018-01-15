<?php
class ControllerApiwebcall extends Controller {
        public function index(){
        $log=new Log("ApiWebCall".date('d_m_Y').".log");
        $log->write($this->request->get);
        //$mcrypt = new MCrypt(); 
        $mob=$this->request->get['mob'];
        $pin=$this->request->get['pin'];
        $this->load->model('api/webcall');
        $log->write("Call From: ".$mob);
        
        $chkAdv=$this->model_api_webcall->chkIfAdv($mob,$pin);//Check Incoming Advisory Call Or Not
        
        if($chkAdv)// Yes Advisory
        {
            $log->write("ADVISORY");
            $MyCallData= $this->model_api_webcall->chkAdvMobPin($mob,$pin);
            //$log->write($MyCallData);
            if($MyCallData){
                      
            $call_mob=$MyCallData['FAR_MOB'];
            $log->write("Call To : ".$call_mob);
            $UpdateCallData= $this->model_api_webcall->updateRecAdv($mob,$pin,$call_mob);
            echo $call_mob;
            } else {
                $log->write("Return : 0");
                    echo 0;
            }
        }
        else{
            $log->write("CALL CENTER");
            //NO Call Center Executive
            $UserType= $this->model_api_webcall->checkUser($mob,$pin);// Check Call Center Executive
            if($UserType){
                $MyCallData= $this->model_api_webcall->chkMobPin($mob,$pin);
                //$log->write($MyCallData);
                if($MyCallData){
                    
                    $call_mob=$MyCallData['MOBILE_NO'];
                    $log->write("Call To : ".$call_mob);
                    $UpdateCallData= $this->model_api_webcall->updateRec($mob,$pin,$call_mob);
                    echo $call_mob;
                } else {
                    $log->write("Return : 0");
                    echo 0;
                }
            }
            else{
                $log->write("No User Exist Return : 0");
                echo 0;
            }
           
        }
    }  
}