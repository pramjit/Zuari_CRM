<?php

class Modelschemeschememodel extends Model {
 
   
    public function getproduct()
    {
       $query = $this->db->query("SELECT SID,PRODUCT_NAME FROM " . DB_PREFIX . "product WHERE ACT='1'");
       return $query->rows;     
    }
    public function checkscheme($data){
        $Start_Date = date('Y-m-d',strtotime($data['date_from']));
        $End_Date = date('Y-m-d',strtotime($data['date_to']));
   
      $id =$data['product_id'];
      $cid=count($id);
     for($i=0;$i<$cid;$i++){
        $fid.="'".$id[$i]."',";
     }
      $ffid=rtrim($fid,',');
   $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "points  WHERE PRODUCT_ID IN (".$ffid.") and CURDATE() between '".$Start_Date."' and '".$End_Date."' ");
    return $query->rows;    
       
    }
   
    public function addscheme($data){
     $sql="INSERT INTO  " . DB_PREFIX . "Scheme_Master SET Scheme_Name = '".$data["scheme_Name"]."',Start_Date = '" . date('Y-m-d',strtotime($data['date_from'])) . "',End_date= '" . date('Y-m-d',strtotime($data['date_to'])) . "',points='".$data["Points"]."',Gift='".$data["gft"]."',act='1'";
     $this->db->query($sql);
     $ret_id = $this->db->getLastId();
     $productcount=$data['product_id'];
    $product=count($productcount);
    for($i=0;$i<$product;$i++) {
     $pid=explode("-",$data["product_id"][$i]);
     $qty=$data["qty".$pid[0]];
     $cf=$data['Points']/$qty;
     $sql1="INSERT INTO  " . DB_PREFIX . "points SET PRODUCT_ID = '".$pid[0]."',CONVERSION_FACTOR = '" . $cf. "',QUANTITY = '" . $qty . "',START_DATE= '" . date('Y-m-d',strtotime($data['date_from'])) . "',END_DATE = '" . date('Y-m-d',strtotime($data['date_to'])) . "',SCHEME_ID='".$ret_id."'";
     $this->db->query($sql1);
     $ret_id2 = $this->db->getLastId();
    }
     return $ret_id2;
    }
     
    
    public function getschemedata($data){
        //print_r($data); die;
    
     if(!empty ($data["fromdate"]))
    {
      $from_date= "'".$data["fromdate"]."'";
    }
    else{
        $from_date='null';
    }
    if(!empty($data["todate"]))
    {
      $to_date=  "'".$data["todate"]."'";
    }
    else{
        $to_date='null';
    }
     
     if(!empty ($data["schemename"]))
    {
      $scheme_name=  $data["schemename"];
     // print_r($scheme_name); die;
    }
    else{
        $scheme_name='null';
    }
        $sql = "select group_concat(p.PRODUCT_NAME)as product_name,pt.START_DATE,pt.END_DATE,asm.Scheme_Name,asm.sid as id
                from " . DB_PREFIX . "points as pt 
                left join " . DB_PREFIX . "product as p on pt.PRODUCT_ID = p.SID
                left join " . DB_PREFIX . "Scheme_Master as asm on asm.sid =pt.SCHEME_ID
                where  pt.START_DATE >= ifnull(".$from_date.",pt.START_DATE) 
               and pt.END_DATE <= ifnull(".$to_date.",pt.END_DATE)
                and asm.sid=ifnull(".$scheme_name.",asm.sid)
                group by pt.START_DATE,pt.END_DATE,pt.SCHEME_ID order by asm.sid DESC ";
        //print_r($sql); die;  
      $query = $this->db->query($sql);
      return $query->rows; 
     
    }
  
    public function getschemename(){
   $query = $this->db->query("SELECT Scheme_Name as 'sname',SID as 'id'  FROM " . DB_PREFIX . "Scheme_Master WHERE ACT= '1'"); 
    return $query->rows;   
 }
 
     public function getschemenamebyid($data){
   $query = $this->db->query("SELECT Scheme_Name as 'sname',SID as 'id'  FROM " . DB_PREFIX . "Scheme_Master WHERE SID = '".$data["schemename"]."' "); 
    return $query->rows;   
 }
 
 public function getsearch() {
  $query = $this->db->query("SELECT Scheme_Name as 'sname',SID as 'id'  FROM " . DB_PREFIX . "Scheme_Master  ORDER BY Scheme_Name ASC "); 
 return $query->rows; 
     
 }

     public function getupdatedata($id){
         $query = $this->db->query("SELECT sid,Scheme_Name ,Start_Date ,End_date,points,Gift FROM " . DB_PREFIX . "Scheme_Master WHERE sid='".$id."'");
         
         return $query->row;  
    }
     public function addredemption($data){
    $productcount=$data['product_id'];
    $pt_sid=$data['points_id'];
    
    $product=count($productcount);
    for($i=0;$i<$product;$i++) {
     $pid=explode("-",$data["product_id"][$i]);
     $qty=$data["qty".$pid[0]];
     //******* Check ID Exist Or Not ************//
    $chksql="SELECT count(SID) as 'total' FROM " . DB_PREFIX . "points WHERE SID = '".$pt_sid[$i]."'";
    $query = $this->db->query($chksql);
    $tot = $query->row['total'];
    if($tot==1)
    {
  $sql="update " . DB_PREFIX . "points SET QUANTITY='".$qty."'WHERE SID='".$pt_sid[$i]."'";
  $this->db->query($sql);
  $ret_id = $this->db->countAffected();

    }
    else{     
     $sql1="INSERT INTO  " . DB_PREFIX . "scheme_detail SET product_id = '".$pid[0]."',product_qty = '" . $qty . "',scheme_id='".$data["sid"]."', act='1'";
     $this->db->query($sql1);
     $ret_id = $this->db->countAffected();
    }
    }
     return $ret_id;
    }
   public function getproqty($id){
     
   $sql = "select p.PRODUCT_NAME as product_name,pt.START_DATE,pt.END_DATE,asm.Scheme_Name,
asm.sid as scheme_id, pt.QUANTITY as quantity, asm.Gift as gift, asm.points as points, PRODUCT_ID,pt.SID as points_id   from " . DB_PREFIX . "points as pt 
left join " . DB_PREFIX . "product as p on pt.PRODUCT_ID = p.SID 
left join " . DB_PREFIX . "Scheme_Master as asm on asm.sid =pt.SCHEME_ID 
where asm.sid ='".$id."'"; 
  // print_r($sql); die;
   $query = $this->db->query($sql);
  return $query->rows;   
 }
 
  

 
     
    
    
 
}