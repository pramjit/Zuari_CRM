<?php
class Controllerdfcdfcordersmail extends Controller {
         
        
	public function index() {
		
		$mydate=date('D-m-y');
   		$month = date("m",strtotime($mydate));
                //$month='11';
             	$filter_data = array(
            	'filter_month'      => $month
                ); 
 //**************************************Market Activity report*********************************
      // Fetching the table data
              
    $this->load->model('dfc/dfcordersmail');
    $email = $this->model_dfc_dfcordersmail->getemail();
    //print_r($email);die;
    $asmid = $this->model_dfc_dfcordersmail->getso();
            
    //print_r($results);die;
    $status_sheet_count = count($asmid);
    $j=$status_sheet_count;
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');
    $objPHPExcel = new PHPExcel();
    
    
   
     
   
     $i=0;
    //******************************** ASM Report**********************************
    foreach($asmid as $value) {
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex($i);
    $objPHPExcel->getActiveSheet()->setTitle("Market Report");
    // Field names in the first row
     $row=1;
    $fields = array(
         'Order Date',
        'Farmer name',
       
        'Dealer Name',
        'SO/ TM/ R-ASM',
        'Product Name',
        'Order Quantity (in tons)',
        
        
    );
   
   
    $objPHPExcel->getActiveSheet()->setTitle($value["firstname"].' '.$value["lastname"]);
   
     $col = 0;
    $results = $this->model_dfc_dfcordersmail->getdfcdata($value["customer_id"]);
    //print_r($results);die;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
        $col++;
    }
     
    
   $row = 2;
    
    foreach($results as $data)
    {
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, date('d-m-Y',strtotime($data['date'])));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['Farmer_name']);
        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['Dealer_name']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['so_name']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['PRODUCT_NAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['PRODUCT_USAGE']);
        
        
        $row++;
    }
  
   
     
   $i++; }
     
     
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Market_Activity_Report_'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
   /*
    //Download
	$rd=date('d-m-Y-H:i:s');
	$xlsName="Market_Activity_Report_".$rd.".xls";
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$filename = DIR_DOWNLOAD.$xlsName;
	$objWriter->save($filename);
        
        //log
        $this->load->model('account/activity');
	$activity_data = $xlsName;
	$this->model_account_activity->addActivity('autoreport', $activity_data);

        array_push($stack, $filename);
        
        $today = date("d M Y"); 
              $sub='Cargill Market Report as on: '.$today;
	$msg='Dear Sir,<br /><br />MDO status report Market wise is attached. <br /><br /><br /><br /><br /><br />Thanks and Regards,<br />
Akshamaala Solution Pvt Ltd';

      	$this->MsgToMail($email,$sub,$msg,$stack);
    //log
        $this->load->model('account/activity');
	$activity_data = "mail send";
	$this->model_account_activity->addActivity('automail', $activity_data);
    */
    //********************************************end market Activity Report********************************
    //********************************************start market POS Report********************************            
      
    }
    
//*****************************MAIL FUNCTION START*********************************************//
function MsgToMail($to,$sub,$msg,$stack){
    print_r($stack[0]); die;
			$tocc=count($to);
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in','AKSHAMAALA');   
			$mail->addAddress($to[0]["EMAIL"]);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Akshamaala';
			$mail->AddAttachment($stack[0]);
			$mail->AddAttachment($stack[1]);
			$mail->AddAttachment($stack[2]);
			$mail->AddAttachment($stack[3]);
			for($i=0;$i<$tocc-1;$i++){
			$mail->AddCC($to[$i+1]["EMAIL"]);
                        			}
			$mail->send();
			
                    }


}
