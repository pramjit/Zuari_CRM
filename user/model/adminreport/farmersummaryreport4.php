<?php

class Modeladminreportfarmersummaryreport4 extends Model {
    
 
public function farmersummaryreport4($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    $sql="SELECT CR.CASE_ID,CR.FAR_MOB,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATENAME',concat(akc.firstname,' ',akc.lastname) AS 'ADVNAME',
    sum(CASE WHEN CR.CASE_STATUS = 99 THEN 1 else 0 END)'CLOSED',
    sum(CASE WHEN CR.CASE_STATUS = 0 THEN 1 else 0 END)'FARMER NOT RESPONDING',
    sum(CASE WHEN CR.CASE_STATUS IN (4,6,7,11,22,23) THEN 1 else 0 END)'PENDING ADVISORY',
    sum(CASE WHEN CR.CASE_STATUS = 27 AND CR.CC_ATTEND=0 THEN 1 else 0 END)'PENDING CC',
    sum(CASE WHEN CR.CASE_STATUS = 27 AND CR.FILE_SYNC=1 AND CR.CC_ATTEND>0 THEN 1 else 0 END)'PENDING APPROVAL'
    FROM crm_adv CR
    LEFT JOIN (SELECT DATE_RECEIVED,MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2  GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
    LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID)
    LEFT JOIN ak_customer akc on(akc.customer_id=CR.ADV_ID)
    WHERE SV.DATE_RECEIVED BETWEEN '".$from_date."' and '".$to_date."'
    GROUP BY SV.STATE";
    $query = $this->db->query($sql);
    return $query->rows;   
  }
}


