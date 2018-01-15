<?php


class Controllercommonhome  extends Controller{
    
    public function  index(){
        $this->load->language('common/login');
		
		$this->document->setTitle($this->language->get('heading_title'));
$data['title']=$this->language->get('heading_title');
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_login'] = $this->language->get('text_login');
        $data['text_forgotten'] = $this->language->get('text_forgotten');
        $data['action'] = $this->url->link('common/login', '', 'SSL');
        
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
        if ($this->config->get('config_password')) {
			$data['forgotten'] = $this->url->link('common/forgotten', '', 'SSL');
		} else {
			$data['forgotten'] = '';
		}

		$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
    }
}
