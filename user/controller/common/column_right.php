<?php
class ControllerCommonColumnRight extends Controller {
	public function index() {
		
			
		$data['username']='';

			return $this->load->view('default/template/common/column_right.tpl', $data);
		
	}
}