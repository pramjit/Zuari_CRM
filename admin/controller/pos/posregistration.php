
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
class Controllerposposregistration extends Controller{

public function index() {
$this->load->language('pos/posregistration');

$this->document->setTitle('Create POS');

$this->load->model('pos/posregistration');



//drop down

$data['dpdistrict']= $this->model_pos_posregistration->getDistrict();



if (isset($this->request->get['customeridupdate'])) {
 $id=$this->request->get['customeridupdate'];
 
 $data["updatedata"]= $this->model_pos_posregistration->getupdatedata($id); 
 $disid=$this->request->get["dis"];
 $this->request->post['district']=$disid;
 $data['dphq']= $this->model_pos_posregistration->getdistrict_hq($this->request->post);

 
}

//end drop down

$data['heading_title'] ='Create POS';
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

$data['createcustomer'] = $this->url->link('pos/posregistration/addCustomer', 'token=' . $this->session->data['token'], 'SSL');
$data['updateretailer'] = $this->url->link('pos/posregistration/updateCustomer', 'token=' . $this->session->data['token'], 'SSL');


$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);

$data['breadcrumbs'][] = array(
'text' => 'Create POS',
'href' => $this->url->link('pos/posregistration', 'token=' . $this->session->data['token'], 'SSL')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('pos/posregistration.tpl', $data));
}

public function addCustomer(){
$this->load->language('pos/posregistration');
$json = array();
$this->load->model('pos/posregistration');

if (isset($this->request->post['pos_name']) && isset($this->request->post['pos_mobile'])
&& isset($this->request->post['income']) && isset($this->request->post['district_id'])&& isset($this->request->post['market_id']))
{
  $chkmobile= $this->model_pos_posregistration->checkMobileNumber($this->request->post); 
 if($chkmobile=='1' ) {
$customer_id= $this->model_pos_posregistration->addPos($this->request->post); 
 if($customer_id){
    $this->session->data['success']='POS Added Sucessfully!';  
  } else {
    $this->session->data['error'] ="Error";
  }
   } else {
     $this->session->data['error'] ="Mobile Number Already Exist";  
   }  
}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
}
$this->response->redirect($this->url->link('pos/posregistration', 'token=' . $this->session->data['token'], 'SSL')); 
} 

public function updateCustomer(){
$this->load->language('pos/posregistration');
$json = array();
$this->load->model('pos/posregistration');
$customer_id= $this->model_pos_posregistration->updatepos($this->request->post); 

if($customer_id) {
$this->session->data['success'] = 'Data Updated Successfully ';
} else {
    $json['error']['warning'] ="Error";
    $this->session->data['error'] ="Error";
}

$this->response->redirect($this->url->link('pos/viewpos', 'token=' . $this->session->data['token'], 'SSL')); 
}


      public function getdistrict_hq(){
        
     $this->load->model('pos/posregistration');
        if (isset($this->request->post['district'])) {
        $data['dp_hq']= $this->model_pos_posregistration->getdistrict_hq($this->request->post); 
        $dp_hq= count($data['dp_hq']);
        echo ' <option value=""> Select Market</option> ';
        for($n=0;$n<$dp_hq;$n++)
        {
        echo '<option value="'.$data['dp_hq'][$n]['SID'].'">'.$data['dp_hq'][$n]['GEO_NAME'].'</option>';
        }

       } 
    
}

public function checkMobileNumber(){
$this->load->model('pos/posregistration');
if (isset($this->request->post['mobile'])) {
$data['mobile'] = $this->model_pos_posregistration->checkMobileNumber($this->request->post); 
print_r($data['mobile']);
} 
} 


}
