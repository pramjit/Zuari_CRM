<?php

class ModeladminreportAgentReportCount extends Model {
    
    public function  StateList($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT A.STATE,A.STATE_NAME
        FROM
        (SELECT CRC.CASE_ID,CRC.COMP_MOBILE,
        CRC.CASE_STATUS,CCS.case_status AS 'COMP_STATUS',
        CCC.STATE,MPG.`NAME` AS 'STATE_NAME',
        CRC.COMP_CATG,CCM.COMP_CATG AS 'COMP_NAME' 
        FROM crm_case CRC 
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS CCC ON(CRC.COMP_MOBILE=CCC.MOBILE)
        LEFT JOIN mas_pol_geo MPG ON(CCC.STATE=MPG.GEO_ID)
        LEFT JOIN crm_comp_catg_mst CCM ON(CRC.COMP_CATG=CCM.SID)
        LEFT JOIN crm_case_status CCS ON(CRC.CASE_STATUS=CCS.sid)
        WHERE DATE(CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'
        GROUP BY CRC.CASE_ID) AS A GROUP BY A.STATE";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function  CategoryList($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT A.COMP_CATG,A.COMP_NAME
        FROM
        (SELECT CRC.CASE_ID,CRC.COMP_MOBILE,
        CRC.CASE_STATUS,CCS.case_status AS 'COMP_STATUS',
        CCC.STATE,MPG.`NAME` AS 'STATE_NAME',
        CRC.COMP_CATG,CCM.COMP_CATG AS 'COMP_NAME' 
        FROM crm_case CRC 
        LEFT JOIN (SELECT MOBILE,STATE FROM cc_incomingcall GROUP BY MOBILE) AS CCC ON(CRC.COMP_MOBILE=CCC.MOBILE)
        LEFT JOIN mas_pol_geo MPG ON(CCC.STATE=MPG.GEO_ID)
        LEFT JOIN crm_comp_catg_mst CCM ON(CRC.COMP_CATG=CCM.SID)
        LEFT JOIN crm_case_status CCS ON(CRC.CASE_STATUS=CCS.sid)
        WHERE DATE(CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'
        GROUP BY CRC.CASE_ID) AS A GROUP BY A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    
    public function  CallingList($data){
        $log=new Log("Exe_Call_Count.log");
	$log->write($data);
        $call_type=$data["call_type"];
        $ex_id=$data["ex_id"];
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        
        
        if($call_type==1){// Advisory Call
        $sql="SELECT 'AGRO ADVISORY' AS 'CALL_TYPE',COUNT(crm_adv.CASE_ID) AS 'TOTAL_CALL',MPG.`NAME` AS 'STATE_NAME',
        DATE(crm_adv.CR_DATE) AS 'CALL_DATE' 
        FROM crm_adv
        LEFT JOIN (SELECT DISTINCT(MOBILE),STATE FROM cc_incomingcall WHERE CALL_TYPE=2) MCD ON(crm_adv.FAR_MOB=MCD.MOBILE)
        LEFT JOIN mas_pol_geo MPG ON(MCD.STATE=MPG.GEO_ID)
        WHERE CR_BY='".$ex_id."'";
        
        
        if(!empty($from_date)&&!empty($to_date)){
        $sql.= " AND DATE(CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'";
        }
        $sql.=" GROUP BY DATE(CR_DATE), MCD.STATE";
        $sql.=" ORDER BY DATE(CR_DATE)";
        }
        if($call_type==2){// Complaint Call
        $sql="SELECT MCS.STATUS_NAME AS 'CALL_TYPE',COUNT(ak_farmer.FAR_ID) AS 'TOTAL_CALL',MPG.`NAME` AS 'STATE_NAME', DATE(CR_DATE) AS 'CALL_DATE' 
        FROM ak_farmer 
        LEFT JOIN mas_pol_geo MPG ON(ak_farmer.STATE_ID=MPG.GEO_ID)
        LEFT JOIN mas_callstatus MCS ON (CALL_STATUS=MCS.STATUS_ID)
        WHERE CR_BY='".$ex_id."'";
        if(!empty($from_date)&&!empty($to_date)){
        $sql.= " AND DATE(CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'";
        }
        $sql.=" GROUP BY DATE(CR_DATE), ak_farmer.STATE_ID, ak_farmer.CALL_STATUS";
        $sql.=" ORDER BY DATE(CR_DATE)";
        }
        
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function AgentList(){
    $sql="SELECT customer_id AS 'EX_ID', firstname AS 'EX_NAME' FROM ak_customer WHERE customer_group_id=5 AND customer_id NOT IN(9,10)";
    $query = $this->db->query($sql);
    return $query->rows;   
  }
    public function History($caseid){
        $sql="SELECT ccd.CASE_ID, ccc.case_status AS 'CASE_PRE_STATUS', 
            ccp.case_status AS 'CASE_CUR_STATUS', SOLUTION, 
            DATE_FORMAT(CR_DATE,'%d-%M %Y') AS 'CASE_UP_DATE',
            akc.firstname AS 'UP_USR_NAME' ,
            ccd.UP_FILE_PATH AS 'UP_FILE_NAME'
            FROM crm_case_detail ccd
            LEFT JOIN crm_case_status ccc ON(ccd.CASE_PRE_STATUS = ccc.sid)
            LEFT JOIN crm_case_status ccp ON(ccd.CASE_CUR_STATUS = ccp.sid)
            LEFT JOIN ak_customer akc ON (ccd.UP_USER_ID = akc.customer_id)
            WHERE ccd.CASE_ID='".$caseid."'";
            $query = $this->db->query($sql);
            return $query->rows;
    }
}
