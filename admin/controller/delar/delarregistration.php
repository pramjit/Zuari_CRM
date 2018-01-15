
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
class Controllerdelardelarregistration extends Controller{

public function index() {
$this->load->language('customer/createcustomer');

$this->document->setTitle($this->language->get('heading_title'));

$this->load->model('delar/delarregistration');

$this->load->model('geo/addgeo');

//drop down
$data['user_group_id']="-1";

$data['dpnation']= $this->model_geo_addgeo->getNations();
$data['dpzone']= $this->model_geo_addgeo->getZone();
$data['dpregion']= $this->model_geo_addgeo->getRegion();
$data['dpstate']= $this->model_geo_addgeo->getState();
$data['dparea']= $this->model_geo_addgeo->getArea();
$data['dpterritory']= $this->model_geo_addgeo->getTerritory();
if (isset($this->request->get['customeridupdate'])) {
  $id=$this->request->get['customeridupdate'];
$data["updatedata"]= $this->model_delar_delarregistration->getupdatedata($id); 
}
$data["role_id"]=$this->request->get['id'];
//$data['dpdistrict']= $this->model_customer_createcustomer->getDistrict();

//$data['dpcustomer']= $this->model_customer_createcustomer->getCustomer();
$data["district"]= $this->model_delar_delarregistration->getdis($this->request->post); 
//end drop down

$data['heading_title'] = $this->language->get('Create Delar');
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

$data['createretailer'] = $this->url->link('delar/delarregistration/addretailer', 'token=' . $this->session->data['token'], 'SSL');
$data['updateretailer'] = $this->url->link('delar/delarregistration/updateretailer', 'token=' . $this->session->data['token'], 'SSL');


$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
if($data["role_id"]=='64') {
$data['breadcrumbs'][] = array(
'text' => 'Create Delar',
'href' => $this->url->link('delar/delarregistration', 'token=' . $this->session->data['token'], 'SSL')
);
}
if($data["role_id"]=='68') {
$data['breadcrumbs'][] = array(
'text' => 'Create Sub Delar',
'href' => $this->url->link('delar/delarregistration', 'token=' . $this->session->data['token'], 'SSL')
);
}
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('delar/delarregistration.tpl', $data));
}

public function addretailer(){
   //print_r($_POST);die;
$this->load->language('customer/createcustomer');
$json = array();
$this->load->model('delar/delarregistration');


if(!empty($this->request->post['delar_f_name'])

){

if (isset($this->request->post['delar_f_name']) && isset($this->request->post['delar_l_name'])
&& isset($this->request->post['delar_mobile_number']) && isset($this->request->post['password'])&& isset($this->request->post['delar_telephone'])
&& isset($this->request->post['delar_address']) &&isset($this->request->post['customer_code'])&&isset($this->request->post['district_id'])&& isset($this->request->post['delar_status'])&& isset($this->request->post['delar']) )

{
$chkmobile= $this->model_delar_delarregistration->checkMobileNumber($this->request->post);
$chkcustomercode= $this->model_delar_delarregistration->checkCustomerCode($this->request->post); 
  if($chkcustomercode=='1' ) {
 if($chkmobile=='1') {
    
$customer_id= $this->model_delar_delarregistration->addCustomer($this->request->post); 

$this->request->post['cust_id']=$customer_id;
//$customer_mapid = $this->model_delar_delarregistration->addCustomermap($this->request->post); 
$customer_empmapid = $this->model_delar_delarregistration->addCustomerempmap($this->request->post); 

if($customer_id && $customer_empmapid) {
$this->session->data['success'] = $this->language->get('text_success');
}
else {
    
    $json['error']['warning'] ="Error";
    $this->session->data['error'] ="Error";
}
 }
 else {
       $json['error']['warning'] =" User id already Exist!";
    $this->session->data['error'] ="User id already Exist!";
   }  
  }
else {
    
    $json['error']['warning'] ="Customer Code already Exist!";
    $this->session->data['error'] ="Customer Code already Exist!";
}


}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
}
}
$this->response->redirect($this->url->link('delar/delarregistration', 'token=' . $this->session->data['token'], 'SSL')); 
} 
public function updateretailer(){
   //print_r($_POST);die;
$this->load->language('customer/createcustomer');
$json = array();
$this->load->model('delar/delarregistration');
$customer_group_id=$this->request->post['customer_group_id'];
$customer_id= $this->model_delar_delarregistration->updateCustomer($this->request->post); 

if($customer_id) {
$this->session->data['success'] = 'Data Updated Successfully ';
} else {
    $json['error']['warning'] ="Error";
    $this->session->data['error'] ="Error";
}
if($customer_group_id=='64')
{
$this->response->redirect($this->url->link('delar/viewdealer', 'token=' . $this->session->data['token'], 'SSL'));
}
 else if ($customer_group_id=='68') {
     $this->response->redirect($this->url->link('delar/viewsubdealer', 'token=' . $this->session->data['token'], 'SSL')); 
     
 }

     
 
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
$this->load->model('delar/delarregistration');
if (isset($this->request->post['mobile'])) {

$data['mobile'] = $this->model_delar_delarregistration->checkMobileNumber($this->request->post); 
print_r($data['mobile']);
} 
}
public function getsoasm() {
    $this->load->model('delar/delarregistration');


        if (isset($this->request->post['district_id'])){

        $data['dp_so']= $this->model_delar_delarregistration->getso($this->request->post); 
        $data['dp_asm']= $this->model_delar_delarregistration->getasm($this->request->post); 
        //print_r($data['dp_so']);   
        //print_r($data['dp_asm']);   
       $dpzone= count($data['dp_so']);
        $dp_zon_ar=' <option value=""> Select SO</option> ';
        for($n=0;$n<$dpzone;$n++)
        {
        $dp_zon_ar.= '<option value="'.$data['dp_so'][$n]['customer_id'].'">'.$data['dp_so'][$n]['firstname'].'</option>';
        }
        
        $dpretailer= count($data['dp_asm']);
        $dpretailer_ar=' <option value="">Select ASM</option> ';
        for($n=0;$n<$dpretailer;$n++)
        {
        $dpretailer_ar.= '<option value="'.$data['dp_asm'][$n]['customer_id'].'">'.$data['dp_asm'][$n]['firstname'].'</option>';
        }
echo $dp_zon_ar."|".$dpretailer_ar;

       } 
    
}
public function insertretailerreg()
{
  $this->load->model('delar/delarregistration');   
     if (isset($this->request->post[''])){
         

     // $data['dp_so']= $this->model_retailer_retailerregistration-> ($this->request->post); 
    
      

       } 
  
    
}



}