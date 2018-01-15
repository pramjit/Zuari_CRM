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
class Controlleruseraddgroup extends Controller {
    public function  index(){
        
        $this->load->language('user/addgroup');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('user/addgroup');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST')
                                {
			
			//CALL MODEL FUNCTION TO SAVE DATA
                    $this->model_user_addgroup->addGroup($this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');

		    $this->response->redirect($this->url->link('user/addgroup', 'token=' . $this->session->data['token'], 'SSL'));
			 
		}
        
          
        //fatch Data
            $data['groupnameshow']= $this->model_user_addgroup->getGroupNameShow();
            //$data['dp_district_state']= $this->model_geo_addgeo->get_District_State();
        //end fatch Data
                
                
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
                
                $data['addgroup'] = $this->url->link('user/addgroup', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/addgroup', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('user/addgroup.tpl', $data));
    }
    
    
   
      
      
    
}
