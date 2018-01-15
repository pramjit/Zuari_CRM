<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addproduct
 *
 * @author agent
 */
class Controllerproductaddproduct extends Controller {
   public function  index(){
        
        $this->load->language('product/addproduct');

	$this->document->setTitle($this->language->get('heading_title'));

	$this->load->model('product/addproduct');
   if (isset($this->request->get['customeridupdate'])) {
  $id=$this->request->get['customeridupdate'];
$data["updatedata"]= $this->model_product_addproduct->getupdatedata($id); 
}
     
        $data['dp_select_product']= $this->model_product_addproduct->get_Select_Product();
        $data['dp_select_productGroup']= $this->model_product_addproduct->get_Select_ProductGroup();
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
                
                $data['addproduct'] = $this->url->link('product/addproduct/addProduct', 'token=' . $this->session->data['token'], 'SSL');
                $data['updateproduct'] = $this->url->link('product/addproduct/updateproduct', 'token=' . $this->session->data['token'], 'SSL');

                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('product/addproduct', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
                $this->response->setOutput($this->load->view('product/addproduct.tpl', $data));
    }
    public function  addProduct(){
      // print_r($_FILES);die;
          $this->load->language('product/addproduct');
          $json = array();
          $this->load->model('product/addproduct');
                        
          // file upload
         
          if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			
				$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}
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
          
          // end file upload
          
                        if (isset($this->request->post['product_name']) && isset($this->request->post['unit'])) {
                         $this->model_product_addproduct->addProduct($this->request->post,$this->request->files['file']['name']); 
                         
                         
                         $this->session->data['success'] = $this->language->get('text_success');
                         $json['redirectf'] = $this->url->link('product/addproduct', 'token=' . $this->session->data['token'], 'SSL');                             
                        }else{
                        $json['error']['warning'] ="Error";
                            
                        }
    $this->response->redirect($this->url->link('product/addproduct', 'token=' . $this->session->data['token'], 'SSL')); 

                         
                        $this->response->addHeader('Content-Type: application/json');
                        $this->response->setOutput(json_encode($json));
                          
      }
      public function updateproduct(){
   //print_r($_POST);die;
$this->load->language('product/addproduct');
$json = array();
$this->load->model('product/addproduct');

//update image

 if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			
				$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}
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
          
          // end file upload
          if (empty($this->request->files['file']['name'])) {
              $this->request->files['file']['name']=$this->request->post["last_image_name"];
          }
//end update image
 $customer_id= $this->model_product_addproduct->updateCustomer($this->request->post,$this->request->files['file']['name']); 

if($customer_id) {
$this->session->data['success'] = 'Data Updated Successfully';
} else {
    $json['error']['warning'] ="Error";
    $this->session->data['error'] ="Error";
}

$this->response->redirect($this->url->link('product/viewproduct', 'token=' . $this->session->data['token'], 'SSL')); 
}
     
}