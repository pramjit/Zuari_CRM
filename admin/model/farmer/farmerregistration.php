<?php

class Modelfarmerfarmerregistration extends Model {
    
     public function addfarmerreg($data){
      $t = time();
       $cr_date = date('Y-m-d');  
     $query = $this->db->query("SELECT FAR_MOBILE FROM " . DB_PREFIX . "farmer WHERE FAR_MOBILE='". $data['email']."' ");
      $farmermobile= $query->row["FAR_MOBILE"];
      
      $query = $this->db->query("SELECT User_Id FROM " . DB_PREFIX . "customer WHERE User_Id='". $data['email']."'");
      $cutomermobile= $query->row["User_Id"];
      
       $query2 = $this->db->query("SELECT Nation_ID,STATE_ID,TERRITORY_ID FROM " . DB_PREFIX . "geo WHERE SID='". $data['district_id']."'");
      $Nation_ID= $query2->row["Nation_ID"];
      $STATE_ID= $query2->row["STATE_ID"];
      $TERRITORY_ID= $query2->row["TERRITORY_ID"];
       
      if(empty($farmermobile) && empty($cutomermobile)) {
       
     $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '67',firstname = '" . $data['first_name'] . "',User_Id = '" . $data['email'] . "',email='". $data['email']."',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',nation_id='".$Nation_ID."',state_id='".$STATE_ID."',territory_id='".$TERRITORY_ID."',district_id = '" . $data['district_id'] . "',village_id = '" . $data['village_name'] . "',status = '" . $data['status'] . "'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
 
    
     $sql="INSERT INTO  " . DB_PREFIX . "farmer SET SID = '$t',FARMER_NAME = '" . $data['first_name'] . "',FAR_MOBILE = '" . $data['email'] . "',DIST_ID = '" . $data['district_id'] . "',VILL_ID = '" . $data['village_name'] . "', CR_DATE='".$cr_date."',FARMER_STATUS='1',FAR_CATEGORY='2'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
      } 
      else if(!empty($farmermobile) && empty($cutomermobile)) {
      $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '67',firstname = '" . $data['first_name'] . "',User_Id = '" . $data['email'] . "',email='". $data['email']."',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',nation_id='".$Nation_ID."',state_id='".$STATE_ID."',territory_id='".$TERRITORY_ID."',district_id = '" . $data['district_id'] . "',village_id = '" . $data['village_name'] . "',status = '" . $data['status'] . "'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
        }
          else if(empty($farmermobile) && !empty($cutomermobile)) {
    $sql="INSERT INTO  " . DB_PREFIX . "farmer SET SID = '$t',FARMER_NAME = '" . $data['first_name'] . "',FAR_MOBILE = '" . $data['email'] . "',DIST_ID = '" . $data['district_id'] . "',VILL_ID = '" . $data['village_name'] . "', CR_DATE='".$cr_date."', FARMER_STATUS='1', FAR_CATEGORY='2'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
        }
      
     
 }
   
 public function getDistricts(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='4' and ACT ='1' order by name asc");
        return $query->rows;   
    }
     public function getdistrictvillage($disid){
        if(isset($this->request->post['district_id'])) {
         $dis=$this->request->post['district_id'];
        } else {
           $dis=$disid;
        }
        $query = $this->db->query("SELECT SID,VILLAGE_NAME  FROM " . DB_PREFIX . "village WHERE DISTRICT_ID='".$dis."' and ACT ='1' order by VILLAGE_NAME asc");
        return $query->rows;   
    }
    //search mobile number
    public function getfarmerdetails($farmermobile)
    {
       $query = $this->db->query("SELECT SID,FARMER_NAME,FAR_MOBILE,VILL_ID,DIST_ID  FROM " . DB_PREFIX . "farmer WHERE FAR_MOBILE='".$farmermobile."'");
       return $query->row;     
    }
    
