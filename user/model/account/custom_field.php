<?php
class ModelAccountCustomField extends Model {
	public function getCustomField($custom_field_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cf.custom_field_id = '" . (int)$custom_field_id . "' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

        
        
        public function generateotp($data){
            
            
             $otp=rand(1111,9999);
             $cr_data =  date('Y-m-d H:i:s');
             $exp_data = date('Y-m-d H:i:s',strtotime('+1 hour'));
             $sql="INSERT INTO " . DB_PREFIX . "customer_otp SET customer_id='".$data["customer_id"]."',otp='".$otp."',status='0',ip_address='".$this->request->server['REMOTE_ADDR']."',date_added='".$cr_data."',date_expire='".$exp_data."'";
             $this->db->query($sql);
             $ret_id = $this->db->countAffected();
             return $otp;
            
        }
        
        public function checkotp($data){

            $cr_date=date('Y-m-d H:i:s');
            $ss="SELECT * FROM `" . DB_PREFIX . "customer_otp` where customer_id = '".$data['customer_id']."' and otp = '".$data['otp']."' and status='0' and date_expire > '".$cr_date."'";
            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_otp` where customer_id = '".$data['customer_id']."' and otp = '".$data['otp']."' and status='0' and date_expire > '".$cr_date."'");
            return $query->row;
        }
        public function updateotpstatus($data){
            
             
             $sql="update " . DB_PREFIX . "customer_otp set status='1' where customer_id = '".$data['customer_id']."' and otp = '".$data['otp']."'";
             $this->db->query($sql);
             $ret_id = $this->db->countAffected();
             return $ret_id;
        }
        public function getCustomFields($customer_group_id = 0) {
		$custom_field_data = array();

		if (!$customer_group_id) {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cf.status = '1' ORDER BY cf.sort_order ASC");
		} else {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field_customer_group` cfcg LEFT JOIN `" . DB_PREFIX . "custom_field` cf ON (cfcg.custom_field_id = cf.custom_field_id) LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cfcg.customer_group_id = '" . (int)$customer_group_id . "' ORDER BY cf.sort_order ASC");
		}

		foreach ($custom_field_query->rows as $custom_field) {
			$custom_field_value_data = array();

			if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio' || $custom_field['type'] == 'checkbox') {
				$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_id = '" . (int)$custom_field['custom_field_id'] . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cfv.sort_order ASC");

				foreach ($custom_field_value_query->rows as $custom_field_value) {
					$custom_field_value_data[] = array(
						'custom_field_value_id' => $custom_field_value['custom_field_value_id'],
						'name'                  => $custom_field_value['name']
					);
				}
			}

			$custom_field_data[] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $custom_field_value_data,
				'name'               => $custom_field['name'],
				'type'               => $custom_field['type'],
				'value'              => $custom_field['value'],
				'location'           => $custom_field['location'],
				'required'           => empty($custom_field['required']) || $custom_field['required'] == 0 ? false : true,
				'sort_order'         => $custom_field['sort_order']
			);
		}

		return $custom_field_data;
	}
}