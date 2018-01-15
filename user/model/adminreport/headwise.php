<?php

class Modeladminreportheadwise extends Model {
    
  
    public function getAdvisoryhead($data){
            $from_date=$data["from_date"];
            $to_date=$data["to_date"];
            $sql="SELECT
            DATE(CA.CR_DATE) AS 'CR_DATE',
            cad.CASE_ID,
            CA.FAR_MOB AS MOBILE,
            CC.STATE,
            MPS.`NAME` AS 'STATE_NAME',
            MPZ.`NAME` AS 'ZONE_NAME',
            MPR.`NAME` AS 'REGION_NAME',
            GEO.CUST_ID,
            CUS.firstname AS 'ADV_NAME',
            cad.ADV_HEAD_ID,
            cad.ADV_HEAD,
            cad.ADV_HEAD_DETAILS,
            (CASE
            WHEN cad.ADV_HEAD_ID=1 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Crop Nutrition'
            WHEN cad.ADV_HEAD_ID=2 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Crop Protection'
            WHEN cad.ADV_HEAD_ID=3 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Seed'
            WHEN cad.ADV_HEAD_ID=4 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Soil'
            WHEN cad.ADV_HEAD_ID=5 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Irrigation'
            WHEN cad.ADV_HEAD_ID=0 AND cad.ADV_HEAD_DETAILS <> 'NA' then  'Others' END ) AS 'TYPE'
            FROM crm_adv_detail cad
            LEFT JOIN (SELECT CASE_ID,FAR_MOB,CR_DATE FROM crm_adv GROUP BY CASE_ID) AS CA ON(cad.CASE_ID = CA.CASE_ID)
            LEFT JOIN (SELECT MOBILE, STATE FROM cc_incomingcall GROUP BY MOBILE) AS CC ON(CA.FAR_MOB = CC.MOBILE)
            LEFT JOIN mas_pol_geo MPS ON(CC.STATE=MPS.GEO_ID)
            LEFT JOIN mas_pol_geo MPZ ON(MPS.ZO_ID=MPZ.GEO_ID)
            LEFT JOIN mas_pol_geo MPR ON(MPS.RO_ID=MPR.GEO_ID)
            LEFT JOIN emp_geo_map GEO ON(CC.STATE=GEO.GEO_ID)
            LEFT JOIN ak_customer CUS ON(GEO.CUST_ID=CUS.customer_id)
            WHERE cad.CASE_ID IN(SELECT case_id FROM crm_adv_detail WHERE CASE_ID IN(SELECT CASE_ID FROM crm_adv GROUP BY CASE_ID))
            AND cad.ADV_HEAD_DETAILS <> 'NA' AND DATE(CA.CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."' GROUP BY cad.CASE_ID,cad.ADV_HEAD_ID ORDER BY cad.CASE_ID";
            $query = $this->db->query($sql);
            return $query->rows;
    }
    

    
  
}


