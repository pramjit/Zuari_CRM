<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sms
 *
 * @author agent
 */
class sms {
public function __construct($registry) {
    $this->config = $registry->get('config');
		$this->db = $registry->get('db');
    $this->request = $registry->get('request');
		$this->session = $registry->get('session');
}

public function sendsms($mobile,$message,$customer_info,$vartype = '',$vartype1 = '',$vartype2 = '')
    {
    
$log=new Log("sms.log");
$log->write($this->getsms($message));
$smsmsg=$this->getsms($message);
    $response ="";
    if(isset($mobile)&&isset($message)&&is_numeric($mobile)){
    $api_info=array();
    $api_info["User"]=SMS_USERNAME;
    $api_info["passwd"]=SMS_PASSWORD;
    $api_info["sid"]=SMS_DISPLAYNAME;
    $api_info["mobilenumber"]=$mobile;
if (strpos($smsmsg["MESSAGE"], '*') !== false) {


    $api_info["message"]=str_replace('*', $vartype, $smsmsg["MESSAGE"]); 
    $smsmsg["MESSAGE"]= $api_info["message"];

}  if (strpos($smsmsg["MESSAGE"], '#') !== false) {


    $api_info["message"]=str_replace('#', $vartype1, $smsmsg["MESSAGE"]); 
     $smsmsg["MESSAGE"]= $api_info["message"];

}  if (strpos($smsmsg["MESSAGE"], '$') !== false) {


    $api_info["message"]=str_replace('$', $vartype2, $smsmsg["MESSAGE"]); 
     $smsmsg["MESSAGE"]= $api_info["message"];

}

                $log->write($api_info);
                $curl = curl_init();
                // Set SSL if required
                if (substr(SMS_HOSTNAME, 0, 5) == 'https') {
                    curl_setopt($curl, CURLOPT_PORT, 443);
                }
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLINFO_HEADER_OUT, true);
                curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, SMS_HOSTNAME );
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));
                $jsonsms = curl_exec($curl);                
                $log->write($jsonsms);
			if ($customer_info) {
				

				$activity_data = array(
					'customer_id' => $customer_info['customer_id'],
					'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname'],
                                    'resp'=>$jsonsms,
					'smsinfo'=>$api_info['message']
				);
				$this->addActivity('sms', $activity_data);
			}    

                    curl_close($curl);
    }
                return $response;
            }
            
            
            
            public function getsms($id){
                
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sms WHERE LOWER(SID) = '" . $this->db->escape(utf8_strtolower($id)) . "'");

		return $query->row;
            }




            public function addActivity($key, $data) 
		{
		if (isset($data['customer_id'])) {
			$customer_id = $data['customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_activity` SET `customer_id` = '" . (int)$customer_id . "', `key` = '" . $this->db->escape($key) . "', `data` = '" . $this->db->escape(serialize($data)) . "', `ip` = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', `date_added` = NOW()");
	}


public function smsinsert($data){
            $msg_time=date('H:i:s');
            $sql="INSERT INTO " . DB_PREFIX . "sms_record SET MOBILE_NO='".$data["MOBILE_NO"]."',MESSAGE='".$data["MESSAGE"]."',MESSAGE_DATE='".$data['MESSAGE_DATE']."',MESSAGE_TIME='".$msg_time."',MESSAGE_PROCESSED='0',TRANSACTIONID='".$data["TRANSACTIONID"]."',STATE='0'";
            $this->db->query($sql);
            $ret_id = $this->db->countAffected();
            return $ret_id;
        }
        
        public function updateSms($msgid,$TRANSACTIONID){
            
        $message_sent=$this->getsms($msgid)["MESSAGE"];
        
           
            $sql="update  " . DB_PREFIX . "sms_record SET message_sent='".$message_sent."',MESSAGE_PROCESSED='1' where TRANSACTIONID='".$TRANSACTIONID."'";
            $this->db->query($sql);
            $ret_id = $this->db->countAffected();
            return $ret_id;
        
        }




}
