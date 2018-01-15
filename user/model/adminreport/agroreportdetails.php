<?php

class Modeladminreportagroreportdetails extends Model {
    
 
    public function agroAdvisory($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    
    /*$sql="select 
    akf.STATE_ID,
    akf.CALL_STATUS AS 'TYPE',
    count(akf.STATE_ID) AS TOTALSTATE,
    mpg.`NAME` AS 
    STATENAME
    from ak_farmer akf
    LEFT JOIN mas_pol_geo mpg ON(akf.STATE_ID=mpg.GEO_ID)
    where 
    akf.CALL_STATUS=32 GROUP BY akf.STATE_ID
    UNION ALL
    SELECT

    cci.state AS STATE,
    cci.CALL_TYPE AS 'TYPE',
    count(cci.STATE) as TOTALSTATE,
    msb.NAME AS STATENAME
    FROM `cc_incomingcall` cci
    left join mas_pol_geo msb on (msb.GEO_ID=cci.STATE)
    WHERE CALL_TYPE=2 AND KEY_PRESS=1 GROUP BY STATE
    ORDER BY STATE_ID";*/
 $sql="select STATE,state_name,DATE_RECEIVED,MOBILE,type from (

SELECT cc.STATE,geo.name as state_name,cc.DATE_RECEIVED,cc.MOBILE,cc.status,
(case when cc.KEY_PRESS=1 and cc.CALL_TYPE=2 then 'AGRO_ADVISORY' when cc.KEY_PRESS=2 and cc.CALL_TYPE=2 and cc.STATUS=32 then 'REDIRECTED ADVISORY'
when cc.KEY_PRESS=2 and cc.CALL_TYPE=2 and cc.STATUS=30 then 'NETWORK QUERY'
 when cc.KEY_PRESS=2 and cc.CALL_TYPE=2 and cc.STATUS=2 then 'COMPLAINT'
 when cc.KEY_PRESS=2 and cc.CALL_TYPE=2 and cc.STATUS=31 then 'SERVICES QUERY'
 when cc.KEY_PRESS=2 and cc.CALL_TYPE=2 and cc.STATUS=29 then 'NON TECHNICAL PRODUCT' end)as type
FROM cc_incomingcall as cc
left join mas_pol_geo as geo on cc.STATE=geo.GEO_ID
    )as a where type is not null and DATE_RECEIVED BETWEEN '".$from_date."' and '".$to_date."' ";
$query = $this->db->query($sql);
return $query->rows;   
    }
       
    
  
}


