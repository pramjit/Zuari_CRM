<?php
class Controllerreportdailyaareport extends Controller 
{
public function  index(){
 
     
      //*****************************MAIL FUNCTION START*********************************************//
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
                 /*       for($x=1;$x<count($email);$x++){
				$mail->AddCC($email[$x]['EMAIL']);
			}*/
			$mail->AddBCC('anamika.arora@aspltech.com','Anamika');
			$mail->AddBCC('pramjit.kumar@aspltech.com','Pramjit');
			$mail->send();
			
			
}
//*****************************MAIL FUNCTION END***********************************************//
     $this->load->model('report/dailyaareport');
     $data1= $this->model_report_dailyaareport->aa_list($this->request->get);
     $len=count($data1);
    for($i=0;$i<$len;$i++){
       
     $reportData= $this->model_report_dailyaareport->aa_list_data($data[$i]['customer_id']);
        if($reportData){
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $fields = array(
        'Total Calls AA',
        'Pending At AA Calls',
        'Pending At REVIEW Calls',
        'Pending FOR FEEDBACK Calls',
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
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['totalCallsAA']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['pendingAtAA']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['pendingReviewAtRa']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['pendingForFeedback']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['closed']);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setItalic(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(12);
            $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:E1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->getColor()->setRGB('FF0000');
            $col++;
            $row++;
        }
           $xlsName='RA_Report'.date('dmY_His').$i.".xls";
           $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
           $filename = DIR_DOWNLOAD.$xlsName;
           $objWriter->save($filename);
           //**************************Mail Function Call***************//
                $attac=$filename;
                $email=$data1[$i]["email"];
		
		$sub='PENDING REPORT OF AA LIST';
		$msg='Dear '.$data1[$i]["name"].',<br /><br />';
		$msg.='Find the <b>Pending for Report</b> Advisory call list file as an attachment in this mail.<br /><br /><br /><br />';
		$msg.='Administrator,<br />Zuari.';
		MsgToMail($email,$sub,$msg,$attac);
           //**************************Mail Function Call***************//
    }
  
}

}


}
