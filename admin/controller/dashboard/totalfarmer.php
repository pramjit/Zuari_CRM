<?php
class ControllerDashboardTotalfarmer extends Controller {
	public function index() {
		$this->load->language('dashboard/farmer');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('dashboard/totalfarmer');
		
		
		$data['percentage'] = 0;
		$farmer_total = $this->model_dashboard_totalfarmer->getTotalFarmer();
		
		if ($farmer_total > 1000000000000) {
			$data['total'] = round($farmer_total / 1000000000000, 1) . 'T';
		} elseif ($farmer_total > 1000000000) {
			$data['total'] = round($farmer_total / 1000000000, 1) . 'B';
		} elseif ($farmer_total > 1000000) {
			$data['total'] = round($farmer_total / 1000000, 1) . 'M';
		} elseif ($farmer_total > 1000) {
			$data['total'] = round($farmer_total / 1000, 1) . 'K';						
		} else {
			$data['total'] = $farmer_total;
		}
				
		$data['farmer'] = $this->url->link('dashboard/totalfarmer', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/farmer.tpl', $data);
	}
}
