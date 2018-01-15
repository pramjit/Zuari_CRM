
<?php

class Controllerschemeschemeregister extends Controller{

public function index() {
//$this->load->language('customer/createcustomer');
$this->document->setTitle('Scheme Register');
$this->load->model('scheme/schememodel');
//search mobile number
$data['product']= $this->model_scheme_schememodel->getproduct();

$data['heading_title'] = 'Scheme Register';
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
$data['createscheme'] = $this->url->link('scheme/schemeregister/addscheme', 'token=' . $this->session->data['token'], 'SSL');

$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);

$data['breadcrumbs'][] = array(
'text' => 'Scheme Register',
'href' => $this->url->link('scheme/schemeregister', 'token=' . $this->session->data['token'], 'SSL')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('scheme/schemeregister.tpl', $data));
}

public function addscheme()
 {
    //print_r($_POST);die;
$this->load->model('scheme/schememodel');

   
if (isset($this->request->post['scheme_Name']) && isset($this->request->post['date_from'])
&& isset($this->request->post['date_to']) && isset($this->request->post['product_id'])&& isset($this->request->post['qty'])
&& isset($this->request->post['Points']))
{
   $chkscheme= $this->model_scheme_schememodel->checkscheme($this->request->post);  
   if(empty($chkscheme)) {
  $customer_id= $this->model_scheme_schememodel->addscheme($this->request->post); 
  if($customer_id){
    $this->session->data['success']='Scheme Added Sucessfully!';  
  } else {
    $this->session->data['error'] ="Error";
  }
   } else {
     $this->session->data['error'] ="This product under scheme";  
   }  
}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
}

$this->response->redirect($this->url->link('scheme/schemeregister', 'token=' . $this->session->data['token'], 'SSL')); 
} 








}

