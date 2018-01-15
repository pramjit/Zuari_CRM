
<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

/**
* Description of createdealer
*
* @author agent
*/
class Controllercustomercreatecustomer extends Controller{

public function index() {
$this->load->language('customer/createcustomer');

$this->document->setTitle($this->language->get('heading_title'));

$this->load->model('customer/createcustomer');

$this->load->model('geo/addgeo');

//drop down
$data['user_group_id']="-1";

$data['dpnation']= $this->model_geo_addgeo->getNations();
$data['dpzone']= $this->model_geo_addgeo->getZone();
$data['dpregion']= $this->model_geo_addgeo->getRegion();
$data['dpstate']= $this->model_geo_addgeo->getState();
$data['dparea']= $this->model_geo_addgeo->getArea();
$data['dpterritory']= $this->model_geo_addgeo->getTerritory();
$data['dpdistrict']= $this->model_customer_createcustomer->getDistrict();

$data['dpcustomer']= $this->model_customer_createcustomer->getCustomer();

//end drop down

$data['heading_title'] = $this->language->get('heading_title');
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

$data['createcustomer'] = $this->url->link('customer/createcustomer/addCustomer', 'token=' . $this->session->data['token'], 'SSL');

$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);

$data['breadcrumbs'][] = array(
'text' => $this->language->get('heading_title'),
'href' => $this->url->link('customer/createcustomer', 'token=' . $this->session->data['token'], 'SSL')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('customer/createcustomer.tpl', $data));
}

public function addCustomer(){
    //print_r($_POST);die;
$this->load->language('customer/createcustomer');
$json = array();
$this->load->model('customer/createcustomer');


if(!isset($this->request->post['group']))
{


$this->request->post['group']=array("0","0","0","0","0");
}



//print_r($group);die;
if(!empty($this->request->post['first_name'])

){

if (isset($this->request->post['first_name']) && isset($this->request->post['last_name'])
&& isset($this->request->post['password']) && isset($this->request->post['status'])&& isset($this->request->post['group_role'])
&& isset($this->request->post['nation_id']) && isset($this->request->post['state_id']))

{

$customer_id= $this->model_customer_createcustomer->addCustomer($this->request->post); 

$this->request->post['cust_id']=$customer_id;
$customer_mapid = $this->model_customer_createcustomer->addCustomermap($this->request->post); 
$customer_empmapid = $this->model_customer_createcustomer->addCustomerempmap($this->request->post); 
if(isset($this->request->post['retailer'])){
   $customer_retailer = $this->model_customer_createcustomer->addretailer($this->request->post);  
}

if($customer_id && $customer_mapid && $customer_empmapid) {
$this->session->data['success'] = $this->language->get('text_success');
} else {
    
    $json['error']['warning'] ="Error";
    $this->session->data['error'] ="Error";
}


}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
}
}
$this->response->redirect($this->url->link('customer/createcustomer', 'token=' . $this->session->data['token'], 'SSL')); 

// $this->response->addHeader('Content-Type: application/json');
//$this->response->setOutput(json_encode($json));

} 

public function groupDropdown(){
//echo $this->request->post['query'];

$json = array();
$this->load->model('customer/createcustomer');
if (isset($this->request->post['query'])) {

$data['dp_grouphide']= $this->model_customer_createcustomer->groupDropdown($this->request->post); 

$icount=0;
foreach ($data['dp_grouphide'] as $result)
{
$data['userdb']= $this->model_customer_createcustomer->getUserByLevelId($result['id']); 
$json["data"].="<div class='form-group required'><label class='col-sm-4 control-label'>".$result['name']."</label><div class='col-sm-8'>";
$json["data"].='<select name="group[]" id="group[]" class="form-control" ><option value=""> Select '.$result['name'].'</option>';
foreach ($data['userdb'] as $user){
$json["data"].='<option value="'.$user['id'].'">'.$user['name'].'</option>';
}
$json["data"].="</select></div></div>";



} 

$json["data"].="<p id='Group_s' style='display:none;color:red;'>Required Group</p>";

} 
$this->response->addHeader('Content-Type: application/json');
$this->response->setOutput(json_encode($json)); 
}


public function checkMobileNumber(){
$this->load->model('customer/createcustomer');
if (isset($this->request->post['mobile'])) {

$data['mobile'] = $this->model_customer_createcustomer->checkMobileNumber($this->request->post); 
print_r($data['mobile']);
} 
} 


}

