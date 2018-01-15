<?php
class Controlleradvisoryfarmerreport extends Controller {
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
$this->session->data["title"]='Advosiry Report';
$data['breadcrumbs'][] = array(
'text' => 'Farmer Report',
'href' => $this->url->link('advisory/farmerreport')
);
$this->load->model('advisory/farmerreport');

$data['complain']= $this->model_advisory_farmerreport->getfarmerdata($this->request->get);
//get State

$this->response->setOutput($this->load->view('default/template/advisory/farmerreport.tpl', $data));
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
'Mobile No.',
'Total Calls',
'PENDING CALL CC',
'PENDING CALL ADVISORY',
'PENDING CALL ADVISORY APPROVAL',
'CLOSE CALL'

    
    
    
);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('advisory/farmerreport');
$results= $this->model_advisory_farmerreport->getfarmerdata($this->request->get);
//print_r($results);die;
$status='';
$statusp='';
        
$row = 2;
$col = 1;
foreach($results as $data)
{

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $col);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['MOBILE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['Totalcalls']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['totalcomplaint']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row,$data['totalcompending']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['totalcomplaintclose']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['totalothercall']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data['totalotherpending']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row,$data['totalothercallclose']);
   
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
       
       
  
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:I1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->getColor()->setRGB('000DEF');
$col++;
$row++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="COMPLAINT_Report'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
