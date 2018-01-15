<?php
class Controllercallfeedback extends Controller {
public function  index(){
//$this->load->language('call/feedback');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('call/feedback');
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
$data['lnk'] = $this->url->link('call/feedback','token=' . $this->session->data['token'], 'SSL');
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
          
$data['misscallData']= $this->model_call_feedback->getfeedbackData($this->request->get);
$order_total_count = $this->model_call_feedback->getfeedbackDatacount($this->request->get);
$order_total = count($order_total_count);





$data['ProdCatData']= $this->model_call_feedback->ProdCatData();

$data['EnqCatData']= $this->model_call_feedback->EnqCatData();
$data['EnqTypData']= $this->model_call_feedback->EnqTypData();



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
$pagination->url = $this->url->link('call/feedback', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Feedback Data';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Feedback',
'href' => $this->url->link('call/feedback')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/call/feedback.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_feedback->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='seldt' name='seldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function edistlist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_feedback->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_feedback->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_feedback->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='prodata' name='prodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function eprodlist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_feedback->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('call/feedback');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_call_feedback->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function saveform(){
        $this->load->model('call/feedback');
        $SaveData= $this->model_call_feedback->SaveFormData($this->request->post);
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
    
    //*****************************RETRIVE DATA SET***************************//
    public function retrivedata(){
        $this->load->model('call/feedback');
        $FeedFarData=$this->model_call_feedback->FeedFarData($this->request->post);
        $CallSts= $this->model_call_feedback->CallSts();
        $CallUsr= $this->model_call_feedback->CallUsr();
        $StateData= $this->model_call_feedback->StateData();
        $DistData= $this->model_call_feedback->DistData($FeedFarData['STATE_ID']);
        $CropData= $this->model_call_feedback->CropData();
        $ProdCatData= $this->model_call_feedback->ProdCatData();
        $ProdData= $this->model_call_feedback->ProdData($FeedFarData['PROD_CATG']);
        $CompCatData= $this->model_call_feedback->CompCatData();
        $CompData= $this->model_call_feedback->CompData($FeedFarData['COMP_CATG']);
        
        echo '<div class="col-sm-8">';
        echo '<form name="callform" id="clfrm">';
        echo '<div class="table-responsive">';
            echo '<div class="form-group" id="formdata">';
            echo '<label class="col-md-2 btn-default">STATUS</label>';
            echo '<div class="col-md-3">';
            echo '<select id="call-sts" name="call-sts" class="form-control"  onchange="callsts(this.value);" disabled="disabled">';
                echo '<option value="0">Select</option>';
                foreach($CallSts as $sts){ 
                            if($FeedFarData['CALL_STATUS']==$sts['STATUS_ID'])
                            {
                                $sel="selected='selected'";
                            }
                            else {
                                $sel="";
                            }
                            echo '<option value="'.$sts['STATUS_ID'].'"'.$sel.'>'.$sts['STATUS_NAME'].'</option>';
                }
                echo '</select>';
                echo '</div>';
                echo '<div class="pro-act">';
                echo '<label class="col-md-2 btn-default" for="selectbasic">USER</label>';
                echo '<div class="col-md-3">';
                echo '<select id="emp-sts" name="emp-sts" class="form-control" onchange="empsts(this.value);" disabled="disabled">';
                echo '<option value="0">Select</option>';
                foreach($CallUsr as $usr){ 
                            if($FeedFarData['EMP_STATUS']==$usr['SID'])
                            {
                                $sel="selected='selected'";
                            }
                            else {
                                $sel="";
                            }
                            echo '<option value="'.$usr['SID'].'"'.$sel.'>'.$usr['NAME'].'</option>';
                        }
                echo '</select>';
                echo '</div>';
                echo '<div class="col-md-2">';
                echo '<input type="button" class="btn btn-primary subprodata" value="SUBMIT" onclick="subfeedbackdata();">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="clearfix"><br/><hr/><br/></div>';
                echo '<div id="exTab1" class="formdata-sub">';
                echo '<ul  class="nav nav-pills">';
                echo '<li class="active" id="A">';
                echo '<a href="#1a" data-toggle="tab">PROFILE DETAILS</a>';
                echo '</li>';
                echo '<li id="B">';
                echo '<a href="#2a" data-toggle="tab">COMPLAINT DETAILS</a>';
                echo '</li>';
                echo '</ul>';
                echo '<div class="tab-content clearfix" style="padding: 0px!important;">';
                echo '<div class="tab-pane active" id="1a">';
                    echo '<fieldset class="far-tab">';
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-name" name="far-name" type="text" placeholder="Name" value="'.$FeedFarData['FAR_NAME'].'" class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-fa-name" name="far-fa-name" type="text" placeholder="Father Name" value="'.$FeedFarData['FAR_FAT_NAME'].'"class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-mob" name="far-mob" type="text" placeholder="Mobile" value="'.$FeedFarData['FAR_MOBILE'].'"  class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<select id="selst" name="selst" class="form-control select2" onchange="showdist(this.value);" disabled="disabled">';
                    echo '<option value="">Select State</option>';
                             foreach($StateData as $state){ 
                                    if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                    echo '<option value="'.$state['GEO_ID'].'"'.$sel.'>'.$state['NAME'].'</option>';
                                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-4" id="dist-data">';
                    echo '<select id="seldt" name="seldt" class="form-control select2-selection--single" disabled="disabled">';
                    echo '<option value="">Select District</option>';
                          foreach($DistData as $dist){ 
                                    if($FeedFarData['DISTRICT_ID']==$dist['GEO_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                    echo '<option value="'.$dist['GEO_ID'].'"'.$sel.'>'.$dist['NAME'].'</option>';
                                    }         
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-add" name="far-add" type="text" placeholder="Address" value="'.$FeedFarData['ADDRESS'].'" class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '</div>';
                        
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-pin" name="far-pin" type="text" placeholder="Pincode" value="'.$FeedFarData['PIN_CODE'].'" class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-alt-no" name="far-alt-no" type="text" placeholder="Alt. Contact Number" value="'.$FeedFarData['FAR_ALT_NUMBER'].'" class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<select id="crop1" name="crop1" class="form-control select2" disabled="disabled">';
                    echo '<option value="">Select Crop-I</option>';
                            foreach($CropData as $crop){
                                    if($FeedFarData['RABI_CROP']==$crop['CROP_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                    echo '<option value="'.$crop['CROP_ID'].'"'.$sel.'>'.$crop['CROP_DESC'].'</option>';
                                    }
                    echo '</select>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-group">';
                           
                    echo '<div class="col-md-4">';
                    echo '<input id="corp1-acr" name="corp1-acr" type="text" placeholder="Acreage"  value="'.$FeedFarData['RABI_ACERAGE'].'"class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<select id="crop2" name="crop2" class="form-control select2" disabled="disabled">';
                    echo '<option value="">Select Crop-II</option>';
                            foreach($CropData as $crop){
                                    if($FeedFarData['KHARIF_CROP']==$crop['CROP_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                    echo '<option value="'.$crop['CROP_ID'].'"'.$sel.'>'.$crop['CROP_DESC'].'</option>';
                                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<input id="crop2-acr" name="crop2-acr" type="text" placeholder="Acreage" value="'.$FeedFarData['KHARIF_ACERAGE'].'"class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '</div>';
                        
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<input id="far-tot-acr" name="far-tot-acr" type="text" placeholder="Total Acreage" value="'.$FeedFarData['ACERAGE'].'" class="form-control input-md" disabled="disabled">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<textarea class="form-control" id="far-remarks" name="far-remarks" disabled="disabled">'.$FeedFarData['FAR_REMARKS'].'</textarea>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<select id="fed-satisfy" name="fed-satisfy" class="form-control">';
                    echo '<option value="">Select Satisfication</option>';
                    echo '<option value="1">Yes - Satisfy</option>';
                    echo '<option value="2">No - Un-Satisfy</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<input id="fed-case-id" name="fed-case-id" type="hidden" placeholder="Total Acreage" value="'.$FeedFarData['CASE_ID'].'" class="form-control input-md">';
                    echo '<textarea class="form-control" id="fed-cc-remarks" name="fed-cc-remarks" placeholder="Remarks..."></textarea>';
                    echo '</div>';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                    echo '<div class="tab-pane" id="2a">';
                    echo '<fieldset>';
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4">';
                    echo '<select id="procat" name="procat" class="form-control select2" onchange="showpro(this.value);" disabled="disabled">';
                    echo '<option value="0">Select Product Category</option>';
                            foreach($ProdCatData as $pcat){
                                if($FeedFarData['PROD_CATG']==$pcat['PRODUCT_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                echo '<option value="'.$pcat['PRODUCT_ID'].'"'.$sel.'>'.$pcat['PRODUCT_DESC'].'</option>';
                            }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-4" id="prod-data">';
                    echo '<select id="prodata" name="prodata" class="form-control select2" disabled="disabled">';
                    echo '<option value="0">Select Product</option>';
                             foreach($ProdData as $prod){
                                if($FeedFarData['PROD_ID']==$prod['PRODUCT_ID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                echo '<option value="'.$prod['PRODUCT_ID'].'"'.$sel.'>'.$prod['PRODUCT_DESC'].'</option>';
                            }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-4">';
                    echo '<select id="comcat" name="comcat" class="form-control select2" onchange="showcomp(this.value);" disabled="disabled">';
                    echo '<option value="0">Complaint Category</option>';
                            foreach($CompCatData as $comp){
                                if($FeedFarData['COMP_CATG']==$comp['SID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                echo '<option value="'.$comp['SID'].'"'.$sel.'>'.$comp['COMP_CATG'].'</option>';
                            }
                    echo '</select>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4" id="comp-data">';
                    echo '<select id="comdata" name="comdata" class="form-control select2" disabled="disabled">';
                    echo '<option value="0">Complaint Sub Category</option>';
                    foreach($CompData as $comp){
                           if($FeedFarData['COMP_TYPE']==$comp['SID'])
                                    {
                                        $sel="selected='selected'";
                                    }
                                    else {
                                        $sel="";
                                    }
                                echo '<option value="'.$comp['SID'].'"'.$sel.'>'.$comp['COMP_CATG'].'</option>';
                            }
                    
                    echo '</select>';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<textarea class="form-control" id="comdtls" name="comdtls" disabled="disabled">'.$FeedFarData['COMPLAINT_REMARKS'].'</textarea>';
                    echo '</div>';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                  echo '</div>';
              echo '</div>';
           echo '</div>';
        echo '</form>';
      echo '</div>';
        
        
    }
    //*****************************RETRIVE DATA SET***************************//
    public function savefeedback(){
        $this->load->model('call/feedback');
        $SubCcData=$this->model_call_feedback->subccdata($this->request->post);
        if($SubCcData==1)
        {
            echo 'Data saved successfully';
        }
        else{
            echo 'Sorry! Try Again';
        }
    }
    


}
