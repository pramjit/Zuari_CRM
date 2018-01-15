<?php

class Modeladminreportfarmerdetailreport4 extends Model {
    
 
    public function AdvData($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
$sql="SELECT DATE(CR.CR_DATE)AS CR_DATE,CR.FAR_MOB,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATENAME',concat(akc.firstname,' ',akc.lastname) AS 'ADVNAME',
(CASE WHEN CR.CASE_STATUS = 99 THEN 'CLOSED' 
WHEN CR.CASE_STATUS = 0 THEN 'FARMER NOT RESPONDING'
WHEN CR.CASE_STATUS IN (4,6,7,11,22,23) THEN 'PENDING ADVISORY'
WHEN CR.CASE_STATUS = 27 AND CR.CC_ATTEND=0 THEN 'PENDING CC'
WHEN CR.CASE_STATUS = 27 AND CR.FILE_SYNC=1 AND CR.CC_ATTEND>0 THEN 'PENDING APPROVAL'
END ) AS 'STATUS'
FROM crm_adv CR
LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID)
LEFT JOIN ak_customer akc on(akc.customer_id=CR.ADV_ID)
WHERE DATE(CR.CR_DATE) BETWEEN '".$from_date."' and '".$to_date."'
ORDER BY SV.STATE";
$query = $this->db->query($sql);
return $query->rows;   
    }
       
    
  
}


