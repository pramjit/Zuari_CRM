<?php
class Controllerresolutionreport extends Controller {
public function  index(){
//$this->load->language('resolution/report');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('resolution/report');
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
$data['lnk'] = $this->url->link('resolution/report','token=' . $this->session->data['token'], 'SSL');
$data['orders'] = array();
  
            $filter_data = array(
                   
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                => $this->config->get('config_limit_admin')
        );
           
$this->request->get['start' ]=($page - 1) * $this->config->get('config_limit_admin');
$this->request->get['limit' ]=$this->config->get('config_limit_admin');
          
            
            $data['lastfromdate']=$this->request->get["from_date"];
            $data['lasttodate']=$this->request->get["to_date"];
          
$data['misscallData']= $this->model_resolution_report->getmissedcallData($this->request->get);
$order_total_count = $this->model_resolution_report->getmissedcallDatacount($this->request->get);
$order_total = count($order_total_count);

$data['StateData']= $this->model_resolution_report->StateData();
$data['CropData']= $this->model_resolution_report->CropData();
$data['CallSts']= $this->model_resolution_report->CallSts();
$data['CallUsr']= $this->model_resolution_report->CallUsr();
$data['ProdCatData']= $this->model_resolution_report->ProdCatData();
$data['CompCatData']= $this->model_resolution_report->CompCatData();
$data['EnqCatData']= $this->model_resolution_report->EnqCatData();
$data['EnqTypData']= $this->model_resolution_report->EnqTypData();



$data['heading_title'] = $this->language->get('heading_title');
$data['text_list'] = $this->language->get('text_list');
$data['text_no_results'] = $this->language->get('text_no_results');

$data['token'] = $this->session->data['token'];

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
$pagination->url = $this->url->link('resolution/report', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Missedcall Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Report',
'href' => $this->url->link('resolution/report')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/resolution/report.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_resolution_report->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='seldt' name='seldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function edistlist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_resolution_report->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_resolution_report->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_resolution_report->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='prodata' name='prodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function eprodlist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_resolution_report->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('resolution/report');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_resolution_report->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function saveform(){
        $this->load->model('resolution/report');
        $SaveData= $this->model_resolution_report->SaveFormData($this->request->post);
        if($SaveData==2){
            echo 'Enquiry';
        }
        else if($SaveData==1){
            echo 'Data Saved Successfully';
        }
        else {
            echo 'Sorry';
        }
        
    }


}
