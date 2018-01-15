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
class ModelReportmarketactivityrepo extends Model {
    
  
        
    function getstate(){
       
       $query = $this->db->query("SELECT SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='2'");
      return $query->rows;  
    }
    
     function gethq($state){
        
         $query = $this->db->query(" select SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='5' and state_id='".$state."'");
      return $query->rows;  
    }
    
    function getmdodata($state){
        
          $query = $this->db->query(" select User_Id ,firstname  from " . DB_PREFIX . "customer where state_id ='".$state."' and customer_group_id ='49'");
          return $query->rows;  
    } 
    
    
    
    function Market_Activity_Report($data = array()){
        //$a=call Market_Activity_Report_count(".$data["filter_market_pos"].",".$data["filter_from_date"].",".$data["filter_to_date"].";
        
        
        
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        
        
      
         $query = $this->db->query("call Market_Activity_Report_count(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_market_pos"].",".$data["filter_state_id"].",null,null,'".$data["start"]."','".$data["limit"]."')");
        return $query->rows;
 
            
    }
    
    function Market_Activity_Report_count($data = array()){
      
       
         $query = $this->db->query("call Market_Activity_Report(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_market_pos"].",".$data["filter_state_id"].",null,null)");
        return $query->rows;
        
        
    
    }
}
