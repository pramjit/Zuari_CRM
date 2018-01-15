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
        
         $sql="SELECT crd.FAR_MOB as MOBILE,mpg.NAME AS STATE,mpgz.NAME AS ZONE,mpgd.NAME AS REGION,
                cad.ADV_HEAD as ADV_HEAD,cad.ADV_HEAD_DETAILS ,
                DATE(cad.CR_DATE) AS 'CR_DATE' FROM `crm_adv_detail` cad 
                left join
                crm_adv crd on crd.CASE_ID=cad.CASE_ID
                left join cc_incomingcall cc on (cc.MOBILE=crd.FAR_MOB)
                left join mas_pol_geo mpg on(mpg.GEO_ID=cc.STATE)
                left join mas_pol_geo mpgz on(mpgz.GEO_ID=mpg.ZO_ID)
                left join mas_pol_geo mpgd on(mpgd.GEO_ID=mpg.RO_ID) 
                where cad.CR_DATE BETWEEN '".$from_date."' and '".$to_date."' and cad.ADV_HEAD=ifnull($advhead_name,cad.ADV_HEAD) 
				and cad.case_id in(select case_id from crm_adv_detail where case_id in(select case_id from crm_adv group by case_id))";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    

    
  
}


