<?php
class Controllerreportdailyadvisoryreport extends Controller 
{
public function  index(){
    $this->load->library('PHPMailer/PHPMailerAutoload');
    function MsgToMail($to,$sub,$msg,$attach){
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in', 'Agri CRM Adventz');   
			//$mail->addAddress($to);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Agri CRM Adventz';
			$mail->AddAttachment($attach);
                /*        for($x=1;$x<count($email);$x++){
				$mail->AddCC($email[$x]['EMAIL']);
			}*/
			$mail->AddBCC('anamika.arora@aspltech.com','Anamika');
			$mail->AddBCC('pramjit.kumar@aspltech.com','Pramjit');
			$mail->send();
			
			
}
//*****************************MAIL FUNCTION END***********************************************//
  
   $this->load->model('report/dailyadvisoryreport');
   
    $data1= $this->model_report_dailyadvisoryreport->adv_list($this->request->get);
   // print_r($data);die;
    $len=count($data1);
    
    for($i=0;$i<$len;$i++){
  
        $reportData= $this->model_report_dailyadvisoryreport->adv_list_data($data[$i]['customer_id']);
   
        if($reportData){
            $this->load->library('PHPExcel');
            $this->load->library('PHPExcel/IOFactory');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $fields = array(
            'Total Calls Advisory',
            'Pending At Advisory Calls',
            'Pending At CC Calls',
            'Pending At Approval Calls',
            'Call Not Connected Calls',
            'Closed Calls'

            );
            $col = 0;
            foreach ($fields as $field)
            {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
            }
            $row = 2;
            $col = 1;
    
            foreach($reportData as $data){
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['totalCalls']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['pendingatadvisroy']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['PendingatCC']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['Pendingataproval']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['CallNotConnected']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['closed']);


                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);


                $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setItalic(true);
                $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setSize(12);
                $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:F1')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->getColor()->setRGB('FF0000');
            $col++;
            $row++;
            }
            //$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            //header('Content-Type: application/vnd.ms-excel');
            //header('Content-Disposition: attachment;filename="COMPLAINT_Report'.date('dMy').'.xls"');
            //header('Cache-Control: max-age=0');
            //$objWriter->save('php://output');
        
                $xlsName='Advisory_Report'.date('dmY_His').$i.".xls";
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $filename = DIR_DOWNLOAD.$xlsName;
                $objWriter->save($filename);
                //**************************Mail Function Call***************//
                $attac=$filename;
                $email=$data1[$i]['email'];
		
		$sub='PENDING REPORT OF ADVISORY LIST';
		$msg='Dear '.$data1[$i]["name"].',<br /><br />';
		$msg.='Find the <b>Pending for Report</b> Advisory call list file as an attachment in this mail.<br /><br /><br /><br />';
		$msg.='Administrator,<br />Zuari.';
		MsgToMail($email,$sub,$msg,$attac);
              //**************************Mail Function Call***************//
        }
    }

}
}
