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
		
                $this->load->model('dashboard/alldatadashboard');
                $data['Allmissedcall']= $this->model_dashboard_alldatadashboard->getMissedCall($this->request->get);
                $data['ReceivedCall']= $this->model_dashboard_alldatadashboard->getReceivedCall($this->request->get);
                $data['AdvisoryCall']= $this->model_dashboard_alldatadashboard->getAdvisoryCall($this->request->get);
                $data['ComplainCall']= $this->model_dashboard_alldatadashboard->getComplainCall($this->request->get);
                $data['missedmonth']= $this->model_dashboard_alldatadashboard->getMissedCallMonthWise($this->request->get);
                $data['receivedmonth']= $this->model_dashboard_alldatadashboard->getAnsweredCallMonthWise($this->request->get);
		$roleid = $this->customer->getGroupId();
		//forwarding load dashboard according role 
		if($roleid==6){
			header("location:?route=advisory/dashboard");
		}
                $this->session->data["title"]=$this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
               // $data['column_right'] = $this->load->controller('common/column_right');		
		$data['footer'] = $this->load->controller('common/footer');
                if($roleid=='71') 
                {
		$this->response->setOutput($this->load->view('default/template/common/dfcdashboard.tpl', $data));	
                } else if($roleid==1)
                 {
                   
                   
		     $this->response->setOutput($this->load->view('default/template/common/admindashboard.tpl', $data));
               
                }
                else 
                 {
		$this->response->setOutput($this->load->view('default/template/common/dashboard.tpl', $data));
                }
	}
}
