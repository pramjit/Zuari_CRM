<?php

class Modeldashboardalldatadashboard extends Model {
    
    public function getMissedCall(){
    $sql="select count(MOBILE) from cc_incomingcall where CALL_TYPE=2 ";
    $query = $this->db->query($sql);
    return $query->row;   
        
    }public function getReceivedCall(){
    $sql="SELECT count(MOBILE) FROM `cc_incomingcall` where  STATUS IN (2,29,30,31,32,33,34) and CALL_TYPE=2 ";
    $query = $this->db->query($sql);
    return $query->row;   
        
    }
    public function getAdvisoryCall(){
    $sql="SELECT count(MOBILE) FROM `cc_incomingcall` where  STATUS IN (32) and CALL_TYPE=2 ";
    $query = $this->db->query($sql);
    return $query->row;   
        
    }
    public function getComplainCall(){
    $sql="SELECT count(MOBILE) FROM `cc_incomingcall` where  STATUS IN (2) and CALL_TYPE=2 ";
    $query = $this->db->query($sql);
    return $query->row;   
        
    }
     public function getMissedCallMonthWise(){
		 $log=new Log("Dashboard.log");
       $month= date('m');
       $year= date('Y');
       $dateto= $year ."-". $month."-"."01";
       $datefrom=$year ."-". $month."-"."31";
       $sql="SELECT count(TO_STATUS) FROM crm_status_trans WHERE TO_STATUS=2 and UPDATE_DATE BETWEEN '".$dateto."' and '".$datefrom."' and CALL_TYPE=2 GROUP BY TO_STATUS ";
       $log->write($sql);
	   $query = $this->db->query($sql);
      return $query->row;
    
        
    }
    public function getAnsweredCallMonthWise(){
       $month= date('m');
       $year= date('Y'); 
       $dateto= $year ."-". $month."-"."01";
       $datefrom=$year ."-". $month."-"."31";
       $sql="SELECT count(`TO_STATUS`) FROM `crm_status_trans` WHERE TO_STATUS IN (2,29,30,31,32,33,34) and UPDATE_DATE BETWEEN '".$dateto."' and '".$datefrom."' and CALL_TYPE=2 GROUP BY TO_STATUS  ";
       $query = $this->db->query($sql);
       return $query->row;   
    
   
  
}

}
