<?php

class Modelcomplaintcomplaindetails extends Model 
{
    public function complaintData($data){
          $from_date=$data["from_date"];
          $to_date=$data["to_date"];
          $state=$data["state"];
          if(empty($state))
          {
               $state='NULL';
          }
        
          $complain=$data["complain"];
          if(empty( $complain))
          {
                $complain='NULL';
          }
           $pendding=$data["pendding"];
          if(empty( $pendding))
          {
                $pendding='NULL';
          }
         $sql="SELECT (CASE WHEN cc.CASE_STATUS <> 8 THEN (TO_DAYS(CURDATE())-TO_DAYS(cc.DUE_DATE) )
ELSE 'NA'
END)as due_date,crcs.case_status, cc.PROD_BRAND,cc.CR_DATE,cc.COMP_MOBILE,cci.STATE ,mpg.NAME as STATE,cc.COMPLAINT_QUERY,cccm.COMP_CATG as COMP_CATG ,cccms.COMP_CATG as COMP_TYPE,map.PRODUCT_DESC as PROD_GROUP,mapp.PRODUCT_DESC as PROD_CATG,mappo.PRODUCT_DESC as PROD_ID FROM `crm_case` cc LEFT JOIN cc_incomingcall cci on cci.MOBILE=cc.COMP_MOBILE left join mas_pol_geo mpg on mpg.GEO_ID=cci.STATE left join crm_comp_catg_mst cccm on cccm.SID=cc.COMP_CATG left join crm_comp_catg_mst cccms on cccms.SID=cc.COMP_TYPE left join mas_product map on map.PRODUCT_ID=cc.PROD_GROUP left join mas_product mapp on mapp.PRODUCT_ID=cc.PROD_CATG left join mas_product mappo on mappo.PRODUCT_ID=cc.PROD_ID left join crm_case_status crcs on crcs.sid=cc.CASE_STATUS where cc.CR_DATE BETWEEN '".$from_date."' and '".$to_date."' and cci.STATE=ifnull($state,cci.STATE) and cccm.SID=ifnull($complain,cccm.SID) and crcs.sid=ifnull($pendding,crcs.sid)";
          $query = $this->db->query($sql);
          return $query->rows;
    }
    public function getState(){
        $sql="SELECT GEO_ID,NAME FROM mas_pol_geo WHERE MARK_TYPE=2 ORDER BY NAME";
        $query = $this->db->query($sql);
        return $query->rows;
    }
     public function getComplain(){
        $sql="SELECT SID,COMP_CATG FROM `crm_comp_catg_mst` where LAYER_TYPE=1 ORDER BY COMP_CATG ";
        $query = $this->db->query($sql);
        return $query->rows;
    }
     public function getPendding(){
        $sql="SELECT sid,case_status FROM `crm_case_status` where emp_role in(4,0) and act=1 and sid not in(1) ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    
  
}


