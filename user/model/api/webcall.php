<?php
class Modelapiwebcall extends Model {
    
    public function chkIfAdv($mob,$pin){
        $sql="SELECT * FROM ak_customer WHERE land_line='".$mob."'";  
        $query = $this->db->query($sql);
        return $query->row;
    }
    
    public function chkAdvMobPin($mob,$pin){
        $sql="SELECT * FROM `crm_adv` WHERE `CASE_PIN` = '".$pin."' AND CASE_STATUS=7";
        $query = $this->db->query($sql);
        return $query->row; 
    }

    
    public function checkUser($mob,$code){
        $sql="SELECT customer_id,customer_group_id,User_Id,telephone FROM ak_customer WHERE telephone='".$mob."'";
        $query = $this->db->query($sql);
        return $query->row;
    } 
    public function chkMobPin($mob,$pin){
        
        $sql="SELECT * FROM `ak_retailers_call` WHERE `RTLR_CODE` = '".$pin."' and CALL_STATUS=1";
        $query = $this->db->query($sql);
        return $query->row;   
        
    }
    public function updateRec($mob,$pin,$call_mob){
		$lastcalldate=date('Y-m-d H:i:s');
        $sql="update `ak_retailers_call` set `CALL_FROM`='".$mob."',CALL_COUNT=CALL_COUNT+1, CALL_DATE='".$lastcalldate."' where MOBILE_NO='".$call_mob."' and RTLR_CODE='".$pin."' and CALL_STATUS=1";
        $this->db->query($sql);
    }
    public function updateRecAdv($mob,$pin,$call_mob){
		$lastcalldate=date('Y-m-d H:i:s');
        $sql="update `crm_adv` set `CALL_FROM`='".$mob."', CALL_COUNT=CALL_COUNT+1 , CALL_DATE='".$lastcalldate."' where FAR_MOB='".$call_mob."' and CASE_PIN='".$pin."' and CASE_STATUS=7";
        $this->db->query($sql);
    }
}


