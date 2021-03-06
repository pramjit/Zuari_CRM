<?php
class Modelapiivrcall extends Model {          
    public function checkRec($mob,$code){        
        $sql="SELECT MOBILE,STATUS FROM `cc_incomingcall` WHERE `MOBILE` = '".$mob."'and `STATUS`='18' and CALL_TYPE=2 and KEY_PRESS='".$code."'";
        $query = $this->db->query($sql);
        return $query->row;           
    }
    public function updateRec($mob,$code){
        $dtrcv=date('Y-m-d');
        $tmrcv=date('H:i:s');
        $sql="update `cc_incomingcall` set NOTIMESRECEIVED = NOTIMESRECEIVED+1 , DATE_RECEIVED='".$dtrcv."' , TIME_RECEIVED='".$tmrcv."' WHERE `MOBILE` = '".$mob."' and `STATUS`='18' and CALL_TYPE=2 and KEY_PRESS='".$code."'";
        $this->db->query($sql);
        if($this->db->countAffected()==1){
            $sql="select state from `cc_incomingcall` WHERE `MOBILE` = '".$mob."' and `STATUS`='18' and CALL_TYPE=2 and KEY_PRESS='".$code."' ";
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
        $mobcode=substr($mob,0,4);
        //Geting State from Mobile
        $sqlst="SELECT stateid FROM ms_mobilestate where mobilecode='".$mobcode."'";
        $query = $this->db->query($sqlst);
        $stid = $query->row['stateid'];
        if(empty($stid)){$stid=728;}
        //Set Farmer ID
        $sqlusr="SELECT userid FROM cc_incomingcall ORDER BY USERID DESC LIMIT 1 ";
        $query = $this->db->query($sqlusr);
        $usrid = $query->row['userid']+1;
        
        $sql="insert into `cc_incomingcall` set userid='".$usrid."', MOBILE='".$mob."', DATE_RECEIVED='".$dtrcv."', TIME_RECEIVED='".$tmrcv."', STATUS='18', STATE='".$stid."',NOTIMESRECEIVED='1',CALL_TYPE=2,KEY_PRESS='".$code."',LANGUAGE='1' ";
        $this->db->query($sql);
        if($this->db->countAffected()==1)
        {
            if($code==2)
            {
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
            if($code==1)
            {
                $sql="select case_pin from `crm_adv` order by case_pin DESC LIMIT 1 ";
                $query=$this->db->query($sql);
                if(empty($query->row['case_pin'])){
                   $pin=1001; 
                }
                else{
                $pin = $query->row['case_pin']+1;
                }
                $case_id = rand(1000000000,9999999999);
                //Find Advisory by state
                $advsql="SELECT CUST_ID FROM emp_geo_map WHERE GEO_TYPE_ID=2 AND GEO_ID='".$stid."'";
                $query=$this->db->query($advsql);
                $adv_id=$query->row['CUST_ID'];
                if(empty($adv_id)){$adv_id=0;}
                $sqlcom="INSERT INTO `crm_adv` set
                        `CASE_ID` ='".$case_id."',
                        `CASE_PIN`='".$pin."',
                        `FAR_MOB` ='".$mob."',
                        `CR_BY` ='0',
                        `ADV_ID`='".$adv_id."',
                        `CASE_STATUS`='7',
                        `CR_DATE` ='".$dttmrcv."'";
                
                $this->db->query($sqlcom);
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
        }
        else {
                $suc=array("stid"=>$stid,"msg"=>1);
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
            
}

