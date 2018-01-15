<?php
class ControlleradminreportAgentReportCount extends Controller 
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
$this->session->data["title"]='EXECUTIVE REPORT';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('adminreport/AgentReportCount', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Call Count Report',
'href' => $this->url->link('adminreport/AgentReportCount')
);
$this->load->model('adminreport/AgentReportCount');
//$data['StateList']= $this->model_adminreport_AgentReportCount->StateList($this->request->get);
//$data['MobileList']= $this->model_adminreport_AgentReportCount->MobileList($this->request->get);
$data['AgentList']= $this->model_adminreport_AgentReportCount->AgentList();
//****************************************************************************//

//****************************************************************************//
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/AgentReportCount.tpl', $data));

}

public function RecordList(){
    $this->load->model('adminreport/AgentReportCount');
    $CT= // Call Type Advisory(1) / Retailer(2)
    
    
    $arr=array('call_type'=>$this->request->post['callid'],'ex_id'=>$this->request->post['exid'],'from_date'=> $this->request->post['frmdt'],'to_date'=>$this->request->post['todt']);
    $CallingList= $this->model_adminreport_AgentReportCount->CallingList($arr);
     
        $tbl='<table class="table display" id="example">';
        $tbl.='<thead>';
        $tbl.='<tr style="background: #515151; color: #ffffff !important; font-size:10px;">';
        $tbl.='<td>SNO</td>';
        $tbl.='<td>CALL TYPE</td>';
        $tbl.='<td>TOTAL CALL</td>';
        $tbl.='<td>STATE NAME</td>';
        $tbl.='<td>CALL DATE</td>';
        $tbl.='</tr>';
        $tbl.='</thead>';
        $tbl.='<tbody>';
        $n=1;
        foreach($CallingList as $com){
            $tbl.='<tr>';
                $tbl.='<td>'.$n.'</td>';
                $tbl.='<td>'.$com['CALL_TYPE'].'</td>';
                $tbl.='<td>'.$com['TOTAL_CALL'].'</td>';
                $tbl.='<td>'.$com['STATE_NAME'].'</td>';
                $tbl.='<td>'.$com['CALL_DATE'].'</td>';

            $tbl.='</tr>';
            $n++;
        }   
        $tbl.='</tbody>';
    $tbl.='</table>';
    echo $tbl;
    
}
public function history(){
    $this->load->model('adminreport/AgentReportCount');
   // $a = $this->request->post['stsid'];
    
    $HisData= $this->model_adminreport_AgentReportCount->History($this->request->post['caseid']);
        echo '<div class="table-responsive">';
        echo '<table id="casetbl" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        echo '<thead>';
        echo '<tr role="row" style="background: #12a4f4; color: #ffffff;">';
        echo '<th>USER</th>';
        echo '<th>FROM STATS</th>';
        echo '<th>TO STATUS</th>';
        echo '<th>SOLUTION/COMMENTS</th>';
        echo '<th>UPDTED DATE</th>';
        echo '<th>FILE</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        if(sizeof($HisData)==0)
        {
            echo '<tr><td colspan="6" class="text-center" style="color:#F00;">Sorry! No records found</td></tr>';
        }
        else {
            foreach($HisData as $prod){
            echo '<tr>';
                echo "<td>".$prod['UP_USR_NAME']."</td>";
                echo "<td>".$prod['CASE_PRE_STATUS']."</td>";
                echo "<td>".$prod['CASE_CUR_STATUS']."</td>";
                echo "<td>".$prod['SOLUTION']."</td>";
                echo "<td>".$prod['CASE_UP_DATE']."</td>";
                if($prod['UP_FILE_NAME']=='NA'){
                echo '<td><i class="fa fa-ban" aria-hidden="true"></i></td>';   
                }
                else{
                echo "<td><a href=".DIR_DOWNLOAD_FILE.$prod['UP_FILE_NAME']." download='download'><i class='fa fa-download' aria-hidden='true'></i></a></td>"; 
                }
            echo '</tr>';
            }
        }
        echo '</tbody>';
        echo '</table>';
       
    }

public function downloadExcel()
{
$this->load->model('adminreport/AgentReportCount');
$arr=array('call_type'=>$this->request->get['callid'],'ex_id'=>$this->request->get['exid'],'from_date'=> $this->request->get['frmdt'],'to_date'=>$this->request->get['todt']);
$CallingList= $this->model_adminreport_AgentReportCount->CallingList($arr);
      
    
// Starting the PHPExcel library
$this->load->library('PHPExcel');
$this->load->library('PHPExcel/IOFactory');
$objPHPExcel = new PHPExcel();
$objPHPExcel->createSheet();
$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
$objPHPExcel->setActiveSheetIndex(0);
// Field names in the first row
$HeadList=array('SNO','CALL TYPE','TOTAL CALL','STATE NAME','CALL DATE');

$col = 0;
foreach ($HeadList as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$col = 0;
$row=2;
$sn=1;
foreach ($CallingList as $field)
{     
    $tot=$field['OPEN']+$field['CLOSE'];
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $sn);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $field['CALL_TYPE']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $field['TOTAL_CALL']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $field['STATE_NAME']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $field['CALL_DATE']);
    
$sn++;
$col++;
$row++;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Exe_Calling_Report'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
