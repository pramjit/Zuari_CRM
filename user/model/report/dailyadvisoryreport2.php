<?php

class Modelreportdailyadvisoryreport extends Model {
    
    //*************GET ADVISORY LIST **************//
    
        public function adv_list(){
        $sql="SELECT customer_id,email,concat(firstname,'',lastname) as name FROM `ak_customer` where customer_group_id=6";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET ADVISORY LIST **************//
          //*************GET ADVISORY LIST **************//
    
        public function adv_list_data($data){
        $adv_id=$data;
        $sql="SELECT COUNT(FAR_MOB) as totalCalls,
        sum(case when CASE_STATUS = 7 then 1 else 0 end )as 'pendingatadvisroy', 
        sum(case when CASE_STATUS = 27 and TOT_ATTEMPT=0 then 1 else 0 end )as 'PendingatCC', 
        sum(case when CASE_STATUS = 27 and TOT_ATTEMPT >=1 then 1 else 0 end )as 'Pendingataproval', 
        sum(case when CASE_STATUS =0  then 1 else 0 end )as 'CallNotConnected', 
        sum(case when CASE_STATUS IN(8,99) then 1 else 0 end )as 'closed' 
        FROM `crm_adv` WHERE ADV_ID='".$adv_id."' and CR_DATE<=CURRENT_DATE GROUP BY FAR_MOB";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET ADVISORY LIST **************//
}


