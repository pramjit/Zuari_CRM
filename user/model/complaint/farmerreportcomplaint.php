<?php

class Modelcomplaintfarmerreportcomplaint extends Model 
{
   
     public function getfarmerdata(){
        $sql="SELECT cc.MOBILE as MOBILE,count(*) as Totalcalls ,
count(crm.COMP_MOBILE) as totalcomplaint,
sum(case when crm.CASE_STATUS = 7 then 1 else 0 end )as 'totalcompending',
sum(case when crm.CASE_STATUS = 8 then 1 else 0 end)as 'totalcomplaintclose',
sum(case when cc.STATUS IN(18,4,5,6,11,12,13,14,17,23,23,27)then 1 else 0 end) as 'totalothercall',
sum(case when cc.STATUS IN(18,4,5,6,11,12,13,14,17,23,23,27) and cc.CASE_STATUS <>2 then 1 else 0 end) as 'totalotherpending',
sum(case when cc.STATUS IN(18,4,5,6,11,12,13,14,17,23,23,27) and cc.CASE_STATUS=2 then 1 else 0 end) as 'totalothercallclose'
FROM cc_incomingcall cc
left join crm_case crm on crm.COMP_MOBILE=cc.MOBILE
WHERE cc.CALL_TYPE=2 and cc.KEY_PRESS=2 GROUP BY cc.MOBILE ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    
  
}


