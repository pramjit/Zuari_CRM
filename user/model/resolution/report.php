<?php

class Modelresolutionreport extends Model {
    
    public function getmissedcallData($data){
    
    /*
     * 18-Missed Call
     * 4-busy
     * 6-not reachable
     * 11-attempt later
     * 12-not intersted
     * 13-dnd
     * 22-switch off
     * 23-not picking
     */
         
        $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE, mas_callstatus.STATUS_NAME AS 'STATUS'
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON (cc_incomingcall.STATE=ms_mobilestate.stateid)
            LEFT JOIN mas_callstatus
            ON (cc_incomingcall.`STATUS` = mas_callstatus.STATUS_ID)
            where cc_incomingcall.status in(18,4,6,11,12,13,22,23)
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state,mas_callstatus.STATUS_NAME";
  
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
        $sql="select SID,`NAME` from voc_user where ACT=1 LIMIT 1";
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
        $farname=str_replace("'", "", $farname);
        
        $farfaname= $data['far-fa-name'];
        $farfaname=str_replace("'", "", $farfaname);
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
        $farremarks=str_replace("'", "", $farremarks);
        
    
    //****************** COMPLAIN TAB DATA *******************//
        $comprocat= $data['procat'];
        $comprodata   = $data['prodata'];
        $comcat   = $data['comcat'];
        $comtype  = $data['comdata'];
        $comdtls  = $data['comdtls'];
        $comdtls=str_replace("'", "", $comdtls);
        $far_id = $case_id = rand(1000000000,9999999999); //Unique Farmer/Case ID
        $adv_pin = rand(1000, 9999); //Unique Adv Pin
        $adv_id = 12;
        
        $cr_date=date("Y-m-d");
        $cr_time=date("H:i:s");
        if($calsts==4 ||
           $calsts==5 || 
           $calsts==6 || 
           $calsts==11 || 
           $calsts==12 || 
           $calsts==13 || 
           $calsts==14 || 
           $calsts==17 || 
           $calsts==22 || 
           $calsts==23 && $empsts==""){
            
                $sqlprests="select status from cc_incomingcall where mobile='".$farmob."'";
                $authority=$this->db->query($sqlprests);
                $pre_sts=$authority->row['status'];
                $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                $this->db->query($sqltrans);
                $ret_id = $this->db->countAffected(); 
                if($ret_id==1){
                    if($pre_sts==$calsts)
                    {
                        return 1;
                    }
                    else{
                        //return 1;
                        $sqlcc="update cc_incomingcall set status='".$calsts."' where mobile='".$farmob."'";
                        $this->db->query($sqlcc);
                        $ret_id2 = $this->db->countAffected();
                        if($ret_id2==1){
                            return 1;
                        }
                        else{
                            return 0;
                        }
                    }
                }
                else{
                    return 0;
                }
        }
        
        
        
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
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
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
                `CALL_STATUS` = '".$calsts."',
                `EMP_STATUS` = '".$empsts."',
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
                    $tot_days=3;
                    $update = strtotime($cr_date);
                    $update = strtotime("+".$tot_days." day");
                    $due_date=date('Y-m-d', $update);
                    $sqlcom="INSERT INTO `crm_adv` set
                        `CASE_ID` ='".$case_id."',
                        `CASE_PIN`='".$adv_pin."',
                        `FAR_MOB` ='".$farmob."',
                        `CR_BY` ='".$cr_by."',
                        `ADV_ID`='".$adv_id."',
                        `CASE_STATUS`='7',
                        `CR_DATE` ='".$cr_date."',
                        `DUE_DATE`='".$due_date."',
                        `COMP_QUERY`='".$farremarks."'";
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
        if(($calsts==29 ||$calsts==30 ||$calsts==31 ||$calsts==33 ||$calsts==34 ) && $empsts==1)//AGRO PRODUCT, NETWORK, SERVICE, SUGGESTION, FEEDBACK + FARMER
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
                `CALL_STATUS` = '".$calsts."',
                `EMP_STATUS` = '".$empsts."',
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
           }//END PRODUCT, SERVICE, NETWORK, SUGGESTION, FEEDBACK + FARMER
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
}


