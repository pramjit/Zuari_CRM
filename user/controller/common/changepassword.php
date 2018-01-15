<?php
class ControllerCommonchangepassword extends Controller {
	public function index() {
            
                $data['user_id']= $this->customer->getId();
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
                $this->session->data["title"]=$this->language->get('heading_title');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
               // $data['column_right'] = $this->load->controller('common/column_right');		
		$data['footer'] = $this->load->controller('common/footer');
               
		$this->response->setOutput($this->load->view('default/template/common/changepassword.tpl', $data));
             
	}
        public function abc()
        {
//            echo 'ss';
//            echo $this->request->post["userid"];
//              echo $this->request->post["new_pass"];
            
           
           $this->load->model('dashboard/changedpassword');
           $data['un'] = $this->model_dashboard_changedpassword->newPassword($this->request->post);
           if($un==0)
           {
            echo "Password Update Successfully Changed";   
           }  else 
               {
               echo "Passowrd Does Not Changed";
               
           }
           
        }
}
