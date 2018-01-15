<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createdealer
 *
 * @author agent
 */
class Modelcustomercreatecustomer extends Model {
   
    
    /*public function  adddealer($data)
    {
        $sql="INSERT INTO " . DB_PREFIX . "channel_partner SET CHANNEL_CODE = '" . $data['channel_code'] . "', `CHANNEL_TYPE` = '" . (isset($data['chanel_type']) ? $data['chanel_type'] : 0) . "', `FIRM_NAME` = '" . $data['firm_name'] . "', OWNER_NAME = '" . $data['owner_name'] . "', MOBILE = '" . $data['mobile_number'] . "',  EMAIL_ID = '" . $data['email_id'] . "', HO_ID = '" .$data['ho_id'] . "', ZONE_ID = '" . $data['zone_id'] . "', REGION_ID = '" .$data['region_id'] . "', AREA_ID = '" . $data['area_id'] . "', TERRITORY_ID= '" .$data['territory_id'] . "', DMR_ID= '" .$data['dmr_id'] . "',DMR_NAME= '" . $data['dmr_name'] . "', FMR_ID= '" . $data['fmr_id'] . "', FMR_NAME= '" . $data['fmr_name'] . "', ACT= '" . $data['act'] . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }*/
 public function addCustomer($data){
     $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id	 = '" . $data['group_role'] . "',User_Id = '" . $data['email'] . "', firstname = '" . $data['first_name']. "',lastname = '" . $data['last_name'] . "', email = '" . $data['email'] . "',telephone = '" . $data['telephone'] . "',address = '" . $data['address'] . "',salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' , status = '" . $data['status'] . "',nation_id = '" . $data['nation_id'] . "',state_id = '" . $data['state_id'] . "',hq_id = '" . $data['hq_id'] . "',territory_id = '" . $data['territory_id'] . "',district_id = '" . $data['district_id'] . "',approved='1',date_added=Now()";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
 }
 
 public function addCustomermap($data){
     
     foreach ($data['group'] as $key => $value) {            
     if($value!=""){
     $sql="INSERT INTO " . DB_PREFIX . "customer_map SET CUSTOMER_ID	 = '" . $data['cust_id'] . "',PARENT_CUSTOMER_ID = '" . $value. "',CUSTOMER_GROUP_ID = (SELECT CUSTOMER_GROUP_ID from ".DB_PREFIX."customer where customer_id='".$value."' )";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
         }
     }
        return $ret_id;
 }
 
 public function addCustomerempmap($data){
     
     $cr_date=date('Y-m-d');
     $n=$data['nation_id'];
     $geo_id=array();
    
    $geo_data=$data;
    //print_r($geo_data);
    if(array_key_exists('nation_id', $geo_data)){
        array_push($geo_id, $data['nation_id']);
        
    }
    if(array_key_exists('state_id', $geo_data)){
        array_push($geo_id, $data['state_id']);
        
    } 
    if(array_key_exists('territory_id', $geo_data)){
        array_push($geo_id, $data['territory_id']);
        
    } 
     if(array_key_exists('district_id', $geo_data)){
        array_push($geo_id, $data['district_id']);
        
    } 
    if(array_key_exists('hq_id', $geo_data)){
        array_push($geo_id, $data['hq_id']);
        
    } 
   // print_r($geo_id);die;   
        for($i=0;$i<count($geo_id);$i++) {  
     $sql="INSERT INTO " . DB_PREFIX . "customer_emp_map SET EMP_ID='" . $data['cust_id'] . "',LEVEL_TYPE = (select Level_ID from " . DB_PREFIX . "customer_group where customer_group_id='" . $data['group_role'] . "' ),GEO_ID='" . $geo_id[$i] . "',GEO_LEVEL_ID=(select GEO_TYPE from " . DB_PREFIX . "geo where sid='" . $geo_id[$i] . "'),ACT_ID=1,START_DATE='".$cr_date."',END_DATE='".$cr_date."'  ";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        }
        return $ret_id;
 }
 public function addretailer($data){
     
         $retailercount=$data['retailer'];
    $retailer=count($retailercount);
    for($i=0;$i<$retailer;$i++) {
        $sql="INSERT INTO " . DB_PREFIX . "customer_outlet_map SET CUSTOMER_ID='" . $data['cust_id'] . "',OUTLET_ID = '" . $data['retailer'][$i] . "',DISTRICT_ID ='" . $data['district_id'] . "',ACT=1 ";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
    }
        return $ret_id;
 }

  public function getCustomer(){
          $query = $this->db->query("SELECT customer_group_id as 'id',name as 'name'  FROM " . DB_PREFIX . "customer_group order by name");

        
        return $query->rows;   
    }
    
   public function groupDropdown($data){
    
           $query = $this->db->query("SELECT customer_group_id as 'id',name as 'name' ,Level_ID as 'lvl'  FROM " . DB_PREFIX . "customer_group where LEVEL_ID <> '1' AND   LEVEL_ID < (Select LEVEL_ID from ".DB_PREFIX."customer_group where   customer_group_id='" . $data['query']. "') order by id ")  ;
     
        
        return $query->rows;   
    }
   public function  getUserByLevelId($levelid)
   {
           $query = $this->db->query("SELECT customer_id as 'id',concat(firstname,' ',lastname) as 'name' FROM " . DB_PREFIX . "customer where customer_group_id='".$levelid."'");
           return $query->rows;   
           
   }
   public function getDistrict(){
    
$query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='7' and ACT ='1' order by name asc");      

return $query->rows;   
    
   }
}
