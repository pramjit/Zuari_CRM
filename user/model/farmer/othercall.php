<?php

class Modelfarmerothercall extends Model {
    public function stateupdate($data)
    {
     
       $log=new Log("OtherStateID.log");
       $stateid=$data["stateid"];
       $mob=$data["mob"];
       $sql = "UPDATE cc_incomingcall SET STATE='".$stateid."' where  MOBILE='".$mob."' and STATE='728' ";
       $log->write($sql);
       $this->db->query($sql);
       $ret_id = $this->db->countAffected();
       $log->write($ret_id);
       return $ret_id;  
    }
    public function AdvDtls($data){
        $log=new Log("AdvDtlsOC.log");
        $mob=$data["mob"];
        $stid=$data["stateid"];
        //Find Advisory by state
                $advsql="SELECT CUST_ID FROM emp_geo_map WHERE GEO_TYPE_ID=2 AND GEO_ID='".$stid."'";
                $query=$this->db->query($advsql);
                $adv_id=$query->row['CUST_ID'];
                $upsql="update crm_adv set adv_id='".$adv_id."' where far_mob='".$mob."'";
                $query=$this->db->query($upsql);
                if($this->db->countAffected()==1){
                    $upadvsql="select email AS 'ADV_MAIL', telephone AS 'ADV_MOB',crm_adv.case_pin AS 'ADV_PIN'  
                            from ak_customer 
                            left join crm_adv on(ak_customer.customer_id=crm_adv.adv_id)
                            where customer_id='".$adv_id."'  and crm_adv.far_mob='".$mob."'";
                    $query=$this->db->query($upadvsql);
                    return $query->row;
                }
    }

        public function getothercallData($data){
    $log=new Log("CcotherCallData.log");
    $cr_by = $this->customer->getId(); // Get CC AGENT CUSTOMER_ID
    /*
     * 18-Missed Call
     * 4-busy
     * 6-not reachable
     * 11-attempt later
     * 12-not intersted
     * 13-dnd
     * 22-switch off
     * 23-not picking
     */
$sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE,
mas_callstatus.STATUS_NAME AS 'STATUS', arc.CASE_PIN AS 'PIN'
from cc_incomingcall 
LEFT JOIN ms_mobilestate 	ON (cc_incomingcall.STATE = ms_mobilestate.stateid)
LEFT JOIN mas_callstatus 	ON (cc_incomingcall.`STATUS` = mas_callstatus.STATUS_ID)
LEFT JOIN crm_adv arc 		ON( cc_incomingcall.MOBILE = arc.FAR_MOB)
where cc_incomingcall.CALL_TYPE=2 
and cc_incomingcall.KEY_PRESS=1
and cc_incomingcall.state =728 
GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state,mas_callstatus.STATUS_NAME ORDER BY DATE_RECEIVED";

 $log->write($sql);
            
            
            //echo $sql;die;
            $query = $this->db->query($sql);
            return $query->rows;   
    }
  
    public function StateData(){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=2 ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->rows;  
    }
   
  
}


