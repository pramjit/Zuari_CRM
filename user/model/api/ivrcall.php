<?php
class Modelapiivrcall extends Model {          
    public function checkRec($mob,$code){   
	$log=new Log("AllLandCall".date('d_m_Y').".log");
        $sql="SELECT MOBILE,STATUS FROM `cc_incomingcall` WHERE `MOBILE` = '".$mob."'and `STATUS`='18' and CALL_TYPE=2 and KEY_PRESS='".$code."'";
	$log->write($sql);
        $query = $this->db->query($sql);
        return $query->row;           
    }
    
    public function checkRtlrRec($mob,$type){  
        if(empty($type)){$type=3;}
        $sql="SELECT MOBILE,STATUS FROM `cc_incomingcall` WHERE `MOBILE` = '".$mob."'and `STATUS`='18' and CALL_TYPE='".$type."'";
        $query = $this->db->query($sql);
        return $query->row;           
    }
    
    public function updateRec($mob,$code){
        $dtrcv=date('Y-m-d');
        $tmrcv=date('H:i:s');
	    $log=new Log("updateRec".date('d_m_Y').".log");
        $sql="update `cc_incomingcall` set NOTIMESRECEIVED = NOTIMESRECEIVED+1 , DATE_RECEIVED='".$dtrcv."' , TIME_RECEIVED='".$tmrcv."' WHERE `MOBILE` = '".$mob."' and `STATUS`='18' and CALL_TYPE=2 and KEY_PRESS='".$code."'";
        $this->db->query($sql);
        if($this->db->countAffected()==1){
            //************************************************ FIND ADV DETAILS ********************************************//
            $sql="SELECT cc_incomingcall.MOBILE,cc_incomingcall.STATE AS 'ADV_ST', CONCAT(cc_incomingcall.DATE_RECEIVED,' ',cc_incomingcall.TIME_RECEIVED) AS 'ADV_DATE',EGM.CUST_ID AS 'ADV_ID',AKC.land_line AS 'ADV_LL'  
            FROM cc_incomingcall 
            LEFT JOIN emp_geo_map EGM ON (cc_incomingcall.STATE=EGM.GEO_ID)
            LEFT JOIN ak_customer AKC ON (EGM.CUST_ID=AKC.customer_id)
            WHERE cc_incomingcall.MOBILE = '".$mob."' and cc_incomingcall.`STATUS`='18' and cc_incomingcall.CALL_TYPE=2 and cc_incomingcall.KEY_PRESS=1";
            $log->write($sql);
            $query=$this->db->query($sql); 
            $log->write($query);
            $adv_id = $query->row['ADV_ID'];//Adv id
            $adv_st = $query->row['ADV_ST'];//Adv state
            $adv_ll = $query->row['ADV_LL'];//Adv landline
            $dttmrcv = $query->row['ADV_DATE'];//Adv Date
            //
            if($adv_st==728){$adv_ll=8772244865;}
			//************************************************ FIND ADV DETAILS END ****************************************//
            
            //Check At Adv_Crm
            $cadv="SELECT CASE_PIN FROM crm_adv WHERE FAR_MOB='".$mob."' AND CASE_STATUS=7";
            $query=$this->db->query($cadv);
            $cpin = $query->row['CASE_PIN'];
            if(empty($cpin)){// Case PIN Empty, There is no record in crm_adv
            //Find State ID 
            
            //*************************Insert Record In crm_adv**********************//
            $sql="select case_pin from `crm_adv` order by case_pin DESC LIMIT 1 ";
                $query=$this->db->query($sql);
                if(empty($query->row['case_pin'])){
                    $cpin=1001; 
                }
                else{
                    $cpin = $query->row['case_pin']+1;
                }
                    $t = microtime(true);
                    $micro = sprintf("%02d",($t - floor($t)) * 100);
                    $utc = date('ymdHis', $t).$micro;
                    $case_id=$utc;
                    
                    if(empty($adv_id)){$adv_id=0;}
                    $sqlcom="INSERT INTO `crm_adv` set
                            `CASE_ID` ='".$case_id."',
                            `CASE_PIN`='".$cpin."',
                            `FAR_MOB` ='".$mob."',
                            `CR_BY` ='0',
                            `ADV_ID`='".$adv_id."',
                            `CASE_STATUS`='7',
                            `CASE_TYPE`='1',
                            `CR_DATE` ='".$dttmrcv."'";

                    $this->db->query($sqlcom);   
                
            //*************************Insert Record In crm_adv**********************//    
            }
                $suc=array("stid"=>$adv_st,"msg"=>1,"land_line"=>$adv_ll,"pin"=>$cpin);
                $log->write($suc);
		return $suc;
        }
        else{
                $suc=array("stid"=>$stid,"msg"=>0,"land_line"=>0);
		$log->write($suc);
                return $suc;
        }
    }
    public function updateRtlrRec($mob,$type){
        if(empty($type)){$type=3;}
        $dtrcv=date('Y-m-d');
        $tmrcv=date('H:i:s');
        $sql="update `cc_incomingcall` set NOTIMESRECEIVED = NOTIMESRECEIVED+1 , DATE_RECEIVED='".$dtrcv."' , TIME_RECEIVED='".$tmrcv."' WHERE `MOBILE` = '".$mob."' and `STATUS`='18' and CALL_TYPE='".$type."'";
        $this->db->query($sql);
        if($this->db->countAffected()==1){
            $sql="select state from `cc_incomingcall` WHERE `MOBILE` = '".$mob."' and `STATUS`='18' and CALL_TYPE='".$type."'";
            $query=$this->db->query($sql);
            $stid = $query->row['state'];
            $suc=array("stid"=>$stid,"msg"=>1);
            return $suc;
        }
        else{
            $suc=array("stid"=>$stid,"msg"=>0);
            return $suc;
        }
    }
    public function insertRec($mob,$code){
        $dtrcv=date('Y-m-d');
        $dttmrcv=date('Y-m-d H:i:s');
        $tmrcv=date('H:i:s');
        
        $log=new Log("insertRec".date('d_m_Y').".log");
        //******************** Getting State Code 4/5 Series Start**********************//
        
        $mobcode5=substr($mob,0,5);
        $sqlst5="SELECT stateid FROM ms_mobilestate where mobilecode='".$mobcode5."'";
        $query = $this->db->query($sqlst5);
        $stid5 = $query->row['stateid'];
        if(empty($stid5)){
                $mobcode=substr($mob,0,4);
                $sqlst="SELECT stateid FROM ms_mobilestate where mobilecode='".$mobcode."'";
                $query = $this->db->query($sqlst);
                $stid = $query->row['stateid'];
        }
        else{
            $stid = $stid5;
        }
        //******************** Getting State Code 4/5 Series End**********************//
        if(empty($stid)){$stid=728;}
        //Set Farmer ID
        $sqlusr="SELECT userid FROM cc_incomingcall ORDER BY USERID DESC LIMIT 1 ";
        $query = $this->db->query($sqlusr);
        $usrid = $query->row['userid']+1;
        
        //******************** Check Adv Case Open Or Not *********************//
        if($code==1){
           
            $sql="SELECT CASE_PIN,ADV_ID FROM crm_adv WHERE FAR_MOB='".$mob."' AND CASE_STATUS=7";
            $query=$this->db->query($sql);
            $cpin=$query->row['CASE_PIN'];
            if(empty($cpin)){ // Insert New
                $sql="insert into `cc_incomingcall` set userid='".$usrid."', MOBILE='".$mob."', DATE_RECEIVED='".$dtrcv."', TIME_RECEIVED='".$tmrcv."', STATUS='18', STATE='".$stid."',NOTIMESRECEIVED='1',CALL_TYPE=2,KEY_PRESS='".$code."',LANGUAGE='1' ";
                $this->db->query($sql);
                if($this->db->countAffected()==1)
                {
                    $sql="select case_pin from `crm_adv` order by case_pin DESC LIMIT 1 ";
                    $query=$this->db->query($sql);
                    if(empty($query->row['case_pin'])){
                       $cpin=1001; 
                    }
                    else{
                    $cpin = $query->row['case_pin']+1;
                    }
                                    $t = microtime(true);
                                    $micro = sprintf("%02d",($t - floor($t)) * 100);
                                    $utc = date('ymdHis', $t).$micro;
                                    $case_id=$utc;
                    //$case_id = rand(1000000000,9999999999);
                    //Find Advisory by state
                    
                    $advsql="SELECT emp_geo_map.CUST_ID,AKC.land_line AS 'CUST_LL' 
                            FROM emp_geo_map 
                            LEFT JOIN ak_customer AKC ON(emp_geo_map.CUST_ID=AKC.customer_id)
                            WHERE emp_geo_map.GEO_TYPE_ID=2 AND emp_geo_map.GEO_ID='".$stid."'";
                    $query=$this->db->query($advsql);
                    $adv_id=$query->row['CUST_ID'];
                    $adv_ll=$query->row['CUST_LL'];
                    if($stid==728){$adv_ll=8772244865;}
                    if(empty($adv_id)){$adv_id=0;}
                    $sqlcom="INSERT INTO `crm_adv` set
                            `CASE_ID` ='".$case_id."',
                            `CASE_PIN`='".$cpin."',
                            `FAR_MOB` ='".$mob."',
                            `CR_BY` ='0',
                            `ADV_ID`='".$adv_id."',
                            `CASE_STATUS`='7',
                            `CASE_TYPE`='1',
                            `CR_DATE` ='".$dttmrcv."'";

                    $this->db->query($sqlcom);
                    $suc=$this->db->countAffected();
                    if($suc==1)
                    {
                        $suc=array("stid"=>$stid,"msg"=>1,"land_line"=>$adv_ll,"pin"=>$cpin);
                        return $suc;
                    }
                    else {
                            $suc=array("stid"=>$stid,"msg"=>0,"land_line"=>8772244865,"pin"=>$cpin);
                            return $suc;
                    }
                }
                else {
                    $suc=array("stid"=>$stid,"msg"=>0,"land_line"=>8772244865,"pin"=>$cpin);
                    return $suc;
                }
            }
            else{ //Insert New with Call Type=4
                
                    $advsql="SELECT emp_geo_map.CUST_ID,AKC.land_line AS 'CUST_LL' 
                            FROM emp_geo_map 
                            LEFT JOIN ak_customer AKC ON(emp_geo_map.CUST_ID=AKC.customer_id)
                            WHERE emp_geo_map.GEO_TYPE_ID=2 AND emp_geo_map.GEO_ID='".$stid."'";
                    $query=$this->db->query($advsql);
                    if($query){
                        $adv_id=$query->row['CUST_ID'];
                        $adv_ll=$query->row['CUST_LL'];
                        
                        if($stid==728){$adv_ll=8772244865;}
                        $suc=array("stid"=>$stid,"msg"=>1,"land_line"=>$adv_ll,"pin"=>$cpin);
                        return $suc;
                    }
                    else {
                        $suc=array("stid"=>$stid,"msg"=>0,"land_line"=>8772244865,"pin"=>$cpin);
                        return $suc;
                    }
                
                
               /* 
                $sql="insert into `cc_incomingcall` set userid='".$usrid."', MOBILE='".$mob."', DATE_RECEIVED='".$dtrcv."', TIME_RECEIVED='".$tmrcv."', STATUS='18', STATE='".$stid."',NOTIMESRECEIVED='1',CALL_TYPE=4,KEY_PRESS='".$code."',LANGUAGE='1' ";
                $this->db->query($sql);
                if($this->db->countAffected()==1)
                {
                    $suc=array("stid"=>$stid,"msg"=>1);
                    return $suc;
                }
                else {
                    $suc=array("stid"=>$stid,"msg"=>0);
                    return $suc;
                }
                */
            }
        }
        //***************** Check Adv Case Open Or Not End********************//
        //********************** Rtlr Code Insert Start **********************//
        if($code==2){
            $sql="insert into `cc_incomingcall` set userid='".$usrid."', MOBILE='".$mob."', DATE_RECEIVED='".$dtrcv."', TIME_RECEIVED='".$tmrcv."', STATUS='18', STATE='".$stid."',NOTIMESRECEIVED='1',CALL_TYPE=2,KEY_PRESS='".$code."',LANGUAGE='1' ";
            $this->db->query($sql);
            if($this->db->countAffected()==1){
                $sql="select rtlr_code from `ak_retailers_call` order by rtlr_code DESC LIMIT 1 ";
                $query=$this->db->query($sql);
                if(empty($query->row['rtlr_code'])){
                $pin=1001;
                }else{
                $pin = $query->row['rtlr_code']+1;
                }
                $sqlins="insert into `ak_retailers_call` set RETAILER_NAME='FARMER', MOBILE_NO='".$mob."', RTLR_CODE='".$pin."', CALL_TYPE=2, CR_DATE='".$dttmrcv."'";
                $this->db->query($sqlins);
                $suc=$this->db->countAffected();
                if($suc==1)
                {
                    $suc=array("stid"=>$stid,"msg"=>1);
                    return $suc;
                }
                else {
                         $suc=array("stid"=>$stid,"msg"=>0);
                        return $suc;
                }
            }
            else{
                $suc=array("stid"=>$stid,"msg"=>0);
                return $suc;
            }
        }
        //********************** Rtlr Code Insert End ************************//
    }
    
