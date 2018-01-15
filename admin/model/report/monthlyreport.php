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
class ModelReportmonthlyreport extends Model {
    
    
   
    
    
    function Mdo_wise_farmer_monthly_report($data = array()){
          if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
         $query = $this->db->query("call Mdo_wise_farmer_monthly_report('".$data['filter_month']."','".$data["start"]."','".$data["limit"]."')");
          return $query->rows; 
    }
    
    
    
    function Fgm_Monthly_wise_report($data = array()){
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
          $query = $this->db->query("call Fgm_Monthly_wise_report('".$data['filter_month']."','".$data["start"]."','".$data["limit"]."')");
          return $query->rows; 
    }
    
    function Milk_Monthly_wise_report($data = array()){
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
          $query = $this->db->query("call Milk_Monthly_wise_report('".$data['filter_month']."','".$data["start"]."','".$data["limit"]."')");
          return $query->rows; 
    }
    function Pos_Monthly_wise_report($data = array()){
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
          $query = $this->db->query("call Pos_Monthly_wise_report ('".$data['filter_month']."','".$data["start"]."','".$data["limit"]."')");
          return $query->rows; 
    }
    
    //count
    function Mdo_wise_farmer_monthly_report_count($data = array()){
         
         $query = $this->db->query("call Mdo_wise_farmer_monthly_report_count('".$data['filter_month']."')");
         return $query->rows; 
    }
    function Fgm_Monthly_wise_report_count($data = array()) {
        $query = $this->db->query("call Fgm_Monthly_wise_report_count('".$data['filter_month']."')");
        return $query->rows; 
    }
    
    function Milk_Monthly_wise_report_count($data = array()) {
        $query = $this->db->query("call Milk_Monthly_wise_report_count('".$data['filter_month']."')");
        return $query->rows; 
    }
    
    function Pos_Monthly_wise_report_count($data = array()) {
        $query = $this->db->query("call Pos_Monthly_wise_report_count('".$data['filter_month']."')");
        return $query->rows; 
    }
}
