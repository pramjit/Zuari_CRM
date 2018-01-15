<?php
class ControllerApicases extends Controller {
public  function allcase(){
        $log=new Log("Cases.log");
        $log->write($this->request->post);
       
        $mcrypt = new MCrypt(); 
        $keys = array('userid','roleid','geoid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
        
        //$role=4;
        $role=$this->request->post['roleid'];
        if($role==4)// Resolution Authority
        {
            $this->load->model('api/cases');
            $MyCaseData= $this->model_api_cases->appMycaseData();
            foreach($MyCaseData as $case){
            $complist[] = array(
				'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']),
                                'CASE_BY'   => $mcrypt->encrypt($case['CASE_BY']),
                                'CASE_MOB'   => $mcrypt->encrypt($case['CASE_MOB']),
				'CR_BY'     => $mcrypt->encrypt($case['CR_BY']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'DUE_DATE'  => $mcrypt->encrypt($case['DUE_DATE']),
                                'COMP_BY'   => $mcrypt->encrypt($case['COMP_BY']),
                                'COMP_REMARKS'  => $mcrypt->encrypt($case['COMP_REMARKS']),
                                'COMP_STATUS'   => $mcrypt->encrypt($case['COMP_STATUS']),
                                'PROD_CAT'  => $mcrypt->encrypt($case['PROD_CAT']),
                                'PROD_NAME' => $mcrypt->encrypt($case['PROD_NAME']),
                                'COMP_CAT'  => $mcrypt->encrypt($case['COMP_CAT']),
                                'COMP_TYPE' => $mcrypt->encrypt($case['COMP_TYPE'])
			);
            }
        }
        if($role==3)// Approval Authority
        {
             $this->load->model('api/cases');
            $MyCaseData= $this->model_api_cases->appMycaseData();
            foreach($MyCaseData as $case){
               	$complist[] = array(
				'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']),
                                'CASE_BY'   => $mcrypt->encrypt($case['CASE_BY']),
                                'CASE_MOB'   => $mcrypt->encrypt($case['CASE_MOB']),
				'CR_BY'     => $mcrypt->encrypt($case['CR_BY']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'DUE_DATE'  => $mcrypt->encrypt($case['DUE_DATE']),
                                'COMP_BY'   => $mcrypt->encrypt($case['COMP_BY']),
                                'COMP_REMARKS'  => $mcrypt->encrypt($case['COMP_REMARKS']),
                                'COMP_STATUS'   => $mcrypt->encrypt($case['COMP_STATUS']),
                                'PROD_CAT'  => $mcrypt->encrypt($case['PROD_CAT']),
                                'PROD_NAME' => $mcrypt->encrypt($case['PROD_NAME']),
                                'COMP_CAT'  => $mcrypt->encrypt($case['COMP_CAT']),
                                'COMP_TYPE' => $mcrypt->encrypt($case['COMP_TYPE'])
			);
            }
        }
        if($role==6)// Advisory Authority
        {
            $this->load->model('approval/mycases');
        }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist));
        
    }
