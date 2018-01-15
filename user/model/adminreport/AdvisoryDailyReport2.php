<?php

class ModeladminreportAdvisoryDailyReport extends Model {
    
    public function AdlList(){
        $sql="SELECT customer_id AS 'EX_ID', firstname AS 'EX_NAME', email AS 'EX_EMAIL'  
        FROM ak_customer 
        WHERE customer_group_id=6 AND customer_id NOT IN(32,77)";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function CallIn($AdlID){
        $sql="SELECT 
            CASE_PIN AS 'CASE_ID',
            FAR_MOB,
            MP.`NAME` AS 'STATE_NAME',
            ADV_ID,
            AK.firstname AS 'ADL_NAME',
            DATE(CR_DATE) AS 'IN_DATE',
            DATE(CALL_DATE) AS 'OUT_DATE',
            DATEDIFF(CALL_DATE,CR_DATE) AS 'DIFF',
            'INCOMING' AS 'CALL_TYPE',
			(CASE WHEN CALL_RESPONSE=1 THEN 'DIRECT' ELSE 'INDIRECT' END) AS 'CALL_RESP'
            FROM crm_adv 
            LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)) AS CM ON(FAR_MOB=CM.MOBILE)
            LEFT JOIN mas_pol_geo MP ON(CM.STATE=MP.GEO_ID)
            LEFT JOIN ak_customer AK ON(ADV_ID=AK.customer_id)
            WHERE ADV_ID='".$AdlID."'
            AND DATE(CR_DATE)=(CURDATE() - INTERVAL 5 DAY)
			GROUP BY FAR_MOB
            ORDER BY AK.firstname";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CallOut($AdlID){
        $sql="SELECT 
             CASE_PIN AS 'CASE_ID',
            FAR_MOB,
            MP.`NAME` AS 'STATE_NAME',
            ADV_ID,
            AK.firstname AS 'ADL_NAME',
            DATE(CR_DATE) AS 'IN_DATE',
            DATE(CALL_DATE) AS 'OUT_DATE',
            DATEDIFF(CALL_DATE,CR_DATE) AS 'DIFF',
            'OUTGOING' AS 'CALL_TYPE',
			(CASE WHEN CALL_RESPONSE=1 THEN 'DIRECT' ELSE 'INDIRECT' END) AS 'CALL_RESP'
            FROM crm_adv 
            LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)) AS CM ON(FAR_MOB=CM.MOBILE)
            LEFT JOIN mas_pol_geo MP ON(CM.STATE=MP.GEO_ID)
            LEFT JOIN ak_customer AK ON(ADV_ID=AK.customer_id)
            WHERE ADV_ID='".$AdlID."'
            AND DATE(CALL_DATE)=(CURDATE() - INTERVAL 5 DAY)
			GROUP BY FAR_MOB
            ORDER BY AK.firstname";
        $query = $this->db->query($sql);
        return $query->rows;
    }
}


