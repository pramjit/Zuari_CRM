<?php

class Modelapprovalmycases extends Model {
    
    public function getmissedcallData($data){
    
        $cr_by = $this->customer->getId();
        // SELECT DATA WHERE CASE_STATUS IN 2,4 FOR RA RESOLUTION SUBMITTED/HOLD
        $sql="SELECT cc.CASE_ID AS 'CASE_ID',
                CONCAT(cf.FAR_FIR_NAME,'',cf.FAR_MID_NAME,'',cf.FAR_LST_NAME) AS 'FAR_NAME',
                cc.COMP_MOBILE AS 'FAR_MOB',
                mp.PRODUCT_DESC AS 'PROD_CAT',
                DATE_FORMAT(cc.CR_DATE,'%d%M %y') AS 'CR_DATE',
                DATEDIFF(cc.DUE_DATE,CURDATE()) as 'DUE_DAYS',
                cs.case_status AS 'CASE_STS'
                FROM crm_case cc
                LEFT JOIN ak_farmer cf ON (cc.CASE_ID = cf.FAR_ID and cc.COMP_MOBILE = cf.FAR_MOBILE)
                LEFT JOIN mas_product mp ON (cc.PROD_CATG = mp.PRODUCT_ID and PRODUCT_TYPE = 2)
                LEFT JOIN crm_case_status cs ON (cc.CASE_STATUS = cs.sid)
                WHERE cc.CASE_STATUS IN(2,4) and cc.COMP_AA='".$cr_by."'
                ORDER BY cc.CR_DATE";
  
       if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        //echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function CallSts(){
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function CallUsr(){
        $sql="select SID,`NAME` from voc_user where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    
  public function getmissedcallDatacount($data){
       $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
    public function StateData(){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=2 ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function DistData($stid){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=3 AND STATE_ID='".$stid."'ORDER BY `NAME` ";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CropData(){
        $sql="select CROP_ID, CROP_DESC from mas_crop";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdData($caseid){
    /* $sql="SELECT 
        cc.CASE_ID AS 'COM_ID',
        ccm.COMP_CATG AS 'COM_CAT',
        cct.COMP_CATG AS 'COM_TYP',
        cc.COMPLAINT_QUERY AS 'COM_TXT',
        akc.firstname AS 'COM_CR_USR',
        ccd.UP_USER_NAME AS 'COM_CU_USR',
        cc.CASE_STATUS AS 'COM_STS'
        FROM crm_case cc
        LEFT JOIN crm_comp_catg_mst ccm ON (cc.COMP_CATG = ccm.SID and ccm.LAYER_TYPE=1)
        LEFT JOIN crm_comp_catg_mst cct ON (cc.COMP_TYPE = cct.SID and cct.LAYER_TYPE=2)
        LEFT JOIN ak_customer akc ON (cc.CR_BY = akc.customer_id)
        LEFT JOIN crm_case_detail ccd ON (cc.CASE_ID = ccd.CASE_ID)
        WHERE cc.CASE_ID='".$caseid."'"; */
        $sql="SELECT A.COM_ID,A.COM_CAT,A.COM_TYP,A.COM_TXT,A.COM_CR_USR,A.COM_STS,B.UP_USER_ID,B.UP_FILE_PATH 
        FROM (
	(SELECT 
        cc.CASE_ID AS 'COM_ID',
        ccm.COMP_CATG AS 'COM_CAT',
        cct.COMP_CATG AS 'COM_TYP',
        cc.COMPLAINT_QUERY AS 'COM_TXT',
        akc.firstname AS 'COM_CR_USR',
        cc.CASE_STATUS AS 'COM_STS'
        FROM crm_case cc
        LEFT JOIN crm_comp_catg_mst ccm ON (cc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
        LEFT JOIN crm_comp_catg_mst cct ON (cc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
        LEFT JOIN ak_customer akc ON (cc.CR_BY = akc.customer_id)
        WHERE cc.CASE_ID='".$caseid."')AS A
				LEFT JOIN (SELECT crm_case_detail.CASE_ID AS 'CASE_ID',crm_case_detail.UP_FILE_PATH AS 'UP_FILE_PATH', aku.firstname AS 'UP_USER_ID' 
				FROM crm_case_detail
				LEFT JOIN ak_customer aku ON (crm_case_detail.UP_USER_ID = aku.customer_id)
				WHERE CASE_ID = '".$caseid."' ORDER BY SID DESC LIMIT 1) AS B
				ON( A.COM_ID = B.CASE_ID)
        )";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdCatData(){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=1 and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CompData($comid){
        $sql="select SID,COMP_CATG from crm_comp_catg_mst where LAYER_TYPE=2 and PAR_COMP_CATG='".$comid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CompCatData(){
        $sql="select SID,COMP_CATG from crm_comp_catg_mst where LAYER_TYPE=1 and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function EnqCatData(){
        $sql="select SID,CATEGORY_NAME from mas_enquiry_category where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function EnqTypData(){
        $sql="select SID, ENQUIRY_TYPE from mas_enquiry_category_name where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
      
    
    
    
    public function AaStatus(){
        $sql="select sid, case_status from crm_case_status where emp_role in(3)";
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
    public function subaadata($caseid,$commnts,$status,$filepath){
        $commnts=str_replace("'", "", $commnts);
        $sqlprests="select case_status from crm_case where case_id='".$caseid."'";
        $authority=$this->db->query($sqlprests);
        $pre_sts=$authority->row['case_status'];
        $cr_date=date('Y-m-d');
        $cr_by = $this->customer->getId();
        $sqllastrec="SELECT crm_case_detail.CASE_ID AS 'CASE_ID',
			IFNULL(crm_case_detail.RA_REMARKS,'NA') AS 'RA_REMARKS',
			IFNULL(crm_case_detail.RA_DATE,'NULL') AS 'RA_DATE',
			IFNULL(crm_case_detail.AA_REMARKS,'NA') AS 'AA_REMARKS',
			IFNULL(crm_case_detail.AA_DATE,'NULL') AS 'AA_DATE'
			FROM crm_case_detail
			WHERE CASE_ID = '".$caseid."' ORDER BY SID DESC LIMIT 1";
        $lstqry=$this->db->query($sqllastrec);
        if($lstqry->num_rows==0){
            $ra_remarks='NA';
            $ra_date=NULL; 
        }
        else{
        $ra_remarks=$lstqry->row['RA_REMARKS'];
        $ra_date=$lstqry->row['RA_DATE'];
        }
        
        
        $sql="insert into crm_case_detail set 
                case_id='".$caseid."',
                case_pre_status='".$pre_sts."',
                case_cur_status='".$status."',
                solution='".$commnts."',
                ra_remarks='".$ra_remarks."',
                ra_date='".$ra_date."',
                aa_remarks='".$commnts."',
                aa_date='".$cr_date."',
                cr_date='".$cr_date."',
                up_user_id='".$cr_by."',
                up_file_path='".$filepath."'";
        $this->db->query($sql);
        $ret_id = $this->db->countAffected();  
        if($ret_id==1){
            $sql="update crm_case set case_status='".$status."' where case_id='".$caseid."'";
            $this->db->query($sql);
            $ret_id2 = $this->db->countAffected();
            if($ret_id2==1){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{            
            return 0;
        }
    }
  
}


