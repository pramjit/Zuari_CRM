<?php
class ModelAccountActivity extends Model {
	public function addActivity($key, $data) {
		if (isset($data['customer_id'])) {
			$customer_id = $data['customer_id'];
		} else {
                    $query = $this->db->query("SELECT customer_id  FROM " . DB_PREFIX . "customer where User_Id='".$data['username']."' ");
                    $customer_id=$query->row["customer_id"]; 
			//$customer_id = 0;
                        
		}
                if(isset($this->request->post['login_type'])){
                    $login_type=$this->request->post['login_type'];
                } else {
                    $login_type='1';
                }

		$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_activity` SET `customer_id` = '" . (int)$customer_id . "', `key` = '" . $this->db->escape($key) . "', `data` = '" . $this->db->escape(serialize($data)) . "', `ip` = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', `date_added` = NOW(),`login_type`='".$login_type."'");
	}
}