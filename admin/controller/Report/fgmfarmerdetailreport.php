<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of createVillage
 *
 * @author agent
 */
class ControllerReportfgmfarmerdetailreport extends Controller {
    public function  index(){
        
        $this->load->language('report/fgmfarmerdetailreport');

	$this->document->setTitle($this->language->get('heading_title'));      
       
	$this->load->model('report/fgmfarmerdetailreport');
      
        
        //$data['dp_search_village']=$this->model_village_searchvillage->get_Search_Village();
        
        
        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_list'] = $this->language->get('text_list');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_model'] = $this->language->get('entry_model');
        $data['entry_price'] = $this->language->get('entry price');
        
         
        
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
                
             
               $this->getList();
              
    }
     
    protected function getList() {
        
        
        
        if (isset($this->request->get['filter_from_date'])) {
            $filter_from_date = $this->request->get['filter_from_date'];
            $lastfromdate=$filter_from_date;
            $filter_from_date="'".$filter_from_date."'";
        } else {
            $filter_from_date = 'null';
        }

        if (isset($this->request->get['filter_to_date'])) {
            $filter_to_date = $this->request->get['filter_to_date'];
            $lasttodate=$filter_to_date;
            $filter_to_date="'".$filter_to_date."'";
        } else {
            $filter_to_date = 'null';
        }
        
        if (isset($this->request->get['filter_market'])) {
            $filter_market = $this->request->get['filter_market'];
             $lastmarket=$filter_market;
             $filter_market="'".$filter_market."'";
           
           
            
        } else {
            $filter_market = 'null';
        }
        if (isset($this->request->get['filter_mdo'])) {
            $filter_mdo = $this->request->get['filter_mdo'];
             $lastmdo=$filter_mdo;
             $filter_mdo="'".$filter_mdo."'";
           
           
            
        } else {
            $filter_mdo = 'null';
        }
      
       
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

        if (isset($this->request->get['filter_from_date'])) {
            $url .= '&filter_from_date=' . $this->request->get['filter_from_date'];
        }

        if (isset($this->request->get['filter_to_date'])) {
            $url .= '&filter_to_date=' . urlencode(html_entity_decode($this->request->get['filter_to_date'], ENT_QUOTES, 'UTF-8'));
        }
       if (isset($this->request->get['filter_state_id'])) {
            $url .= '&filter_state_id=' . urlencode(html_entity_decode($this->request->get['filter_state_id'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_mdo_id'])) {
            $url .= '&filter_mdo_id=' . urlencode(html_entity_decode($this->request->get['filter_mdo_id'], ENT_QUOTES, 'UTF-8'));
        }
         

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        

        
        $data['lnk'] = $this->url->link('Report/fgmfarmerdetailreport', 'token=' . $this->session->data['token'], 'SSL');

        $data['orders'] = array();

        $filter_data = array(
            'filter_from_date'      => $filter_from_date,
            'filter_to_date'       => $filter_to_date, 
            'filter_market'     => $filter_market,
            'filter_mdo'     => $filter_mdo,
           
           
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                => $this->config->get('config_limit_admin')
        );

        
        $data['lastfromdate']=$lastfromdate;
        $data['lasttodate']=$lasttodate;
        $data["lastmarket"]=$lastmarket;
         $data["lastmdo"]=$lastmdo;
        $this->request->post['hq']=$lastmarket;
        
       $data['mdo'] = $this->model_report_fgmfarmerdetailreport->getmdo($this->request->post);
       $data['market'] = $this->model_report_fgmfarmerdetailreport->getmarket();
            
        $data["resultdata"] = $this->model_report_fgmfarmerdetailreport->fgmfarmerdetailreport_count($filter_data);
        //print_r($results);
        
        $order_total_count = $this->model_report_fgmfarmerdetailreport->fgmfarmerdetailreport($filter_data);
        $order_total = count($order_total_count);
        
       
       
      

        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_missing'] = $this->language->get('text_missing');

        
        $data['column_district'] = $this->language->get('column_district');
        $data['column_market'] = $this->language->get('column_market');
        $data['column_mdo_name'] = $this->language->get('column_mdo_name');
        $data['column_date'] = $this->language->get('column_date');
        $data['column_act'] = $this->language->get('column_act');
        $data['column_remarks'] = $this->language->get('column_remarks');
        
          $data['column_pos_contact'] = $this->language->get('column_pos_contact');
          $data['pos_monthly_sale'] = $this->language->get('pos_monthly_sale');
          $data['column_posbrand_used'] = $this->language->get('column_posbrand_used');
       

        
        $data['entry_return_id'] = $this->language->get('entry_return_id');
        $data['entry_order_id'] = $this->language->get('entry_order_id');
        $data['entry_customer'] = $this->language->get('entry_customer');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_date_added'] = $this->language->get('entry_date_added');
        $data['entry_date_modified'] = $this->language->get('entry_date_modified');

        $data['button_invoice_print'] = $this->language->get('button_invoice_print');
        $data['button_shipping_print'] = $this->language->get('button_shipping_print');
        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_view'] = $this->language->get('button_view');

        $data['token'] = $this->session->data['token'];
        

	$this->document->setTitle($this->language->get('heading_title'));
      
        if (isset($this->error['warning'])) {
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

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';

        if (isset($this->request->get['filter_from_date'])) {
            $url .= '&filter_from_date=' . $this->request->get['filter_from_date'];
        }

        
        if (isset($this->request->get['filter_from_date'])) {
            $url .= '&filter_to_date=' . $this->request->get['filter_to_date'];
        }

        

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
        $data['sort_customer'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
        $data['sort_total'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
        $data['sort_date_modified'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_from_date'])) {
            $url .= '&filter_from_date=' . $this->request->get['filter_from_date'];
        }

        if (isset($this->request->get['filter_to_date'])) {
            $url .= '&filter_to_date=' . urlencode(html_entity_decode($this->request->get['filter_to_date'], ENT_QUOTES, 'UTF-8'));
        }
         if (isset($this->request->get['filter_market'])) {
            $url .= '&filter_market=' . $this->request->get['filter_market'];
        }
         if (isset($this->request->get['filter_mdo'])) {
            $url .= '&filter_mdo=' . $this->request->get['filter_mdo'];
        }
      

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('Report/fgmfarmerdetailreport', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

        $data['filter_from_date'] = $filter_from_date;
        $data['filter_to_date'] = $filter_to_date;
        $data['filter_order_status'] = $filter_order_status;
        $data['filter_total'] = $filter_total;
        $data['filter_date_added'] = $filter_date_added;
        $data['filter_date_modified'] = $filter_date_modified;

      //  $this->load->model('localisation/order_status');

        $data['order_statuses'] = "";//$this->model_localisation_order_status->getOrderStatuses();

        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['searchgeo'] = $this->url->link('Report/fgmfarmerdetailreport', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('Report/fgmfarmerdetailreport', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
               
      $this->response->setOutput($this->load->view('attendancereport/fgm_farmer_detail_report.tpl', $data));

        
    }
    public function getmdo(){
   
    $this->load->model('report/fgmfarmerdetailreport');    
        
    $mdodata= $this->model_report_fgmfarmerdetailreport->getmdo($this->request->post);
    echo '<option value="">Select Mdo</option>';
    foreach ($mdodata as $value) {
        
        echo '<option value='.$value["customer_id"].'>'.$value["name"].'</option>';
        
    }
    }
    
    
 
    
    public function fgmfarmerreport_download(){
        
         
  
    if (isset($this->request->get['filter_from_date'])) {
            $filter_from_date = $this->request->get['filter_from_date'];
            $lastfromdate=$filter_from_date;
            $filter_from_date="'".$filter_from_date."'";
        } else {
            $filter_from_date = 'null';
        }

        if (isset($this->request->get['filter_to_date'])) {
            $filter_to_date = $this->request->get['filter_to_date'];
            $lasttodate=$filter_to_date;
            $filter_to_date="'".$filter_to_date."'";
        } else {
            $filter_to_date = 'null';
        }
        
        if (isset($this->request->get['filter_market'])) {
            $filter_market = $this->request->get['filter_market'];
             $lastmarket=$filter_market;
             $filter_market="'".$filter_market."'";
           
           
            
        } else {
            $filter_market = 'null';
        }
        if (isset($this->request->get['filter_mdo'])) {
            $filter_mdo = $this->request->get['filter_mdo'];
             $lastmdo=$filter_mdo;
             $filter_mdo="'".$filter_mdo."'";
           
           
            
        } else {
            $filter_mdo = 'null';
        }
      
       
        
         $filter_data = array(
            'filter_from_date'      => $filter_from_date,
            'filter_to_date'        => $filter_to_date, 
            'filter_market'       => $filter_market,
            'filter_mdo'       => $filter_mdo    
           
           
          
        ); 
    // Starting the PHPExcel library
    $this->load->library('PHPExcel');
    $this->load->library('PHPExcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    
    $objPHPExcel->createSheet();
    
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);

    // Field names in the first row
    $fields = array(
        'Market Name',
        'MDO Name ',
        'Fgm_Id',
        'Fgm Date',
        'Farmer Name',
        'No of Milking Cow',
        'Total No of Cow',
        'Daily Milk (In Ltrs)'
        
        
    );
   
    $col = 0;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
        $col++;
    }
     
    // Fetching the table data
    $this->load->model('report/fgmfarmerdetailreport');
    $results = $this->model_report_fgmfarmerdetailreport->fgmfarmerdetailreport($filter_data);
    
    $row = 2;
    
    foreach($results as $data)
    {
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['Market_name']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['Mdo']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['FGM_ID']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['Fgm_date']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['farmer_name']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['MILKING_COWS_CNT']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['TOTAL_COWS']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data['DAILY_MILK_PROD']);
            
        

        $row++;
    }

    

    
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Fgmfarmerreport'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
        
    }
    
    
}
