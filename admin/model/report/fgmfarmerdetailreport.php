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
class ModelReportfgmfarmerdetailreport extends Model {
    
    
   
    
    function getmarket(){
       
       $query = $this->db->query("SELECT SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='5'");
      return $query->rows;  
    }
    
     function getmdo($data){
      $gg="select customer_id,CONCAT(firstname,' ',lastname) as name from " . DB_PREFIX . "customer where customer_id IN(SELECT EMP_ID FROM `" . DB_PREFIX . "customer_emp_map` where GEO_ID='".$data["hq"]."' and GEO_LEVEL_ID=5) and customer_id='49'";
       $query = $this->db->query("select customer_id,CONCAT(firstname,' ',lastname) as name from " . DB_PREFIX . "customer where customer_id IN(SELECT EMP_ID FROM `" . DB_PREFIX . "customer_emp_map` where GEO_ID='".$data["hq"]."' and GEO_LEVEL_ID=5) and customer_group_id='49'");
         return $query->rows;  
    }
    
    
   
    function fgmfarmerdetailreport($data = array()){
        
         
         $query = $this->db->query("call Farmer_detail_report_new(".$data["filter_market"].",".$data["filter_mdo"].",".$data["filter_from_date"].",".$data["filter_to_date"].")");
         return $query->rows;
 
    }
    function fgmfarmerdetailreport_count($data = array()){
        
           if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }
           }
         $query = $this->db->query("call  Farmer_detail_report_new_count(".$data["filter_market"].",".$data["filter_mdo"].",".$data["filter_from_date"].",".$data["filter_to_date"].",'".$data["start"]."','".$data["limit"]."')");
         return $query->rows;
 
    }
    
    
}
