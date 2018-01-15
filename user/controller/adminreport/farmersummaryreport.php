<?php
class Controlleradminreportfarmersummaryreport extends Controller 
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
'href' => $this->url->link('adminreport/farmersummaryreport')
);
$this->load->model('adminreport/farmersummaryreport');
//$data['StateList']= $this->model_adminreport_farmersummaryreport->StateList($this->request->get);
//$data['MobileList']= $this->model_adminreport_farmersummaryreport->MobileList($this->request->get);
$data['farmerSummary']= $this->model_adminreport_farmersummaryreport->farmersummaryreport($this->request->get);
//****************************************************************************//

//****************************************************************************//
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/farmersummaryreport.tpl', $data));

}

public function RecordList(){
    $this->load->model('adminreport/farmersummaryreport');
    $arr=array('from_date'=> $this->request->post['frmdt'],'to_date'=>$this->request->post['todt']);
    
    $MobileList= $this->model_adminreport_farmersummaryreport->MobileList($arr);
    $ChannelList= $this->model_adminreport_farmersummaryreport->ChannelList($arr);
       
        foreach($MobileList as $ML){
            $SCN=$ML['STATE_NAME'];
            for($n=0;$n<count($ChannelList);$n++){
                    
                if($SCN==$ChannelList[$n]['STATE_NAME'])
                    {
                        $Channel[$SCN]=$ChannelList[$n]['CP'];
                    }
                    else{
                        if (array_key_exists($SCN,$Channel))  
                        {
                             
                        }
                        else {
                               
                             $Channel[$SCN]=0;
                        }
                    }
                    
            }
        }
        //print_r($Channel);
        
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
                $tbl.='<td>Existing Farmer</td>';
                foreach($MobileList as $EF){
                $tbl.='<td>'.$EF['EXISTING'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>New Farmer</td>';
                foreach($MobileList as $NF){
                $tbl.='<td>'.$NF['NEW'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Channel Partner</td>';
                
                foreach($MobileList as $CL){
                    $k=$CL['STATE_NAME'];
                $tbl.='<td>'.$Channel[$k].'</td>';
                
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Pending Identification</td>';
                foreach($MobileList as $PF){
                $tbl.='<td>'.$PF['PENDING'].'</td>';
            }
            $tbl.='</tr>';
            $tbl.='<tr>';
                $tbl.='<td>Total</td>';
                foreach($MobileList as $SL){
                    $k=$SL['STATE_NAME'];
                    $tot=$SL['EXISTING']+$SL['NEW']+$SL['PENDING']+$Channel[$k];
                $tbl.='<td>'.$tot.'</td>';
            }
            $tbl.='</tr>';
        $tbl.='</tbody>';
    $tbl.='</table>';
    echo $tbl;
}


public function downloadExcel()
{
$this->load->model('adminreport/farmersummaryreport');
    $arr=array('from_date'=> $this->request->get['frmdt'],'to_date'=>$this->request->get['todt']);
    $MobileList= $this->model_adminreport_farmersummaryreport->MobileList($arr);
    $ChannelList= $this->model_adminreport_farmersummaryreport->ChannelList($arr);   
    foreach($MobileList as $ML){
            $SCN=$ML['STATE_NAME'];
            for($n=0;$n<count($ChannelList);$n++){
                    
                if($SCN==$ChannelList[$n]['STATE_NAME'])
                    {
                        $Channel[$SCN]=$ChannelList[$n]['CP'];
                    }
                    else{
                        if (array_key_exists($SCN,$Channel))  
                        {
                             
                        }
                        else {
                               
                             $Channel[$SCN]=0;
                        }
                    }
                    
            }
        }
       
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
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'EXISTING FARMER');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $field['EXISTING']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, 'NEW FARMER');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 3, $field['NEW']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 4, 'CHANNEL PARTNER');
foreach ($MobileList as $field)
{       
    $k=$field['STATE_NAME'];
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, $Channel[$k]);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 5, 'PENDING IDENTIFICATION');
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $field['PENDING']);
$col++;
}
$col = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 6, 'TOTAL');
foreach ($MobileList as $field)
{      
    $k=$field['STATE_NAME'];
    $tot=$field['EXISTING']+$field['NEW']+$field['PENDING']+$Channel[$k];
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 6, $tot);
$col++;
}
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="FarmerStatus'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
