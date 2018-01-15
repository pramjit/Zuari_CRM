<?php

class Modeldfcvisit extends Model {
    
    public function getvisitdata($data){
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
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID IN(".$so.") ORDER BY v.CR_DATE DESC");
     } else if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]=='null') {
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID = ifnull(".$so.", v.USER_ID) 
and date(v.CR_DATE) BETWEEN ifnull(".$from_date.",date(v.CR_DATE)) and ifnull(".$to_date.",date(v.CR_DATE))
ORDER BY v.CR_DATE DESC");
     } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]!='null') {
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID IN(".$so.")  and date(v.CR_DATE) BETWEEN ifnull(".$from_date.",date(v.CR_DATE)) and ifnull(".$to_date.",date(v.CR_DATE)) ORDER BY v.CR_DATE DESC");
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
       // echo $sql;die;
         $query = $this->db->query($sql);
        return $query->rows;   
        
    }
  public function getvisitdatacount($data){
   
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
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID IN(".$so.") ORDER BY v.CR_DATE DESC");
     } else if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]=='null') {
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID = ifnull(".$so.", v.USER_ID) 
and date(v.CR_DATE) BETWEEN ifnull(".$from_date.",date(v.CR_DATE)) and ifnull(".$to_date.",date(v.CR_DATE))
ORDER BY v.CR_DATE DESC");
     } else  if($data["from_date"]!='null' && $data["to_date"]!='null' && $data["so"]!='null') {
    $sql=("SELECT v.SID,v.CR_DATE,v.NEXT_VISIT_DATE,v.PURPOSE,v.CONCERN,
f.FARMER_NAME as Farmer_name,concat(c.firstname,' ',c.lastname) as Customer_name,v.REMARKS,v.NEXT_STEP 
FROM ak_can_user_visit v
left join ak_farmer as f on v.FARMER_ID=f.SID
left join ak_customer as c on v.USER_ID=c.customer_id
WHERE v.VISIT_TYPE='3' and c.customer_group_id in(47,71) and v.USER_ID IN(".$so.")  and date(v.CR_DATE) BETWEEN ifnull(".$from_date.",date(v.CR_DATE)) and ifnull(".$to_date.",date(v.CR_DATE)) ORDER BY v.CR_DATE DESC");
     }
     
       $query = $this->db->query($sql);
        return $query->rows;   
 
}
public function getdfcso(){
    
    $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_group_id in(47,71)";
    $query = $this->db->query($sql);
        return $query->rows;
}
 public function getasm(){
        
        $sql="SELECT customer_id,concat(firstname,' ',lastname) as name FROM `ak_customer` where customer_group_id = 71 and status=1 order by name asc";
         $query = $this->db->query($sql);
        return $query->rows;   
    }
}
