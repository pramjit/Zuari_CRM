<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();
               //print_r($this);

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}
                
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
                $data['firstname']= $this->customer->getFirstName();
                $data['lastname']= $this->customer->getLastName();
                $data['logout'] = $this->url->link('common/logout', '' , 'SSL');
				$data['Changepassword']=$this->url->link('common/changepassword','','SSL');
                $data['icon']='';
		$this->load->language('common/header');

		$data['heading_title1'] = $this->session->data["title"];

		
			$data['column_left'] = $this->load->controller('common/column_left');		
		

		return $this->load->view('default/template/common/header.tpl', $data);
	}
}