<?php

class Modelresolutiondashboard extends Model {
    
    public function getmissedcallData($data){
    
    
         
        $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
  
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
    public function CallSts(){
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function CallUsr(){
        $sql="select SID,`NAME` from voc_user where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    
  public function getmissedcallDatacount($data){
       $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
    public function StateData(){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=2 ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->rows;  
    }
    public function DistData($stid){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=3 AND STATE_ID='".$stid."'ORDER BY `NAME` ";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CropData(){
        $sql="select CROP_ID, CROP_DESC from mas_crop";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdData($catid){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=2 and PRODUCT_PAR='".$catid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function ProdCatData(){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=1 and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CompData($comid){
        $sql="select SID,COMP_CATG from crm_comp_catg_mst where LAYER_TYPE=2 and PAR_COMP_CATG='".$comid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function CompCatData(){
        $sql="select SID,COMP_CATG from crm_comp_catg_mst where LAYER_TYPE=1 and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function EnqCatData(){
        $sql="select SID,CATEGORY_NAME from mas_enquiry_category where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function EnqTypData(){
        $sql="select SID, ENQUIRY_TYPE from mas_enquiry_category_name where ACT=1";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    
    public function TotalcallData(){
        $cr_by = $this->customer->getId();
        $sql="select 
        COUNT(CASE WHEN case_status <>0 THEN case_status END) AS 'ALLCASE',
        COUNT(CASE WHEN case_status <>0 AND COMP_RA='".$cr_by."' THEN case_status END) AS 'MYCASE',
        COUNT(CASE WHEN case_status = 7 THEN case_status END) AS 'PENDING',
        COUNT(CASE WHEN case_status = 8 THEN case_status END) AS 'CLOSED',
        COUNT(CASE WHEN case_status NOT IN(0,8,7) THEN case_status END) AS 'PROGRESS'
        FROM crm_case";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function TotalcatData(){
        $cr_by = $this->customer->getId();
        $sql="SELECT 
        count(A.SID) AS 'COMP_SUB_COUNT', A.COMP_CATG AS 'COMP_SUB_NAME'
        FROM
            (SELECT 
                cm.SID,cm.COMP_CATG
                FROM crm_case cc
                LEFT JOIN crm_comp_catg_mst cm 
                ON (cc.COMP_TYPE = cm.SID AND cc.COMP_CATG = cm.PAR_COMP_CATG AND cm.LAYER_TYPE=2)
                WHERE cc.COMP_RA='".$cr_by."') AS A
        GROUP BY A.SID,A.COMP_CATG";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    
  
}


