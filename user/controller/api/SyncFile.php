<?php
class ControllerApiSyncFile extends Controller {
        public function index(){
		$this->load->model('api/SyncFile');
		//echo 'Calling';
		$date=date('Ymd');
                $log=new Log("SyncFile".$date.".log");
		/*
        $log->write('Calling');
		$log->write($_POST);
		$log->write($_FILES);
        $jsonStr = file_get_contents("php://input"); //read the HTTP body.
		$log->write($jsonStr);
		$log->write($_REQUEST['name']);
		$fn=$_REQUEST['name'];
		$fm=substr($fn,0,10);
		$log->write($fm);
		$tm=substr($fn,31,10);
		$log->write($tm);
		//8065474856-zuari01170816094236-7760389631
		
		$log->write($this->request->get);
        $log->write($this->request->post);
		$log->write($this->request->file);
       
        if(is_dir(DIR_IMAGE)){
        file_put_contents(DIR_IMAGE.$_REQUEST['name'], $_REQUEST['content']);
		
        $MyCallData= $this->model_api_SyncFile->checkRec($mob,$code);
        }
		*/
		
		//$uploaddir = realpath('./') . '/'; 
		/////NEW STRUCTURE FILE UPLOAD///
		//1232-2024327080-zuari01170817161928-9049901224.wav//
		
		$log->write($_FILES);
		$fn=$_FILES['file_contents']['name'];
		$pin=substr($fn,0,4);
		$log->write("PIN: ".$pin);
		$fm=substr($fn,5,10);
		$log->write("From_Mob: ".$fm);
		$tm=substr($fn,36,10);
		$log->write("To_Mob: ".$tm);
				$dir='c:/inetpub/wwwroot/zuari/image/';
			$uploadfile = $dir. basename($_FILES['file_contents']['name']);
			if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) 
			{ 
				chmod($uploadfile, 777);
				$log->write('File is valid, and was successfully uploaded');
				$MyCallData= $this->model_api_SyncFile->updateRec($fm,$tm);
			} 
			else { 
				$log->write('File is not valid');
			} 
	
    }  
}
