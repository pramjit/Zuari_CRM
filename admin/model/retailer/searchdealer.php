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
class ModelDealersearchdealer extends Model {
    //put your code here
    
     /*public function  addVillage($data)
    {
       
        $sql="INSERT INTO " . DB_PREFIX . "village SET VILLAGE_NAME = '" . $data['village_name'] . "', `VILLAGE_PIN_CODE` = '" . (isset($data['villagepin_code']) ? $data['villagepin_code'] : 0) . "', `DISTRICT_NAME` = '" . $data['district_name'] . "', DISTRICT_CODE = '" . $data['district_code'] . "', DELAER_SID = '" . $data['dealer_id'] . "',  ACT = '" . $data['act'] . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }*/
    
    
   
    
   
   
   public function getVillages($data = array()) {
        
$sql = "SELECT o.SID as id, FIRM_NAME AS name,ACT as status, MOBILE as mobile, EMAIL_ID as email, DMR_NAME as dmrname,  FMR_NAME as fmrname FROM `" . DB_PREFIX . "channel_partner` o";
      
/*
 SELECT v.SID as id, v.VILLAGE_NAME AS name,v.ACT as status, v.VILLAGE_PIN_CODE as code, v.DISTRICT_NAME as dname, v.DISTRICT_CODE as d_code,  v.STATE_ID as s_value,v.DELAER_SID as d_ID, v.date_modified as date_modified,geo.GEO_NAME as DISTRICTNAME,geo1.GEO_NAME as STATENAME,ak.OWNER_NAME
 FROM `ak_village` v 
left join `ak_geo` geo on v.DISTRICT_NAME=geo.SID
left join `ak_geo` geo1 on geo.STATE_ID=geo1.SID
left join `ak_channel_partner` ak on v.DELAER_SID=ak.SID
 */
/*
SID	int(11) AI PK
CHANNEL_CODE	varchar(10)
CHANNEL_TYPE	mediumtext
FIRM_NAME	mediumtext
OWNER_NAME	mediumtext
MOBILE	int(10)
EMAIL_ID	varchar(50)
HO_ID	varchar(10)
ZONE_ID	varchar(10)
REGION_ID	varchar(10)
AREA_ID	varchar(10)
TERRITORY_ID	varchar(10)
DMR_ID	varchar(10)
DMR_NAME	varchar(50)
FMR_ID	varchar(10)
FMR_NAME	varchar(50)
ACT	varchar(2)

 */     


        

        if (!empty($data['filter_village_name'])) {
            $sql .= " WHERE AND VILLAGE_NAME LIKE '%" . $this->db->escape($data['filter_customer']) . "%' AND ACT > '0'";
        }
        else {
            $sql .= " WHERE ACT > '0'";
        }

     
        

        $sort_data = array(
            'id',
            'name',
            'status',
            'mobile',
            'email',
            'dmrname',
            'fmrname'
            
            
          
            
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY o.SID";
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
    
}
