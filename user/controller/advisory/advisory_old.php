<?php
class Controlleradvisoryadvisory extends Controller {
public function index(){
//$this->load->language('advisory/advisory');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('advisory/advisory');
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
$data['lnk'] = $this->url->link('advisory/advisory','token=' . $this->session->data['token'], 'SSL');
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
          
$data['AdvData']= $this->model_advisory_advisory->AdvData($this->request->get);
$order_total_count = $this->model_advisory_advisory->getmissedcallDatacount($this->request->get);
$order_total = count($order_total_count);

$data['StateData']= $this->model_advisory_advisory->StateData();

$data['CropData']= $this->model_advisory_advisory->CropData();
$data['CallSts']= $this->model_advisory_advisory->CallSts();
$data['CallUsr']= $this->model_advisory_advisory->CallUsr();
$data['ProdCatData']= $this->model_advisory_advisory->ProdCatData();
$data['CompCatData']= $this->model_advisory_advisory->CompCatData();
$data['EnqCatData']= $this->model_advisory_advisory->EnqCatData();
$data['EnqTypData']= $this->model_advisory_advisory->EnqTypData();



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
$pagination->url = $this->url->link('advisory/advisory', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Advisory Pending Data';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Advisory Call',
'href' => $this->url->link('advisory/advisory')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/advisory/advisory.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_advisory_advisory->DistData($this->request->post['stsid']);
    //print_r( $DistData);
               
                echo "<select name='district' id='district' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function edistlist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_advisory_advisory->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_advisory_advisory->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_advisory_advisory->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='prodata' name='prodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function eprodlist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_advisory_advisory->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('advisory/advisory');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_advisory_advisory->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function savefeedback(){
        $this->load->model('advisory/advisory');
        $SaveData= $this->model_advisory_advisory->SaveFeedBack($this->request->post);
        
        if($SaveData==1){
            echo 'Record Updated';
        }
        else{
            echo 'Sorry! Try again.';
        }
        
    }
    public function advrecord(){
        $this->load->model('advisory/advisory');
        $log=new Log("advrecord.log");
        $log->write($this->request->post);
        $RecData= $this->model_advisory_advisory->RecData($this->request->post);
        if($RecData){
            $to_mob=$RecData['TO_MOB'];
            $from_mob=$RecData['FROM_MOB'];
            /////////////////////////////////////////////////////////
            $basepath=DIR_IMAGE; //File Source
            $filelist=array();
            if(is_dir($basepath)){
                if($dh = opendir($basepath)){
                        while(($file= readdir($dh))!== FALSE){

                            if(($file!=='.') && ($file!=='..') && (substr($file,0,10)==$from_mob) && (substr($file,31,10)==$to_mob)){
                                array_push($filelist,$file);
                            }
                        }
                        closedir($dh);
                    }
            }
            
            else{
            echo 'No Direcory Found';
            }
            $tot=count($filelist);
            if($tot==0){
                echo 'NA';
            }
            else{
            $file = $filelist[$tot-1];
            $audio="http://192.168.1.159/CRM/image/".$file;
            
            echo '<audio controls>';
            echo '<source src="'.$audio.'" type="audio/ogg">';
            echo '<source src="'.$audio.'" type="audio/mpeg">';
            echo '</audio>';
            }
       
     }
}

}
