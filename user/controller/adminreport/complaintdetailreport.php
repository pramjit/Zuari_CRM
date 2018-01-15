<?php
class Controlleradminreportcomplaintdetailreport extends Controller 
{
public function  index(){
    $this->document->setTitle($this->language->get('heading_title'));      
    $this->load->model('call/missedcall');
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
          
$data['lastfromdate']=$this->request->get["from_date"];
$data['lasttodate']=$this->request->get["to_date"];
          
$data['order_statuses'] = "";
$this->session->data["title"]='Open Complaint Status Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('adminreport/complaintdetailreport', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Open Complaint Status Report',
'href' => $this->url->link('adminreport/complaintdetailreport')
);
$this->load->model('adminreport/complaintdetailreport');
//$data['StateList']= $this->model_adminreport_complaintdetailreport->StateList($this->request->get);
//$data['MobileList']= $this->model_adminreport_complaintdetailreport->MobileList($this->request->get);
$data['farmerSummary']= $this->model_adminreport_complaintdetailreport->farmersummaryreport($this->request->get);
//****************************************************************************//

//****************************************************************************//
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/complaintdetailreport.tpl', $data));

}

public function RecordList(){
    $this->load->model('adminreport/complaintdetailreport');
    $arr=array('from_date'=> $this->request->post['frmdt'],'to_date'=>$this->request->post['todt']);
    
    
    $StateList= $this->model_adminreport_complaintdetailreport->StateList($arr);
    $CategoryList= $this->model_adminreport_complaintdetailreport->CategoryList($arr);
    $ComplaintList= $this->model_adminreport_complaintdetailreport->ComplaintList($arr);
    //echo '<pre>';
    //print_r($CategoryList);
    //echo '</pre>';
    //echo '<pre>';
   // print_r($ComplaintList);
    //echo '</pre>';
    //print_r($ComplaintList);
    
        $tbl='<table class="table display" id="example">';
        $tbl.='<thead>';
        $tbl.='<tr style="background: #515151; color: #ffffff !important; font-size:10px;">';
        $tbl.='<td>STATES</td>';
        
        foreach($StateList as $SL){ 
        $tbl.='<td>'.$SL['STATE_NAME'].'</td>';
        }
        $tbl.='</tr>';
        $tbl.='<tr style="color: #ffffff !important; font-size:10px;">';
        $tbl.='<td>';
		$tbl.='<table style="width:100%!important;">';
                $tbl.='<tr style="background: #00679F; color: #ffffff !important; font-size:10px;"><td class="text-center">COMPLAINT CATEGORY</td></tr>';
        $tbl.='</table>';
		$tbl.='</td>';
        foreach($StateList as $SL){ 
        $tbl.='<td>';
        $tbl.='<table style="width:100%!important;">';
                $tbl.='<tr style="background: #00679F; color: #ffffff !important; font-size:10px;"><td class="text-center">PENDING AT RA</td><td class="text-center">PENDING AT AA</td><td class="text-center">TOTAL</td></tr>';
        $tbl.='</table>'; 
        $tbl.='</td>';
        }
        $tbl.='</tr>';
        
        $tbl.='</thead>';
        $tbl.='<tbody>';
        foreach($CategoryList as $com){
            $tbl.='<tr>';
                $tbl.='<td>'.$com['COMP_NAME'].'</td>';
                foreach($StateList as $SL){ 
                $tbl.='<td>';
                $tbl.='<table style="width:100%!important;">';
                foreach($ComplaintList as $ds){
                    if($ds['STATE']==$SL['STATE'] && $ds['COMP_CATG']==$com['COMP_CATG'])
                    {
                        $tot=$ds['PEN_RA']+$ds['PEN_AA'];
                        $tbl.='<tr>';
                        $tbl.='<td class="text-center">'.$ds['PEN_RA'].'</td>';
                        $tbl.='<td class="text-center">'.$ds['PEN_AA'].'</td>';
                        $tbl.='<td class="text-center">'.$tot.'</td>';
                        $tbl.='</tr>';
                    }
                }
                $tbl.='</table>';
                $tbl.='</td>';
                }
            $tbl.='</tr>';
        }   
        $tbl.='</tbody>';
    $tbl.='</table>';
    echo $tbl;
}


public function downloadExcel()
{
$this->load->model('adminreport/complaintdetailreport');
    $arr=array('from_date'=> $this->request->get['frmdt'],'to_date'=>$this->request->get['todt']);
    $StateList= $this->model_adminreport_complaintdetailreport->StateList($arr);
    $CategoryList= $this->model_adminreport_complaintdetailreport->CategoryList($arr);
    $ComplaintList= $this->model_adminreport_complaintdetailreport->ComplaintList($arr);   
    
// Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$HeadList=array('COMPLAIN CATEGORY','STATE NAME','PENDING AT RA','PENDING AT AA','TOTAL');
$col = 0;
foreach ($HeadList as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$col = 0;
$row=2;
$sn=1;
foreach ($ComplaintList as $field)
{     
    $tot=$field['PEN_RA']+$field['PEN_AA'];
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $field['COMP_NAME']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $field['STATE_NAME']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $field['PEN_RA']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $field['PEN_AA']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $tot);
$sn++;
$col++;
$row++;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="OpenCompStatus'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
