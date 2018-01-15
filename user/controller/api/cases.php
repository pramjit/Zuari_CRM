<?php
class ControllerApicases extends Controller {
public  function allcase(){
        $log=new Log("Cases".date('d_m_Y').".log");
        $log->write($this->request->post);
       
        $mcrypt = new MCrypt(); 
        $keys = array('userid','roleid','geoid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
        
        
            $this->load->model('api/cases');
            $MyCaseData= $this->model_api_cases->appMycaseData($this->request->post);
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
            //$this->load->model('approval/mycases');
             $this->load->model('api/cases');
             $MyCaseData= $this->model_api_cases->appMycaseData_Adv($this->request->post);
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
        if($role==6)//  AUTHORITY Authority
        {
        $MyCaseRep= $this->model_api_cases->MycaseData_report_Adv($this->request->post);
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
    public function mycase_remarks(){
        
        $log=new Log("mycase_remarks.log");
        $log->write($this->request->post);
        $this->load->model('api/cases');
        $mcrypt = new MCrypt();
        $keys = array('remarks','roleid','type','caseid','userid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
       
       $role=4;
       $role=$this->request->post['roleid'];
       if($role==4)// Resolution Authority
      {
       $MyCaseRep= $this->model_api_cases->MycaseData_remarks_Ra($this->request->post);
    
       if($MyCaseRep==1){$comp=1;}else{$comp=2;}
      }
         $this->response->addHeader('Content-Type: application/json');
         $log->write($comp);
         $this->response->setOutput(json_encode($comp));
   }
   
   //***********************Update Advisory Status Start**************************//
    public function update_status_adv(){
        
        $log=new Log("update_status_adv.log");
        $log->write($this->request->post);
        $this->load->model('api/cases');
        $mcrypt = new MCrypt();
        $keys = array('roleid','case_status','caseid','userid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        //write log 
        $log->write($this->request->post);
    
        $role=$this->request->post['roleid'];
        if($role==6)// Resolution Authority
        {
         $MyCaseRep= $this->model_api_cases->Adv_status_update($this->request->post);

        if($MyCaseRep==1){$comp=1;}else{$comp=2;}
        }
          $this->response->addHeader('Content-Type: application/json');
          $log->write($comp);
          $this->response->setOutput(json_encode($comp));
   }
   //***********************Update Advisory Status End**************************//
  //***********************Pending Advisory Approval Start**************************//
  public  function mycaseadv(){
        $log=new Log("mycaseadv.log");
        $log->write($this->request->post);
        $mcrypt = new MCrypt(); 
        $keys = array('userid','roleid','geoid');
        foreach ($keys as $key) {
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
        $log->write($this->request->post);
        $role=$this->request->post['roleid'];
        if($role==6)
        {
            $this->load->model('api/cases');
            $data= $this->model_api_cases->appMyCaseAdv_approval($this->request->post);
            foreach($data as $case){
               	$complist[] = array(
				'CASE_ID'   => $mcrypt->encrypt($case['CASE_ID']), 
                                'CASE_PIN'  => $mcrypt->encrypt($case['CASE_PIN']),
                                'FAR_MOB'   => $mcrypt->encrypt($case['FAR_MOB']),
                                'CR_DATE'   => $mcrypt->encrypt($case['CR_DATE']),
                                'CASE_STATUS'   => $mcrypt->encrypt($case['CASE_STATUS'])
                               
			);
            }
        }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist));
  }
   
   //***********************Pending Advisory Approval End**************************//
   //***********************Submit Pending Advisory Approval Start**************************//
  public function mycase_adv_pending()
  {  
      $log=new Log("mycase_adv_pending.log");
      $log->write($this->request->post);
      $mcrypt = new MCrypt(); 
      $keys = array('userid','roleid','caseid');
      foreach ($keys as $key){
                $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
        }
      $log->write($this->request->post);
      $role=$this->request->post['roleid'];
      if($role==6){
            $this->load->model('api/cases');
            $data= $this->model_api_cases->appMycaseAdvisoryPending($this->request->post);
            foreach($data as $case){
            $complist[] = array(
				'CASE_ID'     => $mcrypt->encrypt($case['CASE_ID']), 
                                'CASE_PIN'    => $mcrypt->encrypt($case['CASE_PIN']),
                                'FAR_MOB'     => $mcrypt->encrypt($case['FAR_MOB']),
                                'CR_DATE'     => $mcrypt->encrypt($case['CR_DATE']),
                                'TOT_ATTEMPT' => $mcrypt->encrypt($case['TOT_ATTEMPT']),
                                'STATE'       => $mcrypt->encrypt($case['STATENAME']),
                                'CASE_STATUS' => $mcrypt->encrypt($case['CASE_STATUS'])
                               
	    );
         }
      
   
   }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist)); 
  }
    //***********************Submit Pending Advisory Approval End**************************//

  //*****************************Advisory Case Details Start***********************//
   public function mycase_adv_case_details(){  
      $log=new Log("mycase_adv_case_details.log");
      $log->write($this->request->post);
      
      $mcrypt = new MCrypt(); 
      $keys = array('userid','roleid','caseid');
      foreach ($keys as $key) {
        $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
      }
      $log->write($this->request->post);
      $role=$this->request->post['roleid'];
      if($role==6){
            $this->load->model('api/cases');
            $data= $this->model_api_cases->appMycaseAdvisoryCases($this->request->post);
            if($data){
               foreach($data as $case){
               $complist[] = array(
				'ADV_HEAD'          => $mcrypt->encrypt($case['ADV_HEAD']), 
                                'ADV_HEAD_DETAILS'  => $mcrypt->encrypt($case['ADV_HEAD_DETAILS']),
                                'CROP_DETAILS'      => $mcrypt->encrypt($case['CROP_DETAILS'])
                               
                                 );
                               }  
            }else {
                $complist['ADV_HEAD']="NA";
                $complist['ADV_HEAD_DETAILS']="NA";
                $complist['CROP_DETAILS']="NA";
                
            }
            $RecData= $this->model_api_cases->appMycaseAdvisoryRec($this->request->post);
            if($RecData){
                $pin=$RecData['CASE_PIN'];
                $to_mob=$RecData['TO_MOB'];
                $from_mob=$RecData['FROM_MOB'];                 
                /////////////////////////////////////////////////////////
                $basepath=DIR_IMAGE; //File Source
                $filelist=array();
                if(is_dir($basepath)){
                    if($dh = opendir($basepath)){
                            while(($file= readdir($dh))!== FALSE){

                                if(($file!=='.') && ($file!=='..') && (substr($file,0,4)==$pin) && (substr($file,5,10)==$from_mob)&& (substr($file,36,10)==$to_mob)){
                                    array_push($filelist,$file);
                                }
                            }
                            closedir($dh);
                        }
                }
                   //$log=new Log("audioid.log");
                   //$log->write($filelist);
                $tot=count($filelist);
                if($tot==0){
                    $audio='NA';
                }
                else{
                    $file = $filelist[$tot-1];
                    $audio="http://zuari.akshapp.com/image/".$file;
                }
            }
            $complist['url']=$audio;
         }
        
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist)); 
  }
  //*****************************Advisory Case Details End***********************//
  //*****************************Advisory Case Details Start***********************//
   public function mycase_adv_crop_insert(){  
      $log=new Log("mycase_adv_crop_insert.log");
      $log->write($this->request->post);
      $mcrypt = new MCrypt(); 
      $keys = array('userid','roleid','caseid','other1','head1','head2','head3','head4','head5','other2','cropdetail1','cropdetail2','cropdetail3','cropdetail4','cropdetail5','other3');
      foreach ($keys as $key) {
        $this->request->post[$key] =$mcrypt->decrypt($this->request->post[$key]) ;            
      }
      $log->write($this->request->post);
      $role=$this->request->post['roleid'];
      if($role==6){
            $this->load->model('api/cases');
            $data= $this->model_api_cases->appMycaseAdvisoryCasesUpdate($this->request->post);
            if($data==1){
               $complist=1;
            }else {
                $complist=0;
            }
        
         }
        $this->response->addHeader('Content-Type: application/json');
	$this->response->setOutput(json_encode($complist)); 
  }
  //*****************************Advisory Case Details End***********************//
  
  
 }