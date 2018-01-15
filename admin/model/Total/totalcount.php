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
class ModelTotaltotalcount extends Model {
   
    
    public function getTotalCountDealer(){
          $query = $this->db->query("SELECT count(SID)  FROM " . DB_PREFIX . "channel_partner ");
          return $query->rows;   
    }
    
    
    
    
    
   
    
}
