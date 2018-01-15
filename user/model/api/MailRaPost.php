<?php
class ModelapiMailRaPost extends Model {          
    public function checkComplain(){        
       $sql="SELECT CS.CASE_ID,DATE(CS.CR_DATE) AS 'CR_DATE',CS.RA_DUE_DATE AS 'RA_DATE',CS.AA_DUE_DATE AS 'AA_DATE',
       CS.COMP_RA,ACRA.firstname AS 'RA_NAME',ACRA.email AS 'RA_MAIL',ACRA.telephone AS 'RA_MOB',
       CS.COMP_AA,ACAA.firstname AS 'AA_NAME',ACAA.email AS 'AA_MAIL',ACAA.telephone AS 'AA_MOB',
       DATEDIFF(CURDATE(),CS.RA_DUE_DATE) AS 'RA_DAY',
       DATEDIFF(CURDATE(),CS.AA_DUE_DATE) AS 'AA_DAY' 
       FROM crm_case CS
       LEFT JOIN ak_customer ACRA ON(CS.COMP_RA=ACRA.customer_id)
       LEFT JOIN ak_customer ACAA ON(CS.COMP_AA=ACAA.customer_id)
       WHERE CS.CASE_STATUS=7";
       $query = $this->db->query($sql);
       return $query->rows;           
    }
}

