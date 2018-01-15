<?php

class Modelreportcomplain extends Model {
    
    public function getmissedcallData($data){
    
        $sql="select cra.COMP_MOBILE as 'FAR_MOB',
IFNULL(msm.state,'NA') AS STATE,
(CASE
		WHEN ccc.KEY_PRESS=1 THEN 'ADVISORY CALL' 
		WHEN ccc.KEY_PRESS=2 THEN 'COMPLAINTS CALL' 
ELSE 'NA'
END) AS 'CALL_TYPE',
(CASE 
		WHEN cra.CASE_STATUS =7 THEN 'PENDING AT RA'
		WHEN cra.CASE_STATUS =3 THEN 'PENDING REVIEW AT CC'
		WHEN cra.CASE_STATUS =2 THEN 'PENDING AT RA'
		WHEN cra.CASE_STATUS =8 THEN 'CLOSED'
		ELSE 'NA'
END) AS 'COM_CASE_STATUS',
DATE(cra.CR_DATE) as 'CASE_CR_DATE',
CONCAT(DATEDIFF(CURDATE(), DATE(cra.DUE_DATE)),' DAY(S)-',
(CASE 
		WHEN DATEDIFF(CURDATE(), DATE(cra.DUE_DATE)) > 0 THEN 'OUTSIDE CYCLE'
		WHEN DATEDIFF(CURDATE(), DATE(cra.DUE_DATE)) <=0 THEN 'WITHIN CYCLE'
		ELSE 'NA'
END) )AS 'CYCLE_DAYS'
from cc_incomingcall ccc
left join ms_mobilestate  msm on(ccc.STATE=msm.stateid)
left join crm_case cra on(ccc.mobile=cra.COMP_MOBILE)
where CALL_TYPE=2 and KEY_PRESS=2 and DATE(cra.CR_DATE) BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
GROUP BY cra.COMP_MOBILE";
         
       
        //echo $sql;die;
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


