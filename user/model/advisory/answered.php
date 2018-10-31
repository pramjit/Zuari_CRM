<?php

class Modeladvisoryanswered extends Model {
    
    public function AdvData($data){
        $cr_by = $this->customer->getId();
        $sql="SELECT CALL_STATUS,CASE_ID,FAR_MOB,CASE_PIN,CALL_COUNT, DATE(CALL_DATE) AS 'CR_DATE'
        FROM crm_adv WHERE case_status IN (27) AND adv_id='".$cr_by."'
        GROUP BY CASE_PIN ORDER BY DATE(CALL_DATE) DESC";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function updateStatus(){
        $log=new Log("ResetPin".date('dmY').".log");
        $log->write($this->request->post);
        $Cid=$this->request->post['CID'];
        $Mob=$this->request->post['MOB'];
        $query = $this->db->query("SELECT (CASE_PIN+1) AS 'NEW_PIN' FROM crm_adv ORDER BY CASE_PIN DESC LIMIT 1");
        $New_Pin=$query->row['NEW_PIN'];
        $sql="UPDATE crm_adv SET 
            CASE_PIN=".$New_Pin.",
            CASE_STATUS=7, 
            MOD_DATE =CURDATE(), 
            CALL_FROM=NULL, 
            CALL_DATE=NULL, 
            CALL_COUNT=0,
            TOT_ATTEMPT=0,
            FILE_SYNC=0, 
            CALL_STATUS=7, 
            CC_ATTEND=0,
            CASE_TYPE=11
            WHERE CASE_ID=$Cid AND FAR_MOB=$Mob";
        $log->write($sql);
        if( $this->db->query($sql)){
            return $New_Pin;
        }else{
            return 0;
        }
        
    }
}

