<?php

class Modeladminreportadvisorydetailopen extends Model {
    public function  farmerdetail($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT concat(akc.firstname,akc.lastname) AS ADVNAME,
        CR.CASE_ID,CR.FAR_MOB AS MOBILE,CR.CALL_STATUS,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATE_NAME', DATE(CR.CR_DATE) AS CR_DATE,
        (case when CR.CASE_STATUS in (4,6,7,11,22,23)then 'Open' when CR.CASE_STATUS in (99,27) or CR.CC_ATTEND=0  or CR.FILE_SYNC=1 or CR.CC_ATTEND>0  then 'Closed' end)as TYPE
        FROM crm_adv CR LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE) LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID) 
        LEFT JOIN emp_geo_map egm on(egm.GEO_ID=SV.STATE) 
        LEFT JOIN ak_customer akc on(akc.customer_id=egm.CUST_ID)
        WHERE DATE(CR.CR_DATE) BETWEEN '".$from_date."' and '".$to_date."' ORDER BY SV.STATE";    
        $query = $this->db->query($sql);
        return $query->rows;
    }
    
}


