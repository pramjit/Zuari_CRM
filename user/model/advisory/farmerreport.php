<?php

class Modeladvisoryfarmerreport extends Model {
    
  
    public function getfarmerdata(){
        $sql="SELECT cc.MOBILE ,count(*) as Totalcalls,
sum(case when crd.CASE_STATUS = 7 then 1 else 0 end )as 'Totalcallsadviory',
sum(case when crd.CASE_STATUS = 27 and crd.TOT_ATTEMPT=0 then 1 else 0 end )as 'AdvisoryPendingCC',
sum(case when crd.CASE_STATUS = 27 and crd.TOT_ATTEMPT < 0 then 1 else 0 end )as 'AprovalPendingCAlls',
sum(case when crd.CASE_STATUS IN(8,99) then 1 else 0 end )as 'close'
FROM `cc_incomingcall` cc
left join crm_adv crd on crd.FAR_MOB=cc.MOBILE

WHERE cc.CALL_TYPE=2 AND cc.KEY_PRESS=1 GROUP BY MOBILE";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    

    
  
}


