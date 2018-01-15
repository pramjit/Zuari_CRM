
<?php

class Controllerschemeschemeredemption extends Controller{

public function index() {
//$this->load->language('customer/createcustomer');
$this->document->setTitle('Scheme Redemption');
$this->load->model('scheme/schememodel');
//search mobile number
$data['product']= $this->model_scheme_schememodel->getproduct();
if(isset($this->request->get['schemeredemptionid']))
{
$id=$this->request->get['schemeredemptionid'];
$data['redemptiondata']= $this->model_scheme_schememodel->getupdatedata($id);
$data["proqty"]= $this->model_scheme_schememodel->getproqty($id); 
}



$data['heading_title'] = 'Scheme Redemption';
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
$data['schemeredemptiondata'] = $this->url->link('scheme/schemeredemption/addredemption', 'token=' . $this->session->data['token'], 'SSL');


$data['breadcrumbs'] = array();

$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);

$data['breadcrumbs'][] = array(
'text' => 'Scheme Redemption',
'href' => $this->url->link('scheme/schemeredemption&schemeredemptionid='.$id, 'token=' . $this->session->data['token'], 'SSL')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('scheme/schemeredemption.tpl', $data));
}
public function addredemption()
      
 {
     $id1=$this->request->post['sid']; 
$this->load->model('scheme/schememodel');

if (isset($this->request->post['sid']))
{
   $customer_id= $this->model_scheme_schememodel->addredemption($this->request->post); 
  if($customer_id ){
    $this->session->data['success']='Scheme Redemption Added Sucessfully!';  
  } else {
    $this->session->data['error'] ="Error";
}
}else{
$json['error']['warning'] ="Error";
$this->session->data['error'] ="Error";
}
$this->response->redirect($this->url->link('scheme/schemeredemption&schemeredemptionid='.$id1, 'token=' . $this->session->data['token'], 'SSL')); 
}
 








}

