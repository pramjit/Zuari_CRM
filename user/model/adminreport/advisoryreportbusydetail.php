<?php

class Modeladminreportadvisoryreportbusydetail extends Model {
    
 
    public function farmerdetail($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    $sql="SELECT concat(akc.firstname,' ',akc.lastname) AS ADVNAME,date(CR.CR_DATE) AS CR_DATE,CR.CASE_ID,CR.FAR_MOB AS MOBILE,CR.CALL_STATUS,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATENAME',
        (CASE WHEN CR.CASE_STATUS=4 THEN  'BUSY'
         WHEN CR.CASE_STATUS=6 THEN 'NOT RECHABLE'
         WHEN CR.CASE_STATUS=11 THEN 'ATTEMPT LATER'
         WHEN CR.CASE_STATUS=22 THEN  'SWITCH OFF'
         WHEN CR.CASE_STATUS=23 THEN  'NOT PICKING'
         WHEN CR.CASE_STATUS=7 THEN  'NOT ATTEMPTED'
         END) AS 'TYPE'

        FROM crm_adv CR
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
        LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID) 
        LEFT JOIN emp_geo_map egm on(egm.GEO_ID=SV.STATE) 
        LEFT JOIN ak_customer akc on(akc.customer_id=egm.CUST_ID)
        WHERE DATE(CR.CR_DATE) BETWEEN '".$from_date."' and '".$to_date."' and CR.CASE_STATUS NOT IN(27,0,99)";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
       
    
  
}


