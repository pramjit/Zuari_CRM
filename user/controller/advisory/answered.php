<?php
class Controlleradvisoryanswered extends Controller {
    public function index(){
        $this->document->setTitle($this->language->get('heading_title'));      
        $this->load->model('advisory/answered');
         $this->session->data["title"]='Advisory Answered Call';
        $this->getList();
    }
    protected function getList() {

        $data['lnk'] = $this->url->link('advisory/answered','token=' . $this->session->data['token'], 'SSL');
        $data['AdvData']= $this->model_advisory_answered->AdvData($this->request->get);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('default/template/advisory/answered.tpl', $data));
    }
    public function ResetPin(){
        $this->load->model('advisory/answered');
        $PinUp= $this->model_advisory_answered->updateStatus();
    
        if(empty($PinUp) || $PinUp==0){
            echo 'Sorry! There is some error occoured';
            
        }else{
           echo "Call Pin Updated By New Pin: ".$PinUp." successfully. ";
        }
    }

}
