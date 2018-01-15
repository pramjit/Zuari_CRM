<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createdealer
 *
 * @author agent
 */
class Controllerretailercreateretailer  extends Controller{
    
       public function index() {
           $this->load->language('dealer/createdealer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('retailer/createretailer');
                
                $this->load->model('customer/createcustomer');
                
               if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.order_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';
                
             $data['user_group_id']="-1";
             
          
            $data['dpdistrict']= $this->model_retailer_createretailer->getDistrict();
            if (isset($this->request->get['SIDUPDATE'])) {
                $data['retailerupdatedata']= $this->model_retailer_createretailer->retailereditdata();
                $disid=$data['retailerupdatedata']["DISTRICT_ID"];
                
                $data['village']=$this->model_retailer_createretailer->getvillage($disid);
                $data['villageid']=$this->model_retailer_createretailer->getvillageid();
            }
            
       
            
           
            
                $data['heading_title'] = $this->language->get('heading_title');
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
                
                $data['createdealer'] = $this->url->link('dealer/createdealer', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('retailer/createretailer', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('retailer/createretailer.tpl', $data));
       }
       
       public function  createretailer(){
          // print_r($_FILES);die;
          $this->load->model('retailer/createretailer');
          $json = array();
          if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

				$filetypes = explode("\n", $extension_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

				$filetypes = explode("\n", $mime_allowed);

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Return any upload error
				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			}
                        if (!$json) {
			$file = $filename;

			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_UPLOAD . $file);

		}
          $data = $this->model_retailer_createretailer->createretailer($this->request->post,$file); 
          if($data){
              return 1;
          } else {
              return 0;
          }
                          
                      
                          
      }
      public function getvillage(){
          $this->load->model('retailer/createretailer');
          $village=$this->model_retailer_createretailer->getvillage();
          echo '<option value="">Select Village</option>';
          foreach($village as $value) {
              echo '<option value="'.$value["SID"].'">'.$value["VILLAGE_NAME"].'</option>';
          }
          
      }
       
}
