<?php
class ModelapiMailRa extends Model {          
    public function checkComplain(){        
        $sql="SELECT CS.CASE_ID,DATE(CS.CR_DATE),
        CS.COMP_RA,ACRA.firstname AS 'RA_NAME',ACRA.email AS 'RA_MAIL',ACRA.telephone AS 'RA_MOB',
        CS.COMP_AA,
        DATEDIFF(CS.RA_DUE_DATE,DATE(CS.CR_DATE)) AS 'RA_DAY',
        DATEDIFF(CS.AA_DUE_DATE,DATE(CS.CR_DATE)) AS 'AA_DAY' 
        FROM crm_case CS
        LEFT JOIN ak_customer ACRA ON(CS.COMP_RA=ACRA.customer_id)
        WHERE CS.CASE_STATUS=7";
        $query = $this->db->query($sql);
        return $query->rows;           
    }
}

