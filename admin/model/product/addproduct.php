<?php

class Modelproductaddproduct extends Model{
 
  public function  addProduct($data,$image_name)
    {
        $sql="INSERT INTO " . DB_PREFIX . "product SET PRODUCT_NAME = '" . $data['product_name'] . "', `SKU` = '" . $data['sku'] . "',`UNIT` = '" . $data['unit'] . "',`PRODUCT_CATEGORY`='0',`PRODUCT_GROUP`='1',`ACT` = '1',`PRODUCT_IMAGE`='" . $image_name . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
    public function get_Select_Product(){
    $query = $this->db->query("SELECT PRODUCT_CATEGORY as 'name',SID as 'id'  FROM " . DB_PREFIX . "product_category");
    return $query->rows;   
    }
    
      public function get_Select_ProductGroup(){
      $query = $this->db->query("SELECT GROUPNAME as 'name',SID as 'id'  FROM " . DB_PREFIX . "product_group");
        return $query->rows;   
    }
     public function getproductdata($data){
$query = $this->db->query("SELECT SID,PRODUCT_NAME,SKU,UNIT,PRODUCT_IMAGE  FROM " . DB_PREFIX . "product WHERE  ACT ='1'");
 return $query->rows;
    }
      public function getupdatedata($id){
$query = $this->db->query("SELECT SID,PRODUCT_NAME,SKU,UNIT,PRODUCT_IMAGE  FROM " . DB_PREFIX . "product WHERE SID='".$id."' and  ACT ='1'");
 return $query->row;
    }
    public function updateCustomer($data,$image_name){
       
      $sql="update " . DB_PREFIX . "product SET PRODUCT_NAME='".$data["product_name"]."',SKU='".$data["sku"]."',UNIT='".$data["unit"]."',PRODUCT_IMAGE='" . $image_name . "' where SID='".$data["sid"]."'";
      $this->db->query($sql);
      $ret_id = $this->db->countAffected();
      return $ret_id1;

    } 
   
}