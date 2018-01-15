<?php
class Controllerdealerbulkupload extends Controller  {
    public function index() {
		$this->load->language('dealer/bulkupload');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('dealer/bulkupload');
                $this->load->library('PHPReadExcel');                
                
                if (($this->request->server['REQUEST_METHOD'] == 'POST') )
                                {
			if (is_uploaded_file($this->request->files['import']['tmp_name'])) 
                            {
                            
				$content = file_get_contents($this->request->files['import']['tmp_name']);
                                //print_r($content);
			} else {
				$content = false;
			}

			if ($content) 
                            {
                            $data['exceldisplay'] = array();
                            //print_r($data['exceldisplay']);
                            unset($this->session->data['exceldata']);
                            $data['exceldisplay'] = $this->model_dealer_bulkupload->readExcel($this->request->files['import']['tmp_name'],$this->request->files['import']['name']);
                            $this->session->data['exceldata']=$data['exceldisplay'];
                 		
                 
                
			    $this->session->data['success'] = $this->language->get('text_success');

				//$this->response->redirect($this->url->link('dealer/bulkupload', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->error['warning'] = $this->language->get('error_empty');
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');

		

		$data['file_restore'] = $this->language->get('file_restore');
		

		$data['button_download'] = $this->language->get('button_download');
		$data['button_upload'] = $this->language->get('button_upload');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('dealer/bulkupload', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['excelupload'] = $this->url->link('dealer/bulkupload', 'token=' . $this->session->data['token'], 'SSL');

		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
               
               
		$this->response->setOutput($this->load->view('dealer/bulkupload.tpl', $data));
    }
    public function confirm() {
        $this->load->language('dealer/bulkupload');
        $json = array();
		if (isset($this->session->data['exceldata'])) {
			$this->load->model('dealer/bulkupload');
			$retValue=$this->model_dealer_bulkupload->addDealer($this->session->data['exceldata']);
                        if($retValue < 1){
                        $json['error']['warning'] ="Error";
                        }
                        unset($this->session->data['exceldata']);
                       $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
		}
                else{
                    $json['redirect'] = $this->url->link('dealer/bulkupload', '', 'SSL');
                }
	}
    
    
}
