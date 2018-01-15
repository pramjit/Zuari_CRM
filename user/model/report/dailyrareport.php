<?php

class Modelreportdailyrareport extends Model {
    
    //*************GET RA LIST **************//
    
        public function ra_list(){
        $sql="SELECT customer_id,email,concat(firstname,'',lastname) as name FROM `ak_customer` where customer_group_id=4";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET RA LIST **************//
  //*************GET RA DATA **************//
    
        public function ra_list_data($data){
        $ra_id=$data;
        
       $sql="SELECT COUNT(COMP_MOBILE) as totalCallsRA,
       sum(case when CASE_STATUS = 7 then 1 else 0 end )as 'pendingAtRA',
       sum(case when CASE_STATUS = 3 then 1 else 0 end )as 'pendingReviewAtCC',
       sum(case when CASE_STATUS = 2 then 1 else 0 end )as 'pendingForAproval'
       FROM `crm_case`
       WHERE  COMP_RA='".$ra_id."' and 
       CR_DATE<=CURRENT_DATE GROUP BY COMP_MOBILE";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET RA DATA **************//
}


