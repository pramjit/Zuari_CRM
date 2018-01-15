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
class ControllerReportmonthlyreport extends Controller {
    public function  index(){
        
        $this->load->language('report/monthlyreport');

	$this->document->setTitle($this->language->get('heading_title'));
      
       
	$this->load->model('report/monthlyreport');
      
        
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
        
        if (isset($this->request->get['filter_type'])) {
            $filter_type = $this->request->get['filter_type'];
        } 
        if (isset($this->request->get['filter_month'])) {
            $filter_month = $this->request->get['filter_month'];
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

        if (isset($this->request->get['filter_type'])) {
            $url .= '&type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_month'])) {
            $url .= '&filter_month=' . urlencode(html_entity_decode($this->request->get['filter_month'], ENT_QUOTES, 'UTF-8'));
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

        

        
        $data['lnk'] = $this->url->link('Report/monthlyreort', 'token=' . $this->session->data['token'], 'SSL');

        $data['orders'] = array();

        $filter_data = array(
            'filter_type'      => $filter_type,
            'filter_month'       => $filter_month, 
           
            'sort'                 => $sort,
            'order'                => $order,
            'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                => $this->config->get('config_limit_admin')
        );

        $data['type']=$filter_type;
        $data['month']=$filter_month;
        
        if($filter_type && $filter_month) {      
        if($filter_type=='Farmer') {
            
        $results = $this->model_report_monthlyreport->Mdo_wise_farmer_monthly_report($filter_data);
        $order_total_count = $this->model_report_monthlyreport->Mdo_wise_farmer_monthly_report_count($filter_data);
        $order_total = count($order_total_count);
        } 
         if($filter_type=='POS') {
             $results = $this->model_report_monthlyreport->Pos_Monthly_wise_report ($filter_data);
             $order_total_count = $this->model_report_monthlyreport->Pos_Monthly_wise_report_count($filter_data);
             $order_total = count($order_total_count);
        } 
         if($filter_type=='MCC') {
             $results = $this->model_report_monthlyreport->Milk_Monthly_wise_report($filter_data);
              $order_total_count = $this->model_report_monthlyreport->Milk_Monthly_wise_report_count($filter_data);
             $order_total = count($order_total_count);
             
        } 
         if($filter_type=='FGM') {
             $results = $this->model_report_monthlyreport->Fgm_Monthly_wise_report($filter_data);
             $order_total_count = $this->model_report_monthlyreport->Fgm_Monthly_wise_report_count($filter_data);
             $order_total = count($order_total_count);
        }
        
       
        foreach ($results as $result) {
            $data['geo'][] = array(
                'Mdo'      => $result['Mdo'],
                'Activity'      => $result['Activity'],
                'Market_Name'        => $result['Market_Name'],
                '01'    => ($result['01']),
                '02'    => ($result['02']),
                '03'    => ($result['03']),
                '03'    => ($result['03']),
                '04'    => ($result['04']),
                '05'    => ($result['05']),
                '06'    => ($result['06']),
                '07'    => ($result['07']),
                '08'    => ($result['08']),
                '09'    => ($result['09']),
                '10'    => ($result['10']),
                '11'    => ($result['11']),
                '12'    => ($result['12']),
                '13'    => ($result['13']),
                '14'    => ($result['14']),
                '15'    => ($result['15']),
                '16'    => ($result['16']),
                '17'    => ($result['17']),
                '18'    => ($result['18']),
                '19'    => ($result['19']),
                '20'    => ($result['20']),
                '21'    => ($result['21']),
                '22'    => ($result['22']),
                '23'    => ($result['23']),
                '24'    => ($result['24']),
                '25'    => ($result['25']),
                '26'    => ($result['26']),
                '27'    => ($result['27']),
                '28'    => ($result['28']),
                '29'    => ($result['29']),
                '30'    => ($result['30']),
                '31'    => ($result['31'])
                
                
            );
        }
         }
        $data['heading_title'] = $this->language->get('heading_title');
        
        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');
        $data['text_missing'] = $this->language->get('text_missing');

        
        
       
        $data['column_mdo_name'] = $this->language->get('column_mdo_name');
        $data['column_market'] = $this->language->get('column_market'); 
       

        
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
         $this->load->language('geo/searchgeo');

	$this->document->setTitle($this->language->get('heading_title'));
      
       
       
        $data['entry_status'] = $this->language->get('Search Monthly Name');

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

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        
        if (isset($this->request->get['filter_month'])) {
            $url .= '&filter_month=' . $this->request->get['filter_month'];
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

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_month'])) {
            $url .= '&filter_month=' . urlencode(html_entity_decode($this->request->get['filter_month'], ENT_QUOTES, 'UTF-8'));
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
        $pagination->url = $this->url->link('Report/monthlyreport', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

        $data['filter_type'] = $filter_type;
        $data['filter_month'] = $filter_month;
        

      //  $this->load->model('localisation/order_status');

        $data['order_statuses'] = "";//$this->model_localisation_order_status->getOrderStatuses();

        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['searchgeo'] = $this->url->link('Report/monthlyreport', 'token=' . $this->session->data['token'], 'SSL');
                
                $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('Report/monthlyreport', 'token=' . $this->session->data['token'], 'SSL')
		);
                $data['button_save'] = $this->language->get('button_save');
		$data['button_back'] = $this->language->get('button_back');
                $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
               
      $this->response->setOutput($this->load->view('monthlyreport/monthlyreport.tpl', $data));

        
    }
   
    
    public function monthlyreport_download(){
        
         
  
   if (isset($this->request->get['filter_type'])) {
            $filter_type = $this->request->get['filter_type'];
        } 

        if (isset($this->request->get['filter_month'])) {
            $filter_month = $this->request->get['filter_month'];
        } 
        
         $filter_data = array(
            'filter_type'      => $filter_type,
            'filter_month'        => $filter_month, 
            
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
        'Mdo',
        'Activity',
        'day1',
        'day2',
        'day3',
        'day4',
        'day5',
        'day6',
        'day7',
        'day8',
        'day9',
        'day10',
        'day11',
        'day12',
        'day13',
        'day14',
        'day15',
        'day16',
        'day17',
        'day18',
        'day19',
        'day20',
        'day21',
        'day22',
        'day23',
        'day24',
        'day25',
        'day26',
        'day27',
        'day28',
        'day29',
        'day30',
        'day31',
    );
   
    $col = 0;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
        $col++;
    }
     
    // Fetching the table data
    $this->load->model('report/monthlyreport');
    if($filter_type=='Farmer') {
            
        $results = $this->model_report_monthlyreport->Mdo_wise_farmer_monthly_report_count($filter_data);
        $order_total = count($results);
        
        } else if($filter_type=='POS') {
             $results = $this->model_report_monthlyreport->Pos_Monthly_wise_report_count($filter_data);
             $order_total = count($results);
             
        } else if($filter_type=='MCC') {
             $results = $this->model_report_monthlyreport->Milk_Monthly_wise_report_count($filter_data);
             $order_total = count($results);
             
        } else if($filter_type=='FGM') {
             $results = $this->model_report_monthlyreport->Fgm_Monthly_wise_report_count($filter_data);
             $order_total = count($results);
        }
        
   $row = 2;
    
    foreach($results as $data)
    {
        $col = 0;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $data['Market_Name']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $data['Mdo']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $data['Activity']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data['01']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data['02']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $data['03']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data['04']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $data['05']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $data['06']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $data['07']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $data['08']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $data['09']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $data['10']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $data['11']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $data['12']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $data['13']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $data['14']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $data['15']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $data['16']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $data['17']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $data['18']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $data['19']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $data['20']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $data['21']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $data['22']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $data['23']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $data['24']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $data['25']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $data['26']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $data['27']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $data['28']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $data['29']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $data['30']);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $data['31']);
        
        
        
         
            
        

        $row++;
    }

    

    
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="monthly_report_'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter->save('php://output');
        
    }
    
    
}
