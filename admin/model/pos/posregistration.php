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
class Modelposposregistration extends Model {
    
   public function getDistrict(){
$query = $this->db->query("SELECT GEO_NAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "geo WHERE GEO_TYPE='4' and ACT ='1' order by name asc");      
return $query->rows;   
   }
   public function getdistrict_hq($data){
        $query = $this->db->query("SELECT GEO_NAME,SID FROM " . DB_PREFIX . "geo where district_id='".$data['district']."' and GEO_TYPE=5");
        return $query->rows;

    }
    public function addPos($data){
        $sid=time();
        $cr_date=date('Y-m-d');
        $sql="INSERT INTO " . DB_PREFIX . "can_pos SET SID = '" . $sid . "',POS_NAME = '" . $data['pos_name'] . "', POS_MOBILE = '" . $data['pos_mobile']. "',MONTHLY_SALES = '" . $data['income'] . "', DIST_ID = '" . $data['district_id'] . "',POS_MARKET = '" . $data['market_id'] . "',CR_DATE = '" . $cr_date. "',CR_BY = '24', ACT = '1', POS_VILL_ID  = '0',IMAGE_URL  = '0',LATT  = '0',POS_STATUS  = '1',BRANDS_AVAILABLE  = '0'";
        $this->db->query($sql);
        $ret_id = $this->db->countAffected();
        return $ret_id;
 }
  public function checkMobileNumber($data){
       $query = $this->db->query("SELECT POS_MOBILE  FROM " . DB_PREFIX . "can_pos  WHERE POS_MOBILE='".$data["pos_mobile"]."'");
       $mob=$query->row['POS_MOBILE'];
       if(empty($mob)) {
           return '1';
       } else {
           return '0';
       }
       
    }
     public function getretailerdetails($retailermobile)
    {
       $query = $this->db->query("SELECT POS_MOBILE   FROM " . DB_PREFIX . "can_pos  WHERE  POS_MOBILE='".$retailermobile."'");
       return $query->row;     
    } 
    public function getretailerregdata($data){
   
        $sql = "SELECT c.SID,c.CR_DATE,c.POS_NAME,c.POS_MOBILE,c.MONTHLY_SALES,c.DIST_ID as dis,p.GEO_NAME as POS_MARKET,g.GEO_NAME as DIST_ID FROM " . DB_PREFIX . "can_pos c"
              ." left join " . DB_PREFIX . "geo as g on c.DIST_ID=g.sid "
              ."left join " . DB_PREFIX . "geo as p on c.POS_MARKET=p.sid "
              ." WHERE c.ACT='1'";
      
       if (isset($data['mob'])) {
            $sql .= " and POS_MOBILE= " . $data['mob'];
       }
       
       if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c.CR_DATE";
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

            if ($data['limit'] <1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        //print_r($sql); die;
      $query = $this->db->query($sql);
      return $query->rows; 
     
    }
     public function getupdatedata($id){
   $query = $this->db->query("SELECT SID,POS_NAME,POS_MOBILE,MONTHLY_SALES,POS_MARKET,DIST_ID  FROM " . DB_PREFIX . "can_pos  WHERE SID='".$id."'");      
   return $query->row;  
    }
      
    public function updatepos($data){
      $sql="update " . DB_PREFIX . "can_pos  SET POS_NAME='".$data["pos_name"]."',MONTHLY_SALES = '".$data["income"]."',DIST_ID = '".$data["district_id"]."',POS_MARKET = '".$data["market_id"]."'  where SID='".$data["SID"]."'";
      $this->db->query($sql);
      $ret_id = $this->db->countAffected();
  
    } 
   
}
