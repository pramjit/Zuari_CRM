<?php

class Modelcallfeedback extends Model {
    
    public function getfeedbackData($data){
    
    $log=new Log("feedback.log");
         
        $sql="SELECT crc.comp_mobile AS 'MOBILE', IFNULL(msm.state,'NA')AS 'STATE', DATE(mod_date) AS 'DATE_RECEIVED'
            FROM crm_case crc
            LEFT JOIN cc_incomingcall cci ON(crc.COMP_MOBILE = cci.MOBILE)
            LEFT JOIN ms_mobilestate msm ON (cci.STATE=msm.stateid)
            WHERE crc.CASE_STATUS IN (5)
            GROUP BY crc.comp_mobile, msm.state, mod_date";
        $log->write($sql); 
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
    public function SaveFormData($data){
        $cr_by = $this->customer->getId();
    //***************** TOP SELECT BAR DATA ****************// 
        $calsts  = $data['call-sts'];
        $empsts  = $data['emp-sts'];
       
    //****************** DEALER TAB DATA *******************//
        $delid    = $data['del-id'];
        $delmob   = $data['del-mob'];
        $delname  = $data['del-name'];
        $delst    = $data['dselst'];
        $deldt    = $data['dseldt'];
        $deladd   = $data['del-add'];
        $delpin   = $data['del-pin'];
    
    //****************** FARMER TAB DATA *******************//
        $farname  = $data['far-name'];
        $farfaname= $data['far-fa-name'];
        $farmob   = $data['far-mob'];
        $farst    = $data['selst'];
        $fardt    = $data['seldt'];
        $faradd   = $data['far-add'];
        $farpin   = $data['far-pin'];
        $faraltno = $data['far-alt-no'];
        $farcrop1 = $data['crop1'];
        $farcrop1acr = $data['corp1-acr'];
        $farcrop2 = $data['crop2'];
        $farcrop2acr = $data['crop2-acr'];
        $fartotacr= $data['far-tot-acr'];
        $farremarks= $data['far-remarks'];
        
    
    //****************** COMPLAIN TAB DATA *******************//
        $comprocat= $data['procat'];
        $comprodata   = $data['prodata'];
        $comcat   = $data['comcat'];
        $comtype  = $data['comdata'];
        $comdtls  = $data['comdtls'];
        
        $far_id = $case_id = rand(1000000000,9999999999); //Unique Farmer/Case ID
        $adv_pin = rand(1000, 9999); //Unique Adv Pin
        
        
        $cr_date=date("Y-m-d");
        $cr_time=date("H:i:s");
        
        if($calsts==2 && $empsts==1)//COMPLAINT + FRAMER
        {
            $sql="insert into crm_farmer set 
                `FAR_ID` ='".$far_id."',
                `FAR_NAME`= '".$farname."',
                `FAR_FAT_NAME`= '".$farfaname."',
                `FAR_MOBILE` = '".$farmob."',
                `FAR_ALT_NUMBER`= '".$faraltno."',
                `STATE_ID`= '".$farst."',
                `DISTRICT_ID`= '".$fardt."',
                `ADDRESS` = '".$faradd."',
                `PIN_CODE` = '".$farpin."',
                `ZO_ID` = 0,
                `RO_ID` = 0,
                `TERR_ID`= 0,
                `RABI_CROP`= '".$farcrop1."',
                `RABI_ACERAGE`= '".$farcrop1acr."',
                `KHARIF_CROP`= '".$farcrop2."',
                `KHARIF_ACERAGE`= '".$farcrop2acr."',
                `ACERAGE` = '".$fartotacr."',
                `FAR_STATUS` = '1',
                `FAR_REMARKS` = '".$farremarks."',
                `CR_BY`= '".$cr_by."',
                `CR_DATE`= '".$cr_date ."'";
                $this->db->query($sql);
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
                    //**************** INSERT INTO COMPLAINT*******************//
                   $sqlraa="select USER_RES as 'RA_ID',CYCLE_RES as 'RA_DAYS', 
                            USER_APP as 'AA_ID', CYCLE_APP as 'AA_DAYS'
                            from crm_case_assign 
                            where PRODUCT_CATG='".$comprocat."' and COMPLAIN_CATG='".$comcat."' and COMPLAIN_TYPE= '".$comtype."'and act=1"; 
                    $authority=$this->db->query($sqlraa);
                    $ra_id=$authority->row['RA_ID'];
                    $ra_days=$authority->row['RA_DAYS'];
                    $aa_id=$authority->row['AA_ID'];
                    $aa_days=$authority->row['AA_DAYS'];
                    $tot_days=$ra_days+$aa_days;
                    $update = strtotime($cr_date);
                    $update = strtotime("+".$tot_days." day");
                    $due_date=date('Y-m-d', $update);
                    $sqlcom="insert into `crm_case` set
                    `CASE_ID`='".$case_id."',
                    `ADV_CASE_PIN` ='0',
                    `COMP_MOBILE` ='".$farmob."',
                    `CR_BY` ='".$cr_by."',
                    `PROD_ID` ='".$comprodata."',
                    `PROD_CATG` ='".$comprocat."',
                    `COMP_CATG` ='".$comcat."',
                    `COMP_TYPE` ='".$comtype."',
                    `COMP_RA` ='".$ra_id."',
                    `COMP_AA` ='".$aa_id."',
                    `COMP_ADV` ='0',
                    `ZO_ID` ='0',
                    `RO_ID` ='0',
                    `TERR_ID` ='0',
                    `CR_SOURCE` ='2',
                    `CR_DATE`='".$cr_date."',
                    `CASE_STATUS`='7',
                    `CASE_PRIO` ='0',
                    `DUE_DATE` ='".$due_date."',
                    `COMPLAINT_QUERY` ='".$comdtls."',
                    `COMPLAINT_REMARKS` ='".$comdtls."'";
                    
                    $this->db->query($sqlcom);
                    $ret_id2 = $this->db->countAffected();  
                    if($ret_id2==1){
                        //return 1;
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."'";
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1){
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."' where mobile='".$farmob."'";
                            $this->db->query($sqlcc);
                            $ret_id4 = $this->db->countAffected(); 
                            if($ret_id4==1){
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
                    else{
                        return 0;
                    }
                                        
                }
                else {
                    return 0;
                }
        }//END COMPLAINT + FARMER
        if($calsts==32 && $empsts==1)//AGRO ADVISORY + FARMER
        {
            $sql="insert into crm_farmer set 
                `FAR_ID` ='".$far_id."',
                `FAR_NAME`= '".$farname."',
                `FAR_FAT_NAME`= '".$farfaname."',
                `FAR_MOBILE` = '".$farmob."',
                `FAR_ALT_NUMBER`= '".$faraltno."',
                `STATE_ID`= '".$farst."',
                `DISTRICT_ID`= '".$fardt."',
                `ADDRESS` = '".$faradd."',
                `PIN_CODE` = '".$farpin."',
                `ZO_ID` = 0,
                `RO_ID` = 0,
                `TERR_ID`= 0,
                `RABI_CROP`= '".$farcrop1."',
                `RABI_ACERAGE`= '".$farcrop1acr."',
                `KHARIF_CROP`= '".$farcrop2."',
                `KHARIF_ACERAGE`= '".$farcrop2acr."',
                `ACERAGE` = '".$fartotacr."',
                `FAR_STATUS` = '1',
                `FAR_REMARKS` = '".$farremarks."',
                `CR_BY`= '".$cr_by."',
                `CR_DATE`= '".$cr_date ."'";
                $this->db->query($sql);
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
                    //**************** INSERT INTO COMPLAINT*******************//
                   $sqlraa="select USER_RES as 'RA_ID',CYCLE_RES as 'RA_DAYS', 
                            USER_APP as 'AA_ID', CYCLE_APP as 'AA_DAYS'
                            from crm_case_assign 
                            where PRODUCT_CATG='".$comprocat."' and COMPLAIN_CATG='".$comcat."' and COMPLAIN_TYPE= '".$comtype."'and act=1"; 
                    $authority=$this->db->query($sqlraa);
                    $ra_id=$authority->row['RA_ID'];
                    $ra_days=$authority->row['RA_DAYS'];
                    $aa_id=$authority->row['AA_ID'];
                    $aa_days=$authority->row['AA_DAYS'];
                    $tot_days=$ra_days+$aa_days;
                    $update = strtotime($cr_date);
                    $update = strtotime("+".$tot_days." day");
                    $due_date=date('Y-m-d', $update);
                    $sqlcom="insert into `crm_case` set
                    `CASE_ID`='".$case_id."',
                    `ADV_CASE_PIN` ='".$adv_pin."',
                    `COMP_MOBILE` ='".$farmob."',
                    `CR_BY` ='".$cr_by."',
                    `PROD_ID` ='".$comprodata."',
                    `PROD_CATG` ='".$comprocat."',
                    `COMP_CATG` ='".$comcat."',
                    `COMP_TYPE` ='".$comtype."',
                    `COMP_RA` ='".$far_id."',
                    `COMP_AA` ='".$far_id."',
                    `COMP_ADV` ='".$far_id."',
                    `ZO_ID` ='0',
                    `RO_ID` ='0',
                    `TERR_ID` ='0',
                    `CR_SOURCE` ='2',
                    `CR_DATE`='".$cr_date."',
                    `CASE_STATUS`='7',
                    `CASE_PRIO` ='0',
                    `DUE_DATE` ='".$due_date."',
                    `COMPLAINT_QUERY` ='".$comdtls."',
                    `COMPLAINT_REMARKS` ='".$comdtls."'";
                    
                    $this->db->query($sqlcom);
                    $ret_id2 = $this->db->countAffected();  
                    if($ret_id2==1){
                        //return 1;
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."'";
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1){
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."' where mobile='".$farmob."'";
                            $this->db->query($sqlcc);
                            $ret_id4 = $this->db->countAffected(); 
                            if($ret_id4==1){
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
                    else{
                        return 0;
                    }
                                        
                }
                else {
                    return 0;
                }
        }//END AGRO ADVISORY + FARMER
        if(($calsts==29 ||$calsts==30 ||$calsts==31 ||$calsts==33 ||$calsts==34 ) && $empsts==1)//AGRO PRODUCT, NETWORK, SERVICE, SUGGESTION, feedback + FARMER
        {
            $sql="insert into crm_farmer set 
                `FAR_ID` ='".$far_id."',
                `FAR_NAME`= '".$farname."',
                `FAR_FAT_NAME`= '".$farfaname."',
                `FAR_MOBILE` = '".$farmob."',
                `FAR_ALT_NUMBER`= '".$faraltno."',
                `STATE_ID`= '".$farst."',
                `DISTRICT_ID`= '".$fardt."',
                `ADDRESS` = '".$faradd."',
                `PIN_CODE` = '".$farpin."',
                `ZO_ID` = 0,
                `RO_ID` = 0,
                `TERR_ID`= 0,
                `RABI_CROP`= '".$farcrop1."',
                `RABI_ACERAGE`= '".$farcrop1acr."',
                `KHARIF_CROP`= '".$farcrop2."',
                `KHARIF_ACERAGE`= '".$farcrop2acr."',
                `ACERAGE` = '".$fartotacr."',
                `FAR_STATUS` = '1',
                `FAR_REMARKS` = '".$farremarks."',
                `CR_BY`= '".$cr_by."',
                `CR_DATE`= '".$cr_date ."'";
                $this->db->query($sql);
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
                    // return 1; 
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."'";
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1)
                        {
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."' where mobile='".$farmob."'";
                            $this->db->query($sqlcc);
                            $ret_id4 = $this->db->countAffected(); 
                            if($ret_id4==1){
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
                else {
                    return 0;
                }
           }//END PRODUCT, SERVICE, NETWORK, SUGGESTION, feedback + FARMER
           if($calsts==4 ||$calsts==5 ||$calsts==6 ||$calsts==11 ||$calsts==12 ||$calsts==13 ||$calsts==14 ||$calsts==17 ||$calsts==22 ||$calsts==23 ) //AGRO ADVISORY + FARMER
           {
                $sqlprests="select status from cc_incomingcall where mobile='".$farmob."'";
                $authority=$this->db->query($sqlprests);
                $pre_sts=$authority->row['status'];
                $sqltrans="insert into crm_status_trans set 
                            `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                $this->db->query($sqltrans);
                $ret_id3 = $this->db->countAffected(); 
                if($ret_id3==1)
                {
                    //return 1;
                    $sqlcc="update cc_incomingcall set status='".$calsts."' where mobile='".$farmob."'";
                    $this->db->query($sqlcc);
                    $ret_id4 = $this->db->countAffected(); 
                    if($ret_id4==1){
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
    
    public function FeedFarData($data)
    {
        $mob=$data['mob'];
        $log=new Log("feedfardata.log");
        $sql="select 
                    crf.FAR_NAME,
                    crf.FAR_FAT_NAME,
                    crf.FAR_ALT_NUMBER,
                    crf.STATE_ID,
                    crf.DISTRICT_ID,
                    crf.PIN_CODE,
                    crf.RABI_CROP,
                    crf.RABI_ACERAGE,
                    crf.KHARIF_CROP,
                    crf.KHARIF_ACERAGE,
                    crf.ACERAGE,
                    crf.FAR_REMARKS,
                    crf.CALL_STATUS,
                    crf.EMP_STATUS,
                    crf.ADDRESS,
                    crf.FAR_MOBILE,
                    crc.PROD_CATG,
                    crc.PROD_ID,
                    crc.COMP_CATG,
                    crc.COMP_TYPE,
                    crc.COMPLAINT_REMARKS,
                    crc.CASE_ID
                    from crm_farmer crf
                    left join crm_case crc on(crf.far_mobile = crc.comp_mobile)
                    where crf.far_mobile='".$mob."'";
        $log->write($mob);
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function subccdata($data){
        $caseid=$data['fed-case-id'];
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
            $sql="update crm_case set case_status='8', COMPLAINT_FEEDBACK='".$remarks."',COMPLAINT_SATISFY='".$satisfy."' where case_id='".$caseid."'";
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


