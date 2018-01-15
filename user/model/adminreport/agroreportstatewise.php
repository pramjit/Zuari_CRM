<?php

class Modeladminreportagroreportstatewise extends Model {
    
 
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
 $sql="SELECT DATE(CR.CR_DATE) AS DATE_RECEIVED,CR.FAR_MOB AS MOBILE,MP.`NAME` AS 'state_name',
(CASE WHEN CR.CASE_TYPE=1 THEN 'AGRO ADVISORY'
WHEN CR.CASE_TYPE=2 THEN 'REDIRECTED CALL' 
END) AS 'type'
FROM crm_adv CR
LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS SV ON(CR.FAR_MOB=SV.MOBILE)
LEFT JOIN mas_pol_geo MP ON(SV.STATE=MP.GEO_ID)
WHERE DATE(CR.CR_DATE) BETWEEN '".$from_date."' and '".$to_date."'
ORDER BY SV.STATE
";
$query = $this->db->query($sql);
return $query->rows;   
    }
       
    
  
}


