<?php
class Controlleradvisorycallreport extends Controller {
public function  index(){
//$this->load->language('call/missedcall');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('call/missedcall');
$data['heading_title'] = $this->language->get('heading_title');
$data['text_list'] = $this->language->get('text_list');
$data['entry_name'] = $this->language->get('entry_name');
$data['entry_model'] = $this->language->get('entry_model');
$data['entry_price'] = $this->language->get('entry price');

$this->getList();
}
protected function getList() {



$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
//Start farmer Complaint Reports
$this->session->data["title"]='CALL REPORT';
$data['breadcrumbs'][] = array(
'text' => 'Advisory/Call Report',
'href' => $this->url->link('advisory/call report')
);
$this->load->model('advisory/callreport');



 $data['from_date']=$fdate=$this->request->get["from_date"];
 $data['to_date']=$tdate=$this->request->get["to_date"];

$callreport= $this->model_advisory_callreport->getcallreport($fdate,$tdate);
 
 //print_r($callreport);
foreach ($callreport as $result) {
   // print_r($result['MOBILE']);
    $CTYPE=$this->model_advisory_callreport->getcalltype($result['MOBILE'],$result['KEY_PRESS']);
    
    if(empty($CTYPE)){$cs="NA";$fl="NA";$sts="NA";$cc='NA';$ls='NA';
    
    }else{
        $cs=$CTYPE['CALL_STATUS'];$fl=$CTYPE['FAR_LIVE'];$sts=$CTYPE['CASE_STATUS'];$cc=$CTYPE['CALL_COUNT'];$ls=$CTYPE['LAST_STATUS'];}
    
    if(empty($sts)){$sts='PENDING';}else{$sts;}
    $data['orders'][] = array(     
    'CR_DATE'    => $result['CR_DATE'],
    'MOBILE'     => $result['MOBILE'],
    'CALL_STATUS'=> $cs,
    'ZONE'       => $result['ZONE'],
    'STATE'      => $result['STATE'],
    'REGION'     => $result['REGION'],
    'FAR_LIVE'   =>$fl,
    'CASE_STATUS'=>$sts,
    'CALL_COUNT' =>$cc,
    'LAST_STATUS'=>$ls
				
  );
}

//get State

$this->response->setOutput($this->load->view('default/template/advisory/callreport.tpl', $data));
//print_r( $data['mob3']); die;
}
public function downloadexcel()
{
       
// Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$fields = array(
'S No.',
'DATE',
'MOBILE NUMBER',
'TYPE OF CALLS',
'ZONE',
'STATE',
'DISTRICT',
'EXITING/NEW',
'CASE STATUS',
'TOTAL ATTEMPT',
'LAST STATUS'
);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('advisory/callreport');
$fdate=$this->request->get['from_date'];
$tdate=$this->request->get['to_date'];
$results= $this->model_advisory_callreport->getcallreport($fdate,$tdate);

        
$row = 2;
$col = 1;
foreach($results as $data)
{
       $CTYPE=$this->model_advisory_callreport->getcalltype($data['MOBILE'],$data['KEY_PRESS']);
       if(empty($CTYPE)){
           
           $cs="NA";$fl="NA";$sts="NA";    
       }else{
           //$cs=$CTYPE['CALL_STATUS'];
	if($CTYPE['CALL_STATUS']=='Agro Advisory'){$cs= 'RESUBMIT TO ADVISORY';}
        else{$cs= $CTYPE['CALL_STATUS'];}
	$fl=$CTYPE['FAR_LIVE'];
        $sts=$CTYPE['CASE_STATUS'];
        $cc=$CTYPE['CALL_COUNT'];
        if($CTYPE['LAST_STATUS']=='Missed Call'){$ls= 'NOT ATTEMPT';}
        else{$ls= $CTYPE['LAST_STATUS'];}
        
        if(empty($sts)){$sts='PENDING';}else{$sts;}
           
       }

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $col);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['CR_DATE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['MOBILE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $cs);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['ZONE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['STATE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['REGION']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row,$fl);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row,$sts);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row,$cc);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10,$row,$ls);
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
       
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:K1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->getColor()->setRGB('000DEF');
$col++;
$row++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="CALL_Report'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}