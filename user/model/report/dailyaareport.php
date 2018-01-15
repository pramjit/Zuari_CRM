<?php

class Modelreportdailyaareport extends Model {
    
    //*************GET RA LIST **************//
    
        public function aa_list(){
        $sql="SELECT customer_id,email,concat(firstname,'',lastname) as name FROM `ak_customer` where customer_group_id=3";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET RA LIST **************//
  //*************GET RA DATA **************//
    
        public function aa_list_data($data){
        $aa_id=$data;
        
        $sql="SELECT COUNT(COMP_MOBILE) as totalCallsAA,
        sum(case when CASE_STATUS = 2 then 1 else 0 end )as 'pendingAtAA',
        sum(case when CASE_STATUS = 6 then 1 else 0 end )as 'pendingReviewAtRa',
        sum(case when CASE_STATUS = 5 then 1 else 0 end )as 'pendingForFeedback',
        sum(case when CASE_STATUS IN(8,99) then 1 else 0 end )as 'closed'
        FROM `crm_case`
        WHERE  COMP_AA='". $aa_id."' and 
        CR_DATE<=CURRENT_DATE GROUP BY COMP_MOBILE";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET RA DATA **************//
}


