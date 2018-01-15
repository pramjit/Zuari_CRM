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
class Modelvillagesearchvillage extends Model {
    //put your code here
    
     /*public function  addVillage($data)
    {
       
        $sql="INSERT INTO " . DB_PREFIX . "village SET VILLAGE_NAME = '" . $data['village_name'] . "', `VILLAGE_PIN_CODE` = '" . (isset($data['villagepin_code']) ? $data['villagepin_code'] : 0) . "', `DISTRICT_NAME` = '" . $data['district_name'] . "', DISTRICT_CODE = '" . $data['district_code'] . "', DELAER_SID = '" . $data['dealer_id'] . "',  ACT = '" . $data['act'] . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }*/
    
    
   
    
   
   
   public function getVillages($data = array()) {
        
//$sql = "SELECT o.SID as id, VILLAGE_NAME AS name,ACT as status, VILLAGE_PIN_CODE as code, DISTRICT_NAME as dname, DISTRICT_CODE as d_code,  STATE_ID as stname,DELAER_SID as d_ID, date_modified as date_modified FROM `" . DB_PREFIX . "village` o";
      

 $sql = "SELECT v.sid,v.village_name,v.village_pin_code,v.date_modified as cr_date,geo.geo_name as state_name,geo1.geo_name as territory_name,geo2.geo_name as district_name,geo3.geo_name as hq_name
FROM `ak_village` v
left join ak_geo geo on v.state_id=geo.sid
left join ak_geo geo1 on v.territory_id=geo1.sid
left join ak_geo geo2 on v.district_id=geo2.sid
left join ak_geo geo3 on v.hq_id=geo3.sid";

        if (!empty($data['filter_village_name'])) {
            $sql .= " WHERE AND v.village_name LIKE '%" . $this->db->escape($data['filter_customer']) . "%' AND v.ACT > '0'";
        }
        else {
            $sql .= " WHERE v.ACT > '0'";
        }

     
       if (isset($data['sort']) && in_array($data['sort'])) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY v.SID";
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
    
    
    
   public function getTotalVillages($data = array()) {
       
        $sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "village`";

        if (!empty($data['filter_village_name'])) {
            $sql .= " WHERE AND VILLAGE_NAME LIKE '%" . $this->db->escape($data['filter_customer']) . "%' AND ACT > '0'";
        }

       
         else {
            $sql .= " WHERE ACT > '0'";
        }

        

       

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    
    public function getmarket(){
        
           $sql = "SELECT sid,geo_name FROM `" . DB_PREFIX . "geo` where geo_type='5'";
           $query = $this->db->query($sql);
           return $query->rows;
    }
    
}
