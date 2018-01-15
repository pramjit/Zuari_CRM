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
class Modelusercreateuser extends Model {
    
    
    
    public function getGroup(){
          $query = $this->db->query("SELECT user_group_id as 'id',name as 'name'  FROM " . DB_PREFIX . "user_group");

        
        return $query->rows;   
    }
    
    public function addUser($data){
        
      
         $sql="INSERT INTO " . DB_PREFIX . "user SET user_group_id = '" . $data['group'] . "', username = '" . $data['name'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' ,firstname = '" . $data['name'] . "',lastname = '" . $data['lastname'] . "',email = '" . $data['email'] . "',status = '" . $data['status'] . "',date_added=Now()";
        
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
   
}
