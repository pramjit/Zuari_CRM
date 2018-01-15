<?php
class Controllercallreview extends Controller {
public function  index(){
//$this->load->language('call/review');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('call/review');
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
$data['lnk'] = $this->url->link('call/review','token=' . $this->session->data['token'], 'SSL');
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
          
$data['misscallData']= $this->model_call_review->getreviewData($this->request->get);
$order_total_count = $this->model_call_review->getreviewDatacount($this->request->get);
$order_total = count($order_total_count);





$data['ProdCatData']= $this->model_call_review->ProdCatData();

$data['EnqCatData']= $this->model_call_review->EnqCatData();
$data['EnqTypData']= $this->model_call_review->EnqTypData();



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
$pagination->url = $this->url->link('call/review', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Review Data';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Review',
'href' => $this->url->link('call/review')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/call/review.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_review->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='seldt' name='seldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function edistlist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_review->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_review->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_review->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='prodata' name='prodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function eprodlist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_review->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('call/review');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_call_review->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function saveform(){
        $this->load->model('call/review');
        $SaveData= $this->model_call_review->SaveFormData($this->request->post);
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
        $this->load->model('call/review');
        $FeedFarData=$this->model_call_review->FeedFarData($this->request->post);
        $CallSts= $this->model_call_review->CallSts();
        $CallUsr= $this->model_call_review->CallUsr();
        $ZoneData=$this->model_call_review->ZoneData($FeedFarData['ZO_ID']);
        $RegionData=$this->model_call_review->RegionData($FeedFarData['RO_ID']);
        $StateData= $this->model_call_review->StateData($FeedFarData['STATE_ID']);
        $DistData= $this->model_call_review->DistData($FeedFarData['DISTRICT_ID']);
        $MoData= $this->model_call_review->MoData($FeedFarData['MO_OFFICE']);
        $CropData1= $this->model_call_review->CropData1($FeedFarData['CROP1']);
        $CropData2= $this->model_call_review->CropData2($FeedFarData['CROP2']);
        $CropData3= $this->model_call_review->CropData3($FeedFarData['CROP3']);
        $ProdGrpData= $this->model_call_review->ProdGrpData($FeedFarData['PROD_GROUP']);
        $ProdCatData= $this->model_call_review->ProdCatData($FeedFarData['PROD_CATG']);
        $ProdData= $this->model_call_review->ProdData($FeedFarData['PROD_ID']);
        $CompCatData= $this->model_call_review->CompCatData();
        $CompData= $this->model_call_review->CompData($FeedFarData['COMP_CATG']);
        
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
                echo '<input type="button" class="btn btn-primary subprodata" value="SUBMIT" onclick="subreviewdata();">';
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
                   echo'<div class="form-group">';
                echo'<div class="col-md-4">';
               /////////////////////////////////////////////////////////////////////////////////// 
                echo'<div id="zone-data">';
                echo'<select disabled="disabled" name="zone" id="zone" class="form-control" onchange="showregion(this.value);">';
                echo'<option value="'.$ZoneData['GEO_ID'].'">'.$ZoneData['NAME'].'</option>';
                echo'</select>';
              	echo'</div>';
                echo'</div>';
		echo'<div class="col-md-4">';
                
                echo'<div id="regi-data">';
                echo'<select disabled="disabled" name="region" id="region" class="form-control" onchange="showstate(this.value);">';
                echo'<option value="'.$RegionData['GEO_ID'].'">'.$RegionData['NAME'].'</option>';
               	echo'</select>';
                echo'</div>';
                echo'</div>';
            	echo'<div class="col-md-4">';
                
                echo'<div id="stat-data">';
               	echo'<select disabled="disabled" name="state" id="state" class="form-control" onchange="showdist(this.value);">';
                echo'<option value="'.$StateData['GEO_ID'].'">'.$StateData['NAME'].'</option>';
                echo'</select>';
                echo'</div>';
              	echo'</div>';
		echo'</div>';
                echo'<div class="form-group">';
                echo'<div class="col-md-4">';
                
                echo'<div id="dist-data">';
                echo'<select disabled="disabled" name="district" id="district" class="form-control select2">';
                echo'<option value="'.$DistData['GEO_ID'].'">'.$DistData['NAME'].'</option>';
                echo'</select>';
                echo'</div>';
                echo'</div>';
            	echo'<div class="col-md-4">';
                
              	echo'<select disabled="disabled" name="mooffice" id="mooffice" class="form-control select2">';
               	echo'<option value="'.$MoData['mo_office_geo_code'].'">'.$MoData['mo_office_name'].'</option>';
                echo'</select>';
               	echo'</div>';
            	echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['DEL_KEY_ADV_CODE'].'" id="keydealeradventcode" name="keydealeradventcode" class="form-control" placeholder="Key Dealer Advent Code "/>';
                echo'</div>';
            	echo'</div>';
                echo'<div class="form-group">';
                echo'<div class="col-md-4">';
             	echo'<input disabled="disabled" type="text" value="'.$FeedFarData['DEL_NAME'].'" id="keydealername" name="keydealername" class="form-control" placeholder="Key Dealer Name "/>';
		echo'</div>';
            	echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['DEL_LOC'].'" id="keydealerlocation" name="keydealerlocation" class="form-control" placeholder="Key Dealer Location"/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['DEL_MOB'].'" maxlength="10" id="keydealermobile" name="keydealermobile" class="form-control" placeholder="Key Dealer Mobile " />';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['RET_NAME'].'" id="keyretailername" name="keyretailername" class="form-control" placeholder="Key Retailer Name "/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['RET_MOB'].'" id="keyretailermobile" maxlength="10" name="keyretailermobile" class="form-control" placeholder="Key Retailer Mobile" />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['RET_LOC'].'" id="keyretailerlocation" name="keyretailerlocation" class="form-control" placeholder="Key Retailer Location"/>';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FM_SID_DEL_RET'].'" id="fmsidofdealer" name="fmsidofdealer" class="form-control" placeholder="FM Sid Of Dealer/Retailer "/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_FIR_NAME'].'" id="farmerfirstname"  name="farmerfirstname" class="form-control" placeholder="Farmer First Name"/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_MID_NAME'].'" id="farmermiddlename" name="farmermiddlename" class="form-control" placeholder="Farmer Middle Name "/>';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_LST_NAME'].'" id="farmerlastname" name="farmerlastname" class="form-control" placeholder="Farmer Last Name "/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_VILL'].'" id="farmervillage" name="farmervillage" class="form-control" placeholder="Key Farmer Village"/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_TALUKA'].'" id="farmertaluka" name="farmertaluka" class="form-control" placeholder="Key Farmer Taluka "/>';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_MOBILE'].'" id="farmermobile" maxlength="10" name="farmermobile" class="form-control" placeholder="Mobile Number " readonly/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_EMAIL'].'" id="email" name="email" class="form-control" placeholder="Email Address "/>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<select disabled="disabled" id="isprogressivefarmer" name="isprogressivefarmer" class="form-control">';
               if($FeedFarData['FAR_IS_PROGRESS']==1){
                echo'<option value="1" selected>Yes</option>';
                echo'<option value="0">No</option>';
               }
               else{
                    echo'<option value="1" >Yes</option>';
                echo'<option value="0" selected>No</option>';
               }
                echo'</select>';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                
                echo'<select disabled="disabled" id="majorcrop1" name="majorcrop1" class="form-control select2">';
                echo'<option value="'.$CropData1['CROP_ID'].'">'.$CropData1['CROP_DESC'].'</option>';
                echo'</select>';
                echo'</div>';
                echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['CROP1_ACERAGE'].'" id="acreage1" name="acreage1" class="form-control" placeholder="Acreage 1" />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<select disabled="disabled" id="majorcrop2" name="majorcrop2" class="form-control select2">';
                echo'<option value="'.$CropData2['CROP_ID'].'">'.$CropData2['CROP_DESC'].'</option>';
                echo'</select>';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['CROP2_ACERAGE'].'" id="acreage2" name="acreage2" class="form-control" placeholder="Acreage 2" />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<select disabled="disabled" id="majorcrop3" name="majorcrop3" class="form-control select2">';
                echo'<option value="'.$CropData3['CROP_ID'].'">'.$CropData3['CROP_DESC'].'</option>';
               	echo'</select>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['CROP3_ACERAGE'].'" id="acreage3" name="acreage3" class="form-control" placeholder="Acreage 3 " />';
                echo'</div>';
            	
                echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['IRR_ACERAGE'].'" id="irrigatedacreage" name="irrigatedacreage" class="form-control" placeholder="Irrigated Acreage " />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['DRIP_IRR_ACERAGE'].'" id="dripirrigatedacreage" name="dripirrigatedacreage" class="form-control" placeholder="Drip Irrigated Acreage " />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['RAIN_IRR_ACERAGE'].'" id="rainfedacreage" name="rainfedacreage" class="form-control" placeholder="Racnifed Acreage " />';
                echo'</div>';
                
            	echo'</div>';
                echo'<div class="form-group">';
                
		echo'<div class="col-md-4">';
                echo'<select disabled="disabled" id="issoiltestdone" name="issoiltestdone" class="form-control">';
                if($FeedFarData['FAR_IS_SOIL_TEST']==1){
                echo'<option value="1" selected>Yes</option>';
                echo'<option value="0">No</option>';
                }
                else{
                    echo'<option value="1">Yes</option>';
                echo'<option value="0" selected>No</option>';
                }
                echo'</select>';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                echo'<input disabled="disabled" type="text" value="'.$FeedFarData['FAR_SOIL_TEST_YEAR'].'" maxlength="4" id="yearofsoiltest" name="yearofsoiltest" class="form-control" placeholder="Year Of Soil Test Done " />';
                echo'</div>';
            
