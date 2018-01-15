<?php
class ControllerCommonForgotten extends Controller {
	private $error = array();

	public function index() {
		if ($this->customer->isLogged()) {
			$this->response->redirect($this->url->link('common/dashboard', '', 'SSL'));
		}

		$this->load->language('common/forgotten');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('account/customer');
                //*****************************MAIL FUNCTION START****************************//
                $this->load->library('PHPMailer/PHPMailerAutoload');
		function MsgToMail($to,$cc,$sub,$msg){
			$log=new Log("ResetPassword.log");
			$log->write($to.'/'.$cc.'/'.$sub.'/'.$msg);
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               		
			$mail->isSMTP();                                      		
			$mail->Host = 'mail.akshamaala.in';                   		
			$mail->SMTPAuth = false;                          
			$mail->Username = 'mis@akshamaala.in';                		
			$mail->Password = 'mismis';                           		
			$mail->Port = 25;                                     		
			$mail->setFrom('mis@akshamaala.in', 'Agri CRM Adventz');   
			$mail->addAddress($to);   
			$mail->isHTML(true);                                    	
			$mail->Subject = $sub;		
			$mail->Body    = $msg;									
			$mail->AltBody = 'Mail from Agri CRM Adventz';
			//$mail->AddAttachment($attach);
			//$mail->AddCC($cc);
			//$mail->AddBCC('aasit.kumar@aspltech.com','Aasit');
			$mail->AddBCC('anamika.arora@aspltech.com','Anamika');
			$mail->send();
			/*if(!$mail->send())	{
    								echo 'Message could not be sent.';
    								echo 'Mailer Error: ' . $mail->ErrorInfo;
								}
								else
								{
    								echo 'Message has been sent';
								}
			*/
		}
	//*****************************MAIL FUNCTION END***********************************************//
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->language('mail/forgotten');

			$password = substr(sha1(uniqid(mt_rand(), true)), 0, 10);

			$this->model_account_customer->editPassword($this->request->post['email'], $password);

			$subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

			$message  = sprintf($this->language->get('text_greeting'), $this->config->get('config_name')) . "\n\n";
			$message .= $this->language->get('text_password') . "\n\n";
			$message .= $password;

			/*$mail = new Mail($this->config->get('config_mail'));
			$mail->setTo($this->request->post['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_name'));
			$mail->setSubject($subject);
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
                        $mail->send();
                         * 
                         */
                        $to=$this->request->post['email'];
                        $msg='Dear '.$to.', <br><br><br>
                        Your Password has been reset, <br><br>
                        Login with your new password: '.$password.'<br><br>
                        Thanks and Regards,<br>
                        Support- Adventz Agri CRM';
                        $cc='aasit.kumar@aspltech.com';
                        $sub='Reset Password-Adventz Agri CRM';
                        MsgToMail($to,$cc,$sub,$msg);

			$this->session->data['success'] = $this->language->get('text_success');

			// Add to activity log
			$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

			if ($customer_info) {
				$this->load->model('account/activity');

				$activity_data = array(
					'customer_id' => $customer_info['customer_id'],
					'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname']
				);

				$this->model_account_activity->addActivity('forgotten', $activity_data);
			}

			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
		}

		
		$data['heading_title'] = $this->language->get('heading_title');
                $data['title'] = $this->language->get('title');
		$data['text_your_email'] = $this->language->get('text_your_email');
		$data['text_email'] = $this->language->get('text_email');

		$data['entry_email'] = $this->language->get('entry_email');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['action'] = $this->url->link('common/forgotten', '', 'SSL');

		$data['back'] = $this->url->link('common/home', '', 'SSL');

		
		$data['footer'] = $this->load->controller('common/footer');
		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/forgotten.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/forgotten.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/forgotten.tpl', $data));
		}
	}

	protected function validate() {
		if (!isset($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_email');
		} elseif (!$this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_email');
		}

		return !$this->error;
	}
}