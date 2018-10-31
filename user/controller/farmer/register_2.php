<?php
class Controllerfarmerregister extends Controller {
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
    }
    elseif(isset($this->error['warning']))
    {
        $data['error_warning'] = $this->error['warning'];
    }else{
        $data['error_warning'] = '';
    }
    
    if (isset($this->session->data['success'])) {
        $data['success'] = $this->session->data['success'];
        unset($this->session->data['success']);
    }else{
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
          
$data['misscallData']= $this->model_farmer_register->getmissedcallData($this->request->get);
$order_total_count = $this->model_farmer_register->getmissedcallDatacount($this->request->get);
$order_total = count($order_total_count);

$data['StateData']= $this->model_farmer_register->StateData();

$data['CropData']= $this->model_farmer_register->CropData();
$data['CallSts']= $this->model_farmer_register->CallSts();
$data['CallUsr']= $this->model_farmer_register->CallUsr();
$data['ProdCatData']= $this->model_farmer_register->ProdCatData();
$data['CompCatData']= $this->model_farmer_register->CompCatData();
$data['EnqCatData']= $this->model_farmer_register->EnqCatData();
$data['EnqTypData']= $this->model_farmer_register->EnqTypData();
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
$this->session->data["title"]='Missed Call';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Missed Call',
'href' => $this->url->link('farmer/register')
);
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/farmer/register.tpl', $data));
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
    public function molist(){
        $this->load->model('farmer/register');
        $MoData= $this->model_farmer_register->MoData($this->request->post['dtid']);
        echo "<select name='mooffice' id='mooffice' class='form-control select2'>";
        echo "<option value=''>Select MO Office</option>";
                    foreach($MoData as $data){
                echo "<option value=".$data['MO_ID'].">".$data['MO_NAME']."</option>";
                }
        echo "</select>";
    }
    public function distlist(){
    $this->load->model('farmer/register');
   
    $DistData= $this->model_farmer_register->DistData($this->request->post['stsid']);
        $dtdata="<select name='district' id='district' class='form-control select2-selection--single' onchange='showmo(this.value);'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                $dtdata.="<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                $dtdata.="</select>";
    $UserGeo= $this->model_farmer_register->UserGeo($this->request->post['stsid']);
    $ZoneData=$this->model_farmer_register->ZoneData();
    $RegionData=$this->model_farmer_register->RegionData();
    if(empty($UserGeo['ZONE_ID'])){
        $zodata='<select name="zone" id="zone" class="form-control" onchange="showregion(this.value);">';
                    $zodata.='<option value="">Select Zone</option>';
                    foreach($ZoneData as $zone){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $zodata.='<option value="'.$zone['GEO_ID'].'"'.$sel.'>'.$zone['NAME'].'</option>';
                    }
                $zodata.='</select>';
    }
    else{
    //ZONE LIST
    $zodata='<select name="zone" id="zone" class="form-control" onchange="showregion(this.value);">';
    $zodata.='<option value="'.$UserGeo['ZONE_ID'].'"'.$sel.'>'.$UserGeo['ZONE_NAME'].'</option>';
    $zodata.='</select>';
    }
    if(empty($UserGeo['ZONE_ID'])){
       $rgdata='<select name="region" id="region" class="form-control" onchange="showstate(this.value);">';
                    $rgdata.='<option value="">Select Region</option>';
                    foreach($RegionData as $region){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $rgdata.='<option value="'.$region['GEO_ID'].'"'.$sel.'>'.$region['NAME'].'</option>';
                    }
                $rgdata.='</select>';
    }
    else{
    //REGION LIST
     $rgdata.='<select name="region" id="region" class="form-control" onchange="showstate(this.value);">';
     $rgdata.='<option value="'.$UserGeo['REGION_ID'].'"'.$sel.'>'.$UserGeo['REGION_NAME'].'</option>';
     $rgdata.='</select>';
    }
    
    $ProdCatData= $this->model_farmer_register->ProdCatData();
    $progrp='<select id="progrp" name="progrp" class="form-control select2" onchange="showprocat(this.value);">';
    $progrp.='<option value="0">Select Product Group</option>';
    foreach($ProdCatData as $pcat){
    $progrp.='<option value="'.$pcat['PRODUCT_ID'].'">'.$pcat['PRODUCT_DESC'].'</option>';
    }
    $progrp.='</select>';
    
    $procat='<select id="procat" name="procat" class="form-control select2">';
        $procat.='<option value="">Select Product Category</option>';
    $procat.='</select>';
    
    $prodat='<select id="pro-name" name="pro-name" class="form-control select2">';
        $prodat.='<option value="">Select Product</option>';
    $prodat.='</select>';
    
    ////////////////////////////////////////////////////////////////////////////////
    $geodata=array("dtdata"=>$dtdata,"zodata"=>$zodata,"rgdata"=>$rgdata,"progrp"=>$progrp,"procat"=>$procat,"prodat"=>$prodat);
    $json=  json_encode($geodata);
    print_r($json);
    
    }
