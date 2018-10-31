<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$data['roleid'] = $this->customer->getGroupId();
		$data['text_dealer'] = $this->language->get('text_dealer');
                $data['text_dashboard'] = $this->language->get('text_dashboard');
                $data['text_report'] = $this->language->get('text_report');
                $data['text_missed_call'] = $this->language->get('text_missed_call');
                
		        $data['home'] = $this->url->link('common/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['missedcall'] = $this->url->link('report/missedcall', 'token='.$this->session->data['token'], 'SSL');
				$data['whatscall'] = $this->url->link('report/whatsapp', 'token='.$this->session->data['token'], 'SSL');
				$data['advisory'] = $this->url->link('report/advisory', 'token='.$this->session->data['token'], 'SSL');
				$data['complain'] = $this->url->link('report/complain', 'token='.$this->session->data['token'], 'SSL');
                $data['retailerdata'] = $this->url->link('retailer/register', 'token='.$this->session->data['token'], 'SSL');
                $data['farmercalldata'] = $this->url->link('farmer/register', 'token='.$this->session->data['token'], 'SSL');
				$data['otherscall'] = $this->url->link('farmer/othercall', 'token='.$this->session->data['token'], 'SSL');
                $data['missedcalldata'] = $this->url->link('call/missedcall', 'token='.$this->session->data['token'], 'SSL');
                $data['feedbackdata'] = $this->url->link('call/feedback', 'token='.$this->session->data['token'], 'SSL');
                $data['reviewdata'] = $this->url->link('call/review', 'token='.$this->session->data['token'], 'SSL');
		$data['advisorydata'] = $this->url->link('call/advisory', 'token='.$this->session->data['token'], 'SSL');
                $data['appserdata'] = $this->url->link('call/appservice', 'token='.$this->session->data['token'], 'SSL');
                /*
                $data['COM_DASHBOARD'] = $this->url->link('complaint/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_MY_CASES'] = $this->url->link('complaint/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_ALL_CASES'] = $this->url->link('complaint/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_REPORT'] = $this->url->link('complaint/report', 'token='.$this->session->data['token'], 'SSL');
                
                */
				$data['COM_DETAILS'] = $this->url->link('complaint/complaindetails', 'token='.$this->session->data['token'], 'SSL');
                $data['COM_FARMER'] = $this->url->link('complaint/farmerreportcomplaint', 'token='.$this->session->data['token'], 'SSL');
				
                $data['RA_DASHBOARD'] = $this->url->link('resolution/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_MY_CASES'] = $this->url->link('resolution/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_ALL_CASES'] = $this->url->link('resolution/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['RA_REPORT'] = $this->url->link('resolution/report', 'token='.$this->session->data['token'], 'SSL');
                
                
                $data['AA_DASHBOARD'] = $this->url->link('approval/dashboard', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_MY_CASES'] = $this->url->link('approval/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_ALL_CASES'] = $this->url->link('approval/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['AA_REPORT'] = $this->url->link('approval/report', 'token='.$this->session->data['token'], 'SSL');
				$data['CALL_REPORT'] = $this->url->link('advisory/callreport', 'token='.$this->session->data['token'], 'SSL');
                
                
                $data['AD_DASHBOARD'] = $this->url->link('advisory/dashboard', 'token='.$this->session->data['token'], 'SSL');
				$data['AD_PENDING_CASES'] = $this->url->link('advisory/advisory', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_MY_CASES'] = $this->url->link('advisory/mycases', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_ALL_CASES'] = $this->url->link('advisory/allcases', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_REPORT'] = $this->url->link('advisory/report', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_COMPLAINT'] = $this->url->link('advisory/complain', 'token='.$this->session->data['token'], 'SSL');
				$data['AD_HEAD'] = $this->url->link('advisory/headwise', 'token='.$this->session->data['token'], 'SSL');
                $data['AD_FARMER'] = $this->url->link('advisory/farmerreport', 'token='.$this->session->data['token'], 'SSL');
				
				$data['ADV_STATE'] = $this->url->link('adminreport/agroreportstatewise', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL'] = $this->url->link('adminreport/agroreportstatewisetotal', 'token='.$this->session->data['token'], 'SSL');
	            $data['ADV_TOTAL_SUMMARY'] = $this->url->link('adminreport/agroreportsummary', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAILS'] = $this->url->link('adminreport/agroreportdetails', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAILS_4'] = $this->url->link('adminreport/farmerdetailreport4', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL_SUMMARY_4'] = $this->url->link('adminreport/farmersummaryreport4', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL_SUMMARY_3'] = $this->url->link('adminreport/farmersummaryreport', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL_DETAIL_3'] = $this->url->link('adminreport/farmerdetailreport', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL_SUMMARY_6'] = $this->url->link('adminreport/advisoryreportbusysummary', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAILS_6'] = $this->url->link('adminreport/advisoryreportbusydetail', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_TOTAL_SUMMARY_7'] = $this->url->link('adminreport/advisorysummaryopen', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAILS_7'] = $this->url->link('adminreport/advisorydetailopen', 'token='.$this->session->data['token'], 'SSL');
			    $data['ADV_TOTAL_SUMMARY_5'] = $this->url->link('adminreport/headwisesummary', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAILS_5'] = $this->url->link('adminreport/headwise', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_SUMMARY_8'] = $this->url->link('adminreport/complaintsummaryreport', 'token='.$this->session->data['token'], 'SSL');
				$data['ADV_STATE_DETAIL_8'] = $this->url->link('adminreport/complaintdetailreport', 'token='.$this->session->data['token'], 'SSL');
                                $data['ADV_STATE_HISTORY_8'] = $this->url->link('adminreport/complainthistory', 'token='.$this->session->data['token'], 'SSL');
				
            return $this->load->view('default/template/common/menu.tpl', $data);
	}
}