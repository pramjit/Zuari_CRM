<?php
class ModelapiSyncFile extends Model {          
    
    public function updateRec($fm,$tm){
		
		$date=date('Ymd');
		$log=new Log("SyncFileMod".$date.".log");
        $dtrcv=date('Y-m-d');
        $tmrcv=date('H:i:s');
        $sql="update crm_adv set FILE_SYNC=1 where CALL_FROM='".$fm."' and FAR_MOB='".$tm."'";
		$log->write($sql);
        $this->db->query($sql);
		//return $this->db->countAffected()
    }
    
}

