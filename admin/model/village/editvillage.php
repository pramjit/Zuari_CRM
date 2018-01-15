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
class Modelvillageeditvillage extends Model {
    //put your code here
    
    
    
    public function  updateVillage($data)
    {
       //$sid= $this->session->request->get['id'];
       
        $sql="UPDATE " . DB_PREFIX . "village SET VILLAGE_NAME = '" . $data['name'] . "',VILLAGE_PIN_CODE='".$data['pincode']."', `DISTRICT_CODE` = '0', STATE_ID = '" . $data['state'] . "', `DISTRICT_NAME` = '" . $data['district'] . "', DELAER_SID = '" . $data['dealer'] . "',  ACT = '1' WHERE SID='".$data['sid']."'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
   
    
    
    public function get_Village_State(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='2' and ACT ='1' order by name asc");

        
        return $query->rows;   
    }
    
   
    
   public function DropDownState($data){
   
        $query = $this->db->query("SELECT GEO_NAME,SID FROM " . DB_PREFIX . "geo where STATE_ID='".$data['state']."'");
        return $query->rows;
   }

   public function get_Select_Dealer(){
          $query = $this->db->query("SELECT FIRM_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "channel_partner ");

        
        return $query->rows;   
    }
   
    public function get_Form_Data()
    {
         $sid= $this->request->get['id'];
        
       $query = $this->db->query("select a.SID as SID,a.village_name as Vname, a.village_pin_code as pincode,
g.geo_name as StateName,g1.GEO_NAME as DistrictName,a.DISTRICT_NAME as DISTRICT_ID,c.SID as Dealer_id,
c.firm_name as FirmName
from ak_village a
LEFT JOIN ak_geo g on g.sid=a.state_id 
left join ak_geo g1 on g1.sid=a.DISTRICT_NAME
LEFT JOIN ak_channel_partner c on c.sid=a.delaer_sid
WHERE a.sid=$sid");
       
          return $query->rows;    
    }
    
}
