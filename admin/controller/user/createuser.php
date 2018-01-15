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
class Controllerusercreateuser extends Controller {
    public function  index(){
        
        $this->load->language('user/createuser');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('user/createuser');
      
          
        
           //drop down
            $data['user_group_id']="-1";
            $data['dpgroup']= $this->model_user_createuser->getGroup();
            
        //end drop down
                     
                
       $data['heading_title'] = $this->language->get('heading_title');
       $data['tab_nation']=$this->language->get('text_nation');
            $data['tab_state']=$this->language->get('text_state');
                $data['tab_district']=$this->language->get('text_district');
                
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
                
                $data['createuser'] = $this->url->link('user/createuser', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/createuser', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('user/createuser.tpl', $data));
    }
   public function  addUser(){
          $this->load->language('user/createuser');
          $json = array();
          $this->load->model('user/createuser');
          
                        if (isset($this->request->post['name']) && isset($this->request->post['lastname'])&& isset($this->request->post['email'])&& isset($this->request->post['password'])&& isset($this->request->post['status'])&& isset($this->request->post['group'])) {
                         $this->model_user_createuser->addUser($this->request->post); 
                         
                         
                         $this->session->data['success'] = $this->language->get('text_success');
                         $json['redirectf'] = str_replace('&amp;', '&', $this->url->link('user/createuser', 'token=' . $this->session->data['token'], 'SSL'));                             
                        }else{
                        $json['error']['warning'] ="Error";
                            
                        }
                         
                        $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
                          
      }  
    
     
      
      
    
}
