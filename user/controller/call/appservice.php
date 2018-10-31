<?php
class Controllercallappservice extends Controller {
public function  index(){
//$this->load->language('call/appservice');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('call/appservice');
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
$data['lnk'] = $this->url->link('call/appservice','token=' . $this->session->data['token'], 'SSL');
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
          
$data['ServiceData']= $this->model_call_appservice->getServiceData($this->request->get);

$order_total = count($order_total_count);





$data['ProdCatData']= $this->model_call_appservice->ProdCatData();

$data['EnqCatData']= $this->model_call_appservice->EnqCatData();
$data['EnqTypData']= $this->model_call_appservice->EnqTypData();



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
$pagination->url = $this->url->link('call/appservice', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='App Service Data';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'App Service',
'href' => $this->url->link('call/Service')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/call/appservice.tpl', $data));
//print_r( $data['mob3']); die;
}

public function distlist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_appservice->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='app-dd' name='app-dd' class='form-control select2' onchange='showmo(this.value);'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function molist(){
        $this->load->model('call/appservice');
        $MoData= $this->model_call_appservice->MoData($this->request->post['dtsid']);
        echo "<select name='app-md' id='app-md' class='form-control select2'>";
        echo "<option value=''>Select MO Office</option>";
                    foreach($MoData as $data){
                echo "<option value=".$data['MO_ID'].">".$data['MO_NAME']."</option>";
                }
        echo "</select>";
    }
public function edistlist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_appservice->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_call_appservice->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_appservice->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='prodata' name='prodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function eprodlist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_call_appservice->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('call/appservice');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_call_appservice->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function saveform(){
        $this->load->model('call/appservice');
        $SaveData= $this->model_call_appservice->SaveFormData($this->request->post);
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
        $this->load->model('call/appservice');
        $app_up_by = $this->customer->getId();
        $CasePin=$this->request->post['casepin'];
        $SerFarData=$this->model_call_appservice->SerFarData($this->request->post);
        $StateData= $this->model_call_appservice->StateData();
        $DistData= $this->model_call_appservice->DistData($SerFarData['StateId']);
       /*$CallSts= $this->model_call_appservice->CallSts();
        $CallUsr= $this->model_call_appservice->CallUsr();
        $StateData= $this->model_call_appservice->StateData();$CasePin
        $DistData= $this->model_call_appservice->DistData($FeedFarData['STATE_ID']);
        $CropData= $this->model_call_appservice->CropData();
        $ProdCatData= $this->model_call_appservice->ProdCatData();$CasePin
        $ProdData= $this->model_call_appservice->ProdData($FeedFarData['PROD_CATG']);
        $CompCatData= $this->model_call_appservice->CompCatData();
        $CompData= $this->model_call_appservice->CompData($FeedFarData['COMP_CATG']);
        */
        if($SerFarData['ServiceType']==1){
            $SerRequest="SERVICE QUERY";
        }else if($SerFarData['ServiceType']==2){
             $SerRequest="ASK OUR EXPERT";
        }else if($SerFarData['ServiceType']==3){
             $SerRequest="PURCHASE INTEREST";
        }else if($SerFarData['ServiceType']==4){
             $SerRequest="SOIL TEST";
        }else if($SerFarData['ServiceType']==5){
             $SerRequest="LEAF TEST";
        }else if($SerFarData['ServiceType']==6){
             $SerRequest="WATER TEST";
        }else {
             $SerRequest="OTHER";
        }
        echo '<div class="col-sm-8">';
        echo '<form name="callform" id="appfrm">';
        echo '<div class="table-responsive">';
                    
                    echo '<div class="form-group">';
                    echo '<fieldset style="background: #337ab7;color: #ffffff;">';
                    echo '<label class="col-md-4 text-left">MOBILE :&nbsp;&nbsp;'.$SerFarData['Mobile'].'/ PIN:'.$CasePin.'</label>';
                    echo '<label class="col-md-4 text-center">QUERY TYPE :&nbsp;&nbsp;'.$SerRequest.'</label>';
                    echo '<label class="col-md-4 text-right">DATE :&nbsp;&nbsp;'.$SerFarData['CrDate'].'</label>';
                    echo '</fieldset>';
                    echo '</div>';
                    
                    echo '<div class="form-group">';
                    echo '<fieldset>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">STATE:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<select id="app-sd" name="app-sd" class="form-control" onchange="showdist(this.value);">';
                    echo '<option value="">Select State</option>';
                    foreach($StateData as $sd){
                        if($SerFarData['StateId']==$sd['GEO_ID']){$selected="selected";}else{$selected="";}
                        echo '<option value="'.$sd['GEO_ID'].'"'.$selected.'>'.$sd['NAME'].'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">DISTRICT:</label>';
                    echo '<div class="col-md-3 text-left" id="dist-data">';
                    echo '<select id="app-dd" name="app-dd" class="form-control" onchange="showmo(this.value);">';
                    echo '<option value="">Select District</option>';
                    foreach($DistData as $dd){
                        
                        echo '<option value="'.$dd['GEO_ID'].'">'.$dd['NAME'].'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">MO OFC:</label>';
                    echo '<div class="col-md-3 text-left" id="mo-data">';
                    echo '<select id="app-md" name="app-md" class="form-control">';
                    echo '<option value="">Select MO Office</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                    
                    echo '<div class="form-group">';
                    echo '<fieldset>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">NAME:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<input type="text" name="app-usr" id="app-usr" class="form-control" value="'.$SerFarData['CustomerName'].'">';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">PRODUCT:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<input type="text" name="app-pro" id="app-pro" class="form-control" value="'.$SerFarData['ProductName'].'">';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">TYPE:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<select id="app-ser" name="app-ser" class="form-control">';
                    echo '<option value="">Select Query Type</option>';
                    if($SerFarData['ServiceType']==1){
                     echo '<option value="1" selected>Service Query</option>';
                    }
                    else{
                         echo '<option value="1">Service Query</option>';
                    }
                    if($SerFarData['ServiceType']==2){
                         echo '<option value="2" selected>Ask our expert</option>';
                    }
                    else{
                         echo '<option value="2">Ask our expert</option>';
                    }
                    if($SerFarData['ServiceType']==3){
                         echo '<option value="3" selected>Purchase Interest</option>';
                    } else {
                         echo '<option value="3">Purchase Interest</option>';
                    }
                    if($SerFarData['ServiceType']==4){
                         echo '<option value="4" selected>Soil Test</option>';
                    } else {
                         echo '<option value="4">Soil Test</option>'; 
                    }
                    if($SerFarData['ServiceType']==5){
                         echo '<option value="5" selected>Leaf Test</option>';
                    } else {
                         echo '<option value="5">Leaf Test</option>'; 
                    }
                    if($SerFarData['ServiceType']==6){
                         echo '<option value="6" selected>Water Test</option>';
                    } else {
                         echo '<option value="6">Water Test</option>'; 
                    }
                    if($SerFarData['ServiceType']==7){
                         echo '<option value="7" selected>Others</option>';
                    } else {
                         echo '<option value="7">Others</option>'; 
                    }
                    
                    echo '</select>';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                    
                    
                    echo '<div class="form-group">';
                    echo '<fieldset>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">STORE:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<input type="text" name="app-sto" id="app-sto" class="form-control" value="'.$SerFarData['StoreName'].'">';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;" >QUANTITY:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<input type="text" name="app-qty" id="app-qty" class="form-control" value="'.$SerFarData['Quantity'].'">';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">ORD. ID:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<input type="text" name="app-odr" id="app-odr" class="form-control" value="'.$SerFarData['OrderId'].'">';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                    
                    
                    echo '<div class="form-group">';
                    echo '<fieldset>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">QUERY:</label>';
                    echo '<div class="col-md-7 text-left">';
                    echo '<textarea class="form-control" name="app-qry" id="app-qry" >'.$SerFarData['Query'].'</textarea>';
                    echo '</div>';
                    echo '<label class="col-md-1 text-left"style="margin-top:5px; padding:5px!important;">IS SOLUTION PROVIDED:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<select id="app-ans" name="app-ans" class="form-control" onchange="ShowAns(this.value);" style="margin-top: 10%;">';
                    echo '<option value="">Select</option>';
                    echo '<option value="1">Yes</option>';
                    echo '<option value="2">No</option>';
                    echo '</select>';
                    echo '</div>';
                   
                    echo '</fieldset>';
                    echo '</div>';
                    
                    
                    echo '<div class="form-group" id="ans-div" style="display:none;">';
                    echo '<fieldset>';
                    echo '<label class="col-md-1 text-left" style="margin-top:5px; padding:5px!important;">SOLUTION:</label>';
                    echo '<div class="col-md-11 text-left">';
                    echo '<textarea class="form-control" placeholder="...your feedback" name="app-sol" id="app-sol"></textarea>';
                    echo '</div>';
                    echo '</fieldset>';
                    echo '</div>';
                    
                    echo '<div class="form-group">';
                    echo '<fieldset>';
                    echo '<label class="col-md-3 text-right" style="margin-top:5px; padding:5px!important;">&nbsp;</label>';
                    echo '<label class="col-md-2 text-right"style="margin-top:5px; padding:5px!important;">CALL STATUS:</label>';
                    echo '<div class="col-md-3 text-left">';
                    echo '<select id="app-cal" name="app-cal" class="form-control">';
                    echo '<option value="">Select</option>';
                    echo '<option value="1">Answered</option>';
                    echo '<option value="2">Not Picked</option>';
                    echo '<option value="3">Wrong Number</option>';
                    echo '<option value="4">Abusing</option>';
                    echo '</select>';
                    echo '</div>';
                    echo '<input type="hidden" name="app-pin" id="app-pin" class="form-control" value="'.$CasePin.'">';
                    echo '<input type="hidden" name="app-cid" id="app-cid" class="form-control" value="'.$SerFarData['SID'].'">';
                    echo '<input type="hidden" name="app-frm" id="app-frm" class="form-control" value="'.$SerFarData['Mobile'].'">';
                    echo '<input type="hidden" name="app-up-by" id="app-up-by" class="form-control" value="'.$app_up_by.'">';
                    echo '<label class="col-md-4 btn btn-primary text-left upappdata"  onclick="upappdata();">SUBMIT</label>';
                    echo '</fieldset>';
                    echo '</div>';
                  
                    
           echo '</div>';
        echo '</form>';
      echo '</div>';
        
        
    }
    //*****************************RETRIVE DATA SET***************************//
    public function SaveFormData(){
        $this->load->model('call/appservice');
        $SerCcData=$this->model_call_appservice->SaveFormData();
        if($SerCcData==0)
        {
            echo 'Sorry! There is some error in the form.';
        }
        else if($SerCcData==1)
        {
            echo 'Data Updated Successfully';
        }
        else{
            $CaseMail= $this->model_call_appservice->CaseMailDtls($SerCcData);
            $caseid =   $CaseMail['CID'];   //Case Id
           // $raid   =   $CaseMail['RAID'];  //Ra Id
            $raname   =   $CaseMail['RA_NAME'];  //Ra Id
            $days    =   $CaseMail['NOD'];   //No of for 2(Complain)Days Remaining //for 32(ADV) pin
            $ramid  =   $CaseMail['MID'];   //Ra Mail Id
            if($CaseMail['FLAG']==2){
                $url= 'zuari.akshapp.com';
                $cc='asad.ahmed@adventz.com';
                $sub='Complaint '.$caseid.': Resolution required';
                $msg='Dear '.$raname.', <br><br><br>
                Complaint '.$caseid.' has been registered. <br><br>
                The complaint can be accessed through  '.$url.'<br><br>
                The expected Resolution date for this complaint is '.$days.' working  days post complaint logging date.<br><br><br>
                Thanks and Regards,<br>
                Support- Adventz Agri CRM';
                MsgToMailRA($ramid,$cc,$sub,$msg);
                echo 'Data Updated Successfully';
            }
            else if($CaseMail['FLAG']==32){
                $url= 'zuari.akshapp.com';
                $cc='asad.ahmed@adventz.com';
                $sub='Advisory ID : '.$days.' awaiting call back';
                $msg="Dear Sir,<br><br><br>
			Advisory ".$days." has been logged in for you.<br><br>
			You may reach the caller by dialing 0120-4398901 followed by the above mentioned advisory ID.<br><br>
			Request you to please call the concerned farmer within 1 working day.<br><br><br>

			Best Regards,<br>
			Support- Adventz Agri CRM";
                MsgToMail($ramid,$cc,$sub,$msg);
                echo 'Data Updated Successfully';
            }
            else if($CaseMail['FLAG']==293031){
                $url= 'zuari.akshapp.com';
               // $cc='asad.ahmed@adventz.com';
                $sub='Complaint '.$caseid.': Resolution required';
                $msg='Dear '.$raname.', <br><br><br>
                Complaint '.$caseid.' has been registered. <br><br>
                The complaint can be accessed through  '.$url.'<br><br>
                The expected Resolution date for this complaint is 2 working  days post complaint logging date.<br><br><br>
                Thanks and Regards,<br>
                Support- Adventz Agri CRM';
                MsgToMail($ramid,$cc,$sub,$msg);
                echo 'Data Updated Successfully';
            }
            else if($CaseMail['FLAG']==1){
                echo 'Data Updated Successfully';
            }
            else{
                echo 'Sorry! There is some error in the form.';
            }
        }
    }
    


}
