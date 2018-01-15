<?php

class Modelfarmerregister extends Model {
    
    public function getmissedcallData($data){
    $log=new Log("CcMissedCallData.log");
    $cr_by = $this->customer->getId(); // Get CC AGENT CUSTOMER_ID
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
    $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE, mas_callstatus.STATUS_NAME AS 'STATUS', arc.RTLR_CODE AS 'PIN',TOT_ATTEMPT
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON (cc_incomingcall.STATE=ms_mobilestate.stateid)
            LEFT JOIN mas_callstatus
            ON (cc_incomingcall.`STATUS` = mas_callstatus.STATUS_ID)
						LEFT JOIN ak_retailers_call arc
						ON( cc_incomingcall.MOBILE = arc.MOBILE_NO)
            where cc_incomingcall.status in(18,4,6,11,12,13,22,23) 
						and cc_incomingcall.CALL_TYPE=2 
						and cc_incomingcall.KEY_PRESS=2 
						and cc_incomingcall.state in(select state_id from ak_agent_geo where cc_agent_id='".$cr_by."')
                                                and TOT_ATTEMPT < 3
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state,mas_callstatus.STATUS_NAME";
            $log->write($sql);
            
            
            //echo $sql;die;
            $query = $this->db->query($sql);
            return $query->rows;   
    }
    
    
    public function CallSts(){
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where ACT=1 and status_id NOT IN(27,35,99)";
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
    public function ProdDataCat($grid){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=2 and PRODUCT_PAR='".$grid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdData($catid,$stid){
        //$sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=3 and PRODUCT_PAR='".$catid."' and ACT=1";
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product
left join mas_product_geo on(mas_product.PRODUCT_ID = mas_product_geo.pro_id) 
where PRODUCT_TYPE=3 and PRODUCT_PAR='".$catid."' and ACT=1 and mas_product_geo.state_id in($stid,0)";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdBrand($proid){
        $sql="select `BRAND_1` AS 'BRAND1', `BRAND_2` AS 'BRAND2', `BRAND_3` AS 'BRAND3' from mas_product where PRODUCT_TYPE=3 and PRODUCT_ID='".$proid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->row;
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
    public function ZoneData(){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=10 ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function RegionData($zoid){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=11 AND ZO_ID='".$zoid."' ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function UserState($mob){
        $sql="select cc_incomingcall.state as 'STATE_ID',mas_pol_geo.`NAME` as 'STATE_NAME'  from cc_incomingcall 
left join mas_pol_geo on(cc_incomingcall.state = mas_pol_geo.geo_id)
where MOBILE='".$mob."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function UserGeo($stid){
        $sql="select 
        mpg.GEO_ID AS 'STATE_ID',
        mpg.`NAME` AS 'STATE_NAME',
        mpgz.GEO_ID AS 'ZONE_ID',
        mpgz.`NAME` AS 'ZONE_NAME',
        mpgr.GEO_ID AS 'REGION_ID',
        mpgr.`NAME` AS 'REGION_NAME'
        from mas_pol_geo mpg
        LEFT JOIN mas_pol_geo mpgz on(mpg.ZO_ID=mpgz.GEO_ID)
        LEFT JOIN mas_pol_geo mpgr on(mpg.RO_ID=mpgr.GEO_ID)
        WHERE mpg.GEO_ID='".$stid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function MoData($dtid){
        $sql="SELECT mo_office_geo_code AS 'MO_ID', mo_office_name AS 'MO_NAME'
        from crm_mo_office 
        WHERE district_geo_code=(SELECT geo_code from mas_pol_geo WHERE geo_id='".$dtid."')";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function LocalGEO($geocode){
        $sql="select GEO_ID,`NAME` from mas_pol_geo where GEO_CODE='".$geocode."'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    



    //********************************SAVE FORM DATA **************************//
    public function SaveFormData($data){
        $cr_by = $this->customer->getId();
        $log=new Log("SaveFormData.log");
        $log->write($data);
    //***************** TOP SELECT BAR DATA ****************// 
        $calsts  = $data['call-sts'];
        $empsts  = $data['emp-sts'];
    //******************Xtra Data *************************//
        $ApiFarmerCode= $data['ApiFarmerCode'];
        $ApiFarmerLive= $data['ApiFarmerLive'];
        $ApiFarmerType= $data['ApiFarmerType'];
    //****************** DEALER TAB DATA *******************//
        $delid    = $data['del-id'];
        $delmob   = $data['del-mob'];
        $delname  = $data['del-name'];
        $delst    = $data['dselst'];
        $deldt    = $data['dseldt'];
        $deladd   = $data['del-add'];
        $delpin   = $data['del-pin'];
    
    //****************** FARMER TAB DATA *******************//
        $zone = $data['zone'];
        $region = $data['region'];
        $state= $data['state'];
        $district= $data['district'];
        $mooffice= $data['mooffice'];
        $keydealeradventcode= $data['keydealeradventcode'];
        $keydealername= $data['keydealername'];
        $keydealerlocation= $data['keydealerlocation'];
        $keydealermobile= $data['keydealermobile'];
        $keyretailername= $data['keyretailername'];
        $keyretailermobile= $data['keyretailermobile'];
        $keyretailerlocation= $data['keyretailerlocation'];
        $fmsidofdealer= $data['fmsidofdealer'];
        $farmerfirstname= $data['farmerfirstname'];
        $farmermiddlename= $data['farmermiddlename'];
        $farmerlastname= $data['farmerlastname'];
        $farmervillage= $data['farmervillage'];
        $farmertaluka= $data['farmertaluka'];
        $farmermobile= $data['farmermobile'];
        $email= $data['email'];
        $isprogressivefarmer= $data['isprogressivefarmer'];
        $majorcrop1= $data['majorcrop1'];
        $acreage1= $data['acreage1'];
        $majorcrop2= $data['majorcrop2'];
        $acreage2= $data['acreage2'];
        $majorcrop3= $data['majorcrop3'];
        $acreage3= $data['acreage3'];
        $irrigatedacreage= $data['irrigatedacreage'];
        $dripirrigatedacreage= $data['dripirrigatedacreage'];
        $rainfedacreage= $data['rainfedacreage'];
        $issoiltestdone= $data['issoiltestdone'];
        $yearofsoiltest= $data['yearofsoiltest'];
        $remarks= $data['remarks']; $remarks=str_replace("'", "", $remarks);
        $farmob=$farmermobile;
    
    //****************** COMPLAIN TAB DATA *******************//
        $comcat   = $data['comcat'];
        $comtype  = $data['comdata'];
        
        
        $progrp =$data['progrp'];
        $procat=$data['procat'];
        $proname=$data['pro-name'];
        $probrand=$data['pro-brand'];
        $proimp=$data['pro-imp'];
        $probatch=$data['pro-batch'];
        $proplant=$data['pro-plant'];
        $propkgmy=$data['pro-pkg-my'];
        $comdtls  = $data['comdtls'];
        $comdtls=str_replace("'", "", $comdtls);                                                           
        
        $far_id = $case_id = rand(1000000000,9999999999); //Unique Farmer/Case ID
        //$adv_pin = rand(1000, 9999); //Unique Adv Pin
        //$adv_id = 12;
        
        $cr_date=date("Y-m-d");
		$cr_datetime=date("Y-m-d H:i:s");
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
           $calsts==23 && $empsts=="0"){
            
                $log->write("In Single Status Section");
                $log=new Log("SingleStatus.log");
               
                $sqlprests="select status from cc_incomingcall where mobile='".$farmob."' and call_type = 2 and key_press=2";
                $log->write($sqlprests);
                $authority=$this->db->query($sqlprests);
                $pre_sts=$authority->row['status'];
                $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                $log->write($sqltrans);
                $this->db->query($sqltrans);
                $ret_id = $this->db->countAffected(); 
                if($ret_id==1){
                        //return 1;
                        $sqlcc="update cc_incomingcall set status='".$calsts."',tot_attempt=tot_attempt+1 where mobile='".$farmob."' and call_type = 2 and key_press=2";
                        $log->write($sqlcc);
                        $this->db->query($sqlcc);
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
        
        
        
        if($calsts==2 && $empsts==1)//COMPLAINT + FRAMER
        {
            $log->write("In Complaint + Farmer Section");
            $log=new Log("FarmerComplaint.log");
            //Check Farmer Data exist Or Not
            $chkfrm="select `FAR_MOBILE` from ak_farmer where `FAR_MOBILE` ='".$farmermobile."'";
            $log->write("Check far Exist : ".$chkfrm);
            $chkrow=$this->db->query($chkfrm);
            $farexmob=$chkrow->row['FAR_MOBILE'];
            if(empty($farexmob)){
            $log->write("New Farmer");
            $sql="insert into ak_farmer set 
                
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_MOBILE` ='".$farmermobile."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."'";

                $log->write("Farmer Entry : ".$sql);
                $this->db->query($sql);
            }
            else{
                $log->write("Old Farmer");
                
                $sqlup="update ak_farmer set 
                
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."' where `FAR_MOBILE` ='".$farmermobile."'";
                $log->write($sqlup);
                $this->db->query($sqlup);
            }
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
                    //**************** INSERT INTO COMPLAINT*******************//
                    //********************RA AA MAPPING************************//
                    //CHECK PROD_CATG AND MARK_TYPE
                    $sqlprotyp="select PRODUCT_CATG, MAP_TYPE,USER_RES,CYCLE_RES,USER_APP,CYCLE_APP from crm_case_assign where COMPLAIN_CATG='".$comcat."' and COMPLAIN_TYPE= '".$comtype."' and ACT=1";
                    $log->write("Check_Map_Type : ".$sqlprotyp);
                    $query=$this->db->query($sqlprotyp);
                    if($query->row['MAP_TYPE']==''||empty($query->row['MAP_TYPE'])||$query->row['MAP_TYPE']==0){//if map type null
                        
                        $sqlraaa="select USER_RES as 'RA_ID',CYCLE_RES as 'RA_DAYS', 
                                        USER_APP as 'AA_ID', CYCLE_APP as 'AA_DAYS'
                                        from crm_case_assign 
                                        where COMPLAIN_CATG='".$comcat."' 
                                        and COMPLAIN_TYPE= '".$comtype."'
                                        and act=1"; 
                        $log->write("Get_RA_AA : ".$sqlraaa);
                        $queryraaa=$this->db->query($sqlraaa);
                        $ra_days=$queryraaa->row['RA_DAYS'];
                        $ra_id=$queryraaa->row['RA_ID'];
                        if($ra_id==0 || $ra_id==''||empty($ra_id)){//NO Resolution Authority
                            $akra="select customer_id from ak_customer where region_id='".$region."' and customer_group_id=4";
                            $log->write("Get_RA_FROM_AK_CUSTOMER : ".$akra);
                            $queryra=$this->db->query($akra);
                            $ra_id=$queryra->row['cusomer_id'];
                            if(empty($ra_id)){$ra_id=0;}
                        }
                        $aa_days=$queryraaa->row['AA_DAYS'];
                        $aa_id=$queryraaa->row['AA_ID'];
                        if($aa_id==0 || $aa_id==''||empty($aa_id)){//NO Approval Authority
                            $akaa="select customer_id from ak_customer where zone_id='".$zone."' and customer_group_id=3";
                            $log->write("Get_AA_FROM_AK_CUSTOMER : ".$akaa);
                            $queryra=$this->db->query($akaa);
                            $aa_id=$queryra->row['cusomer_id'];
                            if(empty($aa_id)){$aa_id=0;}
                        }
                        
                        
                    }
                    if($query->row['MAP_TYPE']==1){//if map type=1
                        $log->write('MAP_TYPE=1');
                        $sqlraaa="select USER_RES as 'RA_ID',CYCLE_RES as 'RA_DAYS', 
                                        USER_APP as 'AA_ID', CYCLE_APP as 'AA_DAYS'
                                        from crm_case_assign 
                                        where PRODUCT_CATG='".$progrp."' 
                                        and COMPLAIN_CATG='".$comcat."' 
                                        and COMPLAIN_TYPE= '".$comtype."'
                                        and act=1"; 
                        $log->write("Get_RA_AA : ".$sqlraaa);
                        $queryraaa=$this->db->query($sqlraaa);
                        $ra_days=$queryraaa->row['RA_DAYS'];
                        $ra_id=$queryraaa->row['RA_ID'];
                        if($ra_id==0 || $ra_id==''||empty($ra_id)){//NO Resolution Authority
                            $akra="select customer_id from ak_customer where region_id='".$region."' and customer_group_id=4";
                            $log->write("Get_RA_FROM_AK_CUSTOMER : ".$akra);
                            $queryra=$this->db->query($akra);
                            $ra_id=$queryra->row['cusomer_id'];
                            if(empty($ra_id)){$ra_id=0;}
                        }
                        $aa_days=$queryraaa->row['AA_DAYS'];
                        $aa_id=$queryraaa->row['AA_ID'];
                        if($aa_id==0 || $aa_id==''||empty($aa_id)){//NO Approval Authority
                            $akaa="select customer_id from ak_customer where zone_id='".$zone."' and customer_group_id=3";
                            $log->write("Get_AA_FROM_AK_CUSTOMER : ".$akaa);
                            $queryra=$this->db->query($akaa);
                            $aa_id=$queryra->row['cusomer_id'];
                            if(empty($aa_id)){$aa_id=0;}
                        }
                    }
                    if($query->row['MAP_TYPE']==2){//if map type=2
                        $log->write('MAP_TYPE=2');
                        $sqlraaa="select USER_RES as 'RA_ID',CYCLE_RES as 'RA_DAYS', 
                                        USER_APP as 'AA_ID', CYCLE_APP as 'AA_DAYS'
                                        from crm_case_assign 
                                        where PRODUCT_CATG='".$procat."' 
                                        and COMPLAIN_CATG='".$comcat."' 
                                        and COMPLAIN_TYPE= '".$comtype."'
                                        and act=1"; 
                        $log->write("Get_RA_AA : ".$sqlraaa);
                        $queryraaa=$this->db->query($sqlraaa);
                        $ra_days=$queryraaa->row['RA_DAYS'];
                        $ra_id=$queryraaa->row['RA_ID'];
                        if($ra_id==0 || $ra_id==''||empty($ra_id)){//NO Resolution Authority
                            $akra="select customer_id from ak_customer where region_id='".$region."' and customer_group_id=4";
                            $log->write("Get_RA_FROM_AK_CUSTOMER : ".$akra);
                            $queryra=$this->db->query($akra);
                            $ra_id=$queryra->row['cusomer_id'];
                            if(empty($ra_id)){$ra_id=0;}
                        }
                        $aa_days=$queryraaa->row['AA_DAYS'];
                        $aa_id=$queryraaa->row['AA_ID'];
                        if($aa_id==0 || $aa_id==''||empty($aa_id)){//NO Approval Authority
                            $akaa="select customer_id from ak_customer where zone_id='".$zone."' and customer_group_id=3";
                            $log->write("Get_AA_FROM_AK_CUSTOMER : ".$akaa);
                            $queryra=$this->db->query($akaa);
                            $aa_id=$queryra->row['cusomer_id'];
                            if(empty($aa_id)){$aa_id=0;}
                        }
                    }
                    if($query->row['MAP_TYPE']==5){//if map type=5 Mapped On August 11
                        $log->write('MAP_TYPE=5');
                        $ra_days=$query->row['CYCLE_RES'];
                        if(empty($ra_days)){$ra_days=0;}
                        //$ra_id=$query->row['RA_ID'];
                        $aa_days=$query->row['CYCLE_APP'];
                        if(empty($aa_days)){$aa_days=0;}
                        
                        $aa_id=$query->row['USER_APP'];
                        if(empty($aa_id)){$aa_id=0;}
                        
                        if((empty($query->row['PRODUCT_CATG']))||($query->row['PRODUCT_CATG']==$procat)){
                            $sqlgt="select geo_type from emp_case_assign where comp_cat='".$comcat."' and comp_type='".$comtype."' group by geo_type";
                            $querygt=$this->db->query($sqlgt);
                            
                            if($querygt->row['geo_type']==2){// RA Mapped By State
                                $sqlemp="select emp_id from emp_case_assign where comp_cat='".$comcat."' and comp_type='".$comtype."' and geo_id='".$state."' and geo_type=2";
                                $queryemp=$this->db->query($sqlemp);
                                $ra_id=$queryemp->row['emp_id'];
                                if(empty($ra_id)){$ra_id=0;}
                            }
                            else if($querygt->row['geo_type']==10){// RA Mapped By Zone
                                $sqlemp="select emp_id from emp_case_assign where comp_cat='".$comcat."' and comp_type='".$comtype."' and geo_id='".$zone."' and geo_type=10";
                                $queryemp=$this->db->query($sqlemp);
                                $ra_id=$queryemp->row['emp_id'];
                                if(empty($ra_id)){$ra_id=0;}
                            }
                            else{
                                $ra_id=0;
                            }
                        }
                        else {//Form Prod Category Not equal to Product Category get from form
                            $ra_id=0;
                        }
                    }
                    if($query->row['MAP_TYPE']==6){//if map type=6 Mapped On August 12
                        $log->write('MAP_TYPE=6');
                        $PB=  explode(',', $probrand);
                        $totpb=count($PB);
                        
                        $sqlgp="select USER_RES,CYCLE_RES,USER_APP,CYCLE_APP from crm_emp_case_assign 
                        where PRODUCT_CATG='".$procat."'
                        and PRODUCT='".$proname."'
                        
                        and COMPLAIN_CATG='".$comcat."' 
                        and COMPLAIN_TYPE='".$comtype."'";
                        for($x=0;$x<$totpb;$x++){
                            
                            if($x==0){
                                 $brand="%".$PB[$x]."%";
                                 $brnd="`BRAND` LIKE '".$brand."'";
                            }
                            if($x==1){
                               $brand="%".$PB[$x]."%";
                               $brnd.=" or `BRAND` LIKE '".$brand."'";
                            }
                            if($x==2){
                               $brand="%".$PB[$x]."%";
                               $brnd.=" or `BRAND` LIKE '".$brand."'";
                            }
                        }
                        $sqlgp.="and(".$brnd.")";
                        if($proimp==1){  
                        $sqlgp.=" and `MFG_IMP` LIKE '%Imported%'";
                            }
                        $log->write("BULK_RA_AA: ".$sqlgp);
                        $querygp=$this->db->query($sqlgp);
                        if(empty($querygp))// RA  NOT FOUND
                        {
                            $log->write("BULK_RA_AA: NOT FOUND");
                            $sql="delete from ak_farmer where far_id='".$far_id."'and far_mobile='".$farmermobile."'";
                            $log->write($sql);
                            $this->db->query($sql);
                            $ret_idd = $this->db->countAffected(); 
                            return 0;
                        }
                        $ra_days=$querygp->row['CYCLE_RES'];
                        if(empty($ra_days)){$ra_days=0;}
                        $ra_id=$querygp->row['USER_RES'];
                        if(empty($ra_id)){$ra_id=0;}
                        $aa_days=$querygp->row['CYCLE_APP'];
                        if(empty($aa_days)){$aa_days=0;}
                        $aa_id=$querygp->row['USER_APP'];
                        if(empty($aa_id)){$aa_id=0;}
                    }
                    //********************RA AA MAPPING END************************//
                    $tot_days=$ra_days+$aa_days;
                    $update = strtotime($cr_date);
                    $update = strtotime("+".$tot_days." day");
                    $due_date=date('Y-m-d', $update); //TOT_DUE_DATE
                    
                    $tot_days_ra=$ra_days;
                    $updatera = strtotime($cr_date);
                    $updatera = strtotime("+".$tot_days_ra." day");
                    $ra_due_date=date('Y-m-d', $updatera); //RA_DUE_DATE
                                        
                    $aa_due_date=$due_date;
					
					
                    $sqlcom="insert into `crm_case` set
                    `CASE_ID`='".$case_id."',
                    `ADV_CASE_PIN` ='0',
                    `COMP_MOBILE` ='".$farmob."',
                    `CR_BY` ='".$cr_by."',
                    `PROD_GROUP`= '".$progrp."',
                    `PROD_ID` ='".$proname."',
                    `PROD_CATG` ='".$procat."',
                    `PROD_BRAND`='".$probrand."',
                    `PROD_IMP`='".$proimp."',
                    `PROD_BATCH`='".$probatch."',
                    `PROD_PLANT`='".$proplant."',
                    `PROD_PAKG`='".$propkgmy."',
                    `COMP_CATG` ='".$comcat."',
                    `COMP_TYPE` ='".$comtype."',
                    `COMP_RA` ='".$ra_id."',
                    `RA_DUE_DATE` ='".$ra_due_date."', 
                    `COMP_AA` ='".$aa_id."',
                    `AA_DUE_DATE` ='".$aa_due_date."', 
                    `COMP_ADV` ='0',
                    `ZO_ID` ='".$zone."',
                    `RO_ID` ='".$region."',
                    `TERR_ID` ='0',
                    `CR_SOURCE` ='2',
                    `CR_DATE`='".$cr_datetime."',
                    `CASE_STATUS`='7',
                    `CASE_PRIO` ='0',
                    `DUE_DATE` ='".$due_date."',
                    `COMPLAINT_QUERY` ='".$comdtls."',
                    `COMPLAINT_REMARKS` ='".$comdtls."'";
                    $log->write("Complaint: ".$sqlcom);
                    $this->db->query($sqlcom);
                    $ret_id2 = $this->db->countAffected();  
                    if($ret_id2==1){
                        //return 1;
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."' and call_type = 2 and key_press=2";
                        $log->write("PRE_STATUS".$sqlprests);
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $log->write("STATUS_TRANS".$sqlprests);
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1){
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."',tot_attempt=tot_attempt+1 where mobile='".$farmob."' and call_type = 2 and key_press=2";
                            $log->write("UPDATE_CC_IN".$sqlprests);
                            $this->db->query($sqlcc);
                            $ret_id4 = $this->db->countAffected(); 
                            if($ret_id4==1){
                                return $case_id;
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
            $log->write("In Agro Advisory Section");
            $log=new Log("AgroAdvisory.log");
             //Check Farmer Data exist Or Not
            $chkfrm="select `FAR_MOBILE` from ak_farmer where `FAR_MOBILE` ='".$farmermobile."'";
            $log->write("Check far Exist : ".$chkfrm);
            $chkrow=$this->db->query($chkfrm);
            $farexmob=$chkrow->row['FAR_MOBILE'];
            if(empty($farexmob)){
            $log->write("New Farmer");
            $sql="insert into ak_farmer set 
                 
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_MOBILE` ='".$farmermobile."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."'";
                $log->write("AGRO_FARMER:".$sql);
                $this->db->query($sql);
                 }
            else{
                $log->write("Old Farmer");
                
                $sqlup="update ak_farmer set 
                
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."' where `FAR_MOBILE` ='".$farmermobile."'";
                $log->write($sqlup);
                $this->db->query($sqlup);
            }
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
                    //**************** INSERT INTO ADVISORY*******************//
                    //Find Advisory by state
					$chksql= "select case_pin from crm_adv where far_mob='".$farmob."' and case_status=7";
					$log->write("CHK FAR_MOB PIN ACTIVE :".$chksql);
                    $query=$this->db->query($chksql);
					$casepin=$query->row['case_pin'];
					if(empty($casepin))
					{					
						$advsql="SELECT CUST_ID FROM emp_geo_map WHERE GEO_TYPE_ID=2 AND GEO_ID='".$state."'";
						$log->write("ADV_ID:".$advsql);
						$query=$this->db->query($advsql);
						$adv_id=$query->row['CUST_ID'];
						if(empty($adv_id)){$adv_id=0;}
						//CASE PIN
						$pinsql="select case_pin from `crm_adv` order by case_pin DESC LIMIT 1";
						$log->write("ADV_PIN:".$pinsql);
						$query=$this->db->query($pinsql);
						$pin = $query->row['case_pin']+1;
						
						$sqlcom="INSERT INTO `crm_adv` set
							`CASE_ID` ='".$case_id."',
							`CASE_PIN`='".$pin."',
							`FAR_MOB` ='".$farmob."',
							`CR_BY` ='".$cr_by."',
							`ADV_ID`='".$adv_id."',
							`CASE_STATUS`='7',
							`CR_DATE` ='".$cr_datetime."',
							`DUE_DATE`='".$cr_date."',
							`COMP_QUERY`='".$remarks."'";
					}	
					else{
						$sqlcom="UPDATE `crm_adv` set `COMP_QUERY`='".$remarks."' WHERE `CASE_PIN`='".$casepin."' AND `FAR_MOB` ='".$farmob."'";
							
					}
						
                    $log->write("CRM_ADV_ENTRY: ".$sqlcom);
                    $this->db->query($sqlcom);
                    $ret_id2 = $this->db->countAffected();  
                    if($ret_id2==1){
                        //return 1;
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."' and call_type = 2 and key_press=2";
                        $log->write("PRE_STS".$sqlprests);
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $log->write("CRM_STATUS_TRANS".$sqltrans);
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1){
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."',tot_attempt=tot_attempt+1 where mobile='".$farmob."' and call_type = 2 and key_press=2";
                            $log->write("UPDATE_CC_IN".$sqlcc);
                            $this->db->query($sqlcc);
                            $ret_id4 = $this->db->countAffected(); 
                            if($ret_id4==1){
                                return $case_id;
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
        if(($calsts==29 ||$calsts==30 ||$calsts==31 ||$calsts==33 ||$calsts==34  ||$calsts==36) && $empsts==1)//AGRO PRODUCT, NETWORK, SERVICE, SUGGESTION, FEEDBACK + FARMER
        {
            $log->write("In Services Section");
            $log=new Log("AgroProduct.log");
             //Check Farmer Data exist Or Not
            $chkfrm="select `FAR_MOBILE` from ak_farmer where `FAR_MOBILE` ='".$farmermobile."'";
            $log->write("Check far Exist : ".$chkfrm);
            $chkrow=$this->db->query($chkfrm);
            $farexmob=$chkrow->row['FAR_MOBILE'];
            if(empty($farexmob)){
            $log->write("New Farmer");
            $sql="insert into ak_farmer set 
                
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_MOBILE` ='".$farmermobile."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."'";
                $log->write("Service_Farmer_Entry: ".$sql);
                $this->db->query($sql);
                 }
            else{
                $log->write("Old Farmer");
                
                $sqlup="update ak_farmer set 
                
                `FAR_ID` ='".$far_id."',
                `ZO_ID` ='".$zone."',
                `RO_ID` ='".$region."',
                `STATE_ID` ='".$state."',
                `DISTRICT_ID` ='".$district."',
                `MO_OFFICE` ='".$mooffice."',
                `DEL_KEY_ADV_CODE` ='".$keydealeradventcode."',
                `DEL_NAME` ='".$keydealername."',
                `DEL_LOC` ='".$keydealerlocation."',
                `DEL_MOB` ='".$keydealermobile."',
                `RET_NAME` ='".$keyretailername."',
                `RET_LOC` ='".$keyretailerlocation."',
                `RET_MOB` ='".$keyretailermobile."',
                `FM_SID_DEL_RET` ='".$fmsidofdealer."',
                `FAR_FIR_NAME` ='".$farmerfirstname."',
                `FAR_MID_NAME` ='".$farmermiddlename."',
                `FAR_LST_NAME` ='".$farmerlastname."',
                `FAR_VILL` ='".$farmervillage."',
                `FAR_TALUKA` ='".$farmertaluka."',
                `FAR_EMAIL` ='".$email."',
                `FAR_IS_PROGRESS` ='".$isprogressivefarmer."',
                `CROP1` ='".$majorcrop1."',
                `CROP1_ACERAGE` ='".$acreage1."',
                `CROP2` ='".$majorcrop2."',
                `CROP2_ACERAGE` ='".$acreage2."',
                `CROP3` ='".$majorcrop3."',
                `CROP3_ACERAGE` ='".$acreage3."',
                `IRR_ACERAGE` ='".$irrigatedacreage."',
                `DRIP_IRR_ACERAGE` ='".$dripirrigatedacreage."',
                `RAIN_IRR_ACERAGE` ='".$rainfedacreage."',
                `FAR_IS_SOIL_TEST` ='".$issoiltestdone."',
                `FAR_SOIL_TEST_YEAR` ='".$yearofsoiltest."',
                `FAR_REMARKS` ='".$remarks."',
                `FAR_STATUS` ='".$empsts."',
                `CALL_STATUS`= '".$calsts."',
                `EMP_STATUS`= '".$empsts."',
                `CR_DATE`= '".$cr_datetime ."',
                `CR_BY`= '".$cr_by."', `FAR_CODE`='".$ApiFarmerCode."', `FAR_LIVE`= '".$ApiFarmerLive."',`FAR_TYPE`='".$ApiFarmerType."' where `FAR_MOBILE` ='".$farmermobile."'";
                $log->write($sqlup);
                $this->db->query($sqlup);
            }
                $ret_id = $this->db->countAffected();  
                if($ret_id==1)
                {
			if($calsts==29){
                        $sqlcom="insert into `crm_case` set
                        `CASE_ID`='".$case_id."',
                        `ADV_CASE_PIN` ='0',
                        `COMP_MOBILE` ='".$farmob."',
                        `CR_BY` ='".$cr_by."',
                        `PROD_GROUP`= '".$progrp."',
                        `PROD_ID` ='".$proname."',
                        `PROD_CATG` ='".$procat."',
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
                        `ZO_ID` ='".$zone."',
                        `RO_ID` ='".$region."',
                        `TERR_ID` ='0',
                        `CR_SOURCE` ='2',
                        `CR_DATE`='".$cr_datetime."',
                        `CASE_STATUS`='7',
                        `CASE_PRIO` ='0',
                        `DUE_DATE` ='".$cr_date."',
                        `COMPLAINT_QUERY` ='".$comdtls."',
                        `COMPLAINT_REMARKS` ='".$comdtls."'";
                        $log->write("CRM_NON_ENTRY: ".$sqlcom);
                        $this->db->query($sqlcom);
                        }
                    // return 1; 
                        $sqlprests="select status from cc_incomingcall where mobile='".$farmob."' and call_type = 2 and key_press=2";
                        $log->write("PRE_STS: ".$sqlprests);
                        $authority=$this->db->query($sqlprests);
                        $pre_sts=$authority->row['status'];
                        $sqltrans="insert into crm_status_trans set 
                                   `CASE_ID` = '".$far_id."',`CASE_MOBILE` = '".$farmob."',`CR_BY` = '".$cr_by."',`FROM_STATUS` = '".$pre_sts."',`TO_STATUS` = '".$calsts."',`UPDATE_DATE` = '".$cr_date."',`UPDATE_TIME` = '".$cr_time."'";
                        $log->write("CASE_TRANS: ".$sqltrans);
                        $this->db->query($sqltrans);
                        $ret_id3 = $this->db->countAffected(); 
                        if($ret_id3==1)
                        {
                            //return 1;
                            $sqlcc="update cc_incomingcall set status='".$calsts."',tot_attempt=tot_attempt+1 where mobile='".$farmob."' and call_type = 2 and key_press=2";
                            $log->write("UP_CC_IN: ".$sqlcc);
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
          
                
    }
    public function CaseMailDtls($cid){
        //Check Case Type
        $chksql="select to_status as 'CASE_TYPE' from crm_status_trans where case_id='".$cid."'";
        $querychk = $this->db->query($chksql);
        if($querychk->row['CASE_TYPE']==2)
        {
            $sql="select crm_case.case_id as 'CID',crm_case.COMP_RA as 'RAID',DATEDIFF(crm_case.DUE_DATE, crm_case.CR_DATE) as 'NOD' ,ak_customer.email as 'MID', concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 2 AS 'FLAG' from crm_case 
            left join ak_customer on(crm_case.COMP_RA=ak_customer.customer_id)
            where crm_case.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
        if($querychk->row['CASE_TYPE']==32)
        {
            $sql="select crm_adv.case_id as 'CID',crm_adv.ADV_ID as 'RAID',crm_adv.case_pin as 'NOD' ,ak_customer.email as 'MID', concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 32 AS 'FLAG' from crm_adv
                left join ak_customer on(crm_adv.adv_id=ak_customer.customer_id)
                where crm_adv.case_id='".$cid."'";
            $query = $this->db->query($sql);
            return $query->row;
        }
    }
  
}
