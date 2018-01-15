<?php

class Modelfarmerfarmerbulkupload extends Model  {
    public function readExcel($inputFileName,$name) {
        $arr=array();
        $read=new PHPReadExcel($inputFileName,$name);
        $arr=$read->getSheetData();   
        //return $arr;
        $user_id=$this->user->getId();
        unset($arr['0']);
        
    // Starting the PHPExcel library
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    
    $objPHPExcel->createSheet();
    
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);

    // Field names in the first row
    $fields = array(
        'Customer Code',
        'LASTNAME',
        'FIRSTNAME',
        'MOBILE',
        'STATE',
        'DISTRICT',
        'VILLAGE',
        'Status'
    );
    $col = 0;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
        $col++;
    }
    $row = 2;
     
    foreach($arr as $key=>$value) {
        
    
        $mobile=  strlen($value[3]);
        $query = $this->db->query("select customer_id,customer_group_id,sap_id from " . DB_PREFIX . "customer where User_Id='".$value[3]."'");
        //$query2 = $this->db->query("select sap_id from " . DB_PREFIX . "customer where sap_id='".$value[0]."'");
        $customer_id= $query->row["customer_id"];
        $customer_group_id=$query->row["customer_group_id"];
        $sap_id=$query->row["sap_id"];
        $query1 = $this->db->query("select FAR_MOBILE from " . DB_PREFIX . "farmer where FAR_MOBILE='".$value[3]."'");
        $mobile_no= $query1->row["FAR_MOBILE"];
        
        if(!empty($customer_id) and !empty($mobile_no) and $customer_group_id=='67') {
             
             $a='1';
         } else if(!empty($customer_id) and $customer_group_id!='67') {
             
             $a='2';
         }
          else {
             
            $a='0';
         }
         if(($sap_id==$value[0]) || empty ($sap_id))
         {
          $b='1';   
         }
         else {
     $b='0';   
         }
       
        if((!empty($value[0]))  && (!empty($value[2])) && (!empty($value[3])) && (!empty($value[5])) && $b=='1' && $mobile=='10' && $a=='0'){
            
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value[0]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value[1]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value[2]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $value[3]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $value[4]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $value[5]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $value[6]);
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, 'SUCCESS');
        
       
      $t = time();
      $cr_date = date('Y-m-d');  
      $query = $this->db->query("SELECT FAR_MOBILE FROM " . DB_PREFIX . "farmer WHERE FAR_MOBILE='". $value[3]."' ");
      $farmermobile= $query->row["FAR_MOBILE"];
      
      $query = $this->db->query("SELECT User_Id FROM " . DB_PREFIX . "customer WHERE User_Id='". $value[3]."'");
      $cutomermobile= $query->row["User_Id"];
      
       $query2 = $this->db->query("SELECT Nation_ID,STATE_ID,TERRITORY_ID FROM " . DB_PREFIX . "geo WHERE SID='". $data['district_id']."'");
      $Nation_ID= $query2->row["Nation_ID"];
      $STATE_ID= $query2->row["STATE_ID"];
      $TERRITORY_ID= $query2->row["TERRITORY_ID"];
       if(empty($value[4])){
           $value[4]=$STATE_ID;
       }
    if(empty($farmermobile) && empty($cutomermobile)) {
       
     $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '67',firstname = '" . $value[2] . "',User_Id = '" . $value[3] . "',email='". $value[3]."',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($value[3])))) . "',nation_id='".$Nation_ID."',state_id='".$value[4]."',territory_id='".$TERRITORY_ID."',district_id = '" . $value[5]. "',village_id = '" . $value[6] . "',status = '23',sap_id='".$value[0]."'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
 
    
     $sql="INSERT INTO  " . DB_PREFIX . "farmer SET SID = '$t',FARMER_NAME = '" . $value[2]. "',FAR_MOBILE = '" . $value[3] . "',DIST_ID = '" . $value[5] . "',VILL_ID = '" . $value[6] . "', CR_DATE='".$cr_date."',FARMER_STATUS='23',FAR_CATEGORY='2'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
    } 
    else if(!empty($farmermobile) && empty($cutomermobile)) {
     $sql="INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '67',firstname = '" . $value[2] . "',User_Id = '" . $value[3] . "',email='". $value[3]."',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($value[3])))) . "',nation_id='".$Nation_ID."',state_id='".$value[4]."',territory_id='".$TERRITORY_ID."',district_id = '" . $value[5]. "',village_id = '" . $value[6] . "',status = '23',sap_id='".$value[0]."'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
    }
    else if(empty($farmermobile) && !empty($cutomermobile)) {
       $sql="INSERT INTO  " . DB_PREFIX . "farmer SET SID = '$t',FARMER_NAME = '" . $value[2]. "',FAR_MOBILE = '" . $value[3] . "',DIST_ID = '" . $value[5] . "',VILL_ID = '" . $value[6] . "', CR_DATE='".$cr_date."',FARMER_STATUS='23',FAR_CATEGORY='2'";
     $this->db->query($sql);
     $ret_id1 = $this->db->getLastId();
    }
        
        
        
        //end
        
        
        
        
        $row++;
        }
        
        else{  
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $value[0]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value[1]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $value[2]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $value[3]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $value[4]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $value[5]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $value[6]);
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, 'FAILED');
        $row++;
        }
    }
       // $rd=date('d-m-Y-H:i:s');
	//$xlsName="farmerupload".$rd.".xls";
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   	//$filename = DIR_DOWNLOAD.$xlsName; 
	//$objWriter->save($filename);
         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="farmerupload'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
       // $email='vivek.singh@aspltech.com';
        //$cc='pragya.singh@aspltech.com';
       // $sub='Dealer Bulk Upload Report';
       // $msg='Dear,<br /><br /> Please find  dealer bulk upload data report.';
       // $mail1=$this->MsgToMail($email,$cc,$sub,$msg,$filename);
         $this->response->redirect(str_replace('&amp;', '&',$this->url->link('farmer/farmerbulkupload', 'token=' .$this->session->data['token'], 'SSL')));      
        $ret=1;
        return $ret;
    }
  

}
