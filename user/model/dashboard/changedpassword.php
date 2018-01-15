<?php

class Modeldashboardchangedpassword extends Model {
    
    public function newPassword($data)
     {
        $password=$data["new_pass"];
        $userid=$data["userid"];
        $sql=("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE customer_id='".$userid."'");

        $query = $this->db->query($sql);
        $ret_id = $this->db->countAffected();
       return $ret_id;   
        
    }

}
