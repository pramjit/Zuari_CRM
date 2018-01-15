<?php

class Modeladvisoryadvisory extends Model {
    
    public function AdvData($data){
	$cr_by = $this->customer->getId();
    $sql="select CALL_STATUS,CASE_ID,FAR_MOB,CASE_PIN,CALL_COUNT, DATE_FORMAT(CR_DATE,'%d-%m-%Y') AS CR_DATE from crm_adv where case_status in (4,6,7,11,22,23) and adv_id='".$cr_by."' and CALL_COUNT<3 ORDER BY CR_DATE DESC ";
    $query = $this->db->query($sql);
    return $query->rows;   
        
    }
    public function CallSts(){
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where ACT=1 and STATUS_ID NOT IN(2,29,30,31,32,33,34,0)";
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
        $sql="select far_mob AS 'TO_MOB',call_from AS 'FROM_MOB' from crm_adv where case_id='".$caseid."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function SaveFeedBack($data){
        $log=new Log("SaveFeedBack.log");
        $cr_by = $this->customer->getId();
        $cr_date=date('Y-m-d');
        $log->write($data);
        
        ///////////////////////////////////
        $compsts=$data['compsts'];
        $Crop_Nutrition_Type=$data['Crop_Nutrition_Type'];
        $Crop_Protection_Type=$data['Crop_Protection_Type'];
        $Seed_Type=$data['Seed_Type'];
        $Soil_Type=$data['Soil_Type'];
        $Irrigation_Type=$data['Irrigation_Type'];
        $Others_Type=$data['Others_Type'];
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
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Crop_Nutrition_Type."',adv_head_details='".$Crop_Nutrition_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc1 = $this->db->countAffected();
        }
        if(!empty($Crop_Protection_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Crop_Protection_Type."',adv_head_details='".$Crop_Protection_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc2 = $this->db->countAffected();
        }
        if(!empty($Seed_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Seed_Type."',adv_head_details='".$Seed_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc3 = $this->db->countAffected();
        }
        if(!empty($Soil_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Soil_Type."',adv_head_details='".$Soil_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc4 = $this->db->countAffected();
        }
        if(!empty($Irrigation_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Irrigation_Type."',adv_head_details='".$Irrigation_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc5 = $this->db->countAffected();
        }
        if(!empty($Others_Data))
        {
            $sqlfeed="insert into crm_adv_detail set case_id='".$caseid."', case_pre_status='".$prests."', case_cur_status='".$callsts."',adv_remarks='NA',cc_remarks='NA',adv_head='".$Others_Type."',adv_head_details='".$Others_Data."',cr_by='".$cr_by."',cr_date='".$cr_date."'";
            $query = $this->db->query($sqlfeed);
            $suc6 = $this->db->countAffected();
        }
        
        
        
        
        
        
        
        if($suc1==1 || $suc2==1 || $suc3==1 || $suc4==1 || $suc5==1 || $suc6==1){
            
            $upadv="update crm_adv set case_status='".$callsts."' where case_id='".$caseid."'";
            $query = $this->db->query($upadv);
            $suc = $this->db->countAffected();
            return $suc;
        }
        else{
            return $suc;
        }
        
    }
     //********************************SAVE FORM DATA **************************//
    //********************************get stataus DATA  **************************//
   
    public function getStatus()
    {
        $sql="select STATUS_ID,STATUS_NAME from mas_callstatus where STATUS_ID NOT IN(2,7,9,10,16,18,19,29,30,31,32,33,34,35,36,99) and ACT=1";
        $query = $this->db->query($sql);
        return $query->rows; 
    }
     //********************************END get stataus DATA **************************//
   
    public function updateStatus($data)
    {
        
        $log=new Log("AdvCall".date('d_m_Y').".log");
		$log->write($data);
		$mobile=$data["mob"];
        $caseSt=$data["statusid"];
		//********************* Check Call Status *************************//
		if(($caseSt==4)||($caseSt==6)||($caseSt==11)||($caseSt==22)||($caseSt==23)){//Busy,Notreachable etc...
			$sql="update crm_adv SET CASE_STATUS='".$caseSt."', CALL_COUNT=CALL_COUNT+1 where FAR_MOB='".$mobile."'";
			$log->write($sql);
			$query = $this->db->query($sql);
			$suc = $this->db->countAffected();
			if($suc==1){
				$sql="select CALL_COUNT FROM crm_adv where FAR_MOB='".$mobile."'";
				$query = $this->db->query($sql);
				if($query->row['CALL_COUNT']>=3)
				{
					
					$sqlccup="update cc_incomingcall  set STATUS=99 where MOBILE='".$mobile."' and CALL_TYPE=2";
					$query = $this->db->query($sqlccup);
					$sqlcaup="update crm_adv set CASE_STATUS=0 where FAR_MOB='".$mobile."'";
					$query = $this->db->query($sqlcaup);
					$suc = $this->db->countAffected();
					return $suc;
					
				}
                                else{
                                    return $suc;
                                }
			}
		}
		if($caseSt==27){//Answered
			$sql="update crm_adv SET CASE_STATUS='".$caseSt."' where FAR_MOB='".$mobile."'";
			$log->write($sql);
			$query = $this->db->query($sql);
			$suc = $this->db->countAffected();
			return $suc;
		}
	}
   
  
}

