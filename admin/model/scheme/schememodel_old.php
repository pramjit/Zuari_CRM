<?php

class Modelschemeschememodel extends Model {
    
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
   

    public function getproduct()
    {
       $query = $this->db->query("SELECT SID,PRODUCT_NAME FROM " . DB_PREFIX . "product WHERE ACT='1'");
       return $query->rows;     
    }
    
    public function addscheme($data){
        
     $cf=$data['Points']/$data['qty'];   
     $sql="INSERT INTO  " . DB_PREFIX . "points SET PRODUCT_ID = '".$data["product_id"]."',CONVERSION_FACTOR = '" . $cf. "',QUANTITY = '" . $data['qty'] . "',START_DATE= '" . date('Y-m-d',strtotime($data['date_from'])) . "',END_DATE = '" . date('Y-m-d',strtotime($data['date_to'])) . "',SCHEME_NAME='".$data["scheme_Name"]."'";
     $this->db->query($sql);
     return $this->db->getLastId();
    }
    public function checkscheme($data){
        $crdate=date('Y-m-d');
        //$q="SELECT QUANTITY FROM " . DB_PREFIX . "points WHERE PRODUCT_ID ='".$data["product_id"]."' and START_DATE <= '".$crdate."' and END_DATE >= '".$crdate."'";
        $q="SELECT QUANTITY FROM " . DB_PREFIX . "points WHERE PRODUCT_ID ='".$data["product_id"]."' and CURDATE() between START_DATE and END_DATE";
        $query = $this->db->query($q);
       return $query->row["QUANTITY"];      
    }
    
 
}