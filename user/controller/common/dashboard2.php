<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
            
            
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		
	if (!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('common/login', '', 'SSL'));
		}
		
		// Check install directory exists
		
			$data['error_install'] = '';
		

		$roleid = $this->customer->getGroupId();
		if($roleid==6)
		{
			header('location:http://zuari.akshapp.com/index.php?route=advisory/dashboard');
		}
                $this->session->data["title"]=$this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
               // $data['column_right'] = $this->load->controller('common/column_right');		
		$data['footer'] = $this->load->controller('common/footer');
                if($roleid=='71') {
		$this->response->setOutput($this->load->view('default/template/common/dfcdashboard.tpl', $data));	
                } else {
		$this->response->setOutput($this->load->view('default/template/common/dashboard.tpl', $data));
                }
	}
}
