<?php

class Modelapicases extends Model {
    
    public function getmissedcallData($data){
    
            // SELECT DATA WHERE CASE_STATUS IN 1,7 FOR PENDING AND HOLD  
            $sql="SELECT 
                cc.CASE_ID AS 'CASE_ID',
                cf.FAR_NAME AS 'FAR_NAME',
                cc.COMP_MOBILE AS 'FAR_MOB',
                mp.PRODUCT_DESC AS 'PROD_CAT',
                DATE_FORMAT(cc.CR_DATE,'%d%M %y') AS 'CR_DATE',
                DATEDIFF(cc.DUE_DATE,CURDATE()) as 'DUE_DAYS',
                cs.case_status AS 'CASE_STS'
                FROM crm_case cc
                LEFT JOIN crm_farmer cf ON (cc.CASE_ID = cf.FAR_ID and cc.COMP_MOBILE = cf.FAR_MOBILE)
                LEFT JOIN mas_product mp ON (cc.PROD_CATG = mp.PRODUCT_ID and PRODUCT_TYPE = 1)
                LEFT JOIN crm_case_status cs ON (cc.CASE_STATUS = cs.sid)
                WHERE cc.CASE_STATUS IN(1,6,7)
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
    
    
    
  //***************************WEB SERVICES FOR MOBILE APPLICATION*****************************//
     public function appMycaseData($data){
        $log=new Log("Cases".date('d_m_Y').".log");
        $aa=$data['userid'];
        $sql="SELECT
crc.CASE_ID AS 'CASE_ID',
crc.COMP_MOBILE AS 'CASE_MOB',
crf.FAR_FIR_NAME AS 'CASE_BY',
akc.firstname AS 'CR_BY',
DATE_FORMAT(crc.CR_DATE,'%d %M %Y') AS 'CR_DATE',
DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') AS 'DUE_DATE',
voc.`NAME` AS 'COMP_BY',
crc.COMPLAINT_REMARKS AS 'COMP_REMARKS',
ccs.case_status AS 'COMP_STATUS',
map.PRODUCT_DESC AS 'PROD_CAT',
mapp.PRODUCT_DESC AS 'PROD_NAME',
ccm.COMP_CATG AS 'COMP_CAT',
cct.COMP_CATG AS 'COMP_TYPE'
FROM crm_case crc
LEFT JOIN ak_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.PROD_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=2)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=3)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
GROUP BY crc.COMP_MOBILE";
	$log->write($sql);
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function appMycaseData_Ra($data){
        
        $ra=$data['userid'];
         $sql="SELECT
		crc.CASE_ID 	AS 'CASE_ID',
                crc.COMP_MOBILE  AS 'CASE_MOB',
		crf.FAR_FIR_NAME AS 'CASE_BY',
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
LEFT JOIN ak_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.COMP_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=1)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=3)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
WHERE crc.COMP_RA='".$ra."'";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
     public function appMycaseData_Aa($data){
        
        $aa=$data['userid'];
        $sql="SELECT
crc.CASE_ID AS 'CASE_ID',
crc.COMP_MOBILE AS 'CASE_MOB',
crf.FAR_FIR_NAME AS 'CASE_BY',
akc.firstname AS 'CR_BY',
DATE_FORMAT(crc.CR_DATE,'%d %M %Y') AS 'CR_DATE',
DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') AS 'DUE_DATE',
voc.`NAME` AS 'COMP_BY',
crc.COMPLAINT_REMARKS AS 'COMP_REMARKS',
ccs.case_status AS 'COMP_STATUS',
map.PRODUCT_DESC AS 'PROD_CAT',
mapp.PRODUCT_DESC AS 'PROD_NAME',
ccm.COMP_CATG AS 'COMP_CAT',
cct.COMP_CATG AS 'COMP_TYPE',
(CASE WHEN crc.CASE_STATUS = 6 THEN 'PENDING REVIEW'
WHEN crc.CASE_STATUS = 2 THEN 'PENDING APPROVAl'
WHEN crc.CASE_STATUS = 5 THEN 'SUBMIT APPROVAL'
WHEN crc.CASE_STATUS = 99 THEN 'CLOSED'
ELSE 'PENDING AT RA'
END
) AS 'CASE_STATUS'
FROM crm_case crc
LEFT JOIN ak_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.PROD_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=2)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=3)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
WHERE crc.COMP_AA='".$aa."' GROUP BY crc.COMP_MOBILE ";
        $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    public function appMycaseData_Adv($data){
        
        $adv=$data['userid'];
        $sql="SELECT
crc.CASE_ID AS 'CASE_ID',
crc.COMP_MOBILE AS 'CASE_MOB',
crf.FAR_FIR_NAME AS 'CASE_BY',
akc.firstname AS 'CR_BY',
DATE_FORMAT(crc.CR_DATE,'%d %M %Y') AS 'CR_DATE',
DATE_FORMAT(crc.DUE_DATE,'%d %M %Y') AS 'DUE_DATE',
voc.`NAME` AS 'COMP_BY',
crc.COMPLAINT_REMARKS AS 'COMP_REMARKS',
ccs.case_status AS 'COMP_STATUS',
map.PRODUCT_DESC AS 'PROD_CAT',
mapp.PRODUCT_DESC AS 'PROD_NAME',
ccm.COMP_CATG AS 'COMP_CAT',
cct.COMP_CATG AS 'COMP_TYPE',
(CASE WHEN crc.CASE_STATUS = 6 THEN 'PENDING REVIEW'
WHEN crc.CASE_STATUS = 2 THEN 'PENDING APPROVAl'
WHEN crc.CASE_STATUS = 5 THEN 'SUBMIT APPROVAL'
WHEN crc.CASE_STATUS = 99 THEN 'CLOSED'
ELSE 'PENDING AT RA'
END
) AS 'CASE_STATUS'
FROM crm_case crc
LEFT JOIN ak_farmer crf ON(crc.COMP_MOBILE = crf.FAR_MOBILE)
LEFT JOIN ak_customer akc ON(crc.CR_BY = akc.customer_id)
LEFT JOIN voc_user voc ON(crf.EMP_STATUS = voc.SID)
LEFT JOIN crm_case_status ccs ON(crc.CASE_STATUS = ccs.sid)
LEFT JOIN mas_product map ON(crc.PROD_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=2)
LEFT JOIN mas_product mapp ON(crc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=3)
LEFT JOIN crm_comp_catg_mst ccm ON (crc.COMP_CATG = ccm.SID AND ccm.LAYER_TYPE=1)
LEFT JOIN crm_comp_catg_mst cct ON (crc.COMP_TYPE = cct.SID AND cct.LAYER_TYPE=2)
WHERE crc.COMP_Adv='".$adv."' GROUP BY crc.COMP_MOBILE ";
        $query = $this->db->query($sql);
        return $query->rows;  
        
    }
    public function appMycaseData_details($caseid){
        // SELECT DATA WHERE CASE_STATUS IN 1,7 FOR PENDING AND HOLD  
        $sql="SELECT A.FAR_NAME,A.FAR_MOB,A.STATE_NAME,A.DIST_NAME,A.CR_USER,A.CR_DATE,B.CUR_USER,A.PROD_CAT,A.PROD_NAME,A.COM_ID,A.COM_CAT,A.COM_TYP,A.COM_TXT,A.COM_STS,B.UP_FILE_PATH 
        FROM (
		(SELECT 
                        cfa.FAR_NAME AS 'FAR_NAME',
			cfa.FAR_MOBILE AS 'FAR_MOB',
			ifnull(geos.`NAME`,'NA') AS 'STATE_NAME',
			ifnull(geod.`NAME`,'NA') AS 'DIST_NAME',
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
			LEFT JOIN mas_pol_geo geos ON(cfa.STATE_ID = geos.GEO_ID AND geos.MARK_TYPE=1)
			LEFT JOIN mas_pol_geo geod ON(cfa.DISTRICT_ID = geod.GEO_ID AND geod.MARK_TYPE=2)
			LEFT JOIN mas_product map ON(cc.PROD_CATG = map.PRODUCT_ID AND map.PRODUCT_TYPE=2)
			LEFT JOIN mas_product mapp ON(cc.PROD_ID = mapp.PRODUCT_ID AND mapp.PRODUCT_TYPE=3)
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
        
        $sql="SELECT 			
            ccd.CASE_ID, 
            ccf.FAR_NAME AS 'CASE_BY',
            ccf.FAR_MOBILE AS 'CASE_MOB',
            ccc.case_status AS 'CASE_PRE_STATUS', 
            ccp.case_status AS 'CASE_CUR_STATUS', SOLUTION, 
            ccd.CR_DATE AS 'CASE_UP_DATE',
           ifnull( akc.firstname,'NA') AS 'UP_USR_NAME' ,
            ccd.UP_FILE_PATH AS 'UP_FILE_NAME'
            FROM crm_case_detail ccd
            LEFT JOIN crm_case_status ccc ON(ccd.CASE_PRE_STATUS = ccc.sid)
            LEFT JOIN crm_case_status ccp ON(ccd.CASE_CUR_STATUS = ccp.sid)
            LEFT JOIN ak_customer akc ON (ccd.UP_USER_ID = akc.customer_id)
            LEFT JOIN crm_case cca ON (ccd.CASE_ID = cca.CASE_ID)
            LEFT JOIN crm_farmer ccf ON (cca.COMP_MOBILE = ccf.FAR_MOBILE)
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
    public function AllcaseData_report(){
        $sql="SELECT 
        count(A.SID) AS 'COMP_SUB_COUNT', A.COMP_CATG AS 'COMP_SUB_NAME'
        FROM
            (SELECT 
                cm.SID,cm.COMP_CATG
                FROM crm_case cc
                LEFT JOIN crm_comp_catg_mst cm 
                ON (cc.COMP_TYPE = cm.SID AND cc.COMP_CATG = cm.PAR_COMP_CATG AND cm.LAYER_TYPE=2)) AS A
        GROUP BY A.SID,A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function MycaseData_report_Ra($data){
        $sql="SELECT 
        count(A.SID) AS 'COMP_SUB_COUNT', A.COMP_CATG AS 'COMP_SUB_NAME'
        FROM
            (SELECT 
                cm.SID,cm.COMP_CATG
                FROM crm_case cc
                LEFT JOIN crm_comp_catg_mst cm 
                ON (cc.COMP_TYPE = cm.SID AND cc.COMP_CATG = cm.PAR_COMP_CATG AND cm.LAYER_TYPE=2)
                WHERE cc.COMP_RA='".$data['userid']."') AS A
        GROUP BY A.SID,A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
     public function MycaseData_report_Aa($data){
        $sql="SELECT 
        count(A.SID) AS 'COMP_SUB_COUNT', A.COMP_CATG AS 'COMP_SUB_NAME'
        FROM
            (SELECT 
                cm.SID,cm.COMP_CATG
                FROM crm_case cc
                LEFT JOIN crm_comp_catg_mst cm 
                ON (cc.COMP_TYPE = cm.SID AND cc.COMP_CATG = cm.PAR_COMP_CATG AND cm.LAYER_TYPE=2)
                WHERE cc.COMP_AA='".$data['userid']."') AS A
        GROUP BY A.SID,A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function MycaseData_report_Adv($data){
        $sql="SELECT 
        count(A.SID) AS 'COMP_SUB_COUNT', A.COMP_CATG AS 'COMP_SUB_NAME'
        FROM
            (SELECT 
                cm.SID,cm.COMP_CATG
                FROM crm_case cc
                LEFT JOIN crm_comp_catg_mst cm 
                ON (cc.COMP_TYPE = cm.SID AND cc.COMP_CATG = cm.PAR_COMP_CATG AND cm.LAYER_TYPE=2)
                WHERE cc.COMP_ADV='".$data['roleid']."') AS A
        GROUP BY A.SID,A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    
    public function MycaseData_remarks_Ra($data)
    {
        
        $caseid=$data["caseid"];
        $commnts=$data["remarks"];
        $status=$data["type"];
        $userid=$data["userid"];
        
        $commnts=str_replace("'","",$commnts);
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
                up_file_path=''";
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
   //***********************update status Advisory Start **********************//
    public function Adv_status_update($data)
    {
        //$roleid=$data["roleid"];
        $case_status=$data["case_status"];
        $caseid=$data["caseid"];
        $userid=$data["userid"];
        $sql="UPDATE crm_case SET CASE_STATUS ='".$case_status."' WHERE CASE_ID ='".$caseid."' and COMP_ADV  ='". $userid."'";
        $this->db->query($sql);
        $ret_id = $this->db->countAffected(); 
        return $ret_id;
    }
    //*********************** update status Advisory End **********************// 
     //***********************Advisory Approval Start **********************//
    public function appMyCaseAdv_approval($data)
    {
       
        $cr_by=$data["userid"];
        /*$sql="SELECT 
                FAR_MOB,DATE_FORMAT(CR_DATE,'%d %M %Y') AS CR_DATE,
                CASE_ID,
                CASE_PIN,
                (case 
                 when CASE_STATUS = 7 and TOT_ATTEMPT=0 then 'pendingatadvisory'
                 when CASE_STATUS = 27 and TOT_ATTEMPT=0 then 'pendingatcc'
                 when CASE_STATUS = 27 and TOT_ATTEMPT >=1 then 'pendingatapproval'
                 when CASE_STATUS =0  then 'callnotconnected'
                 when CASE_STATUS =99  then 'closed'
                 else 'NA'
                 END 
                  ) as CASE_STATUS

                FROM `crm_adv`
                WHERE ADV_ID='".$cr_by."' and CR_DATE<=CURRENT_DATE GROUP BY FAR_MOB";
			*/	
				$sql="SELECT 
            cra.CASE_ID AS 'CASE_ID',
            cra.CASE_PIN AS 'CASE_PIN',
            crf.FAR_FIR_NAME AS 'CASE_FAR',
            cra.FAR_MOB AS 'FAR_MOB',
            DATE_FORMAT(cra.CR_DATE,'%d %M %Y') AS 'CR_DATE',
            cra.COMP_QUERY AS 'CASE_QRY',
            cra.COMP_REMARKS AS 'CASE_RMK',
            
			(case 
                 when cra.CASE_STATUS = 7 and cra.TOT_ATTEMPT=0 then 'pendingatadvisory'
                 when cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT=0 then 'pendingatcc'
                 when cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT >=1 then 'pendingatapproval'
                 when cra.CASE_STATUS =0  then 'callnotconnected'
                 when cra.CASE_STATUS =99  then 'closed'
                 else 'NA'
                 END 
                  ) as CASE_STATUS
            from crm_adv cra
            LEFT JOIN ak_farmer crf ON(cra.FAR_MOB = crf.FAR_MOBILE)
            where cra.case_status=27 and cc_attend >= 1 and cra.tot_attempt <> 0 and adv_id='".$cr_by."'";
				
                $this->db->query($sql);
                $query = $this->db->query($sql);
                return $query->rows; 
    }
    //***********************Advisory Approval End **********************// 
     //***********************Advisory Pending Start **********************// 
    public function appMycaseAdvisoryPending($data)
    {
         $userid=$data["userid"];
         $sql="select
            cra.CASE_ID AS 'CASE_ID',
            cra.CASE_PIN AS 'CASE_PIN', 
            cra.FAR_MOB AS 'FAR_MOB',
            DATE_FORMAT(cra.CR_DATE ,'%d %M %Y') AS CR_DATE,
            cra.CALL_COUNT AS 'TOT_ATTEMPT',
            mpg.NAME as STATENAME,    
            (case 
             when cra.CASE_STATUS = 7 and cra.TOT_ATTEMPT=0 then 'pendingatadvisory'
             when cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT=0 then 'pendingatcc'
             when cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT >=1 then 'pendingatapproval'
             when cra.CASE_STATUS =0  then 'callnotconnected'
             when cra.CASE_STATUS =99  then 'closed'
             else 'NA'
             END 
         
            ) as CASE_STATUS
            from crm_adv cra
            LEFT JOIN ak_farmer crf ON(cra.FAR_MOB = crf.FAR_MOBILE)
            LEFT JOIN ak_customer akc on(akc.customer_id=cra.ADV_ID)
            LEFT JOIN cc_incomingcall cci on(cci.MOBILE=cra.FAR_MOB)
            LEFT JOIN mas_pol_geo mpg on (mpg.GEO_ID=cci.STATE)
            LEFT JOIN crm_case_status ccs ON(cra.CASE_STATUS = ccs.sid)
            where cra.ADV_ID='".$userid."' GROUP BY cra.CASE_PIN";
         $this->db->query($sql);
         $query = $this->db->query($sql);
         return $query->rows; 
    }
     //***********************Advisory Pending End **********************//
     //***********************Advisory Pending Start **********************// 
    public function appMycaseAdvisoryCases($data)
    {
         $userid=$data["userid"];
         $caseid=$data["caseid"];
         $sql="SELECT `ADV_HEAD`,`ADV_HEAD_DETAILS`,`CROP_DETAILS` FROM `crm_adv_detail` WHERE `CASE_ID`='".$caseid."'";
         $this->db->query($sql);
         $query = $this->db->query($sql);
         return $query->rows; 
    }
    public function appMycaseAdvisoryRec($data){
        $caseid=$data['caseid'];
        $sql="select case_pin AS 'CASE_PIN',far_mob AS 'TO_MOB',call_from AS 'FROM_MOB' from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    //***********************Advisory Pending End **********************//
     //***********************appMycaseAdvisoryCasesUpdate  Start **********************// 
    public function appMycaseAdvisoryCasesUpdate($data)
    {
         $userid=$data["userid"]; 
         $caseid=$data["caseid"];
         //get data in Adv_Head Details
         $head1=$data["head1"];
         $head2=$data["head2"];
         $head3=$data["head3"];
         $head4=$data["head4"];
         $head5=$data["head5"];
           //get data in Crop Details
         $crop1=$data["cropdetail1"];
         $crop2=$data["cropdetail2"];
         $crop3=$data["cropdetail3"];
         $crop4=$data["cropdetail4"];
         $crop5=$data["cropdetail5"];
          //get Other data
         $other1=$data["other1"];
         $other2=$data["other2"];
         $other3=$data["other3"];
         $sqll="SELECT SID,count(CASE_ID) as NUMBEROFROW FROM `crm_adv_detail`  WHERE  CASE_ID='".$caseid."'";
         $qq=$this->db->query($sqll);
         
         if($qq->num_rows==0){
            return 0;
        }else {
              $totnum=$qq->row['NUMBEROFROW'];
              $SID=$qq->row['SID'];
                   
              for($i=1;$i<=6;$i++) {

                   if($i==1){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD_DETAILS='".$head1."', CROP_DETAILS='".$crop1."' WHERE CASE_ID ='".$caseid."' AND SID ='".$SID."'";
                   $SID=$SID+1;
                   }else if($i==2){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD_DETAILS='".$head2."', CROP_DETAILS='".$crop2."' WHERE CASE_ID ='".$caseid."' AND SID ='".$SID."'";
                   $SID=$SID+1;
                  }else if($i==3){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD_DETAILS='".$head3."', CROP_DETAILS='".$crop3."' WHERE CASE_ID ='".$caseid."' AND SID ='".$SID."'";
                   $SID=$SID+1;
                  }else if($i==4){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD_DETAILS='".$head4."', CROP_DETAILS='".$crop4."' WHERE CASE_ID ='".$caseid."' AND SID ='".$SID."'";
                   $SID=$SID+1;
                  }else if($i==5){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD_DETAILS='".$head5."', CROP_DETAILS='".$crop5."' WHERE CASE_ID ='".$caseid."'AND SID ='".$SID."'";
                   $SID=$SID+1;
                  }else if($i==6){
                   $sql="UPDATE crm_adv_detail SET ADV_HEAD ='".$other1."',ADV_HEAD_DETAILS='".$other2."', CROP_DETAILS='".$other3."' WHERE CASE_ID ='".$caseid."' AND SID ='".$SID."'";
                   $SID=$SID+1;
                   }
                    $this->db->query($sql);
              }
         }
         $ret_id = $this->db->countAffected();   
         return $ret_id;
    }
     //***********************appMycaseAdvisoryCasesUpdate  End **********************//
}


