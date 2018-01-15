<?php
class Controllerfarmerothercall extends Controller {
public function  index(){
//$this->load->language('farmer/register');
$this->document->setTitle($this->language->get('heading_title'));      
$this->load->model('farmer/register');
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

if (isset($this->request->get['page'])) {
$url .= '&page=' . $this->request->get['page'];
}
$data['lnk'] = $this->url->link('farmer/register','token=' . $this->session->data['token'], 'SSL');
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
$this->load->model('farmer/othercall');
$data['misscallData']= $this->model_farmer_othercall->getothercallData($this->request->get);
$order_total_count = $this->model_farmer_othercall->getothercallData($this->request->get);
$order_total = count($order_total_count);

$data['StateData']= $this->model_farmer_register->StateData();

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
$pagination->url = $this->url->link('farmer/register', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
$data['pagination'] = $pagination->render();
$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));
$data['filter_from_date'] = $filter_from_date;
$data['filter_to_date'] = $filter_to_date;
$data['filter_order_status'] = $filter_order_status;
$data['filter_total'] = $filter_total;
$data['filter_date_added'] = $filter_date_added;
$data['filter_date_modified'] = $filter_date_modified;
$data['order_statuses'] = "";
$this->session->data["title"]='Other Calls';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Other Call',
'href' => $this->url->link('farmer/othercall')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/farmer/othercall.tpl', $data));
//print_r( $data['mob3']); die;
}
public function regionlist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    $RegionData= $this->model_farmer_register->RegionData($this->request->post['zoid']);
    //print_r( $DistData);
               
                /////////////////////////////////////////////////
                echo "<select name='region' id='region' class='form-control' onchange='showstate(this.value);'>";
                echo "<option value=''>Select Region</option>";
                    foreach($RegionData as $data){
                echo "<option value=".$data['GEO_ID'].">".$data['NAME']."</option>";
                }
                echo "</select>";
                ///////////////////////////////////////////////
                
                
    }
  
  
    public function updateStateData()
    {
        $this->load->model('farmer/othercall');
        $this->load->library('PHPMailer/PHPMailerAutoload');
        //*****************************MAIL FUNCTION START*********************************************//
		function MsgToMail($to,$cc,$sub,$msg){
			$log=new Log("ApiRaMail.log");
			$log->write($to.'/'.$cc.'/'.$sub.'/'.$msg);
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in', 'Agri CRM Adventz');   
			$mail->addAddress($to);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Agri CRM Adventz';
			//$mail->AddAttachment($attach);
			//$mail->AddCC($cc);
			//$mail->AddBCC('aasit.kumar@aspltech.com','Aasit');
			$mail->AddBCC('anamika.arora@aspltech.com','Anamika');
			$mail->send();
			/*if(!$mail->send())	{
    								echo 'Message could not be sent.';
    								echo 'Mailer Error: ' . $mail->ErrorInfo;
								}
								else
								{
    								echo 'Message has been sent';
								}
			*/
		}
	//*****************************MAIL FUNCTION END***********************************************//
        //**********************************SEND SMS FUNCTION START*************************************//
        function sendadvsms($mob,$msg){
        $umsg=urlencode($msg);
        $log=new Log("ApiIvrSms.log");
        $cr_date=date('Y-m-d');
        
        $surl="https://www.smscountry.com/SMSCwebservice.asp?User=akshamaala10&passwd=akshamaala10&sid=JAIKSN&DR=Y&mobilenumber=".$mob."&message=".$umsg;
                $log->write($surl);
                $curl_handle=curl_init();
                curl_setopt($curl_handle,CURLOPT_URL,$surl);
                curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
                curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
                $buffer = curl_exec($curl_handle);
                if($buffer === false)
                {
                        echo 'Curl error: ' . curl_error($curl_handle);
                }
                else
                {

                    print_r($buffer);
                    return true;
                }	
                curl_close($curl_handle);
        }
        //**********************************SEND SMS FUNCTION END*************************************//
        
        $Dist= $this->model_farmer_othercall->stateupdate($this->request->post);
        if($Dist==1)
        {
            
             $Adv= $this->model_farmer_othercall->AdvDtls($this->request->post);
             if($Adv){
                $ADV_MAIL= $Adv['ADV_MAIL'];
                $ADV_MOB = $Adv['ADV_MOB'];
                $ADV_PIN = $Adv['ADV_PIN'];
             
             
             //******************* MAIL TO ADVISORY START**********************//
                $cc='asad.ahmed@adventz.com';
                $sub='Advisory ID : '.$ADV_PIN.' awaiting call back';
                $msg="Dear Sir,<br><br><br>
			Advisory ".$ADV_PIN." has been logged in for you.<br><br>
			You may reach the caller by dialing 0120-4398901 followed by the above mentioned advisory ID.<br><br>
			Request you to please call the concerned farmer within 1 working day.<br><br><br>

			Best Regards,<br>
			Support- Adventz Agri CRM";
                MsgToMail($ADV_MAIL,$cc,$sub,$msg);
                $msgadv="Advisory ".$ADV_PIN." has been logged in for you. Kindly contact the caller at 01204398901 and enter the advisory Id. You can view details through web and app.";
                sendadvsms($ADV_MOB,$msgadv);//SMS for Advisory
                echo "State Successfully Updated";
             }
             else{
                 echo 'Sorry! There is some error occoured';
             }
             
            
        }else{
            echo 'Sorry! There is some error occoured';
        }
    }
}
