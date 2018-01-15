<?php
class ControllerDashboardTotalproduct extends Controller {
	public function index() {
		$this->load->language('dashboard/product');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		// Total Orders
		$this->load->model('dashboard/totalproduct');
		
		
		$data['percentage'] = 0;
		$product_total = $this->model_dashboard_totalproduct->getTotalProduct();
		
		if ($product_total > 1000000000000) {
			$data['total'] = round($product_total / 1000000000000, 1) . 'T';
		} elseif ($product_total > 1000000000) {
			$data['total'] = round($product_total / 1000000000, 1) . 'B';
		} elseif ($product_total > 1000000) {
			$data['total'] = round($product_total / 1000000, 1) . 'M';
		} elseif ($product_total > 1000) {
			$data['total'] = round($product_total / 1000, 1) . 'K';						
		} else {
			$data['total'] = $product_total;
		}
				
		$data['product'] = $this->url->link('dashboard/totalproduct', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/product.tpl', $data);
	}
}
