<?php

class Modelreportmissedcall extends Model {
    
    public function getmissedcallData($data){
    
    
         
        $sql="select KEY_PRESS,MOBILE,DATE_RECEIVED,TIME_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."' AND CALL_TYPE=2
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
  
       
        //echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
  public function getmissedcallDatacount($data){
           $sql="select KEY_PRESS,MOBILE,DATE_RECEIVED,TIME_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."' AND CALL_TYPE=2
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
   public function getwhatsappData($data)
   {
         
            $sql="select MOBILE,DATE_RECEIVED,TIME_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."' AND CALL_TYPE=1
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
  
        //echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
   }
    public function getwhatsappDatacount($data){
       $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."' AND CALL_TYPE=1
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
  
}


