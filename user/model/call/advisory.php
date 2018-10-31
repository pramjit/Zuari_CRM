<?php

class Modelcalladvisory extends Model {
    
    public function AdvData($data){
		$cr_by = $this->customer->getId();
		$log=new Log("CC_Adv_Call.log");
    $sql="select crm_adv.CASE_ID,crm_adv.FAR_MOB,crm_adv.CASE_PIN,crm_adv.TOT_ATTEMPT,mas_callstatus.status_name as 'STATUS',mas_pol_geo.STATE_CODE as 'STATE'
from crm_adv 
left join mas_callstatus on(crm_adv.case_status=mas_callstatus.status_id)
left join cc_incomingcall on(crm_adv.FAR_MOB = cc_incomingcall.mobile)
left join mas_pol_geo on(cc_incomingcall.state=mas_pol_geo.geo_id)
where crm_adv.case_status in(27) 
and cc_incomingcall.state in(select state_id from ak_agent_geo where cc_agent_id='".$cr_by."')
and crm_adv.call_from <> '' and file_sync=1 and cc_attend=0
and crm_adv.tot_attempt < 3  group by crm_adv.CASE_ID order by crm_adv.CALL_DATE DESC";   
$log->write($sql);                                                                             
    $query = $this->db->query($sql);
    return $query->rows;   
        
    }
    public function CallSts(){
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where ACT=1 and STATUS_ID IN(27,35)";
        $query = $this->db->query($sql);
        return $query->rows;   
    }
    public function CallUsr(){
        $sql="select SID,`NAME` from voc_user where ACT=1 LIMIT 1";
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
    public function RecData($data){
        $caseid=$data['caseid'];
        $sql="select case_pin AS 'CASE_PIN', far_mob AS 'TO_MOB',call_from AS 'FROM_MOB' from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function SaveFeedBack($data){
        $log=new Log("SaveFeedBack.log");
        $cr_by = $this->customer->getId();
        $cr_date=date('Y-m-d');
        $log->write($data);
		$callsts=$data['callsts'];
        if($callsts==35){
			$caseid=$data['caseid'];
			
			$sql="update crm_adv set case_status=7, call_from=null,call_date=null,call_count=0,tot_attempt=0,call_status=0,file_sync=0 where case_id='".$caseid."'";
			$log->write($sql);
			$query = $this->db->query($sql);
			return $this->db->countAffected();
		}
		else{
        ///////////////////////////////////
        $compsts=$data['compsts'];
        $Crop_Nutrition_Type=$data['Crop_Nutrition_Type'];
        $Crop_Protection_Type=$data['Crop_Protection_Type'];
        $Seed_Type=$data['Seed_Type'];
        $Soil_Type=$data['Soil_Type'];
        $Irrigation_Type=$data['Irrigation_Type'];
        $Others_Type=$data['Others_Type'];
		
		//*********************** CROP ADDITION *******************************//
		$crop_Details_Nurtition=$data["crop_Details_Nurtition"];
        $crop_Details_Protection=$data["crop_Details_Protection"];
        $crop_Details_Seed=$data["crop_Details_Seed"];
        $crop_Details_Soil=$data["crop_Details_Soil"];
        $crop_Details_Irrigation=$data["crop_Details_Irrigation"];
        $crop_Details_Others=$data["crop_Details_Others"];
        
	 if(empty($crop_Details_Nurtition)){$crop_Details_Nurtition='NA';}
         if(empty($crop_Details_Protection)){$crop_Details_Protection='NA';}
         if(empty($crop_Details_Seed)){$crop_Details_Seed='NA';}
         if(empty($crop_Details_Soil)){$crop_Details_Soil='NA';}
         if(empty($crop_Details_Irrigation)){$crop_Details_Irrigation='NA';}
         if(empty($crop_Details_Others)){$crop_Details_Others='NA';}
		
				
		
        if(empty($Others_Type)){$Others_Type='Others';}
        $caseid=$data['caseid'];
        $callsts=$data['callsts'];
		
        $Crop_Nutrition_Data=$data['Crop_Nutrition_Data'];
        $Crop_Nutrition_Data=str_replace("'", "", $Crop_Nutrition_Data);
        if(empty($Crop_Nutrition_Data)){$Crop_Nutrition_Data='NA';}

        $Crop_Protection_Data=$data['Crop_Protection_Data'];
        $Crop_Protection_Data=str_replace("'", "", $Crop_Protection_Data);
        if(empty($Crop_Protection_Data)){$Crop_Protection_Data='NA';}

        $Seed_Data=$data['Seed_Data'];
        $Seed_Data=str_replace("'", "", $Seed_Data);
        if(empty($Seed_Data)){$Seed_Data='NA';}
        
        $Soil_Data=$data['Soil_Data'];
        $Soil_Data=str_replace("'", "", $Soil_Data);
        if(empty($Soil_Data)){$Soil_Data='NA';}

        $Irrigation_Data=$data['Irrigation_Data'];
        $Irrigation_Data=str_replace("'", "", $Irrigation_Data);
        if(empty($Irrigation_Data)){$Irrigation_Data='NA';}
        
        $Others_Data=$data['Others_Data'];
        $Others_Data=str_replace("'", "", $Others_Data);
        if(empty($Others_Data)){$Others_Data='NA';}
        //////////////////////////////////
        $log->write("CrBy: ".$cr_by);
        
        
        //Get pre status of caseid
        $sqlpre="select case_status from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sqlpre);
        $prests = $query->row['case_status'];
        if(!empty($Crop_Nutrition_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Crop_Nutrition_Type."',adv_head_details='".$Crop_Nutrition_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Nurtition."', ADV_HEAD_ID=1";
            $query = $this->db->query($sqlfeed);
            $suc1 = $this->db->countAffected();
        }
        if(!empty($Crop_Protection_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Crop_Protection_Type."',adv_head_details='".$Crop_Protection_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Protection."', ADV_HEAD_ID=2";
            $query = $this->db->query($sqlfeed);
            $suc2 = $this->db->countAffected();
        }
        if(!empty($Seed_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Seed_Type."',adv_head_details='".$Seed_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Seed."', ADV_HEAD_ID=3";
            $query = $this->db->query($sqlfeed);
            $suc3 = $this->db->countAffected();
        }
        if(!empty($Soil_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Soil_Type."',adv_head_details='".$Soil_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Soil."', ADV_HEAD_ID=4";
            $query = $this->db->query($sqlfeed);
            $suc4 = $this->db->countAffected();
        }
        if(!empty($Irrigation_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Irrigation_Type."',adv_head_details='".$Irrigation_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Irrigation."', ADV_HEAD_ID=5";
            $query = $this->db->query($sqlfeed);
            $suc5 = $this->db->countAffected();
        }
        if(!empty($Others_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Others_Type."',adv_head_details='".$Others_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."',CROP_DETAILS='".$crop_Details_Others."', ADV_HEAD_ID=0";
            $query = $this->db->query($sqlfeed);
            $suc6 = $this->db->countAffected();
        }
        if($suc1==1 || $suc2==1 || $suc3==1 || $suc4==1 || $suc5==1 || $suc6==1){
            
            $upadv="update crm_adv set case_status='".$callsts."', cc_attend=cc_attend+1 ,tot_attempt=tot_attempt+1 where case_id='".$caseid."'";
            $query = $this->db->query($upadv);
            $suc = $this->db->countAffected();
            if($callsts==27)
            {
                return $caseid;
            }
            else{
                return $suc;
            }
        }
        else{
            return $suc;
        }
	}//else end  
  }
    //********************************SAVE FORM DATA **************************//
   public function CaseMailDtls($cid){
        $sql="select 
            crm_adv.case_id as 'CID',
            crm_adv.ADV_ID as 'RAID',
            crm_adv.case_pin as 'NOD' ,
            ak_customer.email as 'MID', 
            concat(ak_customer.firstname,' ',ak_customer.lastname)as 'RA_NAME', 
            32 AS 'FLAG' from crm_adv
            left join ak_customer on(crm_adv.adv_id=ak_customer.customer_id)
            where crm_adv.case_id='".$cid."'";
        $query = $this->db->query($sql);
        return $query->row;
   }
  
}