public  function mycase(){
        $log=new Log("Cases.log");
        $log->write($this->request->post);
        $role=$this->request->post["roleid"];
        $mcrypt = new MCrypt(); 
        $keys = array('userid','roleid','geoid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
        
        //$role=4;
        $role=$this->request->post['roleid'];
        if($role==4)// Resolution Authority
        {
            $this->load->model('api/cases');
            $MyCaseData= $this->model_api_cases->appMycaseData_Ra($this->request->post);
            foreach($MyCaseData as $case){
               	$complist[] = array(
				'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']),
                                'CASE_BY'   => $mcrypt->encrypt($case['CASE_BY']),
                                'CASE_MOB'   => $mcrypt->encrypt($case['CASE_MOB']),
				'CR_BY'     => $mcrypt->encrypt($case['CR_BY']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'DUE_DATE'  => $mcrypt->encrypt($case['DUE_DATE']),
                                'COMP_BY'   => $mcrypt->encrypt($case['COMP_BY']),
                                'COMP_REMARKS'  => $mcrypt->encrypt($case['COMP_REMARKS']),
                                'COMP_STATUS'   => $mcrypt->encrypt($case['COMP_STATUS']),
                                'PROD_CAT'  => $mcrypt->encrypt($case['PROD_CAT']),
                                'PROD_NAME' => $mcrypt->encrypt($case['PROD_NAME']),
                                'COMP_CAT'  => $mcrypt->encrypt($case['COMP_CAT']),
                                'COMP_TYPE' => $mcrypt->encrypt($case['COMP_TYPE'])
			);
            }
        }
        if($role==3)// Approval Authority
        {
             $this->load->model('api/cases');
            $MyCaseData= $this->model_api_cases->appMycaseData_Aa($this->request->post);
            foreach($MyCaseData as $case){
               	$complist[] = array(
				'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']),
                                'CASE_BY'   => $mcrypt->encrypt($case['CASE_BY']),
                                'CASE_MOB'   => $mcrypt->encrypt($case['CASE_MOB']),
				'CR_BY'     => $mcrypt->encrypt($case['CR_BY']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'DUE_DATE'  => $mcrypt->encrypt($case['DUE_DATE']),
                                'COMP_BY'   => $mcrypt->encrypt($case['COMP_BY']),
                                'COMP_REMARKS'  => $mcrypt->encrypt($case['COMP_REMARKS']),
                                'COMP_STATUS'   => $mcrypt->encrypt($case['COMP_STATUS']),
                                'PROD_CAT'  => $mcrypt->encrypt($case['PROD_CAT']),
                                'PROD_NAME' => $mcrypt->encrypt($case['PROD_NAME']),
                                'COMP_CAT'  => $mcrypt->encrypt($case['COMP_CAT']),
                                'COMP_TYPE' => $mcrypt->encrypt($case['COMP_TYPE'])
			);
            }
        }
        if($role==6)// Advisory Authority
        {
            $this->load->model('approval/mycases');
        }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist));
        
    }
        public function mycase_details(){
        $log=new Log("Case_Details.log");
        $log->write($this->request->post);
        $mcrypt = new MCrypt(); 
        $caseid=$mcrypt->decrypt($this->request->post['caseid']);
        $log->write($caseid);
        $this->load->model('api/cases');
        $MyCaseData= $this->model_api_cases->appMycaseData_details($caseid);
            foreach($MyCaseData as $case){
                if(empty($case['CUR_USER']))
                {
                    $CaseOwner= $this->model_api_cases->caseOwner($caseid);
                }
                else{
                    $CaseOwner=$case['CUR_USER'];
                }
               	$compdetails[] = array(
                                'FAR_NAME'   => $mcrypt->encrypt($case['FAR_NAME']),
                                'FAR_MOB'   => $mcrypt->encrypt($case['FAR_MOB']),
				'STATE_NAME'     => $mcrypt->encrypt($case['STATE_NAME']),
                                'DIST_NAME'   => $mcrypt->encrypt($case['DIST_NAME']),
                                'CR_USER'  => $mcrypt->encrypt($case['CR_USER']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'CUR_USER'  => $mcrypt->encrypt($CaseOwner),
                                'PROD_CAT'   => $mcrypt->encrypt($case['PROD_CAT']),
                                'PROD_NAME'  => $mcrypt->encrypt($case['PROD_NAME']),
                                'COMP_ID' => $mcrypt->encrypt($case['COM_ID']),
                                'COMP_CAT'  => $mcrypt->encrypt($case['COM_CAT']),
                                'COMP_TYPE' => $mcrypt->encrypt($case['COM_TYP']),
                                'COMP_TXT'  => $mcrypt->encrypt($case['COM_TXT']),
                                'COMP_STS' => $mcrypt->encrypt($case['COM_STS'])
			);
            }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($compdetails));
    }
        public function mycase_history(){
        $log=new Log("Case_History.log");
        $log->write($this->request->post);
        $mcrypt = new MCrypt(); 
        $caseid=$mcrypt->decrypt($this->request->post['caseid']);
        $log->write($caseid);
        $this->load->model('api/cases');
        $MyCaseData= $this->model_api_cases->appMycaseData_history($caseid);
            foreach($MyCaseData as $case){
               	$comphistory[] = array(
                                'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']),
                                'CASE_BY'   => $mcrypt->encrypt($case['CASE_BY']),
                                'CASE_MOB'  => $mcrypt->encrypt($case['CASE_MOB']),
				'CASE_PRE_STATUS'   => $mcrypt->encrypt($case['CASE_PRE_STATUS']),
                                'CASE_CUR_STATUS'   => $mcrypt->encrypt($case['CASE_CUR_STATUS']),
                                'REMARKS'   => $mcrypt->encrypt($case['SOLUTION']),
                                'CASE_UP_DATE'  => $mcrypt->encrypt($case['CASE_UP_DATE']),
                                'CASE_UP_USER'  => $mcrypt->encrypt($case['UP_USR_NAME']),
                                'CASE_FILE' => $mcrypt->encrypt('http://192.168.1.115/CRM/system/upload/'.$case['UP_FILE_NAME'])
                        );
            }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($comphistory));
    }
    //************************* APP REPORT  SECTION **************************//
     public function allcase_report(){
        $log=new Log("mycase_report.log");
        $log->write($this->request->post);
        $mcrypt = new MCrypt(); 
        $caseid=$mcrypt->decrypt($this->request->post['caseid']);
        $log->write($caseid);
        $this->load->model('api/cases');
        $MyCaseRep= $this->model_api_cases->AllcaseData_report();
        foreach($MyCaseRep as $case){
               	$compreport[] = array(
                                'TOTAL'  => $mcrypt->encrypt($case['COMP_SUB_COUNT']),
                                'NAME'  => $mcrypt->encrypt($case['COMP_SUB_NAME'])
                        );
            }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($compreport));
    }
    public function mycase_report(){
        $log=new Log("mycase_report.log");
        $log->write($this->request->post);
        $this->load->model('api/cases');
        $mcrypt = new MCrypt(); 
        $keys = array('userid','roleid','geoid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
        
        //$role=4;
        $role=$this->request->post['roleid'];
        if($role==4)// Resolution Authority
        {
        $MyCaseRep= $this->model_api_cases->MycaseData_report_Ra($this->request->post);
        foreach($MyCaseRep as $case){
               	$comp[] = array(
                                
                                'TOTAL'  => $mcrypt->encrypt($case['COMP_SUB_COUNT']),
                                'NAME'  => $mcrypt->encrypt($case['COMP_SUB_NAME'])
                        );
            }
      
        }
         if($role==3)// Resolution Authority
        {
        $MyCaseRep= $this->model_api_cases->MycaseData_report_Aa($this->request->post);
        foreach($MyCaseRep as $case){
               	$comp[] = array(
                                
                                'TOTAL'  => $mcrypt->encrypt($case['COMP_SUB_COUNT']),
                                'NAME'  => $mcrypt->encrypt($case['COMP_SUB_NAME'])
                        );
            }
       
        }
         $this->response->addHeader('Content-Type: application/json');
         $log->write($comp);
	 $this->response->setOutput(json_encode($comp));
    }
}