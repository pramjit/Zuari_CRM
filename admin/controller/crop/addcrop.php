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
class Controllercropaddcrop extends Controller {
    public function  index(){
        
        $this->load->language('crop/addcrop');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('crop/addcrop');
        
        /*if (($this->request->server['REQUEST_METHOD'] == 'POST') )
            {
			
			//CALL MODEL FUNCTION TO SAVE DATA
                    $this->model_crop_addcrop->addcrop($this->request->post);
                    $this->session->data['success'] = $this->language->get('text_success');

	            $this->response->redirect($this->url->link('crop/addcrop', 'token=' . $this->session->data['token'], 'SSL'));
			 
	    }*/
        
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
                
                $data['addcrop'] = $this->url->link('crop/addcrop', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('crop/addcrop', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('crop/addcrop.tpl', $data));
                            
    }
    
        public function  addCrop()
                {
            $this->load->language('crop/addcrop');
                         $json = array();
                         $this->load->model('crop/addcrop');
          
                        if (isset($this->request->post['name'])&& isset($this->request->post['crop'])) {
                         $this->model_crop_addcrop->addCrop($this->request->post); 
                         
                         $this->session->data['success'] = $this->language->get('text_success');
                         $json['redirectf'] = str_replace('&amp;', '&', $this->url->link('crop/addcrop', 'token=' . $this->session->data['token'], 'SSL'));                             
                        }else{
                        $json['error']['warning'] ="Error";
                            
                        }
                        $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
                          //$json['redirect'] = $this->url->link('geo/addgeo', '', 'SSL');
                }
}
