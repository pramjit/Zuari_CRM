<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addgeo
 *
 * @author agent
 */
class Modeluseraddgroup extends Model {
    
    
    
    
    public function addGroup($data){
        
      
         $sql="INSERT INTO " . DB_PREFIX . "user_group SET name = '" . $data['group_name'] . "'";
        
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
   
    public function getGroupNameShow(){
         $query = $this->db->query("SELECT name as 'name',user_group_id as 'id'  FROM " . DB_PREFIX . "user_group");

        
        return $query->rows;   
    }
   
}
