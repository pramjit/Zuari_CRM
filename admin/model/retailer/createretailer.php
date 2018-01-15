<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createdealer
 *
 * @author agent
 */
class Modelretailercreateretailer extends Model {
   
    
    /*public function  adddealer($data)
    {
        $sql="INSERT INTO " . DB_PREFIX . "channel_partner SET CHANNEL_CODE = '" . $data['channel_code'] . "', `CHANNEL_TYPE` = '" . (isset($data['chanel_type']) ? $data['chanel_type'] : 0) . "', `FIRM_NAME` = '" . $data['firm_name'] . "', OWNER_NAME = '" . $data['owner_name'] . "', MOBILE = '" . $data['mobile_number'] . "',  EMAIL_ID = '" . $data['email_id'] . "', HO_ID = '" .$data['ho_id'] . "', ZONE_ID = '" . $data['zone_id'] . "', REGION_ID = '" .$data['region_id'] . "', AREA_ID = '" . $data['area_id'] . "', TERRITORY_ID= '" .$data['territory_id'] . "', DMR_ID= '" .$data['dmr_id'] . "',DMR_NAME= '" . $data['dmr_name'] . "', FMR_ID= '" . $data['fmr_id'] . "', FMR_NAME= '" . $data['fmr_name'] . "', ACT= '" . $data['act'] . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }*/
 public function createretailer($data,$file){
     
   //village_name
    $CR_DATE=date('Y-m-d');
    //$CR_BY=$this->customer->getId();
    $sql="INSERT INTO " . DB_PREFIX . "retail_outlet SET OUTLET_NAME = '" . $data['outlet_name'] . "', RETAIL_ID = '". $data['outlet_id']."', `CONTACT_NO` = '" . $data['mobile_number'] . "', ADDRESS = '" . $data['address'] . "', DISTRICT_ID = '" . $data['district_id'] . "',  PHOTO_PATH = '" .$file. "',REMARKS= '" .$data['remarks']. "', CR_DATE= '" .$CR_DATE. "', CR_BY= '0', ACT= '1',IMPORTANT= '".$data["important"]."'";
    $this->db->query($sql);
    $ret_id = $this->db->getLastId();
    $villcount=$data['village_name'];
    $vill=count($villcount);
    for($i=0;$i<$vill;$i++) {
    $sql="INSERT INTO " . DB_PREFIX . "outlet_village SET OUTLET_ID = '" .$ret_id. "',VILLAGE_ID  = '". $data['village_name'][$i]."', `CR_BY` = '0', CR_DATE = '" . $CR_DATE."'";
    $this->db->query($sql);
    $ret_id_vill = $this->db->getLastId();
    
    }
    return $ret_id_vill;
 }
 
 public function getDistrict(){
          $query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='4' and ACT ='1' order by name asc");
        return $query->rows;   
    }
    
    public function getvillage($disid){
        if(isset($this->request->post['district_id'])) {
        $dis=$this->request->post['district_id'];
        } else {
           $dis=$disid;
        }
        $query = $this->db->query("SELECT SID,VILLAGE_NAME  FROM " . DB_PREFIX . "village WHERE DISTRICT_ID='".$dis."' and ACT ='1' order by VILLAGE_NAME asc");

        return $query->rows;   
    }
    public function getvillageid(){
        $sid=$this->request->get['SIDUPDATE'];
         $query = $this->db->query("SELECT VILLAGE_ID  FROM " . DB_PREFIX . "outlet_village WHERE OUTLET_ID='".$sid."'");

        return $query->rows;  
    }
    public function getretailerdatacount($data){
    
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "retail_outlet WHERE  ACT ='1' order by OUTLET_NAME asc");

        return $query->rows;   
    
}
public function getretailerdata($data){
    
    $sql="SELECT r.*,g.GEO_NAME as district_name  FROM " . DB_PREFIX . "retail_outlet r 
left join " . DB_PREFIX . "geo g on r.DISTRICT_ID=g.SID
WHERE  r.ACT ='1'";
    if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY SID";
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
   // $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "retail_outlet WHERE  ACT ='1' order by OUTLET_NAME asc");
$query = $this->db->query($sql);
        return $query->rows;   
    
}
public function retailereditdata(){
    
        $sid=$this->request->get['SIDUPDATE'];
        $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "retail_outlet WHERE SID='".$sid."'");

        return $query->row; 
}
}