		echo'<div class="col-md-4">';
                
                echo'<textarea disabled="disabled" class="form-control" id="remarks" name="remarks"  placeholder="Remarks...">'.$FeedFarData['FAR_REMARKS'].'</textarea>';
                echo'</div>';
                echo'<form id="clfrm" name="clfrm">';
                echo'<div class="col-md-12">';
                
                echo'<textarea class="form-control" id="ccremarks" name="ccremarks"  placeholder="Remarks..."></textarea>';
                echo'<input type="hidden" name="caseid" id="caseid" value="'.$FeedFarData['CASE_ID'].'">';
                echo'</div>';
                echo'</form>';
                    echo '</fieldset>';
                    echo '</div>';
                    echo '<div class="tab-pane" id="2a">';
                    echo '<fieldset>';
                    echo '<div class="form-group">';
                    
                    echo '<div class="col-md-4">';
                    echo '<select disabled="disabled" id="comcat" name="comcat" class="form-control select2" onchange="showcomp(this.value);" disabled="disabled">';
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
                    
                    echo '<div class="form-group">';
                    echo '<div class="col-md-4" id="comp-data">';
                    echo '<select disabled="disabled" id="comdata" name="comdata" class="form-control select2" disabled="disabled">';
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
                     			echo '<div class="col-md-4">';
 			echo '<div id="prod-grp">';
 			echo '<select disabled="disabled" id="progrp" name="progrp" class="form-control select2" onchange="showprocat(this.value);">';
 			echo'<option value="'.$ProdGrpData['PRODUCT_ID'].'">'.$ProdGrpData['PRODUCT_DESC'].'</option>';
 			echo '</select>';
                        echo '</div>';
                        echo '</div>';
			echo '</div>';
                     
                            echo '<div class="form-group">';
                            echo '<div class="col-md-4">';
                            echo '<div id="prod-cat">';
                            echo '<select disabled="disabled" id="procat" name="procat" class="form-control select2">';
                            echo'<option value="'.$ProdCatData['PRODUCT_ID'].'">'.$ProdCatData['PRODUCT_DESC'].'</option>';
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';

                            echo '<div class="col-md-4">';
                            echo '<div id="prod-data">';
                            echo '<select disabled="disabled" id="pro-name" name="pro-name" class="form-control select2">';
                            echo'<option value="'.$ProdData['PRODUCT_ID'].'">'.$ProdData['PRODUCT_DESC'].'</option>';
                            echo '</select>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-md-4" id="prod-brand">';
                            echo '<input disabled="disabled" type="text" class="form-control" value="'.$FeedFarData['PROD_BRAND'].'" id="pro-brand" name="pro-brand"  placeholder="Product Brand">';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<div class="col-md-4">';
                            echo '<select disabled="disabled" id="pro-imp" name="pro-imp" class="form-control select2">';
                            if($FeedFarData['PROD_IMP']==1){
                                echo '<option value="1" selected>Yes</option>';
                            echo '<option value="2">No</option>';
                            }else{
                                echo '<option value="1">Yes</option>';
                            echo '<option value="2" selected>No</option>';
                            }
                            
                            echo '</select>';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                            echo '<input disabled="disabled" type="text" class="form-control" value="'.$FeedFarData['PROD_BATCH'].'" id="pro-batch" name="pro-batch"  placeholder="Batch Number">';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                            echo '<input disabled="disabled" type="text" class="form-control" value="'.$FeedFarData['PROD_PLANT'].'" id="pro-plant" name="pro-plant"  placeholder="Manufacturing Plant">';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<div class="col-md-4">';
                            echo '<input disabled="disabled" type="text" class="form-control"  value="'.$FeedFarData['PROD_PAKG'].'" id="pro-pkg-my" name="pro-pkg-my"  placeholder="Month/Year of Manufacture/Packiging">';
                            echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<textarea disabled="disabled" class="form-control" id="comdtls" name="comdtls" disabled="disabled">'.$FeedFarData['COMPLAINT_REMARKS'].'</textarea>';
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
    public function savereview(){
        $this->load->model('call/review');
        $SubCcData=$this->model_call_review->subccdata($this->request->post);
        if($SubCcData==1)
        {
            echo 'Data saved successfully';
        }
        else{
            echo 'Sorry! Try Again';
        }
    }
    


}
