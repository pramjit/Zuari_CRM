<?php
class ModelapiappService extends Model {
    
    public function chkIfAdv($mob,$pin){
        $sql="SELECT * FROM ak_customer WHERE land_line='".$mob."'";  
        $query = $this->db->query($sql);
        return $query->row;
    }
    
    
}


