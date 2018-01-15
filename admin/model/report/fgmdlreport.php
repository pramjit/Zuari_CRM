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
class ModelReportfgmdlreport extends Model {
    
  
        
    function getstate(){
       
       $query = $this->db->query("SELECT SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='5'");
      return $query->rows;  
    }
    
     function gethq($territory){
        
         $query = $this->db->query("select SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='5' and TERRITORY_ID='".$territory."'");
      return $query->rows;  
    }
    
    
    
    
    
    function Fgm_detail_report($data = array()){
        //$a=call Milk_collection_daily_report(".$data["filter_market_pos"].",".$data["filter_from_date"].",".$data["filter_to_date"].";
        ////////////////////////////////////
        
        
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        
        
        //////////////////////////////
         $query = $this->db->query("call Fgm_detail_report_count(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_market_pos"].",null,null,'".$data["start"]."','".$data["limit"]."')");
        return $query->rows;
 
            
    }
    
    function Fgm_detail_report_count($data = array()){
        
         $query = $this->db->query("call Fgm_detail_report(".$data["filter_from_date"].",".$data["filter_to_date"].",".$data["filter_market_pos"].",null,null)");
        return $query->rows;
        
        
    
    }
}
