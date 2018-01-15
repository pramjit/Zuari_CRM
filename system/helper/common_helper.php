<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	
	
if (!function_exists('getsurveydatabyid')) {
    
	function getsurveydatabyid($id)
    {
        
          
      
		//$ci =& get_instance();
                //$this->load->model('techfarmer/customerfarmer');
                // $this->model_techfarmer_customerfarmer->getsurveydetails($filter_data);
		//$ci->load->model('techfarmer/customerfarmer');
		//$data=$ci->model_techfarmer_customerfarmer->getsurveydetailsbyid($id);
                // $data=$this->model_techfarmer_customerfarmer->getsurveydetailsbyid($id);
                
                $ci =& get_instance();
		$ci->load->model('techfarmer/customerfarmer');
		$data=$ci->customerfarmer->getsurveydetailsbyid($id);
		if($data){
		return	 $data;
		}
		else return '';
		
    }
}






/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */