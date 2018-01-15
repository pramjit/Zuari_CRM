<?php
class Controlleradminreportagroreportsummary extends Controller 
{
public function  index(){

$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('call/missedcall');
$data['heading_title'] = $this->language->get('heading_title');
$data['text_list'] = $this->language->get('text_list');
$data['entry_name'] = $this->language->get('entry_name');
$data['entry_model'] = $this->language->get('entry_model');
$data['entry_price'] = $this->language->get('entry price');
if (isset($this->session->data['error'])) {
$data['error_warning'] = $this->session->data['error'];
unset($this->session->data['error']);
} elseif (isset($this->error['warning'])) {
$data['error_warning'] = $this->error['warning'];
} else {
$data['error_warning'] = '';
}
if (isset($this->session->data['success'])) {
$data['success'] = $this->session->data['success'];
unset($this->session->data['success']);
} else {
$data['success'] = '';
}
$this->getList();
}
protected function getList() {
          
$data['lastfromdate']=$this->request->get["from_date"];
$data['lasttodate']=$this->request->get["to_date"];
          
$data['order_statuses'] = "";
$this->session->data["title"]='Summary Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('callreport/agentwisereport', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Summary Report',
'href' => $this->url->link('adminreport/agentwisereport')
);
$this->load->model('adminreport/agroreportsummary');
$data['dataadv']= $this->model_adminreport_agroreportsummary->agroAdvisoryTotal($this->request->get);
$data['dataoth']= $this->model_adminreport_agroreportsummary->agroOtherTotal($this->request->get);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/agroreportsummary.tpl', $data));

}


public function downloadExcel()
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
'STATE',
'AGRO ADVISORY',
'REDIRECTED ADVISORY',
'COMPLAINT',
'SERVICES QUERY',
'NETWORK QUERY',
'NON PRODUCT TECHNICAL QUERY',
'GRAND TOTAL'    
);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('adminreport/agroreportsummary');
$dataadv = $this->model_adminreport_agroreportsummary->agroAdvisoryTotal($this->request->get);
$dataoth = $this->model_adminreport_agroreportsummary->agroOtherTotal($this->request->get);
//print_r($advdata);
$row = 2;
$col = 1;
$tp='';
foreach($dataoth as $order)
{       
    $advdir=0;
    $advre=0;
    foreach($dataadv as $adv){
        if($order['STATE']==$adv['STATE'])
        {
            $advdir = $adv['AgroAdvisory'];
            $advre  = $adv['RediCall'];
        }
    }
    $GrandTotal= $advdir+$advre+$order['No_of_complain']+$order['No_of_services_query']+$order['No_of_network_Query']+$order['No_of_Non_technical'];                           
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $col);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $order['STATENAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $advdir);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $advre);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $order['No_of_complain']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $order['No_of_services_query']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $order['No_of_network_Query']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $order['No_of_Non_technical']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row,$GrandTotal );
      

        
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
header('Content-Disposition: attachment;filename="Advisory_Report'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
