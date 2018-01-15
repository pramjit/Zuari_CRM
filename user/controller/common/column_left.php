<?php
class ControllerCommonColumnLeft extends Controller {
	public function index() {
		
			$data['profile'] = $this->load->controller('common/profile');
			$data['menu'] = $this->load->controller('common/menu');		
			return $this->load->view('default/template/common/column_left.tpl', $data);
		
	}
}