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
                
                $data['Allmissedcall']= $this->model_dashboard_alldatadashboard->getMissedCall();
                $data['AdvisoryCall']= $this->model_dashboard_alldatadashboard->getAdvisoryCall();
                $data['ComplainCall']= $this->model_dashboard_alldatadashboard->getComplainCall();
                $data['AnsweredCall']= $this->model_dashboard_alldatadashboard->getReceivedCall();
                
                $data['AltAdvisoryCall']= $this->model_dashboard_alldatadashboard->AltAdvisoryCall();
                $data['DunningCall']= $this->model_dashboard_alldatadashboard->DunningCall();
                $data['AppCall']= $this->model_dashboard_alldatadashboard->AppCall();
                $data['RetCall']= $this->model_dashboard_alldatadashboard->RetCall();
                
                $data['AltAdvisoryCallAns']= $this->model_dashboard_alldatadashboard->AltAdvisoryCallAns();
                $data['DunningCallAns']= $this->model_dashboard_alldatadashboard->DunningCallAns();
                $data['AppCallAns']= $this->model_dashboard_alldatadashboard->AppCallAns();
                $data['RetCallAns']= $this->model_dashboard_alldatadashboard->RetCallAns();
                
                $data['CurMissed']= $this->model_dashboard_alldatadashboard->CurMissed();
                $data['CurAnswered']= $this->model_dashboard_alldatadashboard->CurAnswered();
                
                
                
                $data['missedmonth']= $this->model_dashboard_alldatadashboard->getMissedCallMonthWise($this->request->get);
                $data['receivedmonth']= $this->model_dashboard_alldatadashboard->getAnsweredCallMonthWise($this->request->get);
		$roleid = $this->customer->getGroupId();
		
                $this->session->data["title"]=$this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
               // $data['column_right'] = $this->load->controller('common/column_right');		
		$data['footer'] = $this->load->controller('common/footer');
                //forwarding load dashboard according role 
		if($roleid==6){
			header("location:?route=advisory/dashboard");
		}
                if($roleid==7 || $roleid==1){
                    $this->response->setOutput($this->load->view('default/template/common/admindashboard.tpl', $data));
                }else{
                    
                    $this->response->setOutput($this->load->view('default/template/common/dashboard.tpl', $data));
                }
	}
}
