<?php

class Modelcallappservice extends Model {
    
    public function getServiceData($data){
    
        $log=new Log("AppServiceCC".date('Y_m_d').".log");
        $cr_by = $this->customer->getId();
        $sql="SELECT app_services.SID,
            (CASE 
                    WHEN ServiceType=1 THEN 'SERVICE QUERY' 
                    WHEN ServiceType=2 THEN 'ASK OUR EXPERT' 
                    WHEN ServiceType=3 THEN 'PURCHASE INTEREST' 
                    WHEN ServiceType=4 THEN 'SOIL TEST' 
                    WHEN ServiceType=5 THEN 'LEAF TEST' 
                    WHEN ServiceType=6 THEN 'WATER TEST'
                    ELSE 'OTHER' 
            END) AS 'SER',
            Mobile AS 'MOB', 
            ARC.RTLR_CODE AS 'PIN',ARC.CALL_COUNT AS 'TOT_ATTEMPT',
            DATE_FORMAT(CrDate,'%d-%m-%Y') AS 'CR_DATE' 
            FROM app_services 
            LEFT JOIN ak_retailers_call ARC ON(ARC.MOBILE_NO=app_services.Mobile AND ARC.CALL_TYPE=3 )
            WHERE 
                StateId IN(SELECT state_id FROM ak_agent_geo WHERE cc_agent_id=$cr_by) 
		AND ServiceStatus=0 
		AND ServiceType NOT IN(2,3,4,0) 
		AND ARC.CALL_COUNT < 3
            GROUP BY ServiceType,Mobile 
            ORDER BY CrDate DESC";  
        $log->write($sql); 
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
    
  public function getfeedbackDatacount($data){
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
     public function MoData($dtid){
        $sql="SELECT mo_office_geo_code AS 'MO_ID', mo_office_name AS 'MO_NAME'
        from crm_mo_office 
        WHERE district_geo_code=(SELECT geo_code from mas_pol_geo WHERE geo_id='".$dtid."')";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function CropData(){
        $sql="select CROP_ID, CROP_DESC from mas_crop";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdData($catid){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=2 and PRODUCT_PAR='".$catid."' and ACT=1";
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
    //********************************SAVE FORM DATA **************************//
    public function SaveFormData(){
        $log=new Log("CcAppService".DATE('d_m_Y').".log");
        $log->write($this->request->post);
        $data=$this->request->post;
        $cr_by = $this->customer->getId();
        $app_cid=$data['app-cid'];
        $app_pin=$data['app-pin'];
        $app_frm=$data['app-frm'];
        $cr_date=date('Y-m-d');
        $cr_time=date('H:i:s');
        $cr_datetime=date('Y-m-d H:i:s');
        //******************************* FORM DATA ****************************//
            $app_sd =$data['app-sd'];
            $app_dd =$data['app-dd'];
            $app_md =$data['app-md'];
            if(empty($app_md)){$app_md=0;}
            $app_usr=$data['app-usr'];
            $app_pro=$data['app-pro'];
            $app_ser=$data['app-ser'];
            $app_sto=$data['app-sto'];
            $app_qty=$data['app-qty'];
            $app_odr=$data['app-odr'];
            $app_qry=addslashes($data['app-qry']);
            $app_ans=$data['app-ans'];
            $app_sol=addslashes($data['app-sol']);
            if(empty($app_sol)){$app_sol='NA';}
            $app_cal=$data['app-cal'];
            $app_up_by  =$data['app-up-by'];
        //******************************* FORM DATA ****************************//
            
        $stsql="SELECT IFNULL(GEO_ID,728) AS 'STID', IFNULL(`NAME`,'OTHER') AS 'STNM' FROM mas_pol_geo WHERE GEO_ID='".$app_sd."' LIMIT 0,1";
        $log->write("State Data: ".$stsql);
        $query = $this->db->query($stsql);
        $log->write($query->row);
        $StateId=$query->row['STID'];   if(empty($StateId)){$StateId='728';}// For Other State
        $StateName=$query->row['STNM']; if(empty($StateName)){$StateName='OTHER';}
        //******************************* UPDATE APP SERVICE DATA ****************************//    
        if($app_cal==1)
        {
        
        $sqlup="UPDATE app_services SET
		`ServiceType`='".$app_ser."',
		`StateId`='".$StateId."',
		`StateName`='".$StateName."',
                `DistrictId`='".$app_dd."',
                `Query`='".$app_qry."', 
		`ProductName`='".$app_pro."',
		`OrderId`='".$app_odr."',
		`Quantity`='".$app_qty."',
		`CustomerName`='".$app_usr."',
		`StoreName`='".$app_sto."',
		`UpDate`='".$cr_date."',
		`UpBy`='".$app_up_by."',`AssignTo`='".$app_md."',`ServiceStatus`=1, `CallStatus`=2 WHERE SID='".$app_cid."'";
       	$log->write("Query Data: ".$sqlup);
	if($query = $this->db->query($sqlup)){
		//return 1;
            if($app_ser!=2)// Not An Advisory Service Request
            {
            //======================================= Non Advisory Services ==========================//
            //Fetching Mo Details
                    $mosql="select mo_user_id from crm_mo_office where district_id='".$app_dd."' and mo_office_geo_code='".$app_md."'";
                    $log->write("Find MO: ".$mosql);
                    $chkmo=$this->db->query($mosql);
                    $mo_id=$chkmo->row['mo_user_id'];
                    $log->write("Find MO ID: ".$mo_id);
                    if(empty($mo_id)){$mo_id=0;}
                    //Generate Unique Case Id
                    $t = microtime(true);
                    $micro = sprintf("%02d",($t - floor($t)) * 100);
                    $utc = date('ymdHis', $t).$micro;
                    $case_id=$utc;
              //*************************************FETCH MO_ID END*************************************//
                        $sqlcom="insert into `crm_case` set
                        `CASE_ID`='".$case_id."',
                        `ADV_CASE_PIN` ='0',
                        `COMP_MOBILE` ='".$app_frm."',
                        `CR_BY` ='".$cr_by."',
                        `PROD_GROUP`= '0',
                        `PROD_ID` ='0',
                        `PROD_CATG` ='0',
                        `PROD_BRAND`='NA',
                        `PROD_IMP`='0',
                        `PROD_BATCH`='NA',
                        `PROD_PLANT`='NA',
                        `PROD_PAKG`='NA',
                        `COMP_CATG` ='NA',
                        `COMP_TYPE` ='NA',
                        `COMP_RA` ='0',
                        `COMP_AA` ='0',
                        `COMP_ADV` ='0',
                        `ZO_ID` ='0',
                        `RO_ID` ='0',
                        `TERR_ID` ='0',
                        `MO_ID` ='".$app_md."',
                        `COMP_MO` ='".$mo_id."',
                        `CR_SOURCE` ='2',
                        `IS_COMP_SOL`='".$app_ans."',
                        `CR_DATE`='".$cr_datetime."',
                        `CASE_STATUS`='7',
                        `CASE_PRIO` ='".$app_ans."',
                        `DUE_DATE` ='".$cr_date."',
                        `COMPLAINT_QUERY` ='".$app_qry."',
                        `COMPLAINT_REMARKS` ='".$app_sol."',`COMP_SOURCE`=2";
                        
                        $log->write("CRM_NON_ENTRY: ".$sqlcom);
                        $this->db->query($sqlcom);
                        
                        
                       //********************* IF SOL PROVIDED ****************//
                        if($app_ans==1){
                            $sql="insert into crm_case_detail set 
                                case_id='".$case_id."',
                                case_pre_status='7',
                                case_cur_status='99',
                                solution='".$app_sol."',
                                ra_remarks='".$app_sol."',
                                ra_date='".$cr_date."',
                                aa_remarks='".$app_sol."',
                                aa_date='".$cr_date."',
                                cr_date='".$cr_date."',
                                up_user_id='".$cr_by."',
                                up_file_path='NA'";
                                $this->db->query($sql);
                                $ret_id = $this->db->countAffected();  
                                if($ret_id==1){
                                    $sql="update crm_case set case_status='27' where case_id='".$case_id."'";
                                    $this->db->query($sql);
                                    $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$case_id."',`CASE_MOBILE` = '".$app_frm."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '18',`TO_STATUS` = '101',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                                    $log->write("CASE_TRANS: ".$sqltrans);
                                    $this->db->query($sqltrans);
                                    return 1;
                                }
                        }
                       
                        //======================================= Non Advisory Services End ==========================//
                        $sqltrans="insert into crm_status_trans set 
                        `CASE_ID` = '".$case_id."',`CASE_MOBILE` = '".$app_frm."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '18',`TO_STATUS` = '101',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $log->write("CASE_TRANS: ".$sqltrans);
                        if($this->db->query($sqltrans)){
                            $upd_ak_rtlr_call="UPDATE ak_retailers_call SET CALL_STATUS=99, CALL_COUNT=CALL_COUNT+1 WHERE CALL_TYPE=3 AND MOBILE_NO='".$app_frm."'";
                            $this->db->query($upd_ak_rtlr_call);
                            return $case_id;
                        }else{
                                return 0;
                        }
                    }
                    else{// Advisory Service Request
                        return 0;
                    }
                }else{
                    return 0;
                }
        }
        else if($app_cal=2){
            $upd_ak_rtlr_call="UPDATE ak_retailers_call SET CALL_STATUS=1, CALL_COUNT=CALL_COUNT+1 WHERE CALL_TYPE=3 AND MOBILE_NO='".$app_frm."' AND RTLR_CODE='".$app_pin."'";
            $this->db->query($upd_ak_rtlr_call);
            $chkctr=$this->db->query("SELECT CALL_COUNT FROM ak_retailers_call WHERE RTLR_CODE='".$app_pin."'");
            $ctr=$chkctr->row['CALL_COUNT'];
            if($ctr>=3){
                $sqlup="UPDATE app_services SET
		`UpDate`='".$cr_date."',
		`UpBy`='".$app_up_by."',`ServiceStatus`=3, `CallStatus`=3, WHERE SID='".$app_cid."'";
            }
            return 1;
        }
        else{
             $sqlup="UPDATE app_services SET
		`UpDate`='".$cr_date."',
		`UpBy`='".$app_up_by."',`ServiceStatus`=3, `CallStatus`=3, WHERE SID='".$app_cid."'";
            $upd_ak_rtlr_call="UPDATE ak_retailers_call SET CALL_STATUS=3, CALL_COUNT=CALL_COUNT+1 WHERE CALL_TYPE=3 AND MOBILE_NO='".$app_frm."'";
            $this->db->query($upd_ak_rtlr_call);
            return 1;
        }
            //******************************* UPDATE APP SERVICE DATA END****************************//        
    }
    public function CaseMailDtls($cid){
        //Check Case Type
        $chksql="select to_status as 'CASE_TYPE' from crm_status_trans where case_id='".$cid."'";
        $querychk = $this->db->query($chksql);
        $case_type=$querychk->row['CASE_TYPE'];
        if($case_type==2)
        {
            $sql="select crm_case.case_id as 'CID',crm_case.COMP_RA as 'RAID',DATEDIFF(crm_case.RA_DUE_DATE, crm_case.CR_DATE) as 'NOD' ,ak_customer.email as 'MID', concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 2 AS 'FLAG' from crm_case 
            left join ak_customer on(crm_case.COMP_RA=ak_customer.customer_id)
            where crm_case.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
        if($case_type==32)
        {
            $sql="select crm_adv.case_id as 'CID',crm_adv.ADV_ID as 'RAID',crm_adv.case_pin as 'NOD' ,ak_customer.email as 'MID', concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 32 AS 'FLAG' from crm_adv
                left join ak_customer on(crm_adv.adv_id=ak_customer.customer_id)
                where crm_adv.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
        if($case_type==29 || $case_type==30 || $case_type==31){
            $sql="select 
                crm_case.case_id as 'CID',
                crm_case.COMP_MO as 'RAID',
                2 as 'NOD',
                ak_customer.email as 'MID', 
                concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 
                (CASE 
                    WHEN IS_COMP_SOL=2 THEN '293031'
                    WHEN IS_COMP_SOL=2 THEN '1'
                    ELSE '0'
                END) AS 'FLAG' from crm_case
                left join ak_customer on(crm_case.COMP_MO=ak_customer.customer_id)
                where crm_case.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
        if($case_type==101){
            $sql="select 
                crm_case.case_id as 'CID',
                crm_case.COMP_MO as 'RAID',
                2 as 'NOD',
                ak_customer.email as 'MID', 
                concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 
                (CASE 
                    WHEN IS_COMP_SOL=2 THEN '293031'
                    WHEN IS_COMP_SOL=2 THEN '1'
                    ELSE '0'
                END) AS 'FLAG' from crm_case
                left join ak_customer on(crm_case.COMP_MO=ak_customer.customer_id)
                where crm_case.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
    }
    public function SerFarData($data)
    {
        $caseid=$data['caseid'];
        $log=new Log("SerFarData.log");
       
        $sql="SELECT * FROM app_services APS WHERE APS.SID='".$caseid."'";
        $log->write($caseid);
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function subccdata($data){
        $caseid=$data['fed-case-id'];
        $casemob=$data['fed-case-mob'];
        $remarks=$data['fed-cc-remarks'];
	$remarks=str_replace("'","",$remarks);
        $satisfy=$data['fed-satisfy'];
        $sqlprests="select case_status from crm_case where case_id='".$caseid."'";
        $authority=$this->db->query($sqlprests);
        $pre_sts=$authority->row['case_status'];
        $cr_date=date('Y-m-d');
        $cr_by = $this->customer->getId();
        $sqllastrec="SELECT crm_case_detail.CASE_ID AS 'CASE_ID',
			IFNULL(crm_case_detail.RA_REMARKS,'NA') AS 'RA_REMARKS',
			IFNULL(crm_case_detail.RA_DATE,'NULL') AS 'RA_DATE',
			IFNULL(crm_case_detail.AA_REMARKS,'NA') AS 'AA_REMARKS',
			IFNULL(crm_case_detail.AA_DATE,'NULL') AS 'AA_DATE',
                        IFNULL(crm_case_detail.CC_REMARKS,'NA') AS 'CC_REMARKS',
			IFNULL(crm_case_detail.CC_DATE,'NULL') AS 'CC_DATE',
                        IFNULL(crm_case_detail.UP_FILE_PATH,'NA') AS 'UP_FILE_PATH',
                        IFNULL(crm_case_detail.SOLUTION,'NA') AS 'SOLUTION'
			FROM crm_case_detail
			WHERE CASE_ID = '".$caseid."' ORDER BY SID DESC LIMIT 1";
        $lstqry=$this->db->query($sqllastrec);
        if($lstqry->num_rows==0){
            $ra_remarks='NA';
            $ra_date=NULL; 
            $aa_remarks='NA';
            $aa_date=NULL; 
            $cc_remarks='NA';
            $cc_date=NULL; 
            $filepath='NA';
            $commnts='NA';
        }
        else{
        $ra_remarks=$lstqry->row['RA_REMARKS'];
        $ra_date=$lstqry->row['RA_DATE'];
        $aa_remarks=$lstqry->row['AA_REMARKS'];
        $aa_date=$lstqry->row['AA_DATE'];
        $cc_remarks=$lstqry->row['CC_REMARKS'];
        $cc_date=$lstqry->row['CC_DATE'];
        $filepath=$lstqry->row['UP_FILE_PATH'];
        $commnts=$lstqry->row['SOLUTION'];
        }
        
        
        $sql="insert into crm_case_detail set 
                case_id='".$caseid."',
                case_pre_status='".$pre_sts."',
                case_cur_status='8',
                solution='".$commnts."',
                ra_remarks='".$ra_remarks."',
                ra_date='".$ra_date."',
                aa_remarks='".$aa_remarks."',
                aa_date='".$aa_date."',
                cc_remarks='".$cc_remarks."',
                cc_date='".$cc_date."',
                cr_date='".$cr_date."',
                up_user_id='".$cr_by."',
                up_file_path='".$filepath."'";
        $this->db->query($sql);
        $ret_id = $this->db->countAffected();  
        if($ret_id==1){
            $sql="update crm_case set case_status='99', COMPLAINT_FEEDBACK='".$remarks."',COMPLAINT_SATISFY='".$satisfy."' where case_id='".$caseid."' and comp_mobile='".$casemob."'";
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
    //****************** ENQUIRY TAB DATA *******************//
    /*  $enname   = $data['en-far-name'];
        $enfaname = $data['en-far-fa-name'];
        $envil    = $data['en-far-vil'];
        $enpost   = $data['en-post'];
        $entehsil = $data['en-tehsil'];
        $enpin    = $data['en-pin'];
        $enst     = $data['eselst'];
        $endt     = $data['eseldt'];
        $enmob    = $data['en-far-mob'];
        $enmob2   = $data['en-far-mob2'];
        $encrop   = $data['ecrop'];
        $encropacr= $data['ecrop-acr'];
        $entotacr = $data['ecrop-tot-acr'];
        $enprocat = $data['eprocat'];
        $enprodata= $data['eprodata'];
        $encat    = $data['ecat'];
        $entyp    = $data['etyp'];
        $endtls   = $data['en-dtls'];
        $endesc   = $data['en-desc'];
        $ensrc    = $data['en-src'];
        $enres    = $data['en-res'];
        $ensts    = $data['en-sts'];
        $enresdt  = $data['en-res-dt'];
        $enressol = $data['en-res-sol'];

     * 
     * 
     * 
     *  $sqldtl="insert into  `crm_case_detail` set
                            `CASE_ID` = '".$far_id."',
                            `CASE_PRE_STATUS`= '".$far_id."',
                            `CASE_CUR_STATUS`= '".$far_id."',
                            `CONV_DETAIL`= '".$far_id."',
                            `SOLUTION`= '".$far_id."',
                            `FURTHER_ACTION`= '".$far_id."',
                            `CR_DATE` = '".$far_id."',
                            `UP_USER_ID` = '".$far_id."',
                            `UP_USER_NAME`= '".$far_id."',
                            `UP_USER_EMAIL`= '".$far_id."',
                            `UP_FILE_PATH`= '".$far_id."'";
                        $this->db->query($sqldtl);
                        $ret_id3 = $this->db->countAffected();      */  
  
}