public function edistlist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_farmer_register->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='eseldt' name='eseldt' class='form-control select2-selection--single'><option value=''>Select District</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function ddistlist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    $DistData= $this->model_farmer_register->DistData($this->request->post['stsid']);
    //print_r( $DistData);
                echo"<select id='dseldt' name='dseldt' class='form-control select2-selection--single'><option value=''>SELECT DISTRICT</option>";
                foreach($DistData as $dist){
                echo "<option value=".$dist['GEO_ID'].">".$dist['NAME']."</option>";
                }
                echo"</select>";
    }
public function prodcat(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    
    $ProdDataCat= $this->model_farmer_register->ProdDataCat($this->request->post['grid']);
    //print_r( $DistData);showpro(catid)
                echo"<select  id='procat' name='procat' class='form-control select2-selection--single' onchange='showpro(this.value);'><option value='0'>Select Product Category</option>";
                foreach($ProdDataCat as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function prodlist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_farmer_register->ProdData($this->request->post['catid'],$this->request->post['stid']);
    //print_r( $DistData);showpro(catid)
                echo"<select  id='pro-name' name='pro-name' class='form-control select2-selection--single' onchange='showbrand(this.value);'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function prodbrand(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    
    $Prodbrand= $this->model_farmer_register->ProdBrand($this->request->post['proid']);
    //print_r( $DistData);showpro(catid)
    if($Prodbrand['BRAND1']=='0'){$B1='';}else{$B1=$Prodbrand['BRAND1'];}
    if($Prodbrand['BRAND2']=='0'){$B2='';}else{$B2=$Prodbrand['BRAND2'];}
    if($Prodbrand['BRAND3']=='0'){$B3='';}else{$B3=$Prodbrand['BRAND3'];}
    $brands = $B1;
    if($B2!=''){$brands.=", ".$B2;}
    if($B3!=''){$brands.=", ".$B3;}
      echo '<input type="text" value="'.$brands.'" class="form-control" id="pro-brand" name="pro-brand"  placeholder="Product Brand">';
    }    
    
    
    
public function eprodlist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    
    $ProdData= $this->model_farmer_register->ProdData($this->request->post['catid']);
    //print_r( $DistData);
                echo"<select  id='eprodata' name='eprodata' class='form-control select2-selection--single'><option value='0'>Select Product</option>";
                foreach($ProdData as $prod){
                echo "<option value=".$prod['PRODUCT_ID'].">".$prod['PRODUCT_DESC']."</option>";
                }
                echo"</select>";
    }
