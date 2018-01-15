<?php
class ControllerApiappService extends Controller {
        public function index(){
        echo 'Calling...';
        $log=new Log("AppService.log");
        $log->write('By Get');
        $log->write($this->request->get);
        $log->write('By Post');
        $log->write($this->request->post);
        $this->load->model('api/appService');
        echo '<br />Finished';
      }  
}