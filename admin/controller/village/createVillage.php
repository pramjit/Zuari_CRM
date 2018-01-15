<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createVillage
 *
 * @author agent
 */
class ControllervillagecreateVillage extends Controller {
    public function  index(){
        
        $this->load->language('village/createVillage');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('village/createVillage');
       
        
         //drop down
             $data['user_group_id']="-1";
             $data['dp_village_state']= $this->model_village_createVillage->get_Village_State();
             $data['dp_village_Territory']= $this->model_village_createVillage->get_Village_Territory();
             $data['dp_village_district']= $this->model_village_createVillage->get_Village_District();
             //$data['dp_village_district']= $this->model_village_createVillage->get_Village_District();
             $data['dp_select_hq']=$this->model_village_createVillage->get_Select_HQ();
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
                
                $data['createVillage'] = $this->url->link('village/createVillage', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('village/createVillage', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('village/createVillage.tpl', $data));
    }
    
    public function  addVillage(){
       
     $this->load->language('village/createVillage');
          $json = array();
          $this->load->model('village/createVillage');
         // print_r($_POST);die;
         
          
                        if (isset($this->request->post['name']) && isset($this->request->post['pincode']) 
                                && isset($this->request->post['state']) && isset($this->request->post['terr']) && isset($this->request->post['district'])
                                && isset($this->request->post['hq'])) {
                        $chkvillage = $this->model_village_createVillage->chkvillage($this->request->post);    
                        if(empty($chkvillage)) {
                         $this->model_village_createVillage->addVillage($this->request->post); 
                         $this->session->data['success'] = $this->language->get('text_success');
                         $json['redirectf'] = str_replace('&amp;', '&', $this->url->link('village/createVillage', 'token=' . $this->session->data['token'], 'SSL'));                             
                        } else {
                             $json['error']['warning'] ="Village Already Exits!";
                        }
                         }else{
                        $json['error']['warning'] ="Error";
                            
                        }
                        $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
                          //$json['redirect'] = $this->url->link('geo/addgeo', '', 'SSL'); 
      }
      
      public function DropDownState(){
          
        
          $this->load->model('village/createVillage');
          
         
          
                        if (isset($this->request->post['state'])) {
                            
                        $data['dp_village_state']=  $this->model_village_createVillage->DropDownState($this->request->post); 
                           
                     $dpstate=   count($data['dp_village_state']);
                     echo ' <option  value=""> Select Territory</option> ';
                         for($n=0;$n<$dpstate;$n++)
                         {
                             echo '<option value="'.$data['dp_village_state'][$n]['SID'].'">'.$data['dp_village_state'][$n]['GEO_NAME'].'</option>';
                         }
                            
                     
               
                        }              
      }
      
    public function DropDownterritory(){
          
        
          $this->load->model('village/createVillage');
          
          $data['result'] =  $this->model_village_createVillage->DropDownterritory(); 
          //print_r( $data['result']); 
           echo ' <option  value=""> Select District</option> ';
           foreach($data['result'] as $value) {
               
               echo '<option value="'.$value['SID'].'">'.$value['GEO_NAME'].'</option>';
               
           }
                           
           
               
                                  
     }  
      
     
    public function DropDownDistrict(){
          
        
          $this->load->model('village/createVillage');
          
          $data['result'] =  $this->model_village_createVillage->DropDownDistrict(); 
          //print_r( $data['result']); 
           echo ' <option  value=""> Select HQ</option> ';
           foreach($data['result'] as $value) {
               
               echo '<option value="'.$value['SID'].'">'.$value['GEO_NAME'].'</option>';
               
           }
                           
           
               
                                  
     }   
      
      public function autoSearch(){
          
                 $this->load->model('village/createVillage');
                  if (isset($this->request->post['query'])) {
                            
                        $data['auto_search']=  $this->model_village_createVillage->autoSearch($this->request->post); 
                           
                        //print_r($data['auto_search']);
                         
                            $dpstate=   count($data['auto_search']);
                     $output = '<ul style="background-color:#eee;cursor:pointer;list-style:none">';
                     foreach ($data['auto_search'] as $search)
                         {
                             $output .= '<li id="li"style=" padding:2px;">'.$search["VILLAGE_NAME"].'</li>';
                         } 
                     
                     $output .= '</ul>'; 
                      echo $output;  
                        }  

                  }   
}
