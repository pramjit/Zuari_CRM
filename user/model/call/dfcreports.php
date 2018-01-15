<?php

class Modeldfcdfcreports extends Model {
    

   public function getdfcdata($data){
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
    if($data["from_date"]=='null' && $data["to_date"]=='null' && $data["so"]!='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID IN(".$so.")
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE order by ak_mas_can_baseline_dtl.CR_DATE desc"); 
    } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]=='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID=ifnull(".$so.",ak_mas_can_baseline_dtl.EMP_ID)
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE order by ak_mas_can_baseline_dtl.CR_DATE desc"); 
    } else  if($data["from_date"]=='null' && $data["to_date"]=='null' && $data["so"]=='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID=ifnull(".$so.",ak_mas_can_baseline_dtl.EMP_ID)
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE order by ak_mas_can_baseline_dtl.CR_DATE desc"); 
    } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]!='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID IN(".$so.")
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))    
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE order by ak_mas_can_baseline_dtl.CR_DATE desc"); 
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
       // print_r($sql); die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    
     public function getdfcdatacount($data){
         
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
    if($data["from_date"]=='null' && $data["to_date"]=='null' && $data["so"]!='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID IN(".$so.")
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE "); 
    } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]=='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID=ifnull(".$so.",ak_mas_can_baseline_dtl.EMP_ID)
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE "); 
    } else  if($data["from_date"]=='null' && $data["to_date"]=='null' && $data["so"]=='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID=ifnull(".$so.",ak_mas_can_baseline_dtl.EMP_ID)
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE "); 
    } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]!='null') {
   $sql = ("SELECT ak_farmer.FARMER_NAME,ak_mas_can_baseline_dtl.CR_DATE, 
ak_farmer.FAR_SEGMENT,ak_farmer.FAR_POSSITION,ak_farmer.REMARKS,ak_farmer_possition.CUSTOMER_POSSITION,ak_mas_can_baseline_dtl.FARMER_ID,concat(ak_customer.firstname,ak_customer.lastname) as soname,
ak_farmer.car_id as customer_code
FROM ak_mas_can_baseline_dtl
left join ak_farmer on ak_farmer.SID= ak_mas_can_baseline_dtl.FARMER_ID
left join ak_farmer_possition on ak_farmer.FAR_POSSITION=ak_farmer_possition.SID
left join ak_customer on ak_mas_can_baseline_dtl.EMP_ID=ak_customer.customer_id
WHERE ak_mas_can_baseline_dtl.EMP_ID IN(".$so.")
and date(ak_mas_can_baseline_dtl.CR_DATE) between ifnull(".$from_date.",date(ak_mas_can_baseline_dtl.CR_DATE)) and ifnull(".$to_date.",date(ak_mas_can_baseline_dtl.CR_DATE))    
GROUP BY ak_mas_can_baseline_dtl.FARMER_ID,ak_mas_can_baseline_dtl.CR_DATE "); 
    }
     $query = $this->db->query($sql);
        return $query->rows;   
        
    }
    
    public function getso($data){
        
        
         $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_id in(SELECT customer_id FROM `ak_customer_map` where PARENT_CUSTOMER_ID IN(".$data["id"].")) and status=1 order by name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function getasm(){
        
        $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_group_id = 71 and status=1 order by name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
    
    public function getproduct(){
        
        $sql="SELECT sid,product_name,sku,unit FROM `ak_product` where act=1 order by product_name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
    
}