public function complist(){
    $this->load->model('farmer/register');
   // $a = $this->request->post['stsid'];
    $CompData= $this->model_farmer_register->CompData($this->request->post['comid']);
    //print_r( $DistData);
                echo"<select  id='comdata' name='comdata' class='form-control select2-selection--single'><option value='0'>Select Complaint Sub-category</option>";
                foreach($CompData as $comp){
                echo "<option value=".$comp['SID'].">".$comp['COMP_CATG']."</option>";
                }
                echo"</select>";
    }
    public function saveform(){
        $this->load->library('PHPMailer/PHPMailerAutoload');
        //*****************************MAIL FUNCTION START*********************************************//
		function MsgToMail($to,$cc,$sub,$msg){
			
			$log=new Log("ApiAdvMail".date('d_m_Y').".log");
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
			//if(!empty($to)){
			//$mail->AddCC($cc);
			//}
			$mail->AddBCC('aasit.kumar@aspltech.com','Aasit');
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
	//*****************************MAIL FUNCTION START*********************************************//
		function MsgToMailRA($to,$cc,$sub,$msg){
			
			$log=new Log("ApiRaMail".date('d_m_Y').".log");
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
			if(!empty($to)){
			$mail->AddCC($cc);
			}
			$mail->AddBCC('aasit.kumar@aspltech.com','Aasit');
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
        $this->load->model('farmer/register');
        //****************** FARMER TAB DATA *******************//
        /*$zone = $this->request->post['zone'];
        $region = $this->request->post['region'];
        $state= $this->request->post['state'];
        $district= $this->request->post['district'];
        $mooffice= $this->request->post['mooffice'];
        $keydealeradventcode= $this->request->post['keydealeradventcode'];
        $keydealername= $this->request->post['keydealername'];
        $keydealerlocation= $this->request->post['keydealerlocation'];
        $keydealermobile= $this->request->post['keydealermobile'];
        $keyretailername= $this->request->post['keyretailername'];
        $keyretailermobile= $this->request->post['keyretailermobile'];
        $keyretailerlocation= $this->request->post['keyretailerlocation'];
        $fmsidofdealer= $this->request->post['fmsidofdealer'];
        $farmerfirstname= $this->request->post['farmerfirstname'];
        $farmermiddlename= $this->request->post['farmermiddlename'];
        $farmerlastname= $this->request->post['farmerlastname'];
        $farmervillage= $this->request->post['farmervillage'];
        $farmertaluka= $this->request->post['farmertaluka'];
        $farmermobile= $this->request->post['farmermobile'];
        $email= $this->request->post['email'];
        $isprogressivefarmer= $this->request->post['isprogressivefarmer'];
        $majorcrop1= $this->request->post['majorcrop1'];
        $acreage1= $this->request->post['acreage1'];
        $majorcrop2= $this->request->post['majorcrop2'];
        $acreage2= $this->request->post['acreage2'];
        $majorcrop3= $this->request->post['majorcrop3'];
        $acreage3= $this->request->post['acreage3'];
        $irrigatedacreage= $this->request->post['irrigatedacreage'];
        $dripirrigatedacreage= $this->request->post['dripirrigatedacreage'];
        $rainfedacreage= $this->request->post['rainfedacreage'];
        $issoiltestdone= $this->request->post['issoiltestdone'];
        $yearofsoiltest= $this->request->post['yearofsoiltest'];
        $remarks= $this->request->post['remarks']; $remarks=str_replace("'", "", $remarks);
        */
        $SaveData= $this->model_farmer_register->SaveFormData($this->request->post);
        if($SaveData==0){
            echo 0;
        }
        else if($SaveData==1){
            echo 1;
        }
        else if($SaveData==2){
            echo 2;
        }
        else{
            $CaseMail= $this->model_farmer_register->CaseMailDtls($SaveData);
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
                echo 1;
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
                echo 1;
            }
            else{
                echo 0;
            }
        }
        
    }
    
    public function farmerprofile(){
        $this->load->model('farmer/register');
        $a = $this->request->post['mob'];
        $log=new Log("ConFarmerProfile.log");
    /////////////////////////////////////////////////////////////////////////////////////////////////////
        //****************************************************************//
        //Function Get Farmer Data
        function getFarmerData($data_string){
        $url="http://staging.jksangam.com/API/WebService/FarmerService.asmx/GetCustomerDetails";
        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json',
        'Authorization: 26be082e3d034ef098fff491c9151e739b645c97316df08f2b071b221032766e'));
        $result = curl_exec($ch);
        $out=  json_decode($result);
        return $getdata=$out->d->DataObject;
        }
        //****************************************************************//
       // $a=8275257764;
        $data_string="{MobileNumber:".$a."}";  
        $rawdata = getFarmerData($data_string); // CALLING FARMER API
        
        
        if($rawdata){
        $log->write('Farmer details for '.$a.'Are:'.$rawdata);
        $FarmerCode = $rawdata->FarmerCode;
        $FarmerLive = 1;
        $FarmerType = $rawdata->FarmerType;
        $FirstName = $rawdata->FirstName;
        $MiddleName = $rawdata->MiddleName;
        $LastName = $rawdata->LastName;
        
        
        $ZONE_NAME = $rawdata->ZONE_NAME;
        if(empty($ZONE_NAME)){$Zone_NAME_Local='Select Zone';}
        $ZONE_ID = $rawdata->ZONE_ID;
        if(empty($ZONE_ID)){
            $Zone_ID_Local='';
        }
        else{
            //DISPLAY ZONE From ZUARI DB
            $ZS=$this->model_farmer_register->LocalGEO($ZONE_ID);
            $Zone_ID_Local=$ZS['GEO_ID'];
            $Zone_NAME_Local=$ZS['NAME'];
        }
        
        
        $REGION_NAME = $rawdata->REGION_NAME;
        if(empty($REGION_NAME)){$Region_NAME_Local='Select Region';}
        $REGION_ID = $rawdata->REGION_ID;
        if(empty($REGION_ID)){
            $Region_ID_Local='';
        }
        else{
            //DISPLAY REGION From ZUARI DB
            $ZS=$this->model_farmer_register->LocalGEO($REGION_ID);
            $Region_ID_Local=$ZS['GEO_ID'];
            $Region_NAME_Local=$ZS['NAME'];
        }
        
        $StateName = $rawdata->StateName;
        if(empty($StateName)){$State_NAME_Local='Select State';}
        $State_ID = $rawdata->State_ID;
        if(empty($State_ID)){
            $State_ID_Local='';
        }
        else{
            //DISPLAY STATE From ZUARI DB
            $ZS=$this->model_farmer_register->LocalGEO($State_ID);
            $State_ID_Local=$ZS['GEO_ID'];
            $State_NAME_Local=$ZS['NAME'];
        }
        
         $DistrictName = $rawdata->DistrictName;
        if(empty($DistrictName)){$District_NAME_Local='Select District';}
        $District_ID = $rawdata->District_ID;
        if(empty($District_ID)){
            $District_ID_Local='';
        }
        else {
            //DISPLAY DISTRICT From ZUARI DB
            $ZS=$this->model_farmer_register->LocalGEO($District_ID);
            $District_ID_Local=$ZS['GEO_ID'];
            $District_NAME_Local=$ZS['NAME'];
        }
        
        
       
        $Taluka = $rawdata->Taluka;
        $Village = $rawdata->Village;
        $LanguageName = $rawdata->LanguageName;
        $MobileNumber = $rawdata->MobileNumber;
        if(empty($MobileNumber)){$MobileNumber=$a;}
        $EmailAddress = $rawdata->EmailAddress;
        
        
        $Crop1 = $rawdata->Crop1;
        if(empty($Crop1)){$Crop1='Select Crop1';}
        $Crop1Data = $rawdata->Crop1_ID;
        if(empty($Crop1Data)){$Crop1Data='';}
        
        $Crop2 = $rawdata->Crop2;
        if(empty($Crop2)){$Crop2='Select Crop1';}
        $Crop2Data = $rawdata->Crop2_ID;
        if(empty($Crop2Data)){$Crop2Data='';}
        
        $Crop3 = $rawdata->Crop3;
        if(empty($Crop3)){$Crop3='Select Crop3';}
        $Crop3Data = $rawdata->Crop3_ID;
        if(empty($Crop3Data)){$Crop3Data='';}
        
        $LandOwned = $rawdata->LandOwned;
        $IrrigatedLand = $rawdata->IrrigatedLand;
        $DripIrrigatedLand = $rawdata->DripIrrigatedLand;
        $RainfedLand = $rawdata->RainfedLand;
        $MOOfficeName = $rawdata->MOOfficeName;
        if(empty($MOOfficeName)){$MOOfficeName='Select MO Office';}
        $MO_HQ_ID = $rawdata->MO_HQ_ID;
        if(empty($MO_HQ_ID)){$MO_HQ_ID='';}
        $YearOfSoilTest = $rawdata->YearOfSoilTest;
        $Acreage1 = $rawdata->Acreage1;
        $Acreage2 = $rawdata->Acreage2;
        $Acreage3 = $rawdata->Acreage3;
        $DealerAdventzCode = $rawdata->DealerAdventzCode;
        $DealerName = $rawdata->DealerName;
        $DealerLocation = $rawdata->DealerLocation;
        $DealerMobile = $rawdata->DealerMobile;
        $RetailerName = $rawdata->RetailerName;
        $RetailerMobile = $rawdata->RetailerMobile;
        $IsProgressiveFarmer = $rawdata->IsProgressiveFarmer;
        if(empty($IsProgressiveFarmer)){$IsProgressiveData='';$IsProgressiveFarmer='Is Progressive Farmer';}else{$IsProgressiveData=1;}
        $SoilTestDone = $rawdata->SoilTestDone;
        if(empty($SoilTestDone)){$SoilTestDoneData='';$SoilTestDone='Is Soil Test Done';}else{$SoilTestDoneData=1;}
        $FarmerType = $rawdata->FarmerType;
        }
        else{
            $log->write('No Farmer details for: '.$a);
            $FarmerCode = 'NA';
            $FarmerLive = 0;
            $FarmerType = 'NA';
            $MobileNumber=$a;
            $Usrst= $this->model_farmer_register->UserState($MobileNumber);
            if($Usrst){$State_NAME_Local=$Usrst['STATE_NAME'];$State_ID_Local=$Usrst['STATE_ID'];}else{$State_NAME_Local='Select State';$State_ID_Local='';}
            $District_NAME_Local='Select District';
            $District_ID_Local='';
            $Zone_NAME_Local='Select Zone';
            $Zone_ID_Local='';
            $Region_NAME_Local='Select Region';
            $Region_ID_Local='';
            $IsProgressiveFarmer='Is Progressive Farmer';
            $IsProgressiveData='';
            $MOOfficeName='Select MO Office';
            $MO_HQ_ID='';
            $SoilTestDone='Is Soil Test Done';
            $SoilTestDoneData='';
            $Crop1='Select Crop1';
            $Crop1Data='';
            $Crop2='Select Crop2';
            $Crop2Data='';
            $Crop3='Select Crop3';
            $Crop3Data='';
        }
    ////////////////////////////////////////////////////////////////////////////////////////////////////   
        // Initiate Raw data
        
        $UserGeo= $this->model_farmer_register->UserGeo($State_ID_Local);
        if($UserGeo){
            $Zone_NAME_Local=$UserGeo['ZONE_NAME'];
            $Zone_ID_Local=$UserGeo['ZONE_ID'];
            $Region_NAME_Local=$UserGeo['REGION_NAME'];
            $Region_ID_Local=$UserGeo['REGION_ID'];
            
        }
        $StateData= $this->model_farmer_register->StateData();
        $DistData= $this->model_farmer_register->DistData($State_ID_Local);
     //$MoData= $this->model_farmer_register->MoData();
        $CropData=$this->model_farmer_register->CropData();
        $ZoneData=$this->model_farmer_register->ZoneData();
     //$RegionData=$this->model_farmer_register->RegionData();
        
                $raw='';
       		$raw.='<div class="form-group">';
                $raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<div id="zone-data">';
                $raw.='<select name="zone" id="zone" class="form-control" onchange="showregion(this.value);">';
                    $raw.='<option value="'.$Zone_ID_Local.'">'.$Zone_NAME_Local.'</option>';
                    foreach($ZoneData as $zone){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $raw.='<option value="'.$zone['GEO_ID'].'"'.$sel.'>'.$zone['NAME'].'</option>';
                    }
                $raw.='</select>';
              	$raw.='</div>';
                $raw.='</div>';
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<div id="regi-data">';
                $raw.='<select name="region" id="region" class="form-control" onchange="showstate(this.value);">';
                    $raw.='<option value="'.$Region_ID_Local.'">'.$Region_NAME_Local.'</option>';
                    foreach($RegionData as $region){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $raw.='<option value="'.$region['GEO_ID'].'"'.$sel.'>'.$region['NAME'].'</option>';
                    }
                $raw.='</select>';
                $raw.='</div>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<div id="stat-data">';
               	$raw.='<select name="state" id="state" class="form-control" onchange="showdist(this.value);">';
                    $raw.='<option value="'.$State_ID_Local.'">'.$State_NAME_Local.'</option>';
                    foreach($StateData as $state){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $raw.='<option value="'.$state['GEO_ID'].'"'.$sel.'>'.$state['NAME'].'</option>';
                    }
                $raw.='</select>';
                $raw.='</div>';
              	$raw.='</div>';

            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
                $raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<div id="dist-data">';
                $raw.='<select name="district" id="district" class="form-control select2" onchange="showmo(this.value);">';
                    $raw.='<option value="'.$District_ID_Local.'">'.$District_NAME_Local.'</option>';
                    foreach($DistData as $dist){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $raw.='<option value="'.$dist['GEO_ID'].'"'.$sel.'>'.$dist['NAME'].'</option>';
                    }
                $raw.='</select>';
                $raw.='</div>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<div id="mo-data">';
              	$raw.='<select name="mooffice" id="mooffice" class="form-control select2">';
                    $raw.='<option value="'.$MO_HQ_ID.'">'.$MOOfficeName.'</option>';
                    foreach($MoData as $mo){ 
                       /* if($FeedFarData['STATE_ID']==$state['GEO_ID'])
                        {
                            $sel="selected='selected'";
                        }
                        else {
                            $sel="";
                        }*/
                        $sel="";
                        $raw.='<option value="'.$mo['GEO_ID'].'"'.$sel.'>'.$mo['NAME'].'</option>';
                    }
                $raw.='</select>';
               	$raw.='</div>';
                $raw.='</div>';
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$DealerAdventzCode.'" id="keydealeradventcode" name="keydealeradventcode" class="form-control" placeholder="Key Dealer Advent Code "/>';
                $raw.='</div>';
            	
		$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
             	$raw.='<input type="text" value="'.$DealerName.'" id="keydealername" name="keydealername" class="form-control" placeholder="Key Dealer Name "/>';
		$raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$DealerLocation.'" id="keydealerlocation" name="keydealerlocation" class="form-control" placeholder="Key Dealer Location"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$DealerMobile.'" maxlength="10" id="keydealermobile" name="keydealermobile" class="form-control" placeholder="Key Dealer Mobile " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$RetailerName.'" id="keyretailername" name="keyretailername" class="form-control" placeholder="Key Retailer Name "/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$RetailerMobile.'" id="keyretailermobile" maxlength="10" name="keyretailermobile" class="form-control" placeholder="Key Retailer Mobile" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" id="keyretailerlocation" name="keyretailerlocation" class="form-control" placeholder="Key Retailer Location"/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" id="fmsidofdealer" name="fmsidofdealer" class="form-control" placeholder="FM Sid Of Dealer/Retailer "/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$FirstName.'" id="farmerfirstname"  name="farmerfirstname" class="form-control" placeholder="Farmer First Name"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$MiddleName.'" id="farmermiddlename" name="farmermiddlename" class="form-control" placeholder="Farmer Middle Name "/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$LastName.'" id="farmerlastname" name="farmerlastname" class="form-control" placeholder="Farmer Last Name "/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$Village.'" id="farmervillage" name="farmervillage" class="form-control" placeholder="Key Farmer Village"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$Taluka.'" id="farmertaluka" name="farmertaluka" class="form-control" placeholder="Key Farmer Taluka "/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$MobileNumber.'" id="farmermobile" maxlength="10" name="farmermobile" class="form-control" placeholder="Mobile Number " readonly/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$EmailAddress.'" id="email" name="email" class="form-control" placeholder="Email Address "/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<select id="isprogressivefarmer" name="isprogressivefarmer" class="form-control">';
                $raw.='<option value="'.$IsProgressiveData.'">'.$IsProgressiveFarmer.'</option>';
                $raw.='<option value="1">Yes</option>';
                $raw.='<option value="0">No</option>';
                $raw.='</select>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<select id="majorcrop1" name="majorcrop1" class="form-control select2">';
                $raw.='<option value="'.$Crop1Data.'">'.$Crop1.'</option>';
                foreach($CropData as $crop){
                    /* if($FeedFarData['RABI_CROP']==$crop['CROP_ID'])
                    {
                        $sel="selected='selected'";
                    }
                    else {
                        $sel="";
                    }*/
                    $raw.='<option value="'.$crop['CROP_ID'].'"'.$sel.'>'.$crop['CROP_DESC'].'</option>';
                }
                $raw.='</select>';
                $raw.='</div>';
                $raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<input type="text" value="'.$Acreage1.'" id="acreage1" name="acreage1" class="form-control" placeholder="Acreage 1" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                
                $raw.='<select id="majorcrop2" name="majorcrop2" class="form-control select2">';
                $raw.='<option value="'.$Crop2Data.'">'.$Crop2.'</option>';
                foreach($CropData as $crop){
                    /* if($FeedFarData['RABI_CROP']==$crop['CROP_ID'])
                    {
                        $sel="selected='selected'";
                    }
                    else {
                        $sel="";
                    }*/
                    $raw.='<option value="'.$crop['CROP_ID'].'"'.$sel.'>'.$crop['CROP_DESC'].'</option>';
                }
                $raw.='</select>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                
                $raw.='<input type="text" value="'.$Acreage2.'" id="acreage2" name="acreage2" class="form-control" placeholder="Acreage 2" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                
                $raw.='<select id="majorcrop3" name="majorcrop3" class="form-control select2">';
                $raw.='<option value="'.$Crop3Data.'">'.$Crop3.'</option>';
                foreach($CropData as $crop){
                    /* if($FeedFarData['RABI_CROP']==$crop['CROP_ID'])
                    {
                        $sel="selected='selected'";
                    }
                    else {
                        $sel="";
                    }*/
                    $raw.='<option value="'.$crop['CROP_ID'].'"'.$sel.'>'.$crop['CROP_DESC'].'</option>';
                }
                $raw.='</select>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                
                $raw.='<input type="text" value="'.$Acreage3.'" id="acreage3" name="acreage3" class="form-control" placeholder="Acreage 3 " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            	
                $raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$IrrigatedLand.'" id="irrigatedacreage" name="irrigatedacreage" class="form-control" placeholder="Irrigated Acreage " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$DripIrrigatedLand.'" id="dripirrigatedacreage" name="dripirrigatedacreage" class="form-control" placeholder="Drip Irrigated Acreage " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$RainfedLand.'" id="rainfedacreage" name="rainfedacreage" class="form-control" placeholder="Racnifed Acreage " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                $raw.='<div class="form-group">';
                
		$raw.='<div class="col-md-4">';
                $raw.='<select id="issoiltestdone" name="issoiltestdone" class="form-control">';
                $raw.='<option value="'.$SoilTestDoneData.'">'.$SoilTestDone.'</option>';
                $raw.='<option value="1">Yes</option>';
                $raw.='<option value="0">No</option>';
                $raw.='</select>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="text" value="'.$YearOfSoilTest.'" maxlength="4" id="yearofsoiltest" name="yearofsoiltest" class="form-control" placeholder="Year Of Soil Test Done " onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<div class="abc">*</div>';
                $raw.='<textarea class="form-control" id="remarks" name="remarks"  placeholder="Remarks..."></textarea>';
                $raw.='</div>';
                
            	$raw.='</div>';
                //////////////////////////////////////////////////////
                $raw.='<div class="col-md-4">';
                $raw.='<input type="hidden" value="'.$FarmerCode.'" maxlength="4" id="ApiFarmerCode" name="ApiFarmerCode" class="form-control"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="hidden" value="'.$FarmerLive.'" maxlength="4" id="ApiFarmerLive" name="ApiFarmerLive" class="form-control"/>';
                $raw.='</div>';
            
		$raw.='<div class="col-md-4">';
                $raw.='<input type="hidden" value="'.$FarmerType.'" maxlength="4" id="ApiFarmerType" name="ApiFarmerType" class="form-control"/>';
                $raw.='</div>';
                
            	$raw.='</div>';
                
                
                
                
                
        echo $raw;//Show Form Details
        
        
        
    }
    
    
    


}
