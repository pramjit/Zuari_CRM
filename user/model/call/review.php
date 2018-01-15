<?php

class Modelcallreview extends Model {
    
    public function getreviewData($data){
    
    $log=new Log("review.log");
         
        $sql="SELECT crc.comp_mobile AS 'MOBILE', IFNULL(msm.state,'NA')AS 'STATE', DATE(mod_date) AS 'DATE_RECEIVED'
            FROM crm_case crc
            LEFT JOIN cc_incomingcall cci ON(crc.COMP_MOBILE = cci.MOBILE)
            LEFT JOIN ms_mobilestate msm ON (cci.STATE=msm.stateid)
            WHERE crc.CASE_STATUS IN (3)
            GROUP BY crc.comp_mobile, msm.state, mod_date";
        $log->write($sql); 
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
    
  public function getreviewDatacount($data){
       $sql="select MOBILE,DATE_RECEIVED,IFNULL(ms_mobilestate.state,'NA') AS STATE
            from cc_incomingcall
            LEFT JOIN ms_mobilestate 
            ON cc_incomingcall.STATE=ms_mobilestate.stateid
            WHERE DATE_RECEIVED BETWEEN '".$data["from_date"]."' AND '".$data["to_date"]."'
            GROUP BY MOBILE,DATE_RECEIVED, ms_mobilestate.state";
       $query = $this->db->query($sql);
        return $query->rows;   
         
  }
  public function ZoneData($zoid){
      $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=10  and GEO_ID='".$zoid."' ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->row;  
  }
  public function RegionData($roid){
      $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=11  and GEO_ID='".$roid."' ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->row;  
  }
  public function StateData($stid){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=2  and GEO_ID='".$stid."' ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->row;  
    }
    public function DistData($dtid){
        $sql="select GEO_ID,`NAME` from mas_pol_geo WHERE MARK_TYPE=3 AND GEO_ID='".$dtid."'ORDER BY `NAME`";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function MoData($moid){
        $sql="select mo_office_geo_code,mo_office_name from crm_mo_office WHERE mo_office_geo_code='".$moid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function CropData1($crp){
        $sql="select CROP_ID, CROP_DESC from mas_crop where CROP_ID='".$crp."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function CropData2($crp){
        $sql="select CROP_ID, CROP_DESC from mas_crop where CROP_ID='".$crp."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function CropData3($crp){
        $sql="select CROP_ID, CROP_DESC from mas_crop where CROP_ID='".$crp."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function ProdGrpData($grp){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=1 and PRODUCT_ID='".$grp."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function ProdCatData($cat){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=2 and PRODUCT_ID='".$cat."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function ProdData($pid){
        $sql="select PRODUCT_ID,PRODUCT_DESC from mas_product where PRODUCT_TYPE=3 and PRODUCT_ID='".$pid."' and ACT=1";
        $query = $this->db->query($sql);
        return $query->row;
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
   
    
    public function FeedFarData($data)
    {
        $mob=$data['mob'];
        $log=new Log("feedfardata.log");
        $sql="select crf.*,crc.PROD_GROUP,crc.PROD_CATG,crc.PROD_ID,crc.PROD_BRAND,crc.PROD_BATCH,crc.PROD_IMP,crc.PROD_PAKG,crc.PROD_PLANT,crc.COMP_CATG,crc.COMP_TYPE,crc.COMPLAINT_REMARKS,crc.CASE_ID
                from ak_farmer crf
                left join crm_case crc on(crf.far_mobile = crc.comp_mobile)
                where crf.far_mobile='".$mob."'";
        $log->write($mob);
        $log->write($sql);
        $query = $this->db->query($sql);
        return $query->row;
    }
    
    
    
    
    
    public function subccdata($data){
        $log=new Log("CC_RA_Review.log");
        $log->write($data);
        $caseid=$data['caseid'];
        $remarks=$data['ccremarks'];
        $remarks=str_replace("'", "", $remarks);
        if(empty($remarks)){$remarks='NA';}
        $sqlprests="select case_status from crm_case where case_id='".$caseid."'";
        $authority=$this->db->query($sqlprests);
        $pre_sts=$authority->row['case_status'];
        $cr_date=date('Y-m-d');
        $cr_by = $this->customer->getId();
        $sqllastrec="SELECT crm_case_detail.CASE_ID AS 'CASE_ID',
			IFNULL(crm_case_detail.RA_REMARKS,'NA') AS 'RA_REMARKS',
			IFNULL(crm_case_detail.RA_DATE,'NULL') AS 'RA_DATE',
			IFNULL(crm_case_detail.AA_REMARKS,'NA') AS 'AA_REMARKS',
			IFNULL(crm_case_detail.AA_DATE,'NULL') AS 'AA_DATE',
                        IFNULL(crm_case_detail.UP_FILE_PATH,'NA') AS 'UP_FILE_PATH',
                        IFNULL(crm_case_detail.SOLUTION,'NA') AS 'SOLUTION'
			FROM crm_case_detail
			WHERE CASE_ID = '".$caseid."' ORDER BY SID DESC LIMIT 1";
        $lstqry=$this->db->query($sqllastrec);
        if($lstqry->num_rows==0){
            $ra_remarks='NA';
            $ra_date=NULL; 
            $aa_remarks='NA';
            $aa_date=NULL; 
            $filepath='NA';
            $commnts='NA';
        }
        else{
        $ra_remarks=$lstqry->row['RA_REMARKS'];
        $ra_date=$lstqry->row['RA_DATE'];
        $aa_remarks=$lstqry->row['AA_REMARKS'];
        $aa_date=$lstqry->row['AA_DATE'];
        $filepath=$lstqry->row['UP_FILE_PATH'];
        $commnts=$lstqry->row['SOLUTION'];
        }
        
        
        $sql="insert into crm_case_detail set 
                case_id='".$caseid."',
                case_pre_status='".$pre_sts."',
                case_cur_status='7',
                solution='".$commnts."',
                ra_remarks='".$ra_remarks."',
                ra_date='".$ra_date."',
                aa_remarks='".$aa_remarks."',
                aa_date='".$aa_date."',
                cc_remarks='".$remarks."',
                cc_date='".$cr_date."',
                cr_date='".$cr_date."',
                up_user_id='".$cr_by."',
                up_file_path='".$filepath."'";
         $log->write($sql);
        $this->db->query($sql);
        $ret_id = $this->db->countAffected();  
        if($ret_id==1){
            $sql="update crm_case set case_status='7' where case_id='".$caseid."'";
            $this->db->query($sql);
            $ret_id2 = $this->db->countAffected();
            if($ret_id2==1){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{            
            return 0;
        }
    }
    //****************** ENQUIRY TAB DATA *******************//
    /*  $enname   = $data['en-far-name'];
        $enfaname = $data['en-far-fa-name'];
        $envil    = $data['en-far-vil'];
        $enpost   = $data['en-post'];
        $entehsil = $data['en-tehsil'];
        $enpin    = $data['en-pin'];
        $enst     = $data['eselst'];
        $endt     = $data['eseldt'];
        $enmob    = $data['en-far-mob'];
        $enmob2   = $data['en-far-mob2'];
        $encrop   = $data['ecrop'];
        $encropacr= $data['ecrop-acr'];
        $entotacr = $data['ecrop-tot-acr'];
        $enprocat = $data['eprocat'];
        $enprodata= $data['eprodata'];
        $encat    = $data['ecat'];
        $entyp    = $data['etyp'];
        $endtls   = $data['en-dtls'];
        $endesc   = $data['en-desc'];
        $ensrc    = $data['en-src'];
        $enres    = $data['en-res'];
        $ensts    = $data['en-sts'];
        $enresdt  = $data['en-res-dt'];
        $enressol = $data['en-res-sol'];

     * 
     * 
     * 
     *  $sqldtl="insert into  `crm_case_detail` set
                            `CASE_ID` = '".$far_id."',
                            `CASE_PRE_STATUS`= '".$far_id."',
                            `CASE_CUR_STATUS`= '".$far_id."',
                            `CONV_DETAIL`= '".$far_id."',
                            `SOLUTION`= '".$far_id."',
                            `FURTHER_ACTION`= '".$far_id."',
                            `CR_DATE` = '".$far_id."',
                            `UP_USER_ID` = '".$far_id."',
                            `UP_USER_NAME`= '".$far_id."',
                            `UP_USER_EMAIL`= '".$far_id."',
                            `UP_FILE_PATH`= '".$far_id."'";
                        $this->db->query($sqldtl);
                        $ret_id3 = $this->db->countAffected();      */  
  
}


