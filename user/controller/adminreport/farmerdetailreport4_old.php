<?php
class Controlleradminreportfarmerdetailreport4 extends Controller 
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
$this->session->data["title"]='Farmer Details Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('callreport/agentwisereport', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Farmer Details Report',
'href' => $this->url->link('adminreport/farmerdetailreport')
);
$this->load->model('adminreport/farmerdetailreport4');
$data['farmerdata']= $this->model_adminreport_farmerdetailreport4->AdvData($this->request->get);

$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/farmerdetailreport4.tpl', $data));

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
'DATE',
'MOBILE',
'STATE',
'TYPE'    
);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('adminreport/farmerdetailreport4');
$farmerdata= $this->model_adminreport_farmerdetailreport4->AdvData($this->request->get);
$row = 2;
$col = 1;
$tp='';
foreach($farmerdata as $data)
{ 
  

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $col);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['CR_DATE']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['FAR_MOB']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['STATENAME']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['STATUS']);
      

        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:E1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->getColor()->setRGB('000DEF');
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
