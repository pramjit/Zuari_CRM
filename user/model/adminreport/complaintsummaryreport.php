<?php

class Modeladminreportcomplaintsummaryreport extends Model {
    
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
        echo $sql="SELECT A.CASE_ID,A.COMP_MOBILE,
        SUM(CASE WHEN A.CASE_STATUS NOT IN(99,0,5)THEN 1 ELSE 0 END) AS 'OPEN', 
        SUM(CASE WHEN A.CASE_STATUS IN(99,0,5) THEN 1 ELSE 0 END) AS 'CLOSE',
        A.COMP_STATUS,A.STATE,A.STATE_NAME,A.COMP_CATG,A.COMP_NAME
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
        GROUP BY CRC.CASE_ID) AS A GROUP BY A.STATE, A.COMP_CATG";   
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
}
