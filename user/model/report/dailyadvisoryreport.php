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
        $sql="select
            cra.CASE_ID AS 'CASE_ID',
            DATE(cra.CR_DATE) AS 'CR_DATE',
            cra.FAR_MOB AS 'FAR_MOB',
            cra.CASE_PIN AS 'CASE_PIN',
            cra.CALL_COUNT AS 'CALL_COUNT',
            cra.TOT_ATTEMPT AS 'TOT_ATTEMPT',
            (CASE
            WHEN cra.CASE_STATUS IN(4,7,6,11,22,23) THEN 'PENDING AT ADVISORY'
            WHEN cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT=0 THEN 'PENDING AT CC'
            WHEN cra.CASE_STATUS = 27 and cra.TOT_ATTEMPT >=1 then 'PENDING AT APROVAL'
            WHEN cra.CASE_STATUS =0 then 'CALL NOT CONNECTED'
            WHEN cra.CASE_STATUS =99 then 'CLOSED'
            END) AS 'CASE_STATUS',
            (CASE
            WHEN cra.CALL_STATUS = 4 THEN 'BUSY'
            WHEN cra.CALL_STATUS = 5 THEN 'DOES NOT EXIST'
            WHEN cra.CALL_STATUS = 7 THEN 'PENDING AT ADVISORY'
            WHEN cra.CALL_STATUS = 6 THEN 'NOT REACHABLE'
            WHEN cra.CALL_STATUS = 11 THEN 'ATTEMPT LATER'
            WHEN cra.CALL_STATUS = 12 THEN 'NOT INTERSTED'
            WHEN cra.CALL_STATUS = 13 THEN 'DND'
            WHEN cra.CALL_STATUS = 14 THEN 'WRONG NUMBER'
            WHEN cra.CALL_STATUS = 22 THEN 'SWITCH OFF'
            WHEN cra.CALL_STATUS = 23 THEN 'NOT PICKING'
            WHEN cra.CALL_STATUS = 27 THEN 'ANSWERED'
            WHEN cra.CALL_STATUS = 99 THEN 'CLOSED'
            ELSE 'NOT ATTEMPT'
            END) AS 'CALL_STATUS'
            from crm_adv cra
            WHERE ADV_ID='".$adv_id."' and CR_DATE<=CURRENT_DATE 
            group by cra.CASE_ID order by cra.CR_DATE ASC";
        $query = $this->db->query($sql);
        return $query->rows;   
        }
  //*************GET ADVISORY LIST **************//
}