    public function insertRtlrRec($mob,$type){
        if(empty($type)){$type=3;}
        $dtrcv=date('Y-m-d');
        $dttmrcv=date('Y-m-d H:i:s');
        $tmrcv=date('H:i:s');
        
        //******************** Getting State Code 4/5 Series Start**********************//
        
        $mobcode5=substr($mob,0,5);
        $sqlst5="SELECT stateid FROM ms_mobilestate where mobilecode='".$mobcode5."'";
        $query = $this->db->query($sqlst5);
        $stid5 = $query->row['stateid'];
        if(empty($stid5)){
                $mobcode=substr($mob,0,4);
                $sqlst="SELECT stateid FROM ms_mobilestate where mobilecode='".$mobcode."'";
                $query = $this->db->query($sqlst);
                $stid = $query->row['stateid'];
        }
        else{
            $stid = $stid5;
        }
        //******************** Getting State Code 4/5 Series End**********************//
        if(empty($stid)){$stid=728;}
        //Set Farmer ID
        $sqlusr="SELECT userid FROM cc_incomingcall ORDER BY USERID DESC LIMIT 1 ";
        $query = $this->db->query($sqlusr);
        $usrid = $query->row['userid']+1;
        
        $sql="insert into `cc_incomingcall` set userid='".$usrid."', MOBILE='".$mob."', DATE_RECEIVED='".$dtrcv."', TIME_RECEIVED='".$tmrcv."', STATUS='18', STATE='".$stid."',NOTIMESRECEIVED='1',CALL_TYPE='".$type."',KEY_PRESS='0',LANGUAGE='1' ";
        $this->db->query($sql);
        if($this->db->countAffected()==1){
            $suc=array("stid"=>$stid,"msg"=>1);
            return $suc;
        }
        else {
            $suc=array("stid"=>$stid,"msg"=>0);
            return $suc;
        }
    }
    
    
    
    
    public function IvrMsg($mob,$msg,$keypress){
        $cr_date=date('Y-m-d');
        $sql="insert into `trans_message` SET `MOBILE`='".$mob."',`MESSAGE`='".$msg."',`GENERATE_TYPE`=4,`SENT_DATE`='".$cr_date."',`KEY_PRESS`='".$keypress."'";
        $this->db->query($sql);
        
        return $this->db->countAffected();
    }
    public function AdvDtls($mob){
        $sql="select crm_adv.ADV_ID AS 'ADV_ID',crm_adv.CASE_PIN AS 'ADV_PIN',ak_customer.telephone AS 'ADV_MOB',ak_customer.email AS 'ADV_MAIL' from crm_adv 
        LEFT JOIN ak_customer ON(crm_adv.ADV_ID = ak_customer.customer_id)
        where FAR_MOB='".$mob."' and CASE_STATUS=7 ORDER BY SID DESC limit 1";
        $query = $this->db->query($sql);
        return $query->row;
    }
	public function AdvMsgDtls($fmob){
        $sql="select crm_adv.ADV_ID AS 'ADV_ID',crm_adv.CASE_PIN AS 'ADV_PIN',ak_customer.telephone AS 'ADV_MOB',ak_customer.email AS 'ADV_MAIL' from crm_adv 
        LEFT JOIN ak_customer ON(crm_adv.ADV_ID = ak_customer.customer_id)
        where  `FAR_MOB` = '".$fmob."' AND CASE_STATUS=7";
        $query = $this->db->query($sql);
        return $query->row;
    }
	public function UpdateAdvResponse($fmob,$tmob,$res){
		$log=new Log("CallResponse".date('d_m_Y').".log");
		$CD=date('Y-m-d H:i:s');
        if($res=='ANSWER'){ //Call Picked Directly
        /*$sql="update `crm_adv` set CALL_RESPONSE=1, CALL_FROM='".$tmob."',CASE_STATUS=27, CALL_DATE='".$CD."', CALL_STATUS=27, CALL_COUNT=CALL_COUNT+1 WHERE `FAR_MOB` = '".$fmob."' AND CASE_STATUS=7";*/
		
		//********************************** CHECK RESPONSE TYPE 1 / 3 **********************************//
		$chk="SELECT (CASE WHEN DATE(CR_DATE)=CURDATE() THEN 1 ELSE 3 END) AS 'RES_CODE' FROM crm_adv WHERE `FAR_MOB` = '".$fmob."' AND CASE_STATUS=7";
		$log->write($chk);
		$query = $this->db->query($chk);
		$RES=$query->row['RES_CODE'];
		$log->write('Response Code: '.$RES);
		//****************************** CHECK RESPONSE TYPE 1 / 3 END **********************************//
		$sql="update `crm_adv` set CALL_RESPONSE='".$RES."', CALL_FROM='".$tmob."',CASE_STATUS=27, CALL_DATE='".$CD."', CALL_STATUS=27, CALL_COUNT=CALL_COUNT+1 WHERE `FAR_MOB` = '".$fmob."' AND CASE_STATUS=7";
		$log->write($sql);
        $this->db->query($sql);
        return $this->db->countAffected();
        }
        else{ //Call Not Picked / Disconnected
        $sql="update `crm_adv` set CALL_STATUS=7, CALL_RESPONSE=2, CALL_COUNT=CALL_COUNT+1 WHERE `FAR_MOB` = '".$fmob."' AND CASE_STATUS=7";
		$log->write($sql);
        $this->db->query($sql);
        return $this->db->countAffected();
        }
    }
            
}

