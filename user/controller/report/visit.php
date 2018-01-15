<?php
class Controllerdfcvisit extends Controller {
public function  index(){
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('dfc/visit');
$this->getList();
}
protected function getList() {
    
if (isset($this->request->get['page'])) {
$page = $this->request->get['page'];
} else {
$page = 1;
}

$data['lnk'] = $this->url->link('dfc/visit','token=' . $this->session->data['token'], 'SSL');
$data['orders'] = array();
  
            $filter_data = array(
                   
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                => $this->config->get('config_limit_admin')
        );
           
 $this->request->get['start' ]=($page - 1) * $this->config->get('config_limit_admin');
$this->request->get['limit' ]=$this->config->get('config_limit_admin');
            $this->load->model('dfc/dfcreports');
            $lso=array();
            $lso=$this->request->get["so"];
            $lso=explode(",",$lso);
            $data['lastso']=$lso;
            $lasm=array();
            $lasm=$this->request->get["asmdfc"];
            $lasm=explode(",",$lasm);
            $data['lastasm']=$lasm;
            $data['lastfromdate']=$this->request->get["from_date"];
            $data['lasttodate']=$this->request->get["to_date"];
            if($this->request->get["asmdfc"]!='null'){
                $this->request->get["id"]=$this->request->get["asmdfc"];
$data['so']= $this->model_dfc_dfcreports->getso($this->request->get);
            }
$data['asm']= $this->model_dfc_dfcreports->getasm($this->request->get);
$data['visitdata']= $this->model_dfc_visit->getvisitdata($this->request->get);
$order_total_count = $this->model_dfc_visit->getvisitdatacount($this->request->get);
$order_total = count($order_total_count);

$pagination = new Pagination();
$pagination->total = $order_total;
$pagination->page = $page;
$pagination->limit = $this->config->get('config_limit_admin');
$pagination->url = $this->url->link('dfc/visit', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$this->session->data["title"]='DFC Visit';
if (isset($this->request->get['so'])) {
$url .= '&so=' . $this->request->get['so'];
}
if (isset($this->request->get['asmdfc'])) {
$url .= '&asmdfc=' . $this->request->get['asmdfc'];
}
if (isset($this->request->get['from_date'])) {
$url .= '&from_date=' . $this->request->get['from_date'];
}
if (isset($this->request->get['to_date'])) {
$url .= '&to_date=' . $this->request->get['to_date'];
}
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'DFC Visit',
'href' => $this->url->link('dfc/visit')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/dfc/visit.tpl', $data));
}

public function visitdata_download(){
   
// Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$fields = array(
'Farmer Name',
'Date',
'Customer Name',
'Next Visit Date',
'Purpose',
'Concern',
'Next Step',
'Remarks'

);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('dfc/visit');
$results = $this->model_dfc_visit->getvisitdata($this->request->get);
$row = 2;
foreach($results as $data)
{
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['Farmer_name']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, date('d-m-Y',strtotime($data['CR_DATE'])));
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['Customer_name']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['NEXT_VISIT_DATE']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['PURPOSE']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['CONCERN']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['NEXT_STEP']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data['REMARKS']);


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
       
  
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:L1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setRGB('FF0000');

$row++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Visit_Report_'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}
public function getdfcso(){
    
    $this->load->model('dfc/dfcreports');
    
    $so= $this->model_dfc_dfcreports->getso($this->request->post);
    
    //$a='<select name="so[]"  id="soo" class="form-control select2-selection select2-selection--multiple"  multiple="multiple"  data-placeholder="Select DFC" >';
                
        foreach($so as $value) {  
            $a.='<option value="'.$value["customer_id"].'" >'.$value["name"].'</option>';
        }     
            // $a.='</select>';
     echo $a;        
    
}

}
