<?php
class Controllerfarmerfarmerbulkupload extends Controller  {
    public function index() {
       
		$this->load->language('dealer/bulkupload');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('farmer/farmerbulkupload');
               // $this->load->library('phpmailer/PHPMailerAutoload');  
                $this->load->library('PHPReadExcel');
                
                $this->load->model('geo/addgeo');
                $data['dpnation']= $this->model_geo_addgeo->getNations();
                
                  
               if (($this->request->server['REQUEST_METHOD'] == 'POST') )
                  {
                     $t = time();

			if (is_uploaded_file($this->request->files['import']['tmp_name'])) 
                            {
                            
				$content = file_get_contents($this->request->files['import']['tmp_name']);
                               
			} else {
				$content = false;
			}

			if ($content) 
                            {
                            $data['exceldisplay'] = array();
                            unset($this->session->data['exceldata']);
                            $d= $this->model_farmer_farmerbulkupload->readExcel($this->request->files['import']['tmp_name'],$this->request->files['import']['name']);
                            if($d=='1') {
                                $this->session->data['success']="Data uploaded Sucessfully!";
                             $this->response->redirect(str_replace('&amp;', '&',$this->url->link('farmer/farmerbulkupload', 'token=' .$this->session->data['token'], 'SSL')));      
                            } else {
                               $this->error['warning'] ="Error!";
                             $this->response->redirect(str_replace('&amp;', '&',$this->url->link('farmer/farmerbulkupload', 'token=' .$this->session->data['token'], 'SSL')));      
                            }
                            $this->session->data['exceldata']=$data['exceldisplay'];
			    $this->session->data['success'] = $this->language->get('text_success');
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('farmer/farmerbulkupload', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['excelupload'] = $this->url->link('farmer/farmerbulkupload', 'token=' . $this->session->data['token'], 'SSL');

		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('farmer/farmerbulkupload.tpl', $data));
    }

public function downloadexlformate(){
    // Starting the PHPExcel library
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    
    $objPHPExcel->createSheet();
    
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);

    // Field names in the first row
    $fields = array(
        'Channel Code',
        'Channel Type',
        'Firm Name',
        'Owner Name',
        'Mobile No',
        'Email ID',
        'Nation',
        'Zone',
        'State',
        'Region',
        'Territory',
        'District',
        'Area',
        'FMR',
        'DMR'
    );
    
    $col = 0;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
        $col++;
    }
  
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Dealer'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
    }
    
    
}
