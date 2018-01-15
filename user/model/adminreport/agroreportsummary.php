<?php

class Modeladminreportagroreportsummary extends Model {
    
 
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
LEFT JOIN (SELECT DATE_RECEIVED,MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2  GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID)
WHERE SV.DATE_RECEIVED BETWEEN '".$from_date."' and '".$to_date."'
GROUP BY SV.STATE ORDER BY MP.`NAME`";
    $query = $this->db->query($sql);
    return $query->rows;   
    }
    public function agroOtherTotal($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    $sql="SELECT cci.STATE,msb.`NAME` AS STATENAME ,
sum(CASE WHEN adv.CASE_TYPE=1 AND cci.CALL_TYPE=2 AND cci.KEY_PRESS=1 THEN 1 ELSE 0 END) AS 'AGRO',
sum(CASE WHEN adv.CASE_TYPE=2 AND cci.CALL_TYPE=2 AND cci.KEY_PRESS=2 THEN 1 ELSE 0 END) AS 'No_of_agro_redirectd',
sum(CASE WHEN cci.STATUS=29 AND cci.KEY_PRESS=2 AND cci.CALL_TYPE=2 THEN 1 ELSE 0 END)AS 'No_of_Non_technical', 
sum(CASE WHEN cci.STATUS=30 AND cci.KEY_PRESS=2 AND cci.CALL_TYPE=2 THEN 1 ELSE 0 END)AS 'No_of_network_Query', 
sum(CASE WHEN cci.STATUS=31 AND cci.KEY_PRESS=2 AND cci.CALL_TYPE=2 THEN 1 ELSE 0 END)AS 'No_of_services_query', 
sum(CASE WHEN cci.STATUS=2 AND cci.KEY_PRESS=2 AND cci.CALL_TYPE=2 THEN 1 ELSE 0 END)AS 'No_of_complain' 
FROM (SELECT * FROM cc_incomingcall WHERE CALL_TYPE=2 GROUP BY MOBILE,KEY_PRESS) AS cci 
LEFT JOIN mas_pol_geo msb ON (msb.GEO_ID=cci.STATE) 
LEFT JOIN (SELECT * FROM crm_adv GROUP BY CASE_ID) AS adv ON(cci.MOBILE=adv.FAR_MOB)
WHERE cci.DATE_RECEIVED BETWEEN '".$from_date."' and  '".$to_date."' GROUP BY cci.STATE ORDER BY msb.`NAME`";
     
$query = $this->db->query($sql);
return $query->rows;   
    }
       
    
  
}


