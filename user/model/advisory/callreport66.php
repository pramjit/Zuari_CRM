<?php

class Modeladvisorycallreport extends Model {
    
  
    public function getcallreport($fdate,$tdate){
      if(empty($fdate)){$fdate='NULL';}else{$fdate="'".$fdate."'";}
      if(empty($tdate)){$tdate='NULL';}else{$tdate="'".$tdate."'";}
$sql="SELECT cc.KEY_PRESS as 'KEY_PRESS',cc.DATE_RECEIVED as CR_DATE,cc.MOBILE as MOBILE,ifnull(mpgz.NAME,'OTHER')as ZONE,mpg.NAME AS STATE,ifnull(mpgd.NAME,'OTHER') AS REGION,
(case 
when crd.FAR_LIVE=1 and cc.KEY_PRESS=1  then 'EXISTING FARMER'
when crd.FAR_LIVE=0 and cc.KEY_PRESS=1 then 'NEW FARMER'
ELSE 'NOT ATTEMPTED'
END
) as 'LIVE',
(case 
when akf.FAR_LIVE=1 and cc.KEY_PRESS=2  then 'EXISTING FARMER'
when akf.FAR_LIVE=0 and cc.KEY_PRESS=2 then 'NEW FARMER'
ELSE 'NOT ATTEMPTED'
END
) as 'COMPLAINT_FARMER_LIVE',
(case 
when cc.key_press=1 then 'ADVISORY'
when cc.key_press=2 then 'FARMER'
ELSE 'OTHER'
END
) as 'CALL_TYPE',
mac.STATUS_NAME as 'STATUS_NAME'
from cc_incomingcall cc
left join crm_adv crd on (crd.FAR_MOB=cc.MOBILE)
left join mas_pol_geo mpg on(mpg.GEO_ID=cc.STATE)
left join mas_pol_geo mpgz on(mpgz.GEO_ID=mpg.ZO_ID)
left join mas_pol_geo mpgd on(mpgd.GEO_ID=mpg.RO_ID)
left join ak_farmer akf on(cc.MOBILE=akf.FAR_MOBILE)
left join mas_callstatus mac on(akf.call_status=mac.status_id)
where cc.key_press in(1,2)and cc.call_type=2 and cc.DATE_RECEIVED BETWEEN ifnull(".$fdate.",cc.DATE_RECEIVED) and ifnull(".$tdate.",cc.DATE_RECEIVED)";
        $query = $this->db->query($sql);
        return $query->rows;
    }
   public function getcalltype($mobile,$keypress)
   {
       //$mobile= $data["MOBILE"];
     $sql="SELECT MOBILE,CALL_TYPE,KEY_PRESS FROM `cc_incomingcall` where MOBILE='".$mobile."' and call_type=2 and key_press='".$keypress."'";
     $query1 = $this->db->query($sql);
       $ct=$query1->row['CALL_TYPE'];
       $kp=$query1->row['KEY_PRESS'];
        if($ct==2 && $kp==1){
               $sqlsts="SELECT FAR_MOB,
                        'ADVISORY' AS 'CALL_STATUS',
                        (CASE WHEN FAR_LIVE=0 THEN 'NEW FARMER' WHEN FAR_LIVE=1 THEN 'EXISTING FARMER'END) AS 'FAR_LIVE' ,
                        (CASE 
                            WHEN CASE_STATUS IN(4,6,7,11,22,23) THEN 'PENDING AT ADVISORY'
                            WHEN CASE_STATUS=27 AND CALL_COUNT >0 AND FILE_SYNC=1 AND TOT_ATTEMPT =0 THEN 'PENDING AT CC'
                            WHEN CASE_STATUS=27 AND CALL_COUNT >0 AND FILE_SYNC=1 AND TOT_ATTEMPT >0 THEN 'PENDING APPROVAL'
                            WHEN CASE_STATUS=0 THEN 'CALL NOT PICKED'
                            WHEN CASE_STATUS=99 THEN 'CLOSED'
                        END) AS 'CASE_STATUS' 
                        FROM crm_adv
                        WHERE FAR_MOB='".$mobile."'";
                $query = $this->db->query($sqlsts);
                
                if(empty($query->row['CALL_STATUS'])){
                    $cs='ADVISORY';$fl='PENDING';
                 }
                 else{
                     $cs=$query->row['CALL_STATUS'];
                     $fl=$query->row['FAR_LIVE'];
                 }
                 return $suc=array('CALL_STATUS'=>$cs,'FAR_LIVE'=>$fl,'CASE_STATUS'=>$query->row['CASE_STATUS']);
        }
        if($ct==2 && $kp==2){
               $sqlsts="SELECT 
                mas_callstatus.STATUS_NAME AS 'CALL_STATUS', 
                (CASE WHEN FAR_LIVE=0 THEN 'NEW FARMER' WHEN FAR_LIVE=1 THEN 'EXISTING FARMER'END) AS 'FAR_LIVE',
		(CASE 
		WHEN crm_case.CASE_STATUS=2 THEN 'PENDING AT AA'
		WHEN crm_case.CASE_STATUS=3 THEN 'PENDING REVIEW AT CC' 
		WHEN crm_case.CASE_STATUS=5 THEN 'SUBMIT APPROVAL' 
		WHEN crm_case.CASE_STATUS=6 THEN 'PENDING REVIEW AT RA'
		WHEN crm_case.CASE_STATUS=7 THEN 'PENDING AT RA' 
		WHEN crm_case.CASE_STATUS=99 THEN 'CLOSED'
		ELSE 'NA'
		END) AS 'CASE_STATUS' 
                from ak_farmer 
                left join mas_callstatus on(ak_farmer.CALL_STATUS=mas_callstatus.STATUS_ID)
								left join crm_case on(ak_farmer.FAR_MOBILE=crm_case.COMP_MOBILE)
                where FAR_MOBILE='".$mobile."'";
               $query = $this->db->query($sqlsts);
               
                if(empty($query->row['CALL_STATUS'])){
                    $cs='FARMER';$fl='PENDING';
                 }
                 else{
                     $cs=$query->row['CALL_STATUS'];
                     if($cs=='Agro Advisory'){
                         $chkatadv="select (CASE WHEN FAR_LIVE=0 THEN 'NEW FARMER' WHEN FAR_LIVE=1 THEN 'EXISTING FARMER'END) AS 'FAR_LIVE' ,(CASE 
                            WHEN CASE_STATUS IN(4,6,7,11,22,23) THEN 'PENDING AT ADVISORY'
                            WHEN CASE_STATUS=27 AND CALL_COUNT >0 AND FILE_SYNC=1 AND TOT_ATTEMPT =0 THEN 'PENDING AT CC'
                            WHEN CASE_STATUS=27 AND CALL_COUNT >0 AND FILE_SYNC=1 AND TOT_ATTEMPT >0 THEN 'PENDING APPROVAL'
                            WHEN CASE_STATUS=0 THEN 'CALL NOT PICKED'
                            WHEN CASE_STATUS=99 THEN 'CLOSED'
                        END) AS 'CASE_STATUS' FROM crm_adv
                        WHERE FAR_MOB='".$mobile."'";
                         $query = $this->db->query($chkatadv);
                         $CASE_STATUS=$query->row['CASE_STATUS'];
                         $fl=$query->row['FAR_LIVE'];
                     }
                     else{
                         $CASE_STATUS=$query->row['CASE_STATUS'];
                         $fl=$query->row['FAR_LIVE'];
                     }
                     
                 }
                 return $suc=array('CALL_STATUS'=>$cs,'FAR_LIVE'=>$fl,'CASE_STATUS'=>$CASE_STATUS);
        }
   }

    
  
}


