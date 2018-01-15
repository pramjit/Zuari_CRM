<?php
class Modelapiadvsync extends Model {          
    public function getAdvData(){
        $log= new Log("Farmer_Adv_Data.log");
        $sql="SELECT FAR_MOB FROM crm_adv WHERE FAR_LIVE=0";
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function updAdvData($fmob,$FarmerCode,$FarmerLive,$FarmerType){
        $sql="update crm_adv set FAR_CODE='".$FarmerCode."',FAR_LIVE='".$FarmerLive."',FAR_TYPE='".$FarmerType."' where FAR_MOB='".$fmob."'";
        $this->db->query($sql);
    }
}

