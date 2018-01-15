<?php

class Modeladvisorymycases extends Model {
    
    public function getmissedcallData($data){
            $cr_by = $this->customer->getId();
            // SELECT DATA WHERE CASE_STATUS IN 1,7 FOR PENDING AND HOLD  
            $sql="SELECT 
            cra.CASE_ID AS 'CASE_ID',
            cra.CASE_PIN AS 'CASE_PIN',
            crf.FAR_FIR_NAME AS 'CASE_FAR',
            cra.FAR_MOB AS 'CASE_MOB',
            cra.CR_DATE AS 'CASE_DATE',
            cra.COMP_QUERY AS 'CASE_QRY',
            cra.COMP_REMARKS AS 'CASE_RMK',
            ccs.case_status AS 'CASE_STS',
			cra.CR_DATE AS 'CR_DATE'
            from crm_adv cra
            LEFT JOIN ak_farmer crf ON(cra.FAR_MOB = crf.FAR_MOBILE)
            LEFT JOIN crm_case_status ccs ON(cra.CASE_STATUS = ccs.sid) where cra.case_status=27 and cc_attend >= 1 and cra.tot_attempt <> 0 and adv_id='".$cr_by."'";
  
      
        //echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    //***************************APP MYCASES DATA*****************************//
     public function appMycaseData($data){
        
        $aa=$data['userid'];
        $sql="SELECT
		crc.CASE_ID 	AS 'CASE_ID',
		akc.firstname   AS 'CR_BY',
		DATE_FORMAT(crc.CR_DATE,'%d %M %Y') 	AS 'CR_DATE',
		DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') 	AS 'DUE_DATE',
		voc.`NAME` 	AS 'COMP_BY',
		crc.COMPLAINT_REMARKS   AS 'COMP_REMARKS',
		ccs.case_status 	AS 'COMP_STATUS',
		map.PRODUCT_DESC 	AS 'PROD_CAT',
		mapp.PRODUCT_DESC       AS 'PROD_NAME',
		ccm.COMP_CATG 		AS 'COMP_CAT',
		cct.COMP_CATG 		AS 'COMP_TYPE'
            FROM crm_case crc 
            LEFT JOIN crm_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
            LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
            LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
            LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
            LEFT JOIN mas_product map ON(crc.COMP_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=1)
            LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=2)
            LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
            LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function appMycaseData_Ra($data){
        
        $ra=$data['userid'];
        $sql="SELECT
		crc.CASE_ID 	AS 'CASE_ID',
		akc.firstname   AS 'CR_BY',
		DATE_FORMAT(crc.CR_DATE,'%d %M %Y') 	AS 'CR_DATE',
		DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') 	AS 'DUE_DATE',
		voc.`NAME` 	AS 'COMP_BY',
		crc.COMPLAINT_REMARKS   AS 'COMP_REMARKS',
		ccs.case_status 	AS 'COMP_STATUS',
		map.PRODUCT_DESC 	AS 'PROD_CAT',
		mapp.PRODUCT_DESC       AS 'PROD_NAME',
		ccm.COMP_CATG 		AS 'COMP_CAT',
		cct.COMP_CATG 		AS 'COMP_TYPE'
FROM crm_case crc 
LEFT JOIN crm_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.COMP_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=1)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=2)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
WHERE crc.COMP_RA='".$ra."'";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
     public function appMycaseData_Aa($data){
        
        $aa=$data['userid'];
        $sql="SELECT
		crc.CASE_ID 	AS 'CASE_ID',
		akc.firstname   AS 'CR_BY',
		DATE_FORMAT(crc.CR_DATE,'%d %M %Y') 	AS 'CR_DATE',
		DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') 	AS 'DUE_DATE',
		voc.`NAME` 	AS 'COMP_BY',
		crc.COMPLAINT_REMARKS   AS 'COMP_REMARKS',
		ccs.case_status 	AS 'COMP_STATUS',
		map.PRODUCT_DESC 	AS 'PROD_CAT',
		mapp.PRODUCT_DESC       AS 'PROD_NAME',
		ccm.COMP_CATG 		AS 'COMP_CAT',
		cct.COMP_CATG 		AS 'COMP_TYPE'
FROM crm_case crc 
LEFT JOIN crm_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.COMP_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=1)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=2)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
WHERE crc.COMP_AA='".$aa."'";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function appMycaseData_details($caseid){
        // SELECT DATA WHERE CASE_STATUS IN 1,7 FOR PENDING AND HOLD  
        $sql="SELECT A.FAR_NAME,A.STATE_NAME,A.DIST_NAME,A.CR_USER,A.CR_DATE,B.CUR_USER,A.PROD_CAT,A.PROD_NAME,A.COM_ID,A.COM_CAT,A.COM_TYP,A.COM_TXT,A.COM_STS,B.UP_FILE_PATH 
        FROM (
		(SELECT 
                    cfa.FAR_NAME AS 'FAR_NAME',
							geos.`NAME` AS 'STATE_NAME',
							geod.`NAME` AS 'DIST_NAME',
							cc.CASE_ID AS 'COM_ID',
							ccm.COMP_CATG AS 'COM_CAT',
							cct.COMP_CATG AS 'COM_TYP',
							cc.COMPLAINT_QUERY AS 'COM_TXT',
							akc.firstname AS 'CR_USER',
							ccs.case_status AS 'COM_STS',
							cc.CR_DATE AS 'CR_DATE',
							map.PRODUCT_DESC AS 'PROD_CAT',
							mapp.PRODUCT_DESC AS 'PROD_NAME'
							FROM crm_case cc
							LEFT JOIN crm_comp_catg_mst ccm ON (cc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
							LEFT JOIN crm_comp_catg_mst cct ON (cc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
							LEFT JOIN ak_customer akc ON (cc.CR_BY = akc.customer_id)
							LEFT JOIN crm_farmer cfa ON(cc.COMP_MOBILE = cfa.FAR_MOBILE)
							LEFT JOIN mas_pol_geo geos ON(cfa.STATE_ID = geos.GEO_ID AND geos.MARK_TYPE=2)
							LEFT JOIN mas_pol_geo geod ON(cfa.DISTRICT_ID = geod.GEO_ID AND geod.MARK_TYPE=3)
							LEFT JOIN mas_product map ON(cc.PROD_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=1)
							LEFT JOIN mas_product mapp ON(cc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=2)
							LEFT JOIN crm_case_status  ccs ON( cc.CASE_STATUS = ccs.sid)
							WHERE cc.CASE_ID='".$caseid."')AS A
							


				LEFT JOIN (SELECT crm_case_detail.CASE_ID AS 'CASE_ID',
													crm_case_detail.UP_FILE_PATH AS 'UP_FILE_PATH',
													aku.firstname AS 'CUR_USER' 
				FROM crm_case_detail
				LEFT JOIN ak_customer aku ON (crm_case_detail.UP_USER_ID = aku.customer_id)
				WHERE CASE_ID = '".$caseid."' ORDER BY SID DESC LIMIT 1) AS B
				ON( A.COM_ID = B.CASE_ID)
        )";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function appMycaseData_history($caseid){
        // SELECT DATA WHERE CASE_STATUS IN 1,7 FOR PENDING AND HOLD  
        $sql="SELECT ccd.CASE_ID, ccc.case_status AS 'CASE_PRE_STATUS', 
            ccp.case_status AS 'CASE_CUR_STATUS', SOLUTION, 
            CR_DATE AS 'CASE_UP_DATE',
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
    public function caseOwner($caseid){
        $cusr="select firstname from ak_customer where customer_id=(select comp_ra from crm_case 
where case_id='".$caseid."')";
        $query = $this->db->query($cusr);
        return $query->row['firstname'];
    }

    //**************************APP MYCASES DATA END**************************//
    
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
    
        $sql="select CASE_ID,COMP_QUERY
                from crm_adv
                where CASE_ID='".$caseid."'";
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
    
    
    
    
    
    public function RaStatus(){
        $sql="select sid, case_status from crm_case_status where emp_role in(4)";
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
    public function subradata($caseid,$commnts,$status,$filepath){
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
            $aa_remarks='NA';
            $aa_date=NULL; 
        }
        else{
        $aa_remarks=$lstqry->row['AA_REMARKS'];
        $aa_date=$lstqry->row['AA_DATE'];
        }
        
        
        $sql="insert into crm_case_detail set 
                case_id='".$caseid."',
                case_pre_status='".$pre_sts."',
                case_cur_status='".$status."',
                solution='".$commnts."',
                ra_remarks='".$commnts."',
                ra_date='".$cr_date."',
                aa_remarks='".$aa_remarks."',
                aa_date='".$aa_date."',
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
    public function subadvdata($caseid,$remarks){
        $cr_date=date('Y-m-d');
        $cr_by = $this->customer->getId();
        $sql="insert into crm_adv_detail set
            case_id='".$caseid."',
            case_pre_status='7',
            case_cur_status='8',
            adv_remarks='".$remarks."',
            adv_date='".$cr_date."',
            cc_remarks='NA',
            cc_date='".$cr_date."',
            file_up_path='NA',
            cr_by='".$cr_by."',
            cr_date='".$cr_date."'";
        $this->db->query($sql);
        $ret_id = $this->db->countAffected(); 
        if($ret_id==1)
        {
            $upsql="update crm_adv set case_status='8' where case_id='".$caseid."'";
            $this->db->query($upsql);
            $ret_id_up = $this->db->countAffected();
            if($ret_id_up==1){
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
    public function RecData($data){
        $caseid=$data['caseid'];
        $sql="select case_pin AS 'CASE_PIN', far_mob AS 'TO_MOB',call_from AS 'FROM_MOB' from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function CaseData($data){
        $caseid=$data['caseid'];
        $sql="select * from crm_adv_detail where case_id='".$caseid."'";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function SaveFeedBack($data){
        $log=new Log("AdvReviewData.log");
        $cr_by = $this->customer->getId();
        $cr_date=date('Y-m-d');
        $log->write($data);
               
        $Crop_Nutrition_Type=$data['Crop_Nutrition_Type'];
        $Crop_Protection_Type=$data['Crop_Protection_Type'];
        $Seed_Type=$data['Seed_Type'];
        $Soil_Type=$data['Soil_Type'];
        $Irrigation_Type=$data['Irrigation_Type'];
        $Others_Type=$data['Others_Type'];
        if(empty($Others_Type)){$Others_Type='Others';}
        $caseid=$data['caseid'];
        $callsts=8;

        $Crop_Nutrition_Data=$data['Crop_Nutrition_Data'];
        $Crop_Nutrition_Data=str_replace("'", "", $Crop_Nutrition_Data);

        $Crop_Protection_Data=$data['Crop_Protection_Data'];
        $Crop_Protection_Data=str_replace("'", "", $Crop_Protection_Data);

        $Seed_Data=$data['Seed_Data'];
        $Seed_Data=str_replace("'", "", $Seed_Data);

        $Soil_Data=$data['Soil_Data'];
        $Soil_Data=str_replace("'", "", $Soil_Data);

        $Irrigation_Data=$data['Irrigation_Data'];
        $Irrigation_Data=str_replace("'", "", $Irrigation_Data);

        $Others_Data=$data['Others_Data'];
        $Others_Data=str_replace("'", "", $Others_Data);
        //////////////////////////////////
        $log->write("CrBy: ".$cr_by);
        
        
        //Get pre status of caseid
        $sqlpre="select case_status from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sqlpre);
        $prests = $query->row['case_status'];
        if(!empty($Crop_Nutrition_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Crop_Nutrition_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Crop_Nutrition_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc1 = $this->db->countAffected();
        }
        if(!empty($Crop_Protection_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Crop_Protection_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Crop_Protection_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc2 = $this->db->countAffected();
        }
        if(!empty($Seed_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Seed_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Seed_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc3 = $this->db->countAffected();
        }
        if(!empty($Soil_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Soil_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Soil_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc4 = $this->db->countAffected();
        }
        if(!empty($Irrigation_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Irrigation_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Irrigation_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc5 = $this->db->countAffected();
        }
        if(!empty($Others_Data))
        {
            $sqlfeed="update crm_adv_detail set adv_remarks='".$Others_Data."',adv_date='".$cr_date."' where case_id='".$caseid."' and adv_head='".$Others_Type."'";
            $query = $this->db->query($sqlfeed);
            $suc6 = $this->db->countAffected();
        }
        
            
            $upadv="update crm_adv set case_status=99 where case_id='".$caseid."'";
            $query = $this->db->query($upadv);
            $suc = $this->db->countAffected();
            return $suc;
        
        
    }
  
}

