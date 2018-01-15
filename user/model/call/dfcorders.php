<?php

class Modeldfcdfcorders extends Model {
    
    public function getdfcordersdata($data){
      if($data["so"]!='null')
    {
      $so= $data["so"];
    }
    else{
        $so='null';
    }
    
     if($data["from_date"]!='null')
    {
      $from_date= "'".$data["from_date"]."'";
    }
    else{
        $from_date='null';
    }
    
     if($data["to_date"]!='null')
    {
      $to_date= "'".$data["to_date"]."'";
    }
    else{
        $to_date='null';
    }
      if($data["product"]!='null')
    {
          //$data["product"]=explode(",",$data["product"]);
         // print_r($data["product"]);die;
    $product= $data["product"]; 
    
    }
    else{
        $product='null';
    }
    if($data["so"]=='null' && $data["product"]=='null') {
          $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
    } else if($data["so"]!='null' && $data["product"]!='null') {
    $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE f.CR_BY IN(".$so.") and fmd.TYPE=3 and fmd.PRODUCT_NAME IN(".$product.")
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
     } else  if($data["so"]!='null' && $data["product"]=='null') {
    $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE f.CR_BY=ifnull(".$so.",f.CR_BY) and fmd.TYPE=3
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
     } else  if($data["so"]=='null' && $data["product"]!='null') {
         
         $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE fmd.TYPE=3 and fmd.PRODUCT_NAME IN(".$product.")
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
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
        //echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
  public function getdfcordersdatacount($data){
       if($data["so"]!='null')
    {
      $so= "'".$data["so"]."'";
    }
    else{
        $so='null';
    }
    
     if($data["from_date"]!='null')
    {
      $from_date= "'".$data["from_date"]."'";
    }
    else{
        $from_date='null';
    }
    
     if($data["to_date"]!='null')
    {
      $to_date= "'".$data["to_date"]."'";
    }
    else{
        $to_date='null';
    }
    if($data["product"]!='null')
    {
      $product= "'".$data["product"]."'";
    }
    else{
        $product='null';
    }
     if($data["so"]=='null' && $data["product"]=='null') {
          $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
    } else 
     if($data["so"]!='null' && $data["product"]!='null') {
    $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE f.CR_BY IN(".$so.") and fmd.TYPE=3 and fmd.PRODUCT_NAME IN(".$product.")
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
     } else  if($data["so"]!='null' && $data["product"]=='null') {
    $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE f.CR_BY=ifnull(".$so.",f.CR_BY) and fmd.TYPE=3
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
     } else  if($data["so"]=='null' && $data["product"]!='null') {
         
         $sql=("SELECT fmd.SID,fmd.PRODUCT_NAME,fmd.PRODUCT_USAGE,fmd.FARMER_ID,f.FARMER_NAME as Farmer_name,
           fmd.CR_DATE as date,f.FAR_POS,cp.POS_NAME as Dealer_name,concat(c.firstname,c.lastname) as so_name,f.car_id as customer_code
           FROM ak_farmer_product_detail fmd
           left join ak_farmer as f on fmd.FARMER_ID=f.SID
           left join ak_can_pos as cp on f.FAR_POS=cp.SID
           
           
           left join ak_customer as c on f.CR_BY=c.customer_id
    WHERE fmd.TYPE=3 and fmd.PRODUCT_NAME IN(".$product.")
        and date(fmd.CR_DATE) between ifnull(".$from_date.",date(fmd.CR_DATE)) and ifnull(".$to_date.",date(fmd.CR_DATE))
           order by f.CR_DATE asc");
     }
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
  
   public function getso(){
        
        $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_group_id in(47,71) and status=1 order by name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
     public function getasm(){
        
        $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_group_id = 71 and status=1 order by name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
 
}


