<?php
class Modelapiccsync extends Model {          
    public function getFarData(){
        $log= new Log("Farmer_Mob_Data.log");
        $sql="SELECT ak_farmer.FAR_MOBILE AS 'FAR_MOB' FROM ak_farmer 
        LEFT JOIN cc_incomingcall ON(ak_farmer.FAR_MOBILE=cc_incomingcall.MOBILE)
        WHERE cc_incomingcall.CC_LIVE=2";
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function getAdvData(){
        $log= new Log("Advisor_Mob_Data.log");
        $sql="SELECT crm_adv.FAR_MOB AS 'FAR_MOB' FROM crm_adv
        LEFT JOIN cc_incomingcall ON(crm_adv.FAR_MOB=cc_incomingcall.MOBILE)
        WHERE cc_incomingcall.CC_LIVE=2";
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function getDelData(){
        $log= new Log("Dealer_Adv_Data.log");
        $sql="SELECT ak_dealer.DEL_MOB AS 'FAR_MOB' FROM ak_dealer
        LEFT JOIN cc_incomingcall ON(ak_dealer.DEL_MOB=cc_incomingcall.MOBILE)
        WHERE cc_incomingcall.CC_LIVE=2";
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function UpdCcData($fmob,$FarmerCode,$FarmerLive,$FarmerType){
        $log= new Log("CcSync".date('YM_d').".log");
        $sql="update cc_incomingcall set CC_CODE='".$FarmerCode."',CC_LIVE='".$FarmerLive."',CC_TYPE='".$FarmerType."' where MOBILE='".$fmob."'";
        $log->write($sql);
        $this->db->query($sql);
    }
}

