<?php
class ControllerApiccsync extends Controller {
public function  index(){
        $this->load->model('api/CcSync');
        $FarData= $this->model_api_CcSync->getFarData();
        $AdvData= $this->model_api_CcSync->getAdvData();
        $DelData= $this->model_api_CcSync->getDelData();
        
        $CcData=array_unique(array_merge($FarData,$AdvData,$DelData), SORT_REGULAR);
       
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
        
        foreach ($CcData as $adv){
        $fmob=$adv['FAR_MOB'];
        $data_string="{MobileNumber:".$fmob."}"; 
        $rawdata = getFarmerData($data_string); // CALLING FARMER API
            if($rawdata){//If Farmer Live
                $FarmerCode = $rawdata[0]->FarmerCode;
                $FarmerLive = 1;
                $FarmerType = $rawdata[0]->FarmerType;
            }
            else{
                $FarmerCode = 'NA';
                $FarmerLive = 0;
                $FarmerType = 'NA';   
            }
            $UpdCcData= $this->model_api_CcSync->UpdCcData($fmob,$FarmerCode,$FarmerLive,$FarmerType);
        }
    }
}
