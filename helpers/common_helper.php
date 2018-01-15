<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	function refreshCache(){
		
		$ci =& get_instance();
		$ci->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$ci->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$ci->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$ci->output->set_header('Pragma: no-cache');
	
	}
	
if (!function_exists('getIndustryinmaster')) {
    
	function getIndustryinmaster($industry)
    {
        
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getIndustryinmaster($industry);
		if($data){
		return	 $data->industry_name;
		}
		else return '';
		
    }
}	
if (!function_exists('getratinginmaster')) {
    
	function getratinginmaster($rating)
    {
        
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getratinginmaster($rating);
		if($data){
		return	 $data->rating_name;
		}
		else return '';
		
    }
}	
if (!function_exists('getuserid')) {
    
	function getuserid($userid)
    {
        
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getuserid($userid);
		if($data){
		return	 $data->fname.' '.$data->mname.' '.$data->lname;
		}
		else return '';
		
    }
}	
if (!function_exists('getcampaignStatus')) {
    
	function getcampaignStatus($status)
    {
        $ci =& get_instance();
		if($status==0)
		{
		return	 'Inactive';
		}
		if($status==1)
		{
		return	 'Active';
		}
		if($status==2)
		{
		return	 'Planning';
		}
		if($status==3)
		{
		return	 'Complete';
		}
		
		
		
    }
}
if (!function_exists('account_type')) {
    
	function account_type($type)
    {
        $ci =& get_instance();
		if($type=='Customer')
		{
		return	 'U';
		}
		if($type=='Supplier')
		{
		return	 'R';
		}
		
    }
}
if (!function_exists('getleadSources')) {
    
	function getleadSources($Source)
    {
        $ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadSources($Source);
		if($data){
		return	 $data->source_id;
		}
		else return '';
		
		
		
    }
}

if (!function_exists('getleadSourcesbyvalue')) {
    
	function getleadSourcesbyvalue($Source)
    {
        $ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadSourcesbyvalue($Source);
		if($data){
		return	 $data->source_name;
		}
		else return '';
		
		
		
		
    }
}

if (!function_exists('getleadIndustry')) {
    
	function getleadIndustry($Industry)
    {
        
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadIndustry($Industry);
		if($data){
		return	 $data->industry_id;
		}
		else return '';
		
		
		
    }
}

if (!function_exists('getleadIndustrybyid')) {
    
	function getleadIndustrybyid($Industry)
    {
       
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadIndustrybyid($Industry);
		if($data){
		return	 $data->industry_name;
		}
		else return '';
		
		
		
    }
}

if (!function_exists('getleadStatus')) {
    
	function getleadStatus($Status)
    {
       
		$ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadStatus($Status);
		if($data){
		return	 $data->status_id;
		}
		else return '';
		
		
		
    }
}


if (!function_exists('getleadStatusbyvalue')) {
    
	function getleadStatusbyvalue($Status)
    {
        $ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadStatusbyvalue($Status);
		if($data){
		return	 $data->status_name;
		}
		else return '';
		
		
    }
}


if (!function_exists('getpriority')) {
    
	function getpriority($priority)
    {
        $ci =& get_instance();
		if($priority==1)
		{
		return	 'high';
		}
		else if($priority==2)
		{
		return	 'highest';
		}
		else if($priority==3)
		{
		return	 'Low';
		}
		else if($priority==4)
		{
		return	 'lowest';
		}
		else if($priority==5)
		{
		return	 'Normal';
		}
    }
}

if (!function_exists('getleadRating')) {
    
	function getleadRating($Rating)
    {
        $ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadRating($Rating);
		if($data){
		return	 $data->rating_id;
		}
		else return '';
		
		
		
    }
}

