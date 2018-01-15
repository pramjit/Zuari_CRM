<?php

class Modeladminreportadvisoryreportbusysummary extends Model {
    
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
        $sql="SELECT concat(akc.firstname,akc.lastname) AS ADVNAME,
        CR.CASE_ID,CR.FAR_MOB,CR.CALL_STATUS,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATE_NAME', 
        SUM(CASE WHEN CR.CASE_STATUS=4 THEN '1' ELSE '0' END) AS 'BUSY',
        SUM(CASE WHEN CR.CASE_STATUS=6 THEN '1' ELSE '0' END) AS 'NOT_RECHABLE', 
        SUM(CASE WHEN CR.CASE_STATUS=11 THEN '1' ELSE '0' END)AS 'ATTEMPT_LATER', 
        SUM(CASE WHEN CR.CASE_STATUS=22 THEN '1' ELSE '0' END)AS 'SWITCH_OFF', 
        SUM(CASE WHEN CR.CASE_STATUS=23 THEN '1' ELSE '0' END)AS 'NOT_PICKING',
        SUM(CASE WHEN CR.CASE_STATUS=7 THEN '1' ELSE '0' END) AS 'NOT_ATTEMPTED' 
        FROM crm_adv CR 
        LEFT JOIN (SELECT DATE_RECEIVED,MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE) 
        LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID) 
        LEFT JOIN emp_geo_map egm on(egm.GEO_ID=SV.STATE) 
        LEFT JOIN ak_customer akc on(akc.customer_id=egm.CUST_ID) 
        WHERE SV.DATE_RECEIVED BETWEEN '".$from_date."' and '".$to_date."' and CR.CASE_STATUS NOT IN(27,0,99) GROUP BY SV.STATE";    
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