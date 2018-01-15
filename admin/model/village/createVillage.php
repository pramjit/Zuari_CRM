<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createVillage
 *
 * @author agent
 */
class ModelvillagecreateVillage extends Model {
    //put your code here
    
    
    
    public function  addVillage($data)
    {
       
       $sql="INSERT INTO " . DB_PREFIX . "village SET VILLAGE_NAME = '" . $data['name'] . "',VILLAGE_PIN_CODE='".$data['pincode']."', `STATE_ID` = '".$data['state']."', TERRITORY_ID = '" . $data['terr'] . "', `DISTRICT_ID` = '" . $data['district'] . "',`HQ_ID` = '" . $data['hq'] . "',  ACT = '1'";
       $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
   
    
    
    public function get_Village_State(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='2' and ACT ='1' order by name asc");

        
        return $query->rows;   
    }
    
    
     public function get_Village_Territory(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='3' and ACT ='1' order by name asc");

        
        return $query->rows;   
    }
     public function get_Village_District(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='4' and ACT ='1' order by name asc");

        
        return $query->rows;   
    }
    
   public function DropDownState($data){
   
        $query = $this->db->query("SELECT GEO_NAME,SID FROM " . DB_PREFIX . "geo where STATE_ID='".$data['state']."' and GEO_TYPE=3");
        return $query->rows;
   }
   public function DropDownterritory() {
       $terr=$this->request->post['territory'];
       $query = $this->db->query("SELECT GEO_NAME,SID FROM " . DB_PREFIX . "geo where TERRITORY_ID='".$terr."' and GEO_TYPE=4");
       return $query->rows;
   }
   
   public function DropDownDistrict() {
       $district=$this->request->post['district'];
       $query = $this->db->query("SELECT GEO_NAME,SID FROM " . DB_PREFIX . "geo where district_id='".$district."' and GEO_TYPE=5");
       return $query->rows;
   }
   public function get_Select_HQ(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='5' and ACT ='1' order by name asc ");

        
        return $query->rows;   
    }
    
    public function  autoSearch($data)
    {
  
       $query = $this->db->query("SELECT VILLAGE_NAME   FROM " . DB_PREFIX . "village where VILLAGE_NAME LIKE '%".$data["query"]."%' ");

       //print_r($query);
        return $query->rows;   
    }
    
    public function chkvillage($data){
        
         $query = $this->db->query("SELECT *   FROM " . DB_PREFIX . "village where VILLAGE_NAME = '".$data['name']."' and HQ_ID = '" . $data['hq'] . "'");
         return $query->rows;  
    }
   
    
    
}
