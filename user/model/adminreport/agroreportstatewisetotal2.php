<?php

class Modeladminreportagroreportstatewisetotal extends Model {
    
 
    public function agroAdvisoryTotal($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    /*$sql="select state,State_name,Total_call,Total_far,(Total_call-Total_far)as Agro from (
    select cc.state,msb.NAME as State_name,sum(case when cc.KEY_PRESS=1 and cc.CALL_TYPE=2 then 1 else 0 end)as Total_call,
    sum(case when  f.call_status=32 then 1 else 0 end)as Total_far from cc_incomingcall as cc 
    left  join ak_farmer as f on cc.MOBILE  = f.FAR_MOBILE
    left join mas_pol_geo msb on (msb.GEO_ID=cc.STATE)
    where cc.DATE_RECEIVED between '".$from_date."' and '".$to_date."'
    group by cc.STATE
    )as b";*/
$sql="SELECT CR.CASE_ID,CR.FAR_MOB,CR.CASE_STATUS,SV.STATE,MP.`NAME` AS 'STATENAME',
SUM(CASE WHEN CR.CASE_TYPE=1 THEN '1' ELSE '0' END) AS 'AgroAdvisory',
SUM(CASE WHEN CR.CASE_TYPE=2 THEN '1' ELSE '0' END) AS 'RediCall'
FROM crm_adv CR
LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID)
WHERE DATE(CR.CR_DATE) BETWEEN '".$from_date."' and '".$to_date."'
GROUP BY SV.STATE
";
    $query = $this->db->query($sql);
    return $query->rows;   
    }
       
    
  
}


