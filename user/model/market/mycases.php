<?php

class Modelmarketmycases extends Model {
    
    public function getmissedcallDataFar($data){
    
        $cr_by = $this->customer->getId();
        $sql="SELECT 
        crm_case.CASE_ID AS 'CASE_ID',crm_case.COMP_MOBILE AS 'CASE_MOB',
        CONCAT(ak_farmer.FAR_FIR_NAME,' ',ak_farmer.FAR_MID_NAME,' ',ak_farmer.FAR_LST_NAME) AS 'CASE_NAME',
        (CASE 
        WHEN ak_farmer.CALL_STATUS=29 THEN 'PRODUCT NON-TECH'
        WHEN ak_farmer.CALL_STATUS=30 THEN 'NETWORK '
        WHEN ak_farmer.CALL_STATUS=31 THEN 'SERVICE'
        ELSE 'NA'
        END) AS 'CASE_TYPE',
        (CASE 
	WHEN crm_case.CASE_STATUS=7 THEN 'PENDING AT MO'
	WHEN crm_case.CASE_STATUS=5 THEN 'PENDING AT CC' 
	WHEN crm_case.CASE_STATUS=0 THEN 'CLOSED'
	WHEN crm_case.CASE_STATUS=99 THEN 'CLOSED' 
	ELSE 'NA'
        END) AS 'CASE_STATUS',
        DATE_FORMAT(crm_case.CR_DATE,'%d-%m-%Y') AS 'CR_DATE', 
        DATEDIFF(CURDATE(),crm_case.CR_DATE) AS 'DAYS',
        (CASE 
            WHEN COMP_SOURCE=1 THEN 'PORTAL'
            WHEN COMP_SOURCE=2 THEN 'APP'
            ELSE 'NA'
        END) AS 'COMP_SRC'
        FROM crm_case
        JOIN ak_farmer ON(crm_case.CASE_ID=ak_farmer.FAR_ID)
        WHERE COMP_MO='".$cr_by."' AND IS_COMP_SOL=2";

  
       
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
     public function getmissedcallDataDel($data){
    
        $cr_by = $this->customer->getId();
        $sql="SELECT 
        crm_case.CASE_ID AS 'CASE_ID',crm_case.COMP_MOBILE AS 'CASE_MOB',
        ak_dealer.DEL_NAME AS 'CASE_NAME',
        (CASE 
        WHEN ak_dealer.CALL_STATUS=29 THEN 'PRODUCT NON-TECH'
        WHEN ak_dealer.CALL_STATUS=30 THEN 'NETWORK '
        WHEN ak_dealer.CALL_STATUS=31 THEN 'SERVICE'
        ELSE 'NA'
        END) AS 'CASE_TYPE',
        (CASE 
	WHEN crm_case.CASE_STATUS=7 THEN 'PENDING AT MO'
	WHEN crm_case.CASE_STATUS=5 THEN 'PENDING AT CC' 
	WHEN crm_case.CASE_STATUS=0 THEN 'CLOSED'
	WHEN crm_case.CASE_STATUS=99 THEN 'CLOSED' 
	ELSE 'NA'
        END) AS 'CASE_STATUS',
        DATE_FORMAT(crm_case.CR_DATE,'%d-%m-%Y') AS 'CR_DATE', 
        DATEDIFF(CURDATE(),crm_case.CR_DATE) AS 'DAYS',
        (CASE 
            WHEN COMP_SOURCE=1 THEN 'PORTAL'
            WHEN COMP_SOURCE=2 THEN 'APP'
            ELSE 'NA'
        END) AS 'COMP_SRC'
        FROM crm_case
        JOIN ak_dealer ON(crm_case.CASE_ID=ak_dealer.DEL_ID)
        WHERE COMP_MO='".$cr_by."' AND IS_COMP_SOL=2";

  
       
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
    $sql="SELECT 
akf.FAR_ID AS 'CASE_ID',
crs.CASE_STATUS,
akf.STATE_ID,
ST.`NAME` AS 'STATE_NAME',
akf.DISTRICT_ID,
DT.`NAME` AS 'DISTRICT_NAME',
akf.MO_OFFICE,
MF.mo_office_name AS 'MO_OFF_NAME',
crs.COMPLAINT_QUERY AS 'CASE_TXT',
crd.RA_REMARKS AS 'CASE_SOL_TXT',
IFNULL(MPP.PRODUCT_DESC,'NA') AS 'PRO_NAME',
IFNULL(MPC.PRODUCT_DESC,'NA') AS 'PRO_CAT'

FROM ak_farmer akf 
LEFT JOIN crm_case crs ON(akf.FAR_ID=crs.CASE_ID)
LEFT JOIN mas_pol_geo ST ON(ST.GEO_ID=akf.STATE_ID)
LEFT JOIN mas_pol_geo DT ON(DT.GEO_ID=akf.DISTRICT_ID)
LEFT JOIN crm_mo_office MF ON(akf.MO_OFFICE=MF.mo_office_geo_code)
LEFT JOIN mas_product MPP ON(crs.PROD_ID=MPP.PRODUCT_ID)
LEFT JOIN mas_product MPC ON(crs.PROD_CATG=MPC.PRODUCT_ID)
LEFT JOIN crm_case_detail crd ON(crs.CASE_ID=crd.CASE_ID)
WHERE akf.FAR_ID='".$caseid."'
GROUP BY akf.FAR_ID";
    $query = $this->db->query($sql);
        if(count($query->rows)>0){
        return $query->row;
        }
        else{
             $sql="SELECT 
            akd.DEL_ID AS 'CASE_ID',
            crs.CASE_STATUS,
            akd.STATE_ID,
            ST.`NAME` AS 'STATE_NAME',
            akd.DISTRICT_ID,
            DT.`NAME` AS 'DISTRICT_NAME',
            crs.MO_ID,
            MF.mo_office_name AS 'MO_OFF_NAME',
            crs.COMPLAINT_QUERY AS 'CASE_TXT',
            crd.RA_REMARKS AS 'CASE_SOL_TXT',
            IFNULL(MPP.PRODUCT_DESC,'NA') AS 'PRO_NAME',
            IFNULL(MPC.PRODUCT_DESC,'NA') AS 'PRO_CAT'

            FROM ak_dealer akd
            LEFT JOIN crm_case crs ON(akd.DEL_ID=crs.CASE_ID)
            LEFT JOIN mas_pol_geo ST ON(ST.GEO_ID=akd.STATE_ID)
            LEFT JOIN mas_pol_geo DT ON(DT.GEO_ID=akd.DISTRICT_ID)
            LEFT JOIN crm_mo_office MF ON(crs.MO_ID=MF.mo_office_geo_code)
            LEFT JOIN mas_product MPP ON(crs.PROD_ID=MPP.PRODUCT_ID)
            LEFT JOIN mas_product MPC ON(crs.PROD_CATG=MPC.PRODUCT_ID)
            LEFT JOIN crm_case_detail crd ON(crs.CASE_ID=crd.CASE_ID)
            WHERE akd.DEL_ID='".$caseid."'
            GROUP BY akd.DEL_ID";
            $query = $this->db->query($sql);
            return $query->row;
        }
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
    public function submodata($caseid,$commnts,$status,$filepath){
        $commnts=str_replace("'", "", $commnts);
        $sqlprests="select case_status from crm_case where case_id='".$caseid."'";
        $authority=$this->db->query($sqlprests);
        $pre_sts=$authority->row['case_status'];
        $cr_date=date('Y-m-d');
        $cr_by = $this->customer->getId();
        $sql="insert into crm_case_detail set 
                case_id='".$caseid."',
                case_pre_status='".$pre_sts."',
                case_cur_status='".$status."',
                solution='".$commnts."',
                ra_remarks='".$commnts."',
                ra_date='".$cr_date."',
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


