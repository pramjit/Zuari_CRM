
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
class Controllerfarmerfarmerregistration extends Controller{

public function index() {
$this->load->language('customer/createcustomer');
$this->document->setTitle($this->language->get('heading_title'));
$this->load->model('farmer/farmerregistration');
//search mobile number
$data['checkdata']= $this->model_farmer_farmerregistration->checkMobileNumber1($farmermobile);
if(isset($this->request->get['farmermobile']))
{

$farmermobile=$this->request->get['farmermobile'];
if($farmermobile==''){
    
     $this->response->redirect($this->url->link('farmer/farmerregistration', 'token=' . $this->session->data['token'], 'SSL')); 
}
$data['farmerdata']= $this->model_farmer_farmerregistration->getfarmerdetails($farmermobile);


$data['checkdata']= $this->model_farmer_farmerregistration->checkMobileNumber1($farmermobile);
$chk = $data['checkdata'];
if($chk== '1')
{
    $this->session->data['success'] = 'Farmer Already Registered!';
} else if($chk!='1' || $chk!='0') {
    if($chk=='64') {
         $this->session->data['success'] = 'You are Already Registered as a DEALER!';
    } else if($chk=='65') {
        $this->session->data['success'] = 'You are Already Registered as a RETAILER!';
    } else if($chk=='66') {
        $this->session->data['success'] = 'You are Already Registered as a BACKEND!';
    } else if($chk=='68') {
        $this->session->data['success'] = 'You are Already Registered as a SUB DEALER!';
    } else if($chk=='69') {
        $this->session->data['success'] = 'You are Already Registered as a DISTRIBUTOR!';
    } else if($chk=='46') {
        $this->session->data['success'] = 'You are Already Registered as a DIRECTOR!';
    } else if($chk=='48') {
        $this->session->data['success'] = 'You are Already Registered as a Area Sales Manager!';
    } else if($chk=='47') {
        $this->session->data['success'] = 'You are Already Registered as a Sales Officer!';
    } else if($chk=='49') {
        $this->session->data['success'] = 'You are Already Registered as a Marketing Development Officer!';
    } else if($chk=='45') {
        $this->session->data['success'] = 'You are Already Registered as a Administrator!';
    } else if($chk=='53') {
        $this->session->data['success'] = 'You are Already Registered as a TAM!';
    } else if($chk=='54') {
        $this->session->data['success'] = 'You are Already Registered as a Sales Lead!';
    } else if($chk=='55') {
        $this->session->data['success'] = 'You are Already Registered as a TSM!';
    } else if($chk=='56') {
        $this->session->data['success'] = 'You are Already Registered as a Sales Coordinator!';
    } else if($chk=='57') {
        $this->session->data['success'] = 'You are Already Registered as a MT!';
    } else if($chk=='58') {
        $this->session->data['success'] = 'You are Already Registered as a Territory Manager!';
    } else if($chk=='59') {
        $this->session->data['success'] = 'You are Already Registered as a TSE!';
    } else if($chk=='60') {
        $this->session->data['success'] = 'You are Already Registered as a Marketing Development Officer!';
    } else if($chk=='61') {
        $this->session->data['success'] = 'You are Already Registered as a Retail Sales Officer!';
    } else if($chk=='62') {
        $this->session->data['success'] = 'You are Already Registered as a Cargill Technical!';
    } else if($chk=='63') {
        $this->session->data['success'] = 'You are Already Registered as a MIS!';
    }
    
}

if(empty($data['farmerdata'])){
    $data['farmerdata']= $this->model_farmer_farmerregistration->getfarmerdetailscustomer($farmermobile);
} 
//end search
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
$data['createfarmer'] = $this->url->link('farmer/farmerregistration/addfarmer', 'token=' . $this->session->data['token'], 'SSL');

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
$this->response->setOutput($this->load->view('farmer/createfarmer.tpl', $data));
}

public function addfarmer()
 {
    //print_r($_POST);die;
$this->load->language('customer/createcustomer');
$json = array();
$this->load->model('farmer/farmerregistration');
if(!empty($this->request->post['first_name']))
{
   
if (isset($this->request->post['first_name']) && isset($this->request->post['email'])
&& isset($this->request->post['password']) && isset($this->request->post['district_id'])&& isset($this->request->post['village_name'])
&& isset($this->request->post['status']))
{
    //check mobile number
   $chkmobile= $this->model_farmer_farmerregistration->checkMobileNumber($this->request->post); 
   if($chkmobile=='0') {
  $customer_id= $this->model_farmer_farmerregistration->addfarmerreg($this->request->post); 
   $this->request->post['cust_id']=$customer_id;
    echo '1';
   } else {
       echo '0';
   }
}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
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

