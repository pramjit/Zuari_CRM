<?php
class ControllerDashboardTotaljeepcampaign extends Controller {
	public function index() {
		$this->load->language('dashboard/jeepcount');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('dashboard/totaljeepcampaign');
		
		
		$data['percentage'] = 0;
		$jeepcampaign_total = $this->model_dashboard_totaljeepcampaign->getTotalJeepCampaign();
		
		if ($jeepcampaign_total > 1000000000000) {
			$data['total'] = round($jeepcampaign_total / 1000000000000, 1) . 'T';
		} elseif ($jeepcampaign_total > 1000000000) {
			$data['total'] = round($jeepcampaign_total / 1000000000, 1) . 'B';
		} elseif ($jeepcampaign_total > 1000000) {
			$data['total'] = round($jeepcampaign_total / 1000000, 1) . 'M';
		} elseif ($jeepcampaign_total > 1000) {
			$data['total'] = round($jeepcampaign_total / 1000, 1) . 'K';						
		} else {
			$data['total'] = $jeepcampaign_total;
		}
				
		$data['jeepcampaign'] = $this->url->link('dashboard/totaljeepcampaign', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/jeepcampaign.tpl', $data);
	}
}
