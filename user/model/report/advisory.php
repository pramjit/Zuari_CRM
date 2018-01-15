<?php

class Modelreportadvisory extends Model {
    
    public function getmissedcallData($data){
        
        $sql="select ccc.MOBILE as 'CC_FAR_MOB',cra.far_mob as 'FAR_MOB',
IFNULL(msm.state,'NA') AS STATE,
(CASE
		WHEN ccc.KEY_PRESS=1 THEN 'ADVISORY CALL' 
		WHEN ccc.KEY_PRESS=2 THEN 'COMPLAINTS CALL' 
ELSE 'NA'
END) AS 'CALL_TYPE',
(CASE 
		WHEN cra.CASE_STATUS =7 AND CALL_COUNT =0 THEN 'PENDING AT ADV'
		WHEN cra.CASE_STATUS =7 AND CALL_COUNT >0 THEN 'PENDING AT CC'
		WHEN cra.CASE_STATUS =27  AND CALL_COUNT >0 THEN 'PENDING APPROVAL'
		WHEN cra.CASE_STATUS =8 AND CALL_COUNT >0 THEN 'CLOSED'
		ELSE 'NA'
END) AS 'ADV_CASE_STATUS',
date(cra.CR_DATE) as 'CASE_CR_DATE',
CONCAT(TIMESTAMPDIFF(DAY, cra.CR_DATE, CURRENT_TIMESTAMP()),' DAY(S)-',(CASE 
WHEN TIMESTAMPDIFF(HOUR, cra.CR_DATE, CURRENT_TIMESTAMP()) > 24 THEN 'OUTSIDE CYCLE'
ELSE 'WITHIN CYCLE'
END)) AS 'CYCLE_DAYS'
from cc_incomingcall ccc
left join ms_mobilestate  msm on(ccc.STATE=msm.stateid)
left join crm_adv cra on(ccc.mobile=cra.far_mob)
where ccc.CALL_TYPE=2 and ccc.KEY_PRESS=1 AND date(CR_DATE) BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
GROUP BY cra.FAR_MOB";

         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
  public function getmissedcallDatacount($data){
       $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
  
}


