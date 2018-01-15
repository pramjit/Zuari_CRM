
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
class Controllerfarmerfarmerupdate extends Controller{

public function index() {
$this->load->language('customer/createcustomer');
$this->document->setTitle($this->language->get('heading_title'));
$this->load->model('farmer/farmerregistration');
//search mobile number

if(isset($this->request->get['customeridupdate']))
{
$id=$this->request->get['customeridupdate'];
$data['farmerdata']= $this->model_farmer_farmerregistration->getupdatedata($id);

$disid = $data['farmerdata']["DIST_ID"];
}

//echo $farmermobile; die;//drop down
$data['user_group_id']="-1";
$data['dpdistrictfar']= $this->model_farmer_farmerregistration->getDistricts();
$data['village']=$this->model_farmer_farmerregistration->getdistrictvillage($disid);
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
$data['updatefarmer'] = $this->url->link('farmer/farmerupdate/updatefarmer', 'token=' . $this->session->data['token'], 'SSL');

$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);

$data['breadcrumbs'][] = array(
'text' => $this->language->get('heading_title'),
'href' => $this->url->link('farmer/farmerregistration', 'token=' . $this->session->data['token'], 'SSL')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('farmer/farmerupdate.tpl', $data));
}

public function updatefarmer()
 {
   // print_r($_POST);die;
$this->load->language('customer/createcustomer');
$json = array();
$this->load->model('farmer/farmerregistration');
if(!empty($this->request->post['first_name']))
{
   
if (isset($this->request->post['first_name']) && isset($this->request->post['email'])
 && isset($this->request->post['district_id'])&& isset($this->request->post['village_name'])
&& isset($this->request->post['status']))
{
    //check mobile number
  
  $customer_id= $this->model_farmer_farmerregistration->updatefarmercustomerreg($this->request->post); 
  $this->session->data['success'] = 'Data Updated Successfully ';
   echo '1';
  
}else{
     echo '0';
//$json['error']['warning'] ="Error";
//$this->session->data['error'] ="Error";
}
}
//$this->response->redirect($this->url->link('farmer/farmerregistration', 'token=' . $this->session->data['token'], 'SSL')); 
} 

 public function getdistrictvillage(){
          $this->load->model('farmer/farmerregistration');
          $village=$this->model_farmer_farmerregistration->getdistrictvillage();
          echo '<option value="">Select Village</option>';
          foreach($village as $value) {
              echo '<option value="'.$value["SID"].'">'.$value["VILLAGE_NAME"].'</option>';
          }
          
      }
//duplicate mobile number
 public function checkMobileNumber(){
$this->load->model('farmer/farmerregistration');
if (isset($this->request->post['mobile'])) {
$number['mobile'] = $this->model_farmer_farmerregistration->checkMobileNumber($this->request->post); 
print_r($number);
} 
}






}

