<?php

class Modeladminreportheadwisesummary extends Model {
    
  
    public function getAdvisoryhead($data){
          $from_date=$data["from_date"];
          $to_date=$data["to_date"];
      
echo $sql="SELECT RAW.STATE_NAME,RAW.ADL_NAME AS 'ADV_NAME',
SUM(CASE WHEN RAW.ADV_HEAD_ID=1 AND RAW.ADV_HEAD_DETAILS<>'NA' THEN 1 ELSE 0 END ) AS 'Crop Nutrition', 
SUM(CASE WHEN RAW.ADV_HEAD_ID=2 AND RAW.ADV_HEAD_DETAILS<>'NA'THEN 1 ELSE 0 END ) AS 'Crop Protection', 
SUM(CASE WHEN RAW.ADV_HEAD_ID=3 AND RAW.ADV_HEAD_DETAILS<>'NA'THEN 1 ELSE 0 END ) AS 'Seed', 
SUM(CASE WHEN RAW.ADV_HEAD_ID=4 AND RAW.ADV_HEAD_DETAILS<>'NA'THEN 1 ELSE 0 END ) AS 'Soil', 
SUM(CASE WHEN RAW.ADV_HEAD_ID=5 AND RAW.ADV_HEAD_DETAILS<>'NA'THEN 1 ELSE 0 END ) AS 'Irrigation', 
SUM(CASE WHEN RAW.ADV_HEAD_ID=0 AND RAW.ADV_HEAD_DETAILS<>'NA'THEN 1 ELSE 0 END ) AS 'Others'
FROM(SELECT 
(CASE 
WHEN CAD.ADV_HEAD_ID=1 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Crop Nutrition' 
WHEN CAD.ADV_HEAD_ID=2 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Crop Protection' 
WHEN CAD.ADV_HEAD_ID=3 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Seed' 
WHEN CAD.ADV_HEAD_ID=4 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Soil' 
WHEN CAD.ADV_HEAD_ID=5 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Irrigation' 
WHEN CAD.ADV_HEAD_ID=0 AND CAD.ADV_HEAD_DETAILS <> 'NA' then 'Others' 
END ) AS 'TYPE',CAD.ADV_HEAD_ID,CAD.ADV_HEAD_DETAILS,CAD.CASE_ID,CA.FAR_MOB,CCA.STATE,MPG.`NAME` AS 'STATE_NAME',GEO.CUST_ID,CUS.firstname AS 'ADL_NAME'

FROM crm_adv_detail CAD 
LEFT JOIN (SELECT CASE_ID, FAR_MOB FROM crm_adv GROUP BY CASE_ID)AS CA ON(CAD.CASE_ID=CA.CASE_ID)
LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 GROUP BY MOBILE) CCA ON(CA.FAR_MOB=CCA.MOBILE)
LEFT JOIN mas_pol_geo MPG ON(CCA.STATE=MPG.GEO_ID)
LEFT JOIN emp_geo_map GEO ON(CCA.STATE=GEO.GEO_ID) 
LEFT JOIN ak_customer CUS ON(GEO.CUST_ID=CUS.customer_id) 
WHERE CAD.CASE_ID IN(SELECT CR.CASE_ID FROM crm_adv CR 
LEFT JOIN (SELECT DATE_RECEIVED,MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 GROUP BY MOBILE) AS SV 
ON(CR.FAR_MOB=SV.MOBILE) 
WHERE CR.CASE_STATUS IN (99,27) 
AND CR.FILE_SYNC=1 
AND CR.CC_ATTEND>0 
AND SV.DATE_RECEIVED BETWEEN '".$from_date."' AND '".$to_date."')
GROUP BY CAD.CASE_ID, CAD.ADV_HEAD) AS RAW
GROUP BY RAW.STATE_NAME";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    

    
  
}

