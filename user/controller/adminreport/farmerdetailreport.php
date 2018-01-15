<?php
class Controlleradminreportfarmerdetailreport extends Controller 
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
$this->session->data["title"]='Farmer Detail Report';
$data['sort'] = $sort;
$data['order'] = $order;
$data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
$data['breadcrumbs'] = array();
$data['breadcrumbs'][] = array(
'text' => $this->language->get('text_home'),
'href' => $this->url->link('callreport/agentwisereport', 'token=' . $this->session->data['token'], 'SSL')
);
$data['breadcrumbs'][] = array(
'text' => 'Farmer Detail Report',
'href' => $this->url->link('adminreport/farmerdetailreport')
);
$this->load->model('adminreport/farmerdetailreport');
//$data['StateList']= $this->model_adminreport_farmersummaryreport->StateList($this->request->get);
//$data['MobileList']= $this->model_adminreport_farmersummaryreport->MobileList($this->request->get);
$data['farmerSummary']= $this->model_adminreport_farmerdetailreport->farmersummaryreport($this->request->get);
//****************************************************************************//

//****************************************************************************//
$data['button_save'] = $this->language->get('button_save');
$data['button_back'] = $this->language->get('button_back');
$data['header'] = $this->load->controller('common/header');
$data['column_left'] = $this->load->controller('common/column_left');
$data['footer'] = $this->load->controller('common/footer');
$this->response->setOutput($this->load->view('default/template/adminreport/farmerdetailreport.tpl', $data));

}

public function RecordList(){
    $this->load->model('adminreport/farmerdetailreport');
    $arr=array('from_date'=> $this->request->post['frmdt'],'to_date'=>$this->request->post['todt']);
    
    $MobileList= $this->model_adminreport_farmerdetailreport->MobileList($arr);
    $ChannelList= $this->model_adminreport_farmerdetailreport->ChannelList($arr);
       
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
        $tbl.='<td>SNO</td>';
        $tbl.='<td>DATE</td>';
        $tbl.='<td>MOBILE</td>';
        $tbl.='<td>STATE</td>';
        $tbl.='<td>STATUS</td>';
        $tbl.='</tr>';
        $tbl.='</thead>';
        $tbl.='<tbody>';
            
                $sn=1;
                foreach($MobileList as $EF){
                    $tbl.='<tr>';
                    $tbl.='<td>'.$sn.'</td>';
                    $tbl.='<td>'.$EF['DATE_RECEIVED'].'</td>';
                    $tbl.='<td>'.$EF['MOBILE'].'</td>';
                    $tbl.='<td>'.$EF['STATE_NAME'].'</td>';
                    $tbl.='<td>'.$EF['FAR_STATUS'].'</td>';
                    $tbl.='</tr>';
                $sn++;
                }
            
           
        $tbl.='</tbody>';
    $tbl.='</table>';
    echo $tbl;
}


public function downloadExcel()
{
$this->load->model('adminreport/farmerdetailreport');
    $arr=array('from_date'=> $this->request->get['frmdt'],'to_date'=>$this->request->get['todt']);
    $MobileList= $this->model_adminreport_farmerdetailreport->MobileList($arr);
    $ChannelList= $this->model_adminreport_farmerdetailreport->ChannelList($arr);   
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
$Header=array('SNO','DATE','MOBILE','STATE','STATUS');
$col = 0;
foreach ($Header as $field)
{
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
$col++;
}
$col = 0;
$row=2;
$sn=1;
foreach ($MobileList as $field)
{       
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $sn);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $field['DATE_RECEIVED']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $field['MOBILE']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $field['STATE_NAME']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $field['FAR_STATUS']);
$sn++;
$col++;
$row++;
}

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="FarmerStatus'.date('dMy').'.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
}


}
