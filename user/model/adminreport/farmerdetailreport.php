<?php

class Modeladminreportfarmerdetailreport extends Model {
    
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
        $sql="SELECT CC.MOBILE,CC.STATE,MP.`NAME` AS 'STATE_NAME', CC.DATE_RECEIVED,CC.`STATUS`,CC.CALL_TYPE,
        (CASE 
            WHEN CC.CC_LIVE=0 THEN 'NEW' 
            WHEN CC.CC_LIVE=1 THEN 'EXISTING' 
            WHEN CC.CC_LIVE=2 THEN 'PENDING' END) AS 'FAR_STATUS' 
        FROM (
        SELECT * FROM cc_incomingcall 
            WHERE CALL_TYPE=2 AND DATE_RECEIVED BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY MOBILE
        ) AS CC
        LEFT JOIN mas_pol_geo MP ON(CC.STATE=MP.GEO_ID)";    
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
