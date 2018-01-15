<?php
class ControllerApiadvsync extends Controller {
public function  index(){
        $this->load->model('api/advSync');
        $AdvData= $this->model_api_advSync->getAdvData();
       
        //Function Get Farmer Data
        function getFarmerData($data_string){
        $url="http://staging.jksangam.com/API/WebService/FarmerService.asmx/GetCustomerDetails";
        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json',
        'Authorization: 26be082e3d034ef098fff491c9151e739b645c97316df08f2b071b221032766e'));
        $result = curl_exec($ch);
        $out=  json_decode($result);
        return $getdata=$out->d->DataObject;
        }
        
        //$fmob=8275257764;
        
        foreach ($AdvData as $adv){
        $fmob=$adv['FAR_MOB'];
        $data_string="{MobileNumber:".$fmob."}"; 
        $rawdata = getFarmerData($data_string); // CALLING FARMER API
            if($rawdata){//If Farmer Live
            //$log->write('Farmer details for '.$fmob.'Are:'.$rawdata);
            $FarmerCode = $rawdata->FarmerCode;
            $FarmerLive = 1;
            $FarmerType = $rawdata->FarmerType;
            $AdvData= $this->model_api_advSync->updAdvData($fmob,$FarmerCode,$FarmerLive,$FarmerType);
            }
        
        }
        
        
    }
    
    
    


}
