<?php

class ModeladminreportAdvisoryDailyReport extends Model {
    
    public function AdlList(){
        $sql="SELECT customer_id AS 'EX_ID', firstname AS 'EX_NAME', email AS 'EX_EMAIL'  
        FROM ak_customer 
        WHERE customer_group_id=6 AND customer_id NOT IN(32,77)";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function CallInDIR($AdlID){
        $sql="SELECT 
        CASE_PIN AS 'CASE_ID',
        FAR_MOB,
	(CASE WHEN CASE_STATUS=7 THEN 'PENDING' WHEN CASE_STATUS=27 THEN 'ANSWERED' WHEN CASE_STATUS=99 THEN 'CLOSED' ELSE 'CALL NOT CONNECTED' END) AS 'CASE_STATUS',
        MP.`NAME` AS 'STATE_NAME',
        ADV_ID,AK.firstname AS 'ADL_NAME',
        DATE(CR_DATE) AS 'IN_DATE',TIME(CR_DATE) AS 'IN_TIME',
        CS.STATUS_NAME AS 'CALL_STATUS',
        DATE(CALL_DATE) AS 'OUT_DATE',TIME(CALL_DATE) AS 'OUT_TIME',
        IFNULL(DATEDIFF(DATE(CALL_DATE),DATE(CR_DATE)),'NA') AS 'DIFF',
        'INCOMING' AS 'CALL_TYPE',(CASE WHEN CALL_RESPONSE=1 THEN 'DIRECT' WHEN CALL_RESPONSE=3 THEN 'DIRECT DELAYED' ELSE 'INDIRECT' END) AS 'CALL_RESP'
        FROM crm_adv 
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)) AS CM ON(FAR_MOB=CM.MOBILE)
        LEFT JOIN mas_pol_geo MP ON(CM.STATE=MP.GEO_ID)
        LEFT JOIN ak_customer AK ON(ADV_ID=AK.customer_id)
	LEFT JOIN mas_callstatus CS ON(crm_adv.CALL_STATUS=CS.STATUS_ID)
        WHERE ADV_ID='".$AdlID."' AND CALL_RESPONSE IN(1,3)
        AND DATE(CR_DATE)=(CURDATE() - INTERVAL 1 DAY)
        GROUP BY CASE_PIN
        ORDER BY AK.firstname";
        $query = $this->db->query($sql);
        return $query->rows;
    }
	public function CallInIN($AdlID){
        $sql="SELECT 
        CASE_PIN AS 'CASE_ID',
        FAR_MOB,
	(CASE WHEN CASE_STATUS=7 THEN 'PENDING' WHEN CASE_STATUS=27 THEN 'ANSWERED' WHEN CASE_STATUS=99 THEN 'CLOSED' ELSE 'CALL NOT CONNECTED' END) AS 'CASE_STATUS',
        MP.`NAME` AS 'STATE_NAME',
        ADV_ID,AK.firstname AS 'ADL_NAME',
        DATE(CR_DATE) AS 'IN_DATE',TIME(CR_DATE) AS 'IN_TIME',
	(CASE WHEN crm_adv.CALL_STATUS=0 AND CASE_STATUS<>0 THEN 'PENDING AT ADV' ELSE CS.STATUS_NAME END)AS 'CALL_STATUS',
        DATE(CALL_DATE) AS 'OUT_DATE',TIME(CALL_DATE) AS 'OUT_TIME',
        IFNULL(DATEDIFF(DATE(CALL_DATE),DATE(CR_DATE)),'NA') AS 'DIFF',
        'INCOMING' AS 'CALL_TYPE',(CASE WHEN CALL_RESPONSE=1 THEN 'DIRECT' WHEN CALL_RESPONSE=3 THEN 'DIRECT DELAYED' ELSE 'INDIRECT' END) AS 'CALL_RESP'
        FROM crm_adv 
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)) AS CM ON(FAR_MOB=CM.MOBILE)
        LEFT JOIN mas_pol_geo MP ON(CM.STATE=MP.GEO_ID)
        LEFT JOIN ak_customer AK ON(ADV_ID=AK.customer_id)
	LEFT JOIN mas_callstatus CS ON(crm_adv.CALL_STATUS=CS.STATUS_ID)
        WHERE ADV_ID='".$AdlID."' AND CALL_RESPONSE=2
        AND DATE(CR_DATE)=(CURDATE() - INTERVAL 1 DAY)
        GROUP BY CASE_PIN
        ORDER BY AK.firstname";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CallOut($AdlID){
        $sql="SELECT 
        CASE_PIN AS 'CASE_ID',
        FAR_MOB,
	(CASE WHEN CASE_STATUS=7 THEN 'PENDING' WHEN CASE_STATUS=27 THEN 'ANSWERED' WHEN CASE_STATUS=99 THEN 'CLOSED' ELSE 'CALL NOT CONNECTED' END) AS 'CASE_STATUS',
        MP.`NAME` AS 'STATE_NAME',
        ADV_ID,AK.firstname AS 'ADL_NAME',
        DATE(CR_DATE) AS 'IN_DATE',TIME(CR_DATE) AS 'IN_TIME',
	(CASE WHEN crm_adv.CALL_STATUS=0 AND CASE_STATUS<>0 THEN 'PENDING AT ADV' ELSE CS.STATUS_NAME END)AS 'CALL_STATUS',
        DATE(CALL_DATE) AS 'OUT_DATE',TIME(CALL_DATE) AS 'OUT_TIME',
        IFNULL(DATEDIFF(DATE(CALL_DATE),DATE(CR_DATE)),'NA') AS 'DIFF',
        'OUTGOING' AS 'CALL_TYPE',(CASE WHEN CALL_RESPONSE=1 THEN 'DIRECT' WHEN CALL_RESPONSE=3 THEN 'DIRECT DELAYED' ELSE 'INDIRECT' END) AS 'CALL_RESP'
        FROM crm_adv 
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall WHERE CALL_TYPE=2 AND KEY_PRESS IN(1,2)) AS CM ON(FAR_MOB=CM.MOBILE)
        LEFT JOIN mas_pol_geo MP ON(CM.STATE=MP.GEO_ID)
        LEFT JOIN ak_customer AK ON(ADV_ID=AK.customer_id)
	LEFT JOIN mas_callstatus CS ON(crm_adv.CALL_STATUS=CS.STATUS_ID)
        WHERE ADV_ID='".$AdlID."' AND CALL_RESPONSE<>1
        AND DATE(CALL_DATE)=(CURDATE() - INTERVAL 1 DAY)
        GROUP BY CASE_PIN
        ORDER BY AK.firstname";
        $query = $this->db->query($sql);
        return $query->rows;
    }
}


