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
class Modeldelardelarregistration extends Model {
   
 public function getdis() {
   $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='4' and ACT ='1' order by name asc");      
   return $query->rows;   
     
 }
 public function addCustomer($data){
       //select nation,state,terr
       $query2 = $this->db->query("SELECT Nation_ID,STATE_ID,TERRITORY_ID FROM " . DB_PREFIX . "geo WHERE SID='". $data['district_id']."'");
      $Nation_ID= $query2->row["Nation_ID"];
      $STATE_ID= $query2->row["STATE_ID"];
      $TERRITORY_ID= $query2->row["TERRITORY_ID"];
      
        $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . $data['delar'] . "',User_Id = '" . $data['delar_mobile_number'] . "',sap_id = '" . $data['customer_code'] . "', firstname = '" . $data['delar_f_name']. "',lastname = '" . $data['delar_l_name'] . "', email = '" . $data['delar_mobile_number'] . "',telephone = '" . $data['delar_telephone'] . "',address = '" . $data['delar_address'] . "',salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' , status = '" . $data['delar_status'] . "',nation_id = '".$Nation_ID."',state_id = '".$STATE_ID."',hq_id = '0',territory_id = '".$TERRITORY_ID."',district_id = '" . $data['district_id'] . "',approved='1',date_added=Now()";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
     }
 
 public function addCustomermap($data){
     
    if(($data["so"]!='') && ($data["asm"]!='')) {
         $sql="INSERT INTO  " . DB_PREFIX . "customer_map SET CUSTOMER_ID	 = '" . $data['cust_id'] . "',PARENT_CUSTOMER_ID = '" . $data['so'] . "',CUSTOMER_GROUP_ID = '" . $data['delar'] . "'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
     
     $sql="INSERT INTO " . DB_PREFIX . "customer_map SET CUSTOMER_ID	 = '" . $data['cust_id'] . "',PARENT_CUSTOMER_ID = '" . $data['asm'] . "',CUSTOMER_GROUP_ID = '" . $data['delar'] . "'";
     $this->db->query($sql);
     $ret_id2 = $this->db->getLastId();
     return $ret_id2;
     
     } else if($data["so"]!='') {  
     $sql="INSERT INTO " . DB_PREFIX . "customer_map SET CUSTOMER_ID	 = '" . $data['cust_id'] . "',PARENT_CUSTOMER_ID = '" . $data['so'] . "',CUSTOMER_GROUP_ID = '" . $data['delar'] . "'";
     $this->db->query($sql);
     $ret_id = $this->db->getLastId();
     return $ret_id;
     } else  if($data["asm"]!='') {
     $sql="INSERT INTO " . DB_PREFIX . "customer_map SET CUSTOMER_ID	 = '" . $data['cust_id'] . "',PARENT_CUSTOMER_ID = '" . $data['asm'] . "',CUSTOMER_GROUP_ID = '" . $data['delar'] . "'";
     $this->db->query($sql);
     $ret_id = $this->db->getLastId();
     return $ret_id;
     }  
 }
 
 public function addCustomerempmap($data){
     
     $cr_date=date('Y-m-d');
     $n=$data['nation_id'];
     $geo_id=array();
    
    $geo_data=$data;
    
      
        $sql="INSERT INTO " . DB_PREFIX . "customer_emp_map SET EMP_ID='" . $data['cust_id'] . "',LEVEL_TYPE = '0',GEO_ID='" . $data["district_id"] . "',GEO_LEVEL_ID='4',ACT_ID=1,START_DATE='".$cr_date."',END_DATE='".$cr_date."'  ";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
       
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
   public function getso($data) {
      
  $query = $this->db->query("SELECT customer_id,firstname,lastname  
FROM " . DB_PREFIX . "customer WHERE customer_id IN
(select EMP_ID from " . DB_PREFIX . "customer_emp_map where GEO_ID='".$data["district_id"]."' and GEO_LEVEL_ID=4)
 and customer_group_id=47");      
        return $query->rows;  
   }
   public function getasm($data) {
       
        $query = $this->db->query("SELECT customer_id,firstname,lastname  
FROM " . DB_PREFIX . "customer WHERE customer_id IN
(select EMP_ID from " . DB_PREFIX . "customer_emp_map where GEO_ID='".$data["district_id"]."' and GEO_LEVEL_ID=4)
 and customer_group_id=48");      
        return $query->rows;  
   }
    public function checkMobileNumber($data){
       $query = $this->db->query("SELECT User_Id FROM " . DB_PREFIX . "customer WHERE User_Id='".$data["delar_mobile_number"]."'");
       $mob=$query->row['User_Id'];
       if(empty($mob)) {
           return '1';
       } else {
           return '0';
       }
       
    }
     public function getdealerdata($data){
 $query = $this->db->query("SELECT c.sap_id,c.customer_group_id,c.customer_id,c.firstname,c.lastname,c.email,c.telephone,c.address,g.geo_name as district_id  FROM " . DB_PREFIX . "customer c left join " . DB_PREFIX . "geo g on c.district_id=g.sid   WHERE customer_group_id='64' order by g.geo_name asc");      
return $query->rows;  
    }
      public function getsubdealerdata($data){
 $query = $this->db->query("SELECT c.sap_id,c.customer_group_id,c.customer_id,c.firstname,c.lastname,c.email,c.telephone,c.address,g.geo_name as district_id  FROM " . DB_PREFIX . "customer c left join " . DB_PREFIX . "geo g on c.district_id=g.sid   WHERE customer_group_id='68'  order by g.geo_name asc");      
return $query->rows;  
    }
     public function getupdatedata($id){
   $query = $this->db->query("SELECT sap_id,customer_group_id,customer_id,firstname,lastname,email,telephone,address,district_id,status  FROM " . DB_PREFIX . "customer WHERE customer_id='".$id."'");      
   return $query->row;  
    }
    
   public function updateCustomer($data){
       
     $query2 = $this->db->query("SELECT Nation_ID,STATE_ID,TERRITORY_ID FROM " . DB_PREFIX . "geo WHERE SID='". $data['district_id']."'");
      $Nation_ID= $query2->row["Nation_ID"];
      $STATE_ID= $query2->row["STATE_ID"];
      $TERRITORY_ID= $query2->row["TERRITORY_ID"];
      
      $sql="update " . DB_PREFIX . "customer SET Nation_ID='". $Nation_ID."',STATE_ID='".$STATE_ID."',TERRITORY_ID='".$TERRITORY_ID."',firstname='".$data["delar_f_name"]."',lastname='".$data["delar_l_name"]."',telephone='".$data["delar_telephone"]."',address='".$data["delar_address"]."',district_id='".$data["district_id"]."',status='".$data["delar_status"]."' where customer_id='".$data["customer_id"]."'";
      $this->db->query($sql);
      $ret_id = $this->db->countAffected();
    
      
      $sql1="update " . DB_PREFIX . "customer_emp_map SET GEO_ID='".$data["district_id"]."' where EMP_ID ='".$data["customer_id"]."' and GEO_LEVEL_ID ='4'";
      $this->db->query($sql1);
      $ret_id1 = $this->db->countAffected();
      return $ret_id1;

    } 
    public function checkCustomerCode($data){
       $query = $this->db->query("SELECT sap_id FROM " . DB_PREFIX . "customer WHERE sap_id='".$data["customer_code"]."'");
       $code=$query->row['sap_id'];
       if(empty($code)) {
           return '1';
       } else {
           return '0';
       }
       
    }
   
   
   
}