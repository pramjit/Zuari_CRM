<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addcrop
 *
 * @author agent
 */
class Modelcropaddcrop extends Model{
    //put your code here
    /*
     public function  addcrop($data)
    {
          print_r("test");
        $sql="INSERT INTO " . DB_PREFIX . "crop SET CROP_NAME = '" . $data['crop_name'] . "', `SEASON_NAME` = '" . (isset($data['season_name']) ? $data['season_name'] : 0) . "', `ACT` = '" . $data['act'] . "'";
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }*/
    
    public function  addCrop($data)
    {
        $sql="INSERT INTO " . DB_PREFIX . "crop SET CROP_NAME = '" . $data['name'] . "', `SEASON_NAME` = '" . $data['crop'] . "',  `ACT` = '1'";
        
        $this->db->query($sql);
        $ret_id = $this->db->getLastId();
        return $ret_id;
    }
}
