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
class ModelReportmarketreport extends Model {
    
    
   
    
    function getstate(){
       
       $query = $this->db->query("SELECT SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='3'");
      return $query->rows;  
    }
    
     function gethq($territory){
      
       $query = $this->db->query("select SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='5' and TERRITORY_ID='".$territory['territory']."'");
         return $query->rows;  
    }
    
    
   
    
    function Farmer_report($data = array()){
        
         
         $query = $this->db->query("call Farmer_report(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_state_id"].",".$data["filter_mdo_id"].",null,null)");
         return $query->rows;
 
    }
    function Farmer_report_count($data = array()){
        
          if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
         
         $query = $this->db->query("call Farmer_report_count(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_state_id"].",".$data["filter_mdo_id"].",null,null,'".$data["start"]."','".$data["limit"]."')");
         return $query->rows;
    }
    
}
