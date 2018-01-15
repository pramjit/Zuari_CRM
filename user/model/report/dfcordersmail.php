<?php

class Modeldfcdfcordersmail extends Model {
    
    function getso() {
       
        $query = $this->db->query("SELECT customer_id,firstname,lastname FROM `ak_customer` where customer_group_id='47'");
        return $query->rows;
    }
    function getemail() {
       
        $query = $this->db->query("SELECT EMAIL FROM `ak_Email` IsActive='2'");
        return $query->rows;
    }
    public function getdfcdata($so){
       $query = $this->db->query("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE f.CR_BY='".$so."' and fmd.TYPE=3  
ORDER BY `fmd`.`PRODUCT_USAGE` ASC");
        return $query->rows; 
    }
}


