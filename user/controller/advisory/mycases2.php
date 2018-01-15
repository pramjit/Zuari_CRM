<?php
class Controlleradvisorymycases extends Controller {
public function  index(){
//$this->load->language('advisory/mycases');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('advisory/mycases');
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
$data['lnk'] = $this->url->link('advisory/mycases','token=' . $this->session->data['token'], 'SSL');
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
          
$data['MyCaseData']= $this->model_advisory_mycases->getmissedcallData($this->request->get);
$order_total_count = $this->model_advisory_mycases->getmissedcallDatacount($this->request->get);
$order_total = count($order_total_count);

$data['StateData']= $this->model_advisory_mycases->StateData();
$data['CropData']= $this->model_advisory_mycases->CropData();
$data['CallSts']= $this->model_advisory_mycases->CallSts();
$data['CallUsr']= $this->model_advisory_mycases->CallUsr();
$data['ProdCatData']= $this->model_advisory_mycases->ProdCatData();
$data['CompCatData']= $this->model_advisory_mycases->CompCatData();
$data['EnqCatData']= $this->model_advisory_mycases->EnqCatData();
$data['EnqTypData']= $this->model_advisory_mycases->EnqTypData();



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
$pagination->url = $this->url->link('advisory/mycases', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Advisory Authority - My Cases';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'My Cases',
'href' => $this->url->link('advisory/mycases')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/advisory/mycases.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('advisory/mycases');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_advisory_mycases->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='seldt' name='seldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function edistlist(){
    $this->load->model('advisory/mycases');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_advisory_mycases->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
    
    
public function prodlist(){
    $this->load->model('advisory/mycases');
   // $a = $this->request->post['stsid'];
    $RaStatus= $this->model_advisory_mycases->RaStatus();
    $ProdData= $this->model_advisory_mycases->ProdData($this->request->post['caseid']);
    //print_r( $DistData); 
        echo '<form name="frmadv" id="frmadv"><div class="table-responsive">';
        echo '<div class="modal-body">';
        echo '<table id="casetbl" class="table table-striped table-bordered" cellspacing="0" width="100%">';
       
        echo '<tbody>';
        foreach($ProdData as $prod){
            echo '<tr>';
                echo "<td><input type='hidden' name='adv-caseid' id='adv-caseid' class='form-control' value='".$prod['CASE_ID']."'><textarea class='form-control' id='adv-remarks' name='adv-remarks'>".$prod['COMP_QUERY']."</textarea></td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo "<button type='button' class='btn btn-default' onclick='editapprove(".$prod['CASE_ID'].");'>Submit</button>";
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
        echo '</div>';
        echo '</form>';
    }
    public function history(){
    $this->load->model('advisory/mycases');
   // $a = $this->request->post['stsid'];
    
    $HisData= $this->model_advisory_mycases->History($this->request->post['caseid']);
        echo '<div class="table-responsive">';
        echo '<table id="casetbl" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr role="row" style="background: #12a4f4; color: #ffffff;">';
        echo '<th>USER</th>';
        echo '<th>FROM STATS</th>';
        echo '<th>TO STATUS</th>';
        echo '<th>SOLUTION/COMMENTS</th>';
        echo '<th>UPDTED DATE</th>';
        echo '<th>FILE</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        if(sizeof($HisData)==0)
        {
            echo '<tr><td colspan="6" class="text-center" style="color:#F00;">Sorry! No records found</td></tr>';
        }
        else {
            foreach($HisData as $prod){
            echo '<tr>';
                echo "<td>".$prod['UP_USR_NAME']."</td>";
                echo "<td>".$prod['CASE_PRE_STATUS']."</td>";
                echo "<td>".$prod['CASE_CUR_STATUS']."</td>";
                echo "<td>".$prod['SOLUTION']."</td>";
                echo "<td>".$prod['CASE_UP_DATE']."</td>";
                echo "<td><a href=".DIR_DOWNLOAD_FILE.$prod['UP_FILE_NAME']." download='download'><i class='fa fa-download' aria-hidden='true'></i></a></td>";
            echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
       
    }
    
    public function subradata(){
        $this->load->model('advisory/mycases');
        $caseid    =   $_REQUEST['ra_case'];   //Case Id
        $commnts   =   $_REQUEST['ra_com'];    //Comments
        $status    =   $_REQUEST['ra_sts'];    //Status
        //echo $caseid.$commnts.$status;
        $filepath  = 'NA';
        if($_FILES['ra_file']['name']!="")
        {   
                $file = $caseid.'_RA_'.rand(1000, 9999).'_'.$_FILES['ra_file']['name']; 
                move_uploaded_file($_FILES['ra_file']['tmp_name'], DIR_UPLOAD . $file);
                $filepath=$file;
        } 
        
        $RaSubData= $this->model_advisory_mycases->subradata($caseid,$commnts,$status,$filepath);
        if($RaSubData==1)
        {
            echo 'Data Updated Successfully';
        }
        else{
            echo 'Sorry! Try Again';
        }
    }
//********************** SUBMIT ADV APPROVE DATA **********************//
    public function approve(){
        $this->load->model('advisory/mycases');
        $caseid    =   $_REQUEST['csid'];   //Case Id
        $commnts   =   $_REQUEST['rmks'];    //Comments
        
        $AdvSubData= $this->model_advisory_mycases->subadvdata($caseid,$commnts);
        if($AdvSubData==1)
        {
            echo 'Data Updated Successfully';
        }
        else{
            echo 'Sorry! Try Again';
        }
       
    }

}
