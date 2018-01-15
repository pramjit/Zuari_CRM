<?php

class Modeldealerbulkupload extends Model  {
    public function readExcel($inputFileName,$name) {
       // echo $name;
        $read=new PHPReadExcel($inputFileName,$name);
        return $read->getSheetData();                        
    }
    
    public function addDealer($data)
    {
        
        //check column match with table
       $sql= "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='".DB_DATABASE."' AND `TABLE_NAME`='".DB_PREFIX."channel_partner'";
       $sql= $this->db->query($sql);
        
        $array1 = $sql->rows;
        foreach ($array1 as $colarry)
        {
            $newarray[]=$colarry['COLUMN_NAME'];
        }
        $array2 = $data[0];
        $result = array_diff($newarray, $array2);
        if(empty($result))
        {
    $query = 'INSERT INTO '.DB_PREFIX.'channel_partner (`'.implode("`, `", array_values($data[0])).'`) VALUES ';        
    $query_parts = array();
    for($icount=1; $icount<count($data); $icount++){                            
            $query_parts[] ="('".implode("', '", array_values($data[$icount]))."')";        
    }
    $query .= implode(',', $query_parts);       
    $this->db->query($query);
        return $this->db->countAffected();}
        else{
        return -1;    
        }
        
    }
    
}