     public function getfarmerdetailscustomer($farmermobile)
    {
       $query = $this->db->query("SELECT customer_id as SID,firstname as FARMER_NAME,User_Id as FAR_MOBILE,village_id as VILL_ID,district_id as DIST_ID,status  FROM " . DB_PREFIX . "customer WHERE User_Id='".$farmermobile."'");
       return $query->row;     
    }
    //duplicate mobile number
    public function checkMobileNumber($data){
              
        if(!empty($data["email"])){ 
        $query = $this->db->query("select customer_id,customer_group_id from " . DB_PREFIX . "customer where User_Id='".$data["email"]."'");
        $customer_id= $query->row["customer_id"];
        $customer_group_id=$query->row["customer_group_id"];   
        $query1 = $this->db->query("select FAR_MOBILE from " . DB_PREFIX . "farmer where FAR_MOBILE='".$data["email"]."'");
        $mobile_no= $query1->row["FAR_MOBILE"];
      
         if(!empty($customer_id) and !empty($mobile_no) and $customer_group_id=='67') {
             
             return '1';
         } else if(!empty($customer_id) and $customer_group_id!='67') {
             
             return $customer_group_id;
         }
             else {
             
            return '0';
           
         }
        } else {
            return '0';
        }
        
       
       
       
    }
    
     public function checkMobileNumber1($farmermobile){
        if(!empty($farmermobile)){ 
        $query = $this->db->query("select customer_id,customer_group_id from " . DB_PREFIX . "customer where User_Id='".$farmermobile."'");
        $customer_id= $query->row["customer_id"];
        $customer_group_id=$query->row["customer_group_id"];   
        $query1 = $this->db->query("select FAR_MOBILE from " . DB_PREFIX . "farmer where FAR_MOBILE='".$farmermobile."'");
        $mobile_no= $query1->row["FAR_MOBILE"];
      
         if(!empty($customer_id) and !empty($mobile_no) and $customer_group_id=='67') {
             
             return '1';
         } else if(!empty($customer_id) and $customer_group_id!='67') {
             
             return $customer_group_id;
         }
             else {
             
            return '0';
           
         }
        } else {
            return '0';
        }
        
    }
    
    public function getretailerregdata($data){
    $query = $this->db->query("SELECT c.customer_id,c.firstname,c.lastname,c.email,c.telephone,c.address,g.geo_name as district_id FROM " . DB_PREFIX . "customer c left join " . DB_PREFIX . "geo g on c.district_id=g.sid WHERE customer_group_id='67' order by firstname asc");
    return $query->rows;
    }
    public function getupdatedata($id){
         
        
         $query = $this->db->query("SELECT customer_id as SID,firstname as FARMER_NAME,User_Id as FAR_MOBILE,village_id as VILL_ID,district_id as DIST_ID,status,sap_id  FROM " . DB_PREFIX . "customer WHERE customer_id='".$id."'");
         return $query->row;  
    }
    
    public function updatefarmercustomerreg($data){
       
    //select nation,state,terr
       $query2 = $this->db->query("SELECT Nation_ID,STATE_ID,TERRITORY_ID FROM " . DB_PREFIX . "geo WHERE SID='". $data['district_id']."'");
      $Nation_ID= $query2->row["Nation_ID"];
      $STATE_ID= $query2->row["STATE_ID"];
      $TERRITORY_ID= $query2->row["TERRITORY_ID"];
     //update farmer 
      $sql="update " . DB_PREFIX . "farmer SET FARMER_NAME ='".$data["first_name"]."',DIST_ID='".$data["district_id"]."',VILL_ID ='".$data["village_name"]."' where SID='".$data["customer_id"]."'";
      $this->db->query($sql);
      $ret_id = $this->db->countAffected();
     //update customer   
      $sql="update " . DB_PREFIX . "customer SET Nation_ID='". $Nation_ID."',STATE_ID='".$STATE_ID."',TERRITORY_ID='".$TERRITORY_ID."',firstname='".$data["first_name"]."',district_id='".$data["district_id"]."',status='".$data["status"]."' where customer_id='".$data["customer_id"]."'";
      $this->db->query($sql);
      $ret_id = $this->db->countAffected();
      
      
      $sql1="update " . DB_PREFIX . "customer_emp_map SET GEO_ID='".$data["district_id"]."' where EMP_ID ='".$data["customer_id"]."' and GEO_LEVEL_ID ='4'";
      $this->db->query($sql1);
      $ret_id1 = $this->db->countAffected();
      return $ret_id1; 
    }
 
}