if (!function_exists('getleadRatingbyvalue')) {
    
	function getleadRatingbyvalue($Rating)
    {
        $ci =& get_instance();
		$ci->load->model('crm/lead_model');
		$data=$ci->lead_model->getleadRatingbyvalue($Rating);
		if($data){
		return	 $data->rating_name;
		}
		else return '';
		
		
    }
}
if (!function_exists('getleadTitle')) {
    
	function getleadTitle($title)
    {
        $ci =& get_instance();
		if($title=='Mr.')
		{
		return	 '1';
		}
		else if($title=='Ms.')
		{
		return	 '2';
		}
		else if($title=='Mrs.')
		{
		return	 '3';
		}
		
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}


if (!function_exists('getleadTitlebyvalue')) {
    
	function getleadTitlebyvalue($title)
    {
        $ci =& get_instance();
		if($title==1)
		{
		return	 'Mr.';
		}
		else if($title==2)
		{
		return	 'Ms.';
		}
		else if($title==3)
		{
		return	 'Mrs.';
		}
		
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}

if (!function_exists('getAccountType')) {
    
	function getAccountType($type)
    {
        $ci =& get_instance();
		if($type=='Analyst')
		{
		return	 '1';
		}
		else if($type=='Competitor')
		{
		return	 '2';
		}
		else if($type=='Customer')
		{
		return	 '3';
		}
		else if($type=='Distributor')
		{
		return	 '4';
		}
		else if($type=='Integrator')
		{
		return	 '5';
		}
		else if($type=='Investor')
		{
		return	 '6';
		}
		else if($type=='Other')
		{
		return	 '7';
		}
		else if($type=='Partner')
		{
		return	 '8';
		}
		else if($type=='Press')
		{
		return	 '9';
		}
		else if($type=='Prospect')
		{
		return	 '10';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}

if (!function_exists('getAccountTypebyvalue')) {
    
	function getAccountTypebyvalue($type)
    {
        $ci =& get_instance();
		if($type==1)
		{
		return	 'Analyst';
		}
		else if($type==2)
		{
		return	 'Competitor';
		}
		else if($type==3)
		{
		return	 'Customer';
		}
		else if($type==4)
		{
		return	 'Distributor';
		}
		else if($type==5)
		{
		return	 'Integrator';
		}
		else if($type==6)
		{
		return	 'Investor';
		}
		else if($type==7)
		{
		return	 'Other';
		}
		else if($type==8)
		{
		return	 'Partner';
		}
		else if($type==9)
		{
		return	 'Press';
		}
		else if($type==10)
		{
		return	 'Prospect';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}
if (!function_exists('getOwnership')) {
    
	function getOwnership($ownership)
    {
        $ci =& get_instance();
		if($ownership=='Other')
		{
		return	 '1';
		}
		else if($ownership=='Private')
		{
		return	 '2';
		}
		else if($ownership=='Public')
		{
		return	 '3';
		}
		else if($ownership=='Subsidiary')
		{
		return	 '4';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}
if (!function_exists('getOwnershipbyvalue')) {
    
	function getOwnershipbyvalue($ownership)
    {
        $ci =& get_instance();
		if($ownership==1)
		{
		return	 'Other';
		}
		else if($ownership==2)
		{
		return	 'Private';
		}
		else if($ownership==3)
		{
		return	 'Public';
		}
		else if($ownership==4)
		{
		return	 'Subsidiary';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}

if (!function_exists('getPotentialType')) {
    
	function getPotentialType($ownership)
    {
        $ci =& get_instance();
		if($ownership=='Existing Business')
		{
		return	 '1';
		}
		else if($ownership=='New Business')
		{
		return	 '2';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}


if (!function_exists('getPotentialTypebyvalue')) {
    
	function getPotentialTypebyvalue($ownership)
    {
        $ci =& get_instance();
		if($ownership==1)
		{
		return	 'Existing Business';
		}
		else if($ownership==2)
		{
		return	 'New Business';
		}
		
		else
		{
		return	 '0';
		}
		
		
		
    }
}


if (!function_exists('getstage')) {
    
	function getstage($stage)
    {
        $ci =& get_instance();
		if($stage=='Qualification')
		{
		return	 '1';
		}
		else if($stage=='Need Analysis')
		{
		return	 '2';
		}
		else if($stage=='Value Preposition')
		{
		return	 '3';
		}
		else if($stage=='Id. Decision Makers')
		{
		return	 '4';
		}
		else if($stage=='Proposal/Price Quote')
		{
		return	 '5';
		}
		else if($stage=='Negotiation/Review')
		{
		return	 '6';
		}
		else if($stage=='Closed Won')
		{
		return	 '7';
		}
		else if($stage=='Closed Lost')
		{
		return	 '8';
		}
		else if($stage=='Closed Lost to Competition')
		{
		return	 '9';
		}
		
		
		else
		{
		return	 '0';
		}
		
    }
}
if (!function_exists('getstagebyvalue')) {
    
	function getstagebyvalue($stage)
    {
        $ci =& get_instance();
		if($stage==1)
		{
		return	 'Qualification';
		}
		else if($stage==2)
		{
		return	 'Need Analysis';
		}
		else if($stage==3)
		{
		return	 'Value Preposition';
		}
		else if($stage==4)
		{
		return	 'Id. Decision Makers';
		}
		else if($stage==5)
		{
		return	 'Proposal/Price Quote';
		}
		else if($stage==6)
		{
		return	 'Negotiation/Review';
		}
		else if($stage==7)
		{
		return	 'Closed Won';
		}
		else if($stage==8)
		{
		return	 'Closed Lost';
		}
		else if($stage==9)
		{
		return	 'Closed Lost to Competition';
		}
		
		else
		{
		return	 '0';
		}
		
    }
}
if (!function_exists('getCompaignType')) {
    
	function getCompaignType($type)
    {
        $ci =& get_instance();
		if($type=='conference')
		{
		return	 '1';
		}
		else if($type=='webinar')
		{
		return	 '2';
		}
		else if($type=='Trade show')
		{
		return	 '3';
		}
		else if($type=='Public relation')
		{
		return	 '4';
		}
		else if($type=='partner')
		{
		return	 '5';
		}
		else if($type=='Referral program')
		{
		return	 '6';
		}
		else if($type=='Advertisement')
		{
		return	 '7';
		}
		else if($type=='Banner ads')
		{
		return	 '8';
		}
		else if($type=='Direct mail')
		{
		return	 '9';
		}
		else if($type=='Email')
		{
		return	 '10';
		}
		else if($type=='Tele marketing')
		{
		return	 '11';
		}
		else if($type=='others')
		{
		return	 '12';
		}
		else
		{
		return	 '0';
		}
		
		
		
    }
}
if (!function_exists('getCompaignTypebyvalue')) {
    
	function getCompaignTypebyvalue($type)
    {
        $ci =& get_instance();
		if($type==1)
		{
		return	 'conference';
		}
		else if($type==2)
		{
		return	 'webinar';
		}
		else if($type==3)
		{
		return	 'Trade show';
		}
		else if($type==4)
		{
		return	 'Public relation';
		}
		else if($type==5)
		{
		return	 'partner';
		}
		else if($type==6)
		{
		return	 'Referral program';
		}
		else if($type==7)
		{
		return	 'Advertisement';
		}
		else if($type==8)
		{
		return	 'Banner ads';
		}
		else if($type==9)
		{
		return	 'Direct mail';
		}
		else if($type==10)
		{
		return	 'Email';
		}
		else if($type==11)
		{
		return	 'Tele marketing';
		}
		else if($type==12)
		{
		return	 'others';
		}
		else
		{
		return	 '0';
		}
		
		
		
    }
}

if (!function_exists('getCompaignStatus')) {
    
	function getCompaignStatus($Status)
    {
        $ci =& get_instance();
		if($Status=='Active')
		{
		return	 '1';
		}
		else if($Status=='Planning')
		{
		return	 '2';
		}
		else if($Status=='Inactive')
		{
		return	 '0';
		}
		else if($Status=='Complete')
		{
		return	 '3';
		}
		
		else
		{
		return	 '4';
		}
		
		
		
    }
}
if (!function_exists('getCompaignStatusbyvalue')) {
    
	function getCompaignStatusbyvalue($Status)
    {
        $ci =& get_instance();
		if($Status==1)
		{
		return	 'Active';
		}
		else if($Status==2)
		{
		return	 'Planning';
		}
		else if($Status==0)
		{
		return	 'Inactive';
		}
		else if($Status==3)
		{
		return	 'Complete';
		}
		
		else
		{
		return	 '4';
		}
		
		
		
    }
	
	
	function generate_uniqueid() {
	  $random = '';
	  for ($i = 0; $i < 8; $i++) {
		$random .= chr(rand(ord('A'), ord('Z')));
	  }
	  return $random;
	}

	function generate_random_password() {
	  $random = '';
	  for ($i = 0; $i < 6; $i++) {
		$random .= chr(rand(ord('a'), ord('z')));
	  }
	  return $random;
	}
}

/* End of file common_helper.php */
/* Location: ./application/helpers/common_helper.php */