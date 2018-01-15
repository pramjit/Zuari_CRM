<?php
class ControllerDashboardTotaldealer extends Controller {
	public function index() {
		$this->load->language('dashboard/dealer');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('dashboard/totaldealer');
		
		
		$data['percentage'] = 0;
		$dealer_total = $this->model_dashboard_totaldealer->getTotalDealer();
		
		if ($dealer_total > 1000000000000) {
			$data['total'] = round($dealer_total / 1000000000000, 1) . 'T';
		} elseif ($dealer_total > 1000000000) {
			$data['total'] = round($farmer_total / 1000000000, 1) . 'B';
		} elseif ($dealer_total > 1000000) {
			$data['total'] = round($farmer_total / 1000000, 1) . 'M';
		} elseif ($dealer_total > 1000) {
			$data['total'] = round($dealer_total / 1000, 1) . 'K';						
		} else {
			$data['total'] = $dealer_total;
		}
				
		$data['dealer'] = $this->url->link('dashboard/totaldealer', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/dealer.tpl', $data);
	}
}
