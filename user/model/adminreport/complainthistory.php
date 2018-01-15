<?php

class Modeladminreportcomplainthistory extends Model {
    
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
    
    public function  ComplaintList($data){
        $from_date=$data["from_date"];
        $to_date=$data["to_date"];
        $sql="SELECT 
        CS.CASE_ID,
        DATE_FORMAT(CS.CR_DATE,'%d %M, %Y') AS 'CR_DATE',
        CS.COMP_RA,CONCAT(AKRA.firstname,'  ',AKRA.lastname) AS 'RA_COMP',
        CS.COMP_AA ,CONCAT(AKAA.firstname,'  ',AKAA.lastname) AS 'AA_COMP',
        (CASE 
                WHEN CS.CASE_STATUS=7 THEN 'PENDING AT RA'
                WHEN CS.CASE_STATUS=2 THEN 'PENDING AT AA'
                WHEN CS.CASE_STATUS=3 THEN 'PENDING REVIEW AT CC'
                WHEN CS.CASE_STATUS=5 THEN 'APPROVED'
                WHEN CS.CASE_STATUS=6 THEN 'PENDING REVIEW AT RA'
                WHEN CS.CASE_STATUS IN(99,0) THEN 'CLOSED'
        END) AS 'CUR_STATUS', 
        CS.CASE_STATUS
        FROM crm_case CS
        LEFT JOIN ak_customer AKRA ON(CS.COMP_RA=AKRA.customer_id)
        LEFT JOIN ak_customer AKAA ON(CS.COMP_AA=AKAA.customer_id)
        WHERE DATE(CS.CR_DATE) BETWEEN '".$from_date."' AND '".$to_date."'
        ORDER BY DATE(CS.CR_DATE)";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function farmersummaryreport($data){
    $from_date=$data["from_date"];
    $to_date=$data["to_date"];
    $sql="";
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
