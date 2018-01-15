<?php

class Modeladminreportagroreportsummary extends Model {
    
 
    public function agroAdvisory($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
 $sql="SELECT cci.STATE,msb.NAME AS STATENAME ,
sum(case when cci.KEY_PRESS=1 and cci.CALL_TYPE=2 then 1 else 0 end)as AGRO,
sum(case when cci.STATUS=32 and cci.KEY_PRESS=2 and cci.CALL_TYPE=2 then 1 else 0 end)as No_of_agro_redirectd,
sum(case when cci.STATUS=29 and cci.KEY_PRESS=2 and cci.CALL_TYPE=2 then 1 else 0 end)as No_of_Non_technical,
sum(case when cci.STATUS=30 and cci.KEY_PRESS=2 and cci.CALL_TYPE=2 then 1 else 0 end)as No_of_network_Query,
sum(case when cci.STATUS=31 and cci.KEY_PRESS=2 and cci.CALL_TYPE=2 then 1 else 0 end)as No_of_services_query,
sum(case when cci.STATUS=2  and cci.KEY_PRESS=2 and cci.CALL_TYPE=2 then 1 else 0 end)as No_of_complain

FROM `cc_incomingcall` cci

left join mas_pol_geo msb on (msb.GEO_ID=cci.STATE)

WHERE cci.DATE_RECEIVED  BETWEEN '".$from_date."' and  '".$to_date."' GROUP BY cci.STATE ";
$query = $this->db->query($sql);
return $query->rows;   
    }
       
    
  
}


