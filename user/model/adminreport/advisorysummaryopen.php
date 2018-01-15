<?php

class Modeladminreportadvisorysummaryopen extends Model {
    
  public function  ChannelList($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT CC.MOBILE,CC.STATE,MP.`NAME` AS 'STATE_NAME', CC.DATE_RECEIVED,CC.`STATUS`,CC.CALL_TYPE,
        COUNT(CC.MOBILE) AS 'CP' 
        FROM (
        SELECT * FROM cc_incomingcall WHERE CALL_TYPE=2 AND DATE_RECEIVED BETWEEN '".$from_date."' AND '".$to_date."'
        AND MOBILE IN(SELECT DEL_MOB FROM ak_dealer GROUP BY DEL_MOB)
        GROUP BY MOBILE
        ) AS CC
        LEFT JOIN mas_pol_geo MP ON(CC.STATE=MP.GEO_ID)
        GROUP BY CC.STATE";    
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function  MobileList($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT CR.CASE_ID,CR.FAR_MOB,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATE_NAME',
            AC.firstname AS 'ADL_NAME',
            sum(CASE WHEN CR.CASE_STATUS IN (27,99,0) THEN 1 else 0 END)'CLOSED', 
            sum(CASE WHEN CR.CASE_STATUS IN (4,6,7,11,22,23) THEN 1 else 0 END)'OPEN' 
            FROM crm_adv CR 
            LEFT JOIN (SELECT DATE_RECEIVED,MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2  GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
            LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID) 
            LEFT JOIN emp_geo_map GP ON(SV.STATE=GP.GEO_ID)
            LEFT JOIN ak_customer AC ON(GP.CUST_ID=AC.customer_id)
            WHERE SV.DATE_RECEIVED BETWEEN '".$from_date."' and '".$to_date."' GROUP BY SV.STATE";
        $query = $this->db->query($sql);
        return $query->rows; 
    }
    public function farmersummaryreport($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    $sql="";
    $query = $this->db->query($sql);
    return $query->rows;   
  }
}


