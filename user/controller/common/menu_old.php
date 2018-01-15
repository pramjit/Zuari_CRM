<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$data['roleid'] = $this->customer->getGroupId();
		$data['text_dealer'] = $this->language->get('text_dealer');
                $data['text_dashboard'] = $this->language->get('text_dashboard');
                $data['text_report'] = $this->language->get('text_report');
                $data['text_missed_call'] = $this->language->get('text_missed_call');
                
		$data['home'] = $this->url->link('common/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['missedcall'] = $this->url->link('report/missedcall', 'token='.$this->session->data['token'], 'SSL');
                
                $data['missedcalldata'] = $this->url->link('call/missedcall', 'token='.$this->session->data['token'], 'SSL');
                $data['feedbackdata'] = $this->url->link('call/feedback', 'token='.$this->session->data['token'], 'SSL');
                $data['reviewdata'] = $this->url->link('call/review', 'token='.$this->session->data['token'], 'SSL');
                /*
                $data['COM_DASHBOARD'] = $this->url->link('complaint/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_MY_CASES'] = $this->url->link('complaint/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_ALL_CASES'] = $this->url->link('complaint/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_REPORT'] = $this->url->link('complaint/report', 'token='.$this->session->data['token'], 'SSL');
                
                */
                
                $data['RA_DASHBOARD'] = $this->url->link('resolution/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_MY_CASES'] = $this->url->link('resolution/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_ALL_CASES'] = $this->url->link('resolution/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_REPORT'] = $this->url->link('resolution/report', 'token='.$this->session->data['token'], 'SSL');
                
                
                $data['AA_DASHBOARD'] = $this->url->link('approval/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_MY_CASES'] = $this->url->link('approval/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_ALL_CASES'] = $this->url->link('approval/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_REPORT'] = $this->url->link('approval/report', 'token='.$this->session->data['token'], 'SSL');
                
                
                $data['AD_DASHBOARD'] = $this->url->link('advisory/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_MY_CASES'] = $this->url->link('advisory/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_ALL_CASES'] = $this->url->link('advisory/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_REPORT'] = $this->url->link('advisory/report', 'token='.$this->session->data['token'], 'SSL');
                
	           
            return $this->load->view('default/template/common/menu.tpl', $data);
	}
}