<?php

class Modeldashboardalldatadashboard extends Model {
    
    public function getMissedCall(){
    $sql="SELECT SUM(NOTIMESRECEIVED) AS 'TOT_MC' FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)";
    $query = $this->db->query($sql);
    return $query->row['TOT_MC'];   
    }
    public function getAdvisoryCall(){
    $sql="SELECT SUM(NOTIMESRECEIVED) AS 'MC_ADV' FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1) ";
    $query = $this->db->query($sql);
    return $query->row['MC_ADV'];   
    }
    
    public function getComplainCall(){
    $sql="SELECT SUM(NOTIMESRECEIVED) AS 'MC_COM' FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(2)";
    $query = $this->db->query($sql);
    return $query->row['MC_COM'];   
    }
    public function getReceivedCall(){
    $sql="SELECT SUM(NOTIMESRECEIVED) AS 'TOT_ANS' FROM `cc_incomingcall` where  STATUS NOT IN(18) and CALL_TYPE=2";
    $query = $this->db->query($sql);
    return $query->row['TOT_ANS'];   
        
    }
    //==============================================================================================================//
    public function AltAdvisoryCall(){
    $sql="SELECT COUNT(CASE_ID) AS 'ALT_ADV' FROM crm_adv WHERE CASE_TYPE=2";
    $query = $this->db->query($sql);
    return $query->row['ALT_ADV'];   
    }
    
    public function DunningCall(){
        $sql="SELECT COUNT(MOBILE_NO) AS 'TOT_DUN' FROM ak_retailers_call WHERE CALL_TYPE=4";
        $query = $this->db->query($sql);
        return $query->row['TOT_DUN'];
    }
    public function AppCall(){
        $sql="SELECT COUNT(MOBILE_NO) AS 'TOT_APP' FROM ak_retailers_call WHERE CALL_TYPE=3";
        $query = $this->db->query($sql);
        return $query->row['TOT_APP'];
    }
    public function RetCall(){
        $sql="SELECT COUNT(MOBILE_NO) AS 'TOT_RET' FROM ak_retailers_call WHERE CALL_TYPE=1";
        $query = $this->db->query($sql);
        return $query->row['TOT_RET'];
    }
     //==============================================================================================================//
    public function AltAdvisoryCallAns(){
    $sql="SELECT COUNT(CASE_ID) AS 'ADV_ANS' FROM crm_adv WHERE CASE_STATUS<>7";
    $query = $this->db->query($sql);
    return $query->row['ADV_ANS'];   
    }
    
    public function DunningCallAns(){
        $sql="SELECT COUNT(CALL_FROM) AS 'DUN_ANS' FROM ak_retailers_call WHERE CALL_TYPE=4";
        $query = $this->db->query($sql);
        return $query->row['DUN_ANS'];
    }
    public function AppCallAns(){
        $sql="SELECT COUNT(CALL_FROM) AS 'APP_ANS' FROM ak_retailers_call WHERE CALL_TYPE=3 ";
        $query = $this->db->query($sql);
        return $query->row['APP_ANS'];
    }
    public function RetCallAns(){
        $sql="SELECT COUNT(CALL_FROM) AS 'RET_ANS' FROM ak_retailers_call WHERE CALL_TYPE IN(1)";
        $query = $this->db->query($sql);
        return $query->row['RET_ANS'];
    }
    //===================== Current Month Missed Call & Answered Call =======================//
    
    public function CurMissed(){
        $sql="SELECT COUNT(MOBILE) AS 'CUR_MIS' FROM cc_incomingcall WHERE  (DATE_RECEIVED BETWEEN  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW())";
        $query = $this->db->query($sql);
        return $query->row['CUR_MIS'];
    }
     public function CurAnswered(){
        $sql="SELECT COUNT(MOBILE) AS 'CUR_ANS' FROM cc_incomingcall WHERE `STATUS`<>18 AND (DATE_RECEIVED BETWEEN  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW())";
        $query = $this->db->query($sql);
        return $query->row['CUR_ANS'];
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
