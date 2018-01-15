<?php

class Modeladvisoryheadwise extends Model {
    
  
    public function getAdvisoryhead($data){
          $from_date=$data["from_date"];
          $to_date=$data["to_date"];
          $advhead_name=$data["advhead_name"];
          if(empty($advhead_name))
          {
               $advhead_name='NULL';
          }
        else {$advhead_name="'".$advhead_name."'";}
        
         $sql="SELECT crd.FAR_MOB as MOBILE,cad.ADV_HEAD as ADV_HEAD,cad.ADV_HEAD_DETAILS ,cad.CR_DATE FROM `crm_adv_detail`cad left join crm_adv crd on crd.CASE_ID=cad.CASE_ID where cad.CR_DATE BETWEEN '".$from_date."' and '".$to_date."' and cad.ADV_HEAD=ifnull($advhead_name,cad.ADV_HEAD)  ";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    

    
  
}


