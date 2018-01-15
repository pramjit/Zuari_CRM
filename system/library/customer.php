<?php
class Customer {
	private $customer_id;
	private $firstname;
	private $lastname;
	private $email;
	private $telephone;
        private $userid;
        private $fax;
	private $newsletter;
	private $customer_group_id;
	private $address_id;
        private $state_id;
        private $district_id;
        private $hq_id;

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['customer_id'])) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND status = '1'");
			if ($customer_query->num_rows) {
				$this->customer_id = $customer_query->row['customer_id'];
				$this->firstname = $customer_query->row['firstname'];
				$this->lastname = $customer_query->row['lastname'];
				$this->email = $customer_query->row['email'];
				$this->telephone = $customer_query->row['telephone'];
				
				$this->customer_group_id = $customer_query->row['customer_group_id'];
				$this->address_id = $customer_query->row['address'];
                                $this->state_id = $customer_query->row['state_id'];
                                $this->district_id = $customer_query->row['district_id'];
                                $this->hq_id = $customer_query->row['hq_id'];
                                  $this->userid= $customer_query->row['User_Id'];

				$this->db->query("UPDATE " . DB_PREFIX . "customer SET  ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$this->session->data['customer_id'] . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");

				if (!$query->num_rows) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "customer_ip SET customer_id = '" . (int)$this->session->data['customer_id'] . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', date_added = NOW()");
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(User_Id) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			$customer_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(User_Id) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}

		if ($customer_query->num_rows) {
			$this->session->data['customer_id'] = $customer_query->row['customer_id'];
 			$this->customer_id = $customer_query->row['customer_id'];
			$this->firstname = $customer_query->row['firstname'];
			$this->lastname = $customer_query->row['lastname'];
			$this->email = $customer_query->row['email'];
			$this->telephone = $customer_query->row['telephone'];						
			$this->customer_group_id = $customer_query->row['customer_group_id'];
			$this->address_id = $customer_query->row['address'];
                        $this->state_id = $customer_query->row['state_id'];
                        $this->district_id = $customer_query->row['district_id'];
                        $this->hq_id = $customer_query->row['hq_id'];
                         $this->userid= $customer_query->row['User_Id'];
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE customer_id = '" . (int)$this->customer_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		

		unset($this->session->data['customer_id']);

		$this->customer_id = '';
		$this->firstname = '';
		$this->lastname = '';
		$this->email = '';
		$this->telephone = '';
		
		$this->customer_group_id = '';
		$this->address_id = '';
	}

	public function isLogged() {
		return $this->customer_id;
	}
        public function getUserId() {
		return $this->userid;
	}
 
	public function getId() {
		return $this->customer_id;
	}

	public function getFirstName() {
		return $this->firstname;
	}

	public function getLastName() {
		return $this->lastname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function getFax() {
		return $this->fax;
	}

	public function getNewsletter() {
		return $this->newsletter;
	}

	public function getGroupId() {
		return $this->customer_group_id;
	}

	public function getAddressId() {
		return $this->address_id;
	}
        public function getStateId() {
		return $this->state_id;
	}
        
        public function getDistrictId() {
		return $this->district_id;
	}
        
        public function getHqId() {
		return $this->hq_id;
	}

	
        public function sentgcmdata($emp_id,$message,$del=false) {  
            
            $reciver_device_id =$this->db->query("SELECT * from " . DB_PREFIX . "customer WHERE customer_id = '" . $emp_id . "'")->row["appid"];
            $registrationIds = array(  $reciver_device_id );
            ////////////////////////
            $msg = array
            (               
                 'message'     => $message,
    'title'        => $message,
    'subtitle'    => '',
    'tickerText'    => '',
    'vibrate'    => 1,
    'sound'        => 1,
    'largeIcon'    => 'large_icon',
    'smallIcon'    => 'small_icon'
            );
            $notmsg=array();
            if($del){
        $notmsg = array
            (               
      "body"=> "del",
      "title" =>"del"
            );}  else {
            $notmsg = array
            (               
      "body"=> $message,
      "title" =>"app"
            );
}
            $fields = array
            (
                'registration_ids'     => $registrationIds,
                'data'            => $msg,
                "notification" => $notmsg
            );
           
            $headers = array
            (
                'Authorization: key='."AIzaSyBgOGeL6QLWG8SYROczlkIMg3d2CYM6kr0",
                'Content-Type: application/json'
            );

            $url = 'https://fcm.googleapis.com/fcm/send';
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, $url );  
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            if(curl_error($ch))
            {
                $result = curl_error($ch);
            }
            curl_close( $ch );
            return $result ;
        }
        
        
        
        public function updategsmid($appid,$tokenid,$empid){
            
            $this->db->query("update ak_customer SET  appid ='".$appid."', token='".$tokenid."' where customer_id ='".$empid."'");
        }
	
}