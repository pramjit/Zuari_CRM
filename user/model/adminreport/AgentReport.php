<?php

class ModeladminreportAgentReport extends Model {
    
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
        $log=new Log("Exe_Call_Detail.log");
	$log->write($data);
        $call_type=$data["call_type"];
        $ex_id=$data["ex_id"];
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        
        
        if($call_type==1){// Advisory Call
            $sql="SELECT crm_adv.CASE_ID AS 'CASE_ID', 
            'AGRO ADVISORY' AS 'CALL_TYPE', 
            FAR_MOB AS 'FAR_MOBILE', 
            'FARMER' AS 'FAR_FIR_NAME', 
            IFNULL(FAR_CODE,'NA') AS 'FAR_CODE',
            (CASE WHEN FAR_LIVE=1 THEN 'YES' WHEN FAR_LIVE=0 THEN 'NO' END) AS 'FAR_LIVE', 
            DATE(crm_adv.CR_DATE) AS 'CR_DATE',
            DATE(crm_adv.CALL_DATE) AS 'CALL_DATE',
            DATEDIFF(crm_adv.CALL_DATE,crm_adv.CR_DATE) AS 'DAYS'
            FROM crm_adv 
            WHERE crm_adv.CR_BY='".$ex_id."' ";
            if(!empty($from_date)&&!empty($to_date)){
                $sql.=" AND DATE(CR_DATE) BETWEEN '2017-08-01' AND '2017-12-31'"; 
            }
            $sql.=" ORDER BY DATE(CR_DATE)";
        }
        if($call_type==2){// Complaint Call
        /*$sql="SELECT FAR_ID AS 'CASE_ID', MCS.STATUS_NAME AS 'CALL_TYPE', FAR_MOBILE,FAR_FIR_NAME,IFNULL(FAR_CODE,'NA') AS 'FAR_CODE',(CASE WHEN FAR_LIVE=1 THEN 'YES' WHEN FAR_LIVE=0 THEN 'NO' END) AS 'FAR_LIVE', DATE(CR_DATE) AS 'CALL_DATE' FROM ak_farmer 
            LEFT JOIN mas_callstatus MCS ON (CALL_STATUS=MCS.STATUS_ID)
            WHERE CR_BY='".$ex_id."' ";
        */
            $sql="SELECT FAR_ID AS 'CASE_ID', 
            MCS.STATUS_NAME AS 'CALL_TYPE', 
            FAR_MOBILE,FAR_FIR_NAME,
            IFNULL(FAR_CODE,'NA') AS 'FAR_CODE',
            (CASE WHEN FAR_LIVE=1 THEN 'YES' WHEN FAR_LIVE=0 THEN 'NO' END) AS 'FAR_LIVE',
            DATE(AR.CR_DATE) AS 'CR_DATE', 
            DATE(ak_farmer.CR_DATE) AS 'CALL_DATE',
            DATEDIFF(ak_farmer.CR_DATE,AR.CR_DATE) AS 'DAYS'
            FROM ak_farmer 
            LEFT JOIN mas_callstatus MCS ON (CALL_STATUS=MCS.STATUS_ID)
            LEFT JOIN (SELECT MOBILE_NO, CALL_DATE, CR_DATE FROM ak_retailers_call WHERE CALL_TYPE IN(1,2)) AS AR ON(ak_farmer.FAR_MOBILE=AR.MOBILE_NO)
            WHERE ak_farmer.CR_BY='".$ex_id."' ";
            if(!empty($from_date)&&!empty($to_date)){
                $sql.=" AND DATE(ak_farmer.CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'";
            }
            $sql.=" ORDER BY DATE(ak_farmer.CR_DATE)";
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
