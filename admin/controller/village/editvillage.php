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
class Controllervillageeditvillage extends Controller {
    public function  index(){
        
        $this->load->language('village/editvillage');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('village/editvillage');
      
        
         //drop down
             $data['user_group_id']="-1";
             $data['dp_village_state']= $this->model_village_editvillage->get_Village_State();
             $data['dp_select_dealer']=$this->model_village_editvillage->get_Select_Dealer();
             $data['get_form_data']=$this->model_village_editvillage->get_Form_Data();
          //print_r ($data['get_form_data']);
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
                
                $data['editvillage'] = $this->url->link('village/editvillage', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('village/editvillage', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('village/editvillage.tpl', $data));
    }
    
    public function  updateVillage(){
      $this->load->language('village/editvillage');
          $json = array();
          $this->load->model('village/editvillage');
          
                        if (isset($this->request->post['name'])&& isset($this->request->post['sid']) && isset($this->request->post['pincode']) 
                                && isset($this->request->post['state']) && isset($this->request->post['district'])
                                && isset($this->request->post['dealer'])) {
                         $this->model_village_editvillage->updateVillage($this->request->post); 
                         $this->session->data['success'] = $this->language->get('text_success');
                         $json['redirectf'] = str_replace('&amp;', '&', $this->url->link('village/editvillage', 'token=' . $this->session->data['token'],'SSL'));                             
                        }else{
                        $json['error']['warning'] ="Error";
                            
                        }
                        $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
                          //$json['redirect'] = $this->url->link('geo/addgeo', '', 'SSL');
      }
      
      public function DropDownState(){
          
        
          $this->load->model('village/editvillage');
          
         
          
                        if (isset($this->request->post['state'])) {
                            
                        $data['dp_village_state']=  $this->model_village_editvillage->DropDownState($this->request->post); 
                           
                     $dpstate=   count($data['dp_village_state']);
                     echo ' <option  value=""> Select District Name</option> ';
                         for($n=0;$n<$dpstate;$n++)
                         {
                             echo '<option value="'.$data['dp_village_state'][$n]['SID'].'">'.$data['dp_village_state'][$n]['GEO_NAME'].'</option>';
                         }
                            
                     
               
                        }
                        
                    
      }
}
