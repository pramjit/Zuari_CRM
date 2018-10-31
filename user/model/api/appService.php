<?php
class ModelapiappService extends Model {
    
    public function InsAppData($AppData){
		$log=new Log("AppService".DATE('d_m_Y').".log");
		$log->write("Model Data: ".$AppData);
		$CrDate=date('Y-m-d H:i:s');	
			$ServiceType 	= $AppData['ServiceType'];
			$getStateName	= $AppData['StateId'];
                        //******** Find State Id From Name **************//
                        $stsql="SELECT IFNULL(GEO_ID,728) AS 'STID', IFNULL(`NAME`,'OTHER') AS 'STNM' FROM mas_pol_geo WHERE `NAME` LIKE '%".$getStateName."%' LIMIT 0,1";
                        $log->write("State Data: ".$stsql);
                        $query = $this->db->query($stsql);
                        
                        $StateId=$query->row['STID'];
                        if(empty($StateId)){$StateId='728';}// For Other State
                        $StateName=$query->row['STNM'];
                        if(empty($StateName)){$StateName='OTHER';}
                       
                        $Mobile			= $AppData['Mobile'];
			$QueryId		= $AppData['QueryId'];
			if(empty($QueryId)){$QueryId='0';}
			$Query			= $AppData['Query'];
			if(empty($Query)){$Query='NA';}
			$ProductId		= $AppData['ProductId'];
			if(empty($ProductId)){$ProductId='0';}
			$ProductName	= $AppData['ProductName'];
			if(empty($ProductName)){$ProductName='NA';}
			$OrderId		= $AppData['OrderId'];
			if(empty($OrderId)){$OrderId='0';}
			$Quantity		= $AppData['Quantity'];
			if(empty($Quantity)){$Quantity='0.00';}
			$CustomerName	= $AppData['CustomerName'];
			if(empty($CustomerName)){$CustomerName='NA';}
			$StoreAssigned	= $AppData['StoreAssigned'];
			if(empty($StoreAssigned)){$StoreAssigned='0';}
			$StoreName		= $AppData['StoreName'];
			if(empty($StoreName)){$StoreName='NA';}
			
			$ImageUrl1		= $AppData['ImageUrl1'];
			if(empty($ImageUrl1)){$ImageUrl1='NA';}
			$ImageUrl2		= $AppData['ImageUrl2'];
			if(empty($ImageUrl2)){$ImageUrl2='NA';}
			
		$sql="INSERT INTO app_services SET
			`ServiceType`='".$ServiceType."',
			`StateId`='".$StateId."',
			`StateName`='".$StateName."',
			`Mobile`='".$Mobile."',
			`QueryId`='".$QueryId."',
			`Query`='".$Query."',
			`ProductId`='".$ProductId."',
			`ProductName`='".$ProductName."',
			`OrderId`='".$OrderId."',
			`Quantity`='".$Quantity."',
			`ImageUrl1`='".$ImageUrl1."',
			`ImageUrl2`='".$ImageUrl2."',
			`CustomerName`='".$CustomerName."',
			`StoreAssigned`='".$StoreAssigned."',
			`StoreName`='".$StoreName."',
			`CrDate`='".$CrDate."',
			`UpDate`='".$CrDate."',
			`CrBy`='100',
			`UpBy`='0'";
		$log->write("Query Data: ".$sql);
		if($query = $this->db->query($sql)){
		
			
                        //Advisory Service
                        if($ServiceType==2){
                            $AdvRecSql="SELECT CASE_ID, CASE_PIN, ADV_ID FROM crm_adv WHERE FAR_MOB='".$Mobile."' AND CASE_STATUS=7 AND ADV_ID<>'' LIMIT 1";
                            $AdvRecQry = $this->db->query($AdvRecSql);
                            $ADL_ID=$AdvRecQry->row['ADV_ID'];
                            $ADL_CASE=$AdvRecQry->row['CASE_ID'];
                            $ADL_CASE_PIN=$AdvRecQry->row['CASE_PIN'];
                            if(empty($ADL_CASE)){
                                $ADL_DATE_TIME=date('Y-m-d H:i:s');
                                $t = microtime(true);
                                $micro = sprintf("%02d",($t - floor($t)) * 100);
                                $case_id = date('ymdHis', $t).$micro;
                                $AdvDtlSql="SELECT emp_geo_map.CUST_ID AS 'CUST_ID',
                                    ak_customer.User_Id AS 'USER_ID',
                                    ak_customer.firstname AS 'ADL_NAME',
                                    ak_customer.telephone AS 'ADL_MOB',
                                    ak_customer.email AS 'ADL_EMAIL' 
                                    FROM emp_geo_map 
                                    JOIN ak_customer ON(emp_geo_map.CUST_ID=ak_customer.customer_id)
                                    WHERE emp_geo_map.GEO_ID='".$StateId."' LIMIT 1";
                                $AdvDtlQry = $this->db->query($AdvDtlSql);
                                $ADL_CASE=$case_id;
                                $ADL_ID=$AdvDtlQry->row['CUST_ID'];
                                $ADL_NAME=$AdvDtlQry->row['ADL_NAME'];
                                $ADL_MOB=$AdvDtlQry->row['ADL_MOB'];
                                $ADL_EMAIL=$AdvDtlQry->row['ADL_EMAIL'];
                                $pinsql="select case_pin from `crm_adv` order by case_pin DESC LIMIT 1 ";
                                $pinqry=$this->db->query($pinsql);
                                if(empty($pinqry->row['case_pin'])){
                                    $ADL_CASE_PIN=1001; 
                                    }
                                else{
                                        $ADL_CASE_PIN = $pinqry->row['case_pin']+1;
                                    }
                                //======================== Add Record To CRM_ADV===========================//
                                if(empty($ADL_ID)){$ADL_ID=0;}
                                $sqlcom="INSERT INTO `crm_adv` set
                                        `CASE_ID` ='".$ADL_CASE."',
                                        `CASE_PIN`='".$ADL_CASE_PIN."',
                                        `FAR_MOB` ='".$Mobile."',
                                        `CR_BY` ='0',
                                        `ADV_ID`='".$ADL_ID."',
                                        `CASE_STATUS`='7',
                                        `CASE_TYPE`='1',
                                        `CR_DATE` ='".$ADL_DATE_TIME."'";

                                $this->db->query($sqlcom);  
                                //======================== Add Record To CRM_ADV===========================//
                                $adlstr=$ADL_CASE.",".$ADL_CASE_PIN.",".$ADL_ID.",".$ADL_NAME.",".$ADL_MOB.",".$ADL_EMAIL.",".$StateId;
                                return $adlstr;
                            }
                            else{ 
                                
                                $AdvDtlSql="SELECT customer_id AS 'CUST_ID',User_Id AS 'USER_ID', 
                                firstname AS 'ADL_NAME',telephone AS 'ADL_MOB',email AS 'ADL_EMAIL'  
                                FROM ak_customer WHERE customer_id='".$ADL_ID."'";
                                $AdvDtlQry = $this->db->query($AdvDtlSql);
                                $ADL_ID=$AdvDtlQry->row['CUST_ID'];
                                $ADL_NAME=$AdvDtlQry->row['ADL_NAME'];
                                $ADL_MOB=$AdvDtlQry->row['ADL_MOB'];
                                $ADL_EMAIL=$AdvDtlQry->row['ADL_EMAIL'];
                                $adlstr=$ADL_CASE.",".$ADL_CASE_PIN.",".$ADL_ID.",".$ADL_NAME.",".$ADL_MOB.",".$ADL_EMAIL.",".$StateId;
                                return $adlstr;
                            }
                        }
                        else{//Service Query 
                                
                            //Check If there is an open call 
                            $chk_rc_sql="SELECT MOBILE_NO,RTLR_CODE,CALL_TYPE FROM ak_retailers_call WHERE MOBILE_NO='".$Mobile."' AND CALL_COUNT=0 AND CALL_TYPE=3 ORDER BY RTLR_CODE DESC LIMIT 1";
                            $chk_rc_qry=$this->db->query($chk_rc_sql);
                            if(empty($chk_rc_qry->row['MOBILE_NO'])){ // There is no record for App Query (Call_Type=3)
                                
                                $pinsql="SELECT RTLR_CODE from `ak_retailers_call` ORDER BY RTLR_CODE DESC LIMIT 1; ";
                                $pinqry=$this->db->query($pinsql);
                                if(empty($pinqry->row['RTLR_CODE'])){
                                    $RTLR_CODE=1001; 
                                }
                                else{
                                        $RTLR_CODE = $pinqry->row['RTLR_CODE']+1;
                                }
                                $ins_app_rtlr_sql="INSERT INTO ak_retailers_call SET 
                                    RETAILER_NAME='APP FARMER', 
                                    MOBILE_NO='".$Mobile."', 
                                    RTLR_CODE='".$RTLR_CODE."', 
                                    CALL_STATUS=1, 
                                    CALL_DATE=CURDATE(), 
                                    CALL_TYPE=3, 
                                    CALL_COUNT=0, 
                                    CR_DATE=CURDATE()";
                                    $this->db->query($ins_app_rtlr_sql);
                                return 1;
                                    
                            }else{
                                return 1;
                            }
                        }
                        
                        
		}else{
			return 0;
		}
    }
    
    
}


