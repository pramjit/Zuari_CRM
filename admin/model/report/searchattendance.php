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
class ModelReportsearchattendance extends Model {
    
    
   
    
   
   
   public function getmdoattendance($data = array()) {
        
//$sql = "SELECT SID as id, GEO_NAME AS name,ACT as status, GEO_TYPE as gtype,Nation_ID as nationid,STATE_ID as stateid FROM `" . DB_PREFIX . "geo`";
   $sql="SELECT a.SID,a.cr_date,a.user_name,a.remarks,c.district_id,c.hq_id,g.geo_name as state_name,g1.geo_name as hq_name,act.user_activity
FROM " . DB_PREFIX . "attendance a 
left join " . DB_PREFIX . "customer c on a.USER_ID = c.customer_id
left join " . DB_PREFIX . "geo g on c.state_id = g.sid
left join " . DB_PREFIX . "geo g1 on c.hq_id = g1.sid
left join " . DB_PREFIX . "user_activity act on a.ACTIVITY_TYPE = act.SID ";     



        
       //from to date
        if (!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_act_id']) ) {
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "'";
        } 
        //state
        else if(!empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date']) && empty($data['filter_act_id']) ){
            $sql .="where a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."')";
        }
        //state and mdo
        else if(!empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date']) && empty($data['filter_act_id']) ){
            $sql .="where a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."')";
        }
        //act
        else if(!empty($data['filter_act_id']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date'])){
            $sql .="where a.ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        //from,to,state
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_act_id'])){
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."')";
        }
        //from,to,state,mdo
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && empty($data['filter_act_id'])){
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."')";
        }
        //from,to,state,mdo,act
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."') and a.ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        
        //from,to,act
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' and a.ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        
        //state,mdo,act
        else if(empty($data['filter_from_date']) && empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where  a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."') and a.ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        //from,to,state,act
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where a.CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND a.USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."') and a.ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
         else {
            $sql .= " WHERE a.ACTIVITY_TYPE > '0'";
        }
        
        

        $sort_data = array(
            'district_name',
            'hq_name',
            'user_name',
            'cr_date',
            'user_activity',
            'remarks'
                
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY a.SID";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }
    
    
    
   public function getTotalattendance($data = array()) {
       
        $sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "attendance`";

       //from to date
        if (!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_act_id']) ) {
            $sql .= "where CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "'";
        } 
        //state
        else if(!empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date']) && empty($data['filter_act_id']) ){
            $sql .="where USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."')";
        }
        //state and mdo
        else if(!empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date']) && empty($data['filter_act_id']) ){
            $sql .="where USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."')";
        }
        //act
        else if(!empty($data['filter_act_id']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_from_date']) && empty($data['filter_to_date'])){
            $sql .="where ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        //from,to,state
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && empty($data['filter_act_id'])){
            $sql .= "where CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."')";
        }
        //from,to,state,mdo
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && empty($data['filter_act_id'])){
            $sql .= "where CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."')";
        }
        //from,to,state,mdo,act
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' AND USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."') and ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        
        //from,to,act
        else if(!empty($data['filter_from_date']) && !empty($data['filter_to_date']) && empty($data['filter_state_id']) && empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where CR_DATE BETWEEN '" . $this->db->escape($data['filter_from_date']) . "' AND '" . $this->db->escape($data['filter_to_date']) . "' and ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
        
        //state,mdo,act
        else if(empty($data['filter_from_date']) && empty($data['filter_to_date']) && !empty($data['filter_state_id']) && !empty($data['filter_mdo_id']) && !empty($data['filter_act_id'])){
            $sql .= "where  USER_ID IN(select customer_id from " . DB_PREFIX . "customer where state_id='".$this->db->escape($data['filter_state_id']) ."' and User_Id='".$this->db->escape($data['filter_mdo_id'])."') and ACTIVITY_TYPE = '".$this->db->escape($data['filter_act_id']) ."'";
        }
         else {
            $sql .= " WHERE ACTIVITY_TYPE > '0'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    
    function getstate(){
        
         $query = $this->db->query(" select SID,GEO_NAME from " . DB_PREFIX . "geo where GEO_TYPE='2'");
      return $query->rows;  
    }
    function getactivitytype(){
        
         $query = $this->db->query(" select SID,USER_ACTIVITY from " . DB_PREFIX . "user_activity where ACT='1'");
      return $query->rows;  
    }
    
    function getmdodata($state){
        
          $query = $this->db->query(" select User_Id ,firstname  from " . DB_PREFIX . "customer where state_id ='".$state."' and customer_group_id ='49'");
          return $query->rows;  
    }
    
    function monthlyreport_mdo($data = array()){
        
         $query = $this->db->query("call Mdo_wise_farmer_monthly_report(10)");
          return $query->rows; 
    }
    
    function monthlyreport_mdo_count($data = array()){
        
    }
    
}
