<?php
class Controlleradminreportadvisoryreportbusysummary extends Controller 
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
$this->session->data["title"]='Farmer Summary Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('callreport/agentwisereport', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Farmer Summary Report',
'href' => $this->url->link('adminreport/advisoryreportbusysummary')
);
$this->load->model('adminreport/advisoryreportbusysummary');
//$data['StateList']= $this->model_adminreport_farmersummaryreport->StateList($this->request->get);
//$data['MobileList']= $this->model_adminreport_farmersummaryreport->MobileList($this->request->get);
$data['farmerSummary']= $this->model_adminreport_advisoryreportbusysummary->farmersummaryreport($this->request->get);
//****************************************************************************//

//****************************************************************************//
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/advisoryreportbusysummary.tpl', $data));

}

public function RecordList(){
    $this->load->model('adminreport/advisoryreportbusysummary');
    $arr=array('from_date'=> $this->request->post['frmdt'],'to_date'=>$this->request->post['todt']);
    $MobileList= $this->model_adminreport_advisoryreportbusysummary->MobileList($arr);
       
        $tbl='<table class="table display" id="example">';
        $tbl.='<thead>';
        $tbl.='<tr style="background: #515151; color: #ffffff !important; font-size:10px;">';
        $tbl.='<td>STATUS</td>';
        
        foreach($MobileList as $SL){ 
        $tbl.='<td>'.$SL['STATE_NAME'].'</td>';
        
        }
        $tbl.='</tr>';
        $tbl.='</thead>';
        $tbl.='<tbody>';
              $tbl.='<tr>';
                $tbl.='<td>ADL</td>';
                foreach($MobileList as $EF){
                $tbl.='<td>'.$EF['ADVNAME'].'</td>';
            }
            $tbl.='<tr>';
                $tbl.='<td>Busy</td>';
                foreach($MobileList as $EF){
                $tbl.='<td>'.$EF['BUSY'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Not Attempted</td>';
                foreach($MobileList as $NF){
                $tbl.='<td>'.$NF['NOT_ATTEMPTED'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Not Reachable</td>';
                foreach($MobileList as $NF){
                $tbl.='<td>'.$NF['NOT_RECHABLE'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Not Responding</td>';
                foreach($MobileList as $PF){
                $tbl.='<td>'.$PF['ATTEMPT_LATER'].'</td>';
            }
           
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Not Picking</td>';
                foreach($MobileList as $PF){
                $tbl.='<td>'.$PF['NOT_PICKING'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Switch Off</td>';
                foreach($MobileList as $PF){
                $tbl.='<td>'.$PF['SWITCH_OFF'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Total</td>';
                foreach($MobileList as $SL){
                    $k=$SL['STATE_NAME'];
                    $tot=$SL['BUSY']+$SL['NOT_ATTEMPTED']+$SL['NOT_RECHABLE']+$SL['ATTEMPT_LATER']+$SL['NOT_PICKING']+$SL['SWITCH_OFF'];
                $tbl.='<td>'.$tot.'</td>';
            }
            $tbl.='</tr>';
        $tbl.='</tbody>';
    $tbl.='</table>';
    echo $tbl;
}


public function downloadExcel()
{
$this->load->model('adminreport/advisoryreportbusysummary');
$arr=array('from_date'=> $this->request->get['frmdt'],'to_date'=>$this->request->get['todt']);
$MobileList= $this->model_adminreport_advisoryreportbusysummary->MobileList($arr);
 // Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$col = 0;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, 'STATUS');
foreach ($MobileList as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+1, 1, $field['STATE_NAME']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'ADL');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $field['ADVNAME']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, 'Busy');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 3, $field['BUSY']);
$col++;
}

$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 4, 'Not Attempted');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $field['NOT_ATTEMPTED']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 5, 'Not Rechable');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $field['NOT_RECHABLE']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 6, 'Not Picking');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $field['NOT_PICKING']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 7, 'TOTAL');
foreach ($MobileList as $field)
{      
    $k=$field['STATE_NAME'];
    $tot=$field['BUSY']+$field['NOT_ATTEMPTED']+$field['NOT_RECHABLE']+$field['NOT_PICKING']+$field['NOT_PICKING'];
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 7, $tot);
$col++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="FarmerStatus'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}