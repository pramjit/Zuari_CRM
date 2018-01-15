<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$data['roleid'] = $this->user->getGroupId(); 
		$data['text_retailer'] = $this->language->get('text_retailer');
		$data['text_bulk_dealer'] = $this->language->get('text_bulk_dealer');
                $data['text_create_retailer'] = $this->language->get('text_create_retailer');
                $data['text_search_dealer'] = $this->language->get('text_search_dealer');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_village'] = $this->language->get('text_village');
                $data['text_search_village'] = $this->language->get('text_search_village');
                $data['text_create_village'] = $this->language->get('text_create_village');
                $data['text_product'] = $this->language->get('text_product');
                $data['text_search_product'] = $this->language->get('text_search_product');
                $data['text_add_product'] = $this->language->get('text_add_product');
                $data['text_crop'] = $this->language->get('text_crop');
                $data['text_search_crop'] = $this->language->get('text_search_crop');
                $data['text_add_crop'] = $this->language->get('text_add_crop');
                $data['text_geo'] = $this->language->get('text_geo');
                $data['text_add_geo'] = $this->language->get('text_add_geo');
                $data['text_search_geo'] = $this->language->get('text_search_geo');
                $data['text_user'] = $this->language->get('text_user');
                $data['text_create_user'] = $this->language->get('text_create_user');
                $data['text_add_group'] = $this->language->get('text_add_group');
                $data['text_customer'] = $this->language->get('text_customer');
                $data['text_create_customer'] = $this->language->get('text_create_customer');
                $data['text_add_group_customer'] = $this->language->get('text_add_group_customer');
                $data['text_report'] = $this->language->get('text_report');
                $data['text_mdo_report'] = $this->language->get('text_mdo_report');
                $data['text_monthly_report'] = $this->language->get('text_monthly_report');
                $data['text_market_report'] = $this->language->get('text_market_report');
                $data['text_market_wise_pos_report'] = $this->language->get('text_market_wise_pos_report');
                
                $data['text_milk_collc_daily_report'] = $this->language->get('text_milk_collc_daily_report');
                $data['text_fgm_detail_report'] = $this->language->get('text_fgm_detail_report');
                $data['text_farmer_detail_report'] = $this->language->get('text_farmer_detail_report');
                $data['text_market_activity_report'] = $this->language->get('text_market_activity_report');
                 //farmer,retailer,delar,pos
                 $data['text_farmer'] = $this->language->get('text_farmer');
                 $data['text_farmer_registration'] = $this->language->get('text_farmer_registration');
                 $data['text_retailer_registration'] = $this->language->get('text_retailer_registration');
		 $data['text_delar'] = $this->language->get('text_delar');
                 $data['text_delar_registration'] = $this->language->get('text_delar_registration');
                 $data['text_subdelar'] = $this->language->get('text_subdelar');
                 $data['text_search_retailer'] = $this->language->get('text_search_retailer');
                 $data['text_search_product'] = $this->language->get('text_search_product');
                 $data['text_search_dealerreg'] = $this->language->get('text_search_dealerreg');
                 $data['text_search_subdealerreg'] = $this->language->get('text_search_subdealerreg');
		 $data['text_search_farmer'] = $this->language->get('text_search_farmer');
                 $data['text_farmer_registrationExcel'] = $this->language->get('text_farmer_registrationExcel');
                 $data['text_fgm_farmer_detail_report'] = $this->language->get('text_fgm_farmer_detail_report');
                 $data['text_scheme_master'] = $this->language->get('text_scheme_master');
                 $data['text_scheme'] = $this->language->get('text_scheme');
                 $data['text_pos'] = $this->language->get('text_pos');
                 $data['text_pos_registration'] = $this->language->get('text_pos_registration');
                 $data['text_search_pos'] = $this->language->get('text_search_pos');
                 $data['text_search_scheme'] = $this->language->get('text_search_scheme');
                        

                
                
                
                
                

		$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['bulkdealer'] = $this->url->link('dealer/bulkupload', 'token=' . $this->session->data['token'], 'SSL');
		$data['createretailer'] = $this->url->link('retailer/createretailer', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchdealer'] = $this->url->link('retailer/viewretailer', 'token=' . $this->session->data['token'], 'SSL');
                $data['createVillage'] = $this->url->link('village/createVillage', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchvillage'] = $this->url->link('village/searchvillage', 'token=' . $this->session->data['token'], 'SSL');
                $data['addproduct'] = $this->url->link('product/addproduct', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchproduct'] = $this->url->link('product/searchproduct', 'token=' . $this->session->data['token'], 'SSL');
                $data['addcrop'] = $this->url->link('crop/addcrop', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchcrop'] = $this->url->link('crop/searchcrop', 'token=' . $this->session->data['token'], 'SSL');
                $data['addgeo'] = $this->url->link('geo/addgeo', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchgeo'] = $this->url->link('geo/searchgeo', 'token=' . $this->session->data['token'], 'SSL');
		$data['createuser'] = $this->url->link('user/createuser', 'token=' . $this->session->data['token'], 'SSL');
		$data['addgroup'] = $this->url->link('user/addgroup', 'token=' . $this->session->data['token'], 'SSL');
                $data['createcustomer'] = $this->url->link('customer/createcustomer', 'token=' . $this->session->data['token'], 'SSL');
                $data['addgroupcustomer'] = $this->url->link('customer/addgroupcustomer', 'token=' . $this->session->data['token'], 'SSL');
                $data['mdoReport'] = $this->url->link('Report/attendancereport', 'token=' . $this->session->data['token'], 'SSL');
                $data['monthlyreport'] = $this->url->link('Report/monthlyreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['marketreport'] = $this->url->link('Report/marketreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['marketwiseposreport'] = $this->url->link('Report/marketwiseposreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['fgm_farmer_detail_report'] = $this->url->link('Report/fgmfarmerdetailreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['milkclocdailyreport'] = $this->url->link('Report/milkcollcdailyreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['fgmdlreport'] = $this->url->link('Report/fgmdlreport', 'token=' . $this->session->data['token'], 'SSL');
                $data['farmerdlreport'] = $this->url->link('Report/farmerdlrept', 'token=' . $this->session->data['token'], 'SSL');
                $data['marketactivityrepo'] = $this->url->link('Report/marketactivityrepo', 'token=' . $this->session->data['token'], 'SSL');
                 //farmer
                $data['farmerregistration'] = $this->url->link('farmer/farmerregistration', 'token=' . $this->session->data['token'], 'SSL');

                //retailer reg
               $data['retailerregistration'] = $this->url->link('retailer/retailerregistration', 'token=' . $this->session->data['token'], 'SSL');
               
               //delar reg
                $data['delarregistration'] = $this->url->link('delar/delarregistration&id=64', 'token=' . $this->session->data['token'], 'SSL');
                
                //sub dealar
                $data['subdealar'] = $this->url->link('delar/delarregistration&id=68', 'token=' . $this->session->data['token'], 'SSL');
                 //view reatilar
                $data['searchretailer'] = $this->url->link('retailer/viewretailerreg', 'token=' . $this->session->data['token'], 'SSL');
               //view product
                $data['searchproduct'] = $this->url->link('product/viewproduct', 'token=' . $this->session->data['token'], 'SSL');
                // view dealer
                $data['searchdealerreg'] = $this->url->link('delar/viewdealer', 'token=' . $this->session->data['token'], 'SSL');
                    //view sub dealer
                $data['searchsubdealerreg'] = $this->url->link('delar/viewsubdealer', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchfarmer'] = $this->url->link('farmer/viewfarmer', 'token=' . $this->session->data['token'], 'SSL');
                $data['farmerregistrationExcel'] = $this->url->link('farmer/farmerbulkupload', 'token=' . $this->session->data['token'], 'SSL');
                $data['scheme_master'] = $this->url->link('scheme/schemeregister', 'token=' . $this->session->data['token'], 'SSL');
                $data['posregistration'] = $this->url->link('pos/posregistration', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchpos'] = $this->url->link('pos/viewpos', 'token=' . $this->session->data['token'], 'SSL');
                $data['searchscheme'] = $this->url->link('scheme/viewscheme', 'token=' . $this->session->data['token'], 'SSL');

                return $this->load->view('common/menu.tpl', $data);
	}
}

