<?php
class ControllerDashboardSale extends Controller {
	public function index() {
		$this->load->language('dashboard/sale');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_view'] = $this->language->get('text_view');

		$data['token'] = $this->session->data['token'];

		//$this->load->model('report/sale');

		$today = "0";//$this->model_report_sale->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-1 day'))));

		$yesterday = "0";//$this->model_report_sale->getTotalSales(array('filter_date_added' => date('Y-m-d', strtotime('-2 day'))));

		$difference = "0";//$today - $yesterday;

		
			$data['percentage'] = 0;
		

		$sale_total = "0";//$this->model_report_sale->getTotalSales();
                $data['total']="0";
	
		$data['sale'] = "#";//$this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('dashboard/sale.tpl', $data);
	}
}
