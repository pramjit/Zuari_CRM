<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class ControlleradminreportAdvisoryMonthlyReport extends Controller 
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
                        $mail->addAddress('aasit.kumar@aspltech.com','Aasit Kumar');
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Agri CRM Adventz';
			$mail->AddAttachment($attach);
			//$mail->AddCC('asad.ahmed@adventz.com','Asad Ahmed');
			//$mail->AddCC('kamal.singh@adventz.com','Kamal Singh');
			//$mail->AddCC('swapnil.kharbade@adventz.com','Swapnil Kharbade'); 
			//$mail->AddBCC('anamika.arora@aspltech.com','Anamika');
			$mail->AddBCC('aasit.kumar@aspltech.com','Aasit Kumar');
			$mail->send();
    }
    //*****************************MAIL FUNCTION END***********************************************//
  
    $this->load->model('adminreport/AdvisoryMonthlyReport');
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');
    
    $AdlList= $this->model_adminreport_AdvisoryMonthlyReport->AdlList();
    $tot=count($AdlList);
    for($i=0;$i<$tot;$i++){
        $AdlID=$AdlList[$i]['EX_ID'];
        $AdlNAME=$AdlList[$i]['EX_NAME'];
        $AdlEMAIL=$AdlList[$i]['EX_EMAIL'];
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->createSheet();
        
        $CallInDIR= $this->model_adminreport_AdvisoryMonthlyReport->CallInDIR($AdlID);
        $CallInIN= $this->model_adminreport_AdvisoryMonthlyReport->CallInIN($AdlID);
        $CallIn=array_merge($CallInDIR,$CallInIN);
        if($CallIn){
            
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->setTitle("INCOMING");
            $fields = array(
            'SNO',
            'CASE PIN',
            'CASE STATUS',
            'FARMER MOBILE',
            'STATE NAME',
            'ADL NAME',
            'INCOMING DATE',
            'INCOMING TIME',
            'OUTGOING DATE',
            'OUTGOING TIME',
            'RESPONSE(DAYS)',
            'RESPONSE(TYPE)',
            'CALL STATUS',
            'CALL TYPE'
            );
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;
            }
            $row = 2;
            $col = 1;
            foreach($CallIn as $CIn){

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,  $row, $col);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,  $row, $CIn['CASE_ID']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,  $row, $CIn['CASE_STATUS']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,  $row, $CIn['FAR_MOB']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,  $row, $CIn['STATE_NAME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,  $row, $CIn['ADL_NAME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,  $row, $CIn['IN_DATE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,  $row, $CIn['IN_TIME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,  $row, $CIn['OUT_DATE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,  $row, $CIn['OUT_TIME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $CIn['DIFF']);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $CIn['CALL_RESP']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $CIn['CALL_STATUS']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $CIn['CALL_TYPE']);
            $col++;
            $row++;
            }
        }
            //*****************************************************************************************//
        $CallOut= $this->model_adminreport_AdvisoryMonthlyReport->CallOut($AdlID);
        if($CallOut){
            
            $objPHPExcel->setActiveSheetIndex(1);
            $objPHPExcel->getActiveSheet()->setTitle("OUTGOING");
            $fields = array(
            'SNO',
            'CASE PIN',
            'CASE STATUS',
            'FARMER MOBILE',
            'STATE NAME',
            'ADL NAME',
            'INCOMING DATE',
            'INCOMING TIME',
            'OUTGOING DATE',
            'OUTGOING TIME',
            'RESPONSE(DAYS)',
            'RESPONSE(TYPE)',
            'CALL STATUS',
            'CALL TYPE'
            );
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;
            }
            $row = 2;
            $col = 1;
            foreach($CallOut as $COut){

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,  $row, $col);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,  $row, $COut['CASE_ID']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,  $row, $COut['CASE_ID']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,  $row, $COut['FAR_MOB']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,  $row, $COut['STATE_NAME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5,  $row, $COut['ADL_NAME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6,  $row, $COut['IN_DATE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7,  $row, $COut['IN_TIME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8,  $row, $COut['OUT_DATE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9,  $row, $COut['OUT_TIME']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $COut['DIFF']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $COut['CALL_RESP']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $COut['CALL_STATUS']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $COut['CALL_TYPE']);
                
                $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:L1')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getDefaultColumnDimension('A1:L1')->setAutoSize(FALSE);
                $objPHPExcel->getActiveSheet()->getDefaultColumnDimension('A1:L1')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle()->getAlignment('A1:L1')->applyFromArray(
                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
                );
            $col++;
            $row++;
            }
        }
            //*****************************************************************************************//
       
            //
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="COMPLAINT_Report'.date('dMy').'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
		if(count($CallIn)!=0 || count($CallOut)!=0){
                $xlsName='ADL'.$AdlID.'_MONTHLY_REPORT'.date('dmY_His').$i.".xls";
                PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $filename = DIR_DOWNLOAD.$xlsName;
                $objWriter->save($filename);
                //**************************Mail Function Call***************//
                $attac=$filename;
                $sub='Advisory Report For Month:'.date('M');
				$msg='Dear '.$AdlNAME.',<br /><br />';
				$msg.='Please Find Advisory Report sheet as an attachment in this mail.<br /><br /><br /><br />';
				$msg.='Administrator,<br />Zuari.';
				MsgToMail($AdlEMAIL,$sub,$msg,$attac);
			}
                unset($objPHPExcel);
                unset($objWriter);
        }
    }
}
