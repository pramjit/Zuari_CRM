<?php
class Controllerdfcdfcorders extends Controller {
public function  index(){
//$this->load->language('dfc/dfcorders');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('dfc/dfcorders');
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

if (isset($this->request->get['sort'])) {
$sort = $this->request->get['sort'];
} else {
$sort = 'o.order_id';
}
if (isset($this->request->get['order'])) {
$order = $this->request->get['order'];
} else {
$order = 'DESC';
}
if (isset($this->request->get['page'])) {
$page = $this->request->get['page'];
} else {
$page = 1;
}
$url = '';

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
if (isset($this->request->get['sort'])) {
$url .= '&sort=' . $this->request->get['sort'];
}
if (isset($this->request->get['order'])) {
$url .= '&order=' . $this->request->get['order'];
}
if (isset($this->request->get['page'])) {
$url .= '&page=' . $this->request->get['page'];
}
$data['lnk'] = $this->url->link('dfc/dfcorders','token=' . $this->session->data['token'], 'SSL');
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
            
            $lproduct=array();
            $lpro=$this->request->get["product"];
            $laproduct=explode(",",$lpro);
            $data['lastproduct']=$laproduct;
             
            
            $data['lastfromdate']=$this->request->get["from_date"];
            $data['lasttodate']=$this->request->get["to_date"];
            if($this->request->get["asmdfc"]!='null'){
                $this->request->get["id"]=$this->request->get["asmdfc"];
$data['so']= $this->model_dfc_dfcreports->getso($this->request->get);
            }
$data['product']= $this->model_dfc_dfcreports->getproduct($this->request->get);            
$data['asm']= $this->model_dfc_dfcreports->getasm($this->request->get);
$data['ordersdata']= $this->model_dfc_dfcorders->getdfcordersdata($this->request->get);
$order_total_count = $this->model_dfc_dfcorders->getdfcordersdatacount($this->request->get);
$order_total = count($order_total_count);

$data['heading_title'] = $this->language->get('heading_title');
$data['text_list'] = $this->language->get('text_list');
$data['text_no_results'] = $this->language->get('text_no_results');
$data['text_confirm'] = $this->language->get('text_confirm');
$data['text_missing'] = $this->language->get('text_missing');
$data['column_mdo_name'] = $this->language->get('column_mdo_name');
$data['market_name'] = $this->language->get('market_name');
$data['pos_added'] = $this->language->get('pos_added');
$data['milk_colc_added'] = $this->language->get('milk_colc_added');        
$data['farmer_added'] = $this->language->get('farmer_added');
$data['fgm_added'] = $this->language->get('fgm_added');
$data['entry_return_id'] = $this->language->get('entry_return_id');
$data['entry_order_id'] = $this->language->get('entry_order_id');
$data['entry_customer'] = $this->language->get('entry_customer');
$data['entry_order_status'] = $this->language->get('entry_order_status');
$data['entry_total'] = $this->language->get('entry_total');
$data['entry_date_added'] = $this->language->get('entry_date_added');
$data['entry_date_modified'] = $this->language->get('entry_date_modified');
$data['button_invoice_print'] = $this->language->get('button_invoice_print');
$data['button_shipping_print'] = $this->language->get('button_shipping_print');
$data['button_add'] = $this->language->get('button_add');
$data['button_edit'] = $this->language->get('button_edit');
$data['button_delete'] = $this->language->get('button_delete');
$data['button_filter'] = $this->language->get('button_filter');
$data['button_view'] = $this->language->get('button_view');
$data['token'] = $this->session->data['token'];
$this->load->language('geo/searchgeo');
$this->document->setTitle($this->language->get('heading_title'));
$this->load->model('dfc/dfcreports');
$data['entry_status'] = $this->language->get('Search Geo Name');
if (isset($this->error['warning'])) {
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
if (isset($this->request->post['selected'])) {
$data['selected'] = (array)$this->request->post['selected'];
} else {
$data['selected'] = array();
}


if ($order == 'ASC') {
$url .= '&order=DESC';
} else {
$url .= '&order=ASC';
}
if (isset($this->request->get['page'])) {
$url .= '&page=' . $this->request->get['page'];
}
$data['sort_order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
$data['sort_customer'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
$data['sort_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
$data['sort_total'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
$data['sort_date_added'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
$data['sort_date_modified'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

if (isset($this->request->get['sort'])) {
$url .= '&sort=' . $this->request->get['sort'];
}
if (isset($this->request->get['order'])) {
$url .= '&order=' . $this->request->get['order'];
}
$pagination = new Pagination();
$pagination->total = $order_total;
$pagination->page = $page;
$pagination->limit = $this->config->get('config_limit_admin');
$pagination->url = $this->url->link('dfc/dfcorders', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='DFC Reports';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'DFC Orders',
'href' => $this->url->link('dfc/dfcorders')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/dfc/dfcorders.tpl', $data));
//print_r( $data['mob3']); die;
}

public function ordersdata_download(){
   
// Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$fields = array(
'DFC Name',
'Date',
'Farmer Name',
'Customer Code',
'Dealer Name',
'Product Name',
'Product Usage'

);
$col = 0;
foreach ($fields as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$this->load->model('dfc/dfcorders');
$results = $this->model_dfc_dfcorders->getdfcordersdata($this->request->get);
$row = 2;
foreach($results as $data)
{
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['so_name']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['date']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['Farmer_name']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['customer_code']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['Dealer_name']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['PRODUCT_NAME']);
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['PRODUCT_USAGE']);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
       
  
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setItalic(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(12);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension('A1:L1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->getColor()->setRGB('FF0000');

$row++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="DFC_Orders_'.date('dMy').'.xls"');
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
