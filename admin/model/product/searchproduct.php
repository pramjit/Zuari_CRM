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
class ModelProductsearchproduct extends Model {
    
    
   
    
   
   
   public function getProduct($data = array()) {
        
$sql = "SELECT SID as id, PRODUCT_NAME AS name,ACT as status, PRODUCT_CATEGORY as category,PRODUCT_GROUP as groups FROM `" . DB_PREFIX . "product`";
        



        

        if (!empty($data['filter_product_name'])) {
            $sql .= " WHERE AND PRODUCT_NAME LIKE '%" . $this->db->escape($data['filter_customer']) . "%' AND ACT > '0'";
        }
        else {
            $sql .= " WHERE ACT > '0'";
        }

        
        

        $sort_data = array(
            'id',
            'name',
            'status',
            'category',
            'groups',
                
        );

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

        $query = $this->db->query($sql);

        return $query->rows;
    }
    
    
    
   public function getTotalProduct($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "product`";

        if (!empty($data['filter_product_name'])) {
            $sql .= " WHERE AND PRODUCT_NAME LIKE '%" . $this->db->escape($data['filter_customer']) . "%' AND ACT > '0'";
        }

       
         else {
            $sql .= " WHERE ACT > '0'";
        }

        

       

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
    
}
