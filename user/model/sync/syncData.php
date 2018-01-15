<?php

class ModelsyncsyncData extends Model {
  
    
    private $file_id;
    
    public function getId() {
		return $this->file_id;
	}
      

        public  function SyncFunction($id)
        
{


   
  

  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 $fid=rand();
    // Create (connect to) SQLite database in file
  //$log=new Log("er.log");
$log=new Log("tester.log");
    $sqdb=DIR_DOWNLOAD.$fid.'.sqlite';
    $file_db = new PDO('sqlite:'.$sqdb);
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
 
    /**************************************
    * Create tables                       *
    **************************************/
 $log->write("error");
    // Create table messages   
 
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_log");

    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "geo"); 
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "product"); 
    
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "crop");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "village");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "channel_partner");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "retailer_type");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "pos_status");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "brand");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "market");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "activity");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "can_pos");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "pos_retailer");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "can_pos_history");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "attendance");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "can_user_visit");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "can_mlk_center");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "distribute_company");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "mcc_disrt_comp");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "mcc_current_feed");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "can_fgm_dtl");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "user_activity");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "retail_outlet");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_retail_outlet");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "customer_outlet_map");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "outlet_stock");
    //so
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "mas_can_baseline_dd");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "mas_can_baseline_dtl");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_segment");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_possition");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_plan");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_product_detail");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "customer");
    $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "farmer_followup");
     $file_db->exec("DROP TABLE IF EXISTS " . DB_PREFIX . "customer_map");
    
    
    
    
    $log->write("error1");
 
   
    
$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer (
    
SID	TEXT,
FARMER_NAME	TEXT,
FAR_MOBILE	TEXT,
CR_DATE	TEXT,
CR_BY	TEXT,
VILL_ID	TEXT,
DIST_ID	TEXT,
CAN_MLK_ID	TEXT,
FGM_ID	TEXT,
KEY_FARMER	TEXT,
MILKING_COWS_CNT	TEXT,
TOTAL_COWS	TEXT,
CURR_SUPPILER	TEXT,
DAILY_MILK_PROD	TEXT,
REMARKS	TEXT,
LAST_VISIT_ID	TEXT,
CAR_ID	TEXT,
FARMER_STATUS TEXT,
APP_TRX_ID	TEXT,
LATT	TEXT,
LONGG	TEXT,
FAR_SEGMENT	TEXT,
FAR_POSSITION 	TEXT,
FAR_CATEGORY	TEXT,
IMAGE 	TEXT,
FAR_POS TEXT,
statusl TEXT
   

    )");
$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_log (
    
SID	TEXT,
FARMER_NAME	TEXT,
FAR_MOBILE	TEXT,
CR_DATE	TEXT,
CR_BY	TEXT,
VILL_ID	TEXT,
DIST_ID	TEXT,
CAN_MLK_ID	TEXT,
FGM_ID	TEXT,
KEY_FARMER	TEXT,
MILKING_COWS_CNT	TEXT,
TOTAL_COWS	TEXT,
CURR_SUPPILER	TEXT,
DAILY_MILK_PROD	TEXT,
REMARKS	TEXT,
LAST_VISIT_ID	TEXT,
CAR_ID	TEXT,
FARMER_STATUS TEXT,
APP_TRX_ID	TEXT,
statusl TEXT
   

    )");
 
$log->write("error2");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "geo (
    
SID	TEXT,
GEO_NAME	TEXT,
GEO_TYPE	TEXT,
Nation_ID	TEXT,
STATE_ID	TEXT,
ACT	TEXT,
statusl TEXT
    
)");
$log->write("error3");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product (
    
SID	TEXT,
PRODUCT_NAME	TEXT,
PRODUCT_CATEGORY  TEXT,
ACT	TEXT,
statusl TEXT    
)");
$log->write("error4");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "crop (
    
SID TEXT,
CROP_NAME TEXT,	
SEASON_NAME TEXT,	
ACT TEXT  ,
statusl TEXT
)");
$log->write("error5");
$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "village (
    
SID	TEXT,
VILLAGE_NAME	TEXT,
VILLAGE_PIN_CODE	TEXT,
STATE_ID	TEXT,
TERRITORY_ID	TEXT,
DISTRICT_ID	TEXT,
HQ_ID	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "channel_partner (
    
SID	TEXT,
CHANNEL_CODE	TEXT,
CHANNEL_TYPE	TEXT,
FIRM_NAME	TEXT,
OWNER_NAME	TEXT,
MOBILE	TEXT,
EMAIL_ID	TEXT,
HO_ID	TEXT,
ZONE_ID	TEXT,
REGION_ID	TEXT,
AREA_ID	TEXT,
TERRITORY_ID	TEXT,
DMR_ID	TEXT,
DMR_NAME	TEXT,
FMR_ID	TEXT,
FMR_NAME	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "retailer_type (
    
SID	TEXT,
RETAILER_TYPE	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pos_status (
    
SID	TEXT,
STATUS	TEXT,
ACT	TEXT,
COLOR_CODE TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "brand (
    
SID	TEXT,
BRAND_NAME	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "market (
    
SID	TEXT,
MARKET_NAME	TEXT,
STATE_ID	TEXT,
TERRITORY_ID	TEXT,
DISTRICT_ID	TEXT,
HQ_ID	TEXT,
VILL_ID	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "activity (
    
SID	TEXT,
ACTIVITY	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "can_pos (
    
SID	TEXT,
POS_NAME	TEXT,
POS_MOBILE	TEXT,
POS_MARKET	TEXT,
POS_VILL_ID	TEXT,
CR_BY	TEXT,
CR_DATE	TEXT,
IMAGE_URL	TEXT,
LATT	TEXT,
LONGG	TEXT,
ACT	TEXT,
POS_STATUS	TEXT,
BRANDS_AVAILABLE	TEXT,
EXISTIN_CAN_RELATION	TEXT,
POS_TYPE	TEXT,
STATUS_CHANGE_DATE	TEXT,
DIST_ID	TEXT,
MONTHLY_SALES	TEXT,
APP_TRX_ID TEXT,
DEALER_ID TEXT,
SUB_DEALER_ID TEXT,
GROUP_ID TEXT,
statusl TEXT
   

    )");
$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "pos_retailer (
    
SID	TEXT,
POS_NAME	TEXT,
MOBILE	TEXT,
statusl TEXT
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "can_pos_history (
    
SID	TEXT,
CAN_POS_ID	TEXT,
STATUS_CHANGE_FROM	TEXT,
STATUS_CHARGE_TO	TEXT,
CHANGE_DATE	TEXT,
CHANGED_BY	TEXT,
APP_TRX_ID TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "attendance (
    
SID	TEXT,
USER_ID	TEXT,
USER_NAME	TEXT,
CR_DATE	TEXT,
ACTIVITY_TYPE	TEXT,
REMARKS	TEXT,
APP_TRX_ID TEXT,
statusl TEXT
)");



$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "can_mlk_center (
    
SID	TEXT,
MLK_CENTER_NAME	TEXT,
CONTACT_NUMBER	TEXT,
DIST_ID	TEXT,
VILL_ID	TEXT,
IMAGE_URL	TEXT,
LATT	TEXT,
LONGG	TEXT,
MILK_DAILY_COLLECTION 		TEXT,
COW_COLLECTION	TEXT,
BUFFALO_COLLECTION	TEXT,
NO_OF_FARMERS	TEXT,
CURRENT_FEED_COMPANY	TEXT,
NOTES	TEXT,
CR_BY	TEXT,
CR_DATE	TEXT,
ACT	TEXT,
APP_TRX_ID TEXT,
HQ_ID TEXT,
statusl TEXT
   

    )");  

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "distribute_company (
    
SID	TEXT,
DISTRIBUTE_COMPANY  TEXT,
ACT	TEXT,
statusl TEXT
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "mcc_disrt_comp (
    
SID	TEXT,
MCC_ID	TEXT,
MCC_DISTRIBUTE	TEXT,
ACT	TEXT,
CR_DATE	TEXT,
CR_BY	TEXT,
APP_TRX_ID TEXT,
statusl TEXT
   

    )"); 

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "mcc_current_feed (
    
SID	TEXT,
CURRENT_FEED_COMPANY 		TEXT,
ACT	TEXT,
statusl TEXT
   

    )"); 

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "can_fgm_dtl (
    
SID	TEXT,
USER_ID	TEXT,
USER_NAME	TEXT,
VILL_ID	TEXT,
CR_DATE	TEXT,
FARMER_CNT	TEXT,
REMARKS TEXT,
APP_TRX_ID TEXT,
IMAGE	TEXT,
LATT	TEXT,
LONGG	TEXT,
statusl TEXT
   

    )");   

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "user_activity (
    
SID	TEXT,
USER_ACTIVITY	TEXT,
ACT	TEXT,
statusl TEXT
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "retail_outlet (
    
SID	TEXT,
OUTLET_NAME	TEXT,
RETAIL_ID 	TEXT,
CONTACT_NO 	TEXT,
ADDRESS 	TEXT,
DISTRICT_ID 	TEXT,
PHOTO_PATH 	TEXT,
REMARKS 	TEXT,
CR_DATE 	TEXT,
CR_BY 	TEXT,
ACT	TEXT,
IMPORTANT	TEXT,
statusl TEXT
  
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_retail_outlet (
    
SID	TEXT,
FARMER_ID	TEXT,
APP_TRX_ID	TEXT,
OUTLET_ID 	TEXT,
CR_BY 	TEXT,
CR_DATE 	TEXT,
statusl TEXT
    
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "customer_outlet_map (
    
SID	TEXT,
CUSTOMER_ID	TEXT,
OUTLET_ID	TEXT,
DISTRICT_ID 	TEXT,
ACT 	TEXT,
statusl TEXT
    
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "outlet_stock (
    
SID	TEXT,
OUTLET_ID	TEXT,
PRODUCT_ID	TEXT,
QUANTITY  	TEXT,
CR_DATE  	TEXT,
CR_BY           TEXT,
APP_TRX_ID      TEXT,
statusl         TEXT,
CONNECT TEXT
    
)");

//so
$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "mas_can_baseline_dd (
    
SID	TEXT,
DESCRIPTION	TEXT,
APP_VARIABLE_ID 	TEXT,
TYPE 	TEXT,
OPTION  	TEXT,
PAR_ID 	TEXT,
UNIT  	TEXT,
ACT  	TEXT,
MEAN  	TEXT,
MANDATORY 	TEXT,
CATEGORY 	TEXT,
CATEGORY_DESCR	TEXT,
NEXT_ID  TEXT,
HEADING  TEXT,
statusl TEXT
  
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "mas_can_baseline_dtl (
    
SID	TEXT,
FARMER_ID 	TEXT,
FARMER_MOB      TEXT,
FARMER_NAME    TEXT,
EMP_ID  	TEXT,
EMP_NAME  	TEXT,
DIST_ID  	TEXT,
VILL_ID   	TEXT,
VILL_NAME   	TEXT,
SBL_DATE   	TEXT,
SBL_QUEST_ID  	TEXT,
SBL_QUEST_DES 	TEXT,
SBL_ANSWER_ID  	TEXT,
SBL_ANSWER_ID_VALUE  	TEXT,
CR_DATE  	TEXT,
APP_TRX_ID  	TEXT,
MOD_DATE  	TEXT,
CowGroup        TEXT,
statusl TEXT
  
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_segment (
    
SID	TEXT,
SEGMENT 	TEXT,
ACT 	TEXT,
statusl TEXT
  
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_possition (
    
SID	TEXT,
CUSTOMER_POSSITION 	TEXT,
ACT 	TEXT,
statusl TEXT
  
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_plan (
    
SID	TEXT,
CURRENT_SITUATION 	TEXT,
CUSTOMER_GOAL 	TEXT,
OPPORTUNITY 	TEXT,
GOALS 	TEXT,
FARMER_ID  	TEXT,
APP_TRANS_ID 	TEXT,
statusl TEXT
  
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_product_detail (
    
SID	TEXT,
TYPE 	TEXT,
PRODUCT_NAME 	TEXT,
PRODUCT_USAGE  	TEXT,
FARMER_ID  	TEXT,
TEMP_STATUS  	TEXT,
FARMER_PLAN_ID   	TEXT,
CR_DATE      TEXT,
statusl TEXT
  
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "can_user_visit (
    
SID	TEXT,
VISIT_TYPE 	TEXT,
POS_ID  	TEXT,
FARMER_ID   	TEXT,
CR_DATE   	TEXT,
USER_ID    	TEXT,
REMARKS   	TEXT,
APP_TRX_ID    	TEXT,
NEXT_VISIT_DATE   	TEXT,
status 	TEXT,
PURPOSE   	TEXT,
CONCERN   	TEXT,
NEXT_STEP   	TEXT,
statusl TEXT
  
)");

$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "customer (
    
customer_id	TEXT,
Name	TEXT,
customer_group_id  TEXT,
district_id    TEXT,
statusl TEXT
)");


$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "customer_map (
SID  TEXT,    
CUSTOMER_ID 	TEXT,
PARENT_CUSTOMER_ID	TEXT,
 CUSTOMER_GROUP_ID    TEXT,
statusl TEXT
)");




$file_db->exec("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "farmer_followup (
    
SID	TEXT,
FARMER_ID 	TEXT,
DISTRICT_ID  	TEXT,
VILLAGE_ID   	TEXT,
CR_BY   	TEXT,
CR_DATE    	TEXT,
TYPE    	TEXT,
statusl TEXT
  
)");

$mcrt=new MCrypt();



//save data geo

//state
$role_id = $this->db->query("SELECT customer_group_id  FROM " . DB_PREFIX . "customer where customer_id = '".$id."' ");
$role_id1=$role_id->row["customer_group_id"];
if($role_id1=='73') {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and GEO_TYPE='2' and sid in(select state_id from ak_customer where customer_id='".$id."') order by GEO_NAME asc");
$data=$query->rows; 

} else {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and SID in (SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2'  ) order by GEO_NAME asc");
$data=$query->rows; 
}
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "geo (SID,GEO_NAME,GEO_TYPE,Nation_ID,STATE_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["GEO_NAME"])."','".$mcrt->encrypt($value["GEO_TYPE"])."','".$mcrt->encrypt($value["Nation_ID"])."','".$mcrt->encrypt($value["STATE_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}


//dist

if($role_id1=='49' || $role_id1=='60' || $role_id1=='61') {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and SID in (SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='4'  ) order by GEO_NAME asc");
$data=$query->rows; 
} else if($role_id1=='47'){
    //$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and SID in (SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='4'  ) order by GEO_NAME asc");
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo where geo_type=4 and state_id In(SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2')");
    $data=$query->rows; 
    
} else if($role_id1=='71'){
    //$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and SID in (SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='4'  ) order by GEO_NAME asc");
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo where geo_type=4 and state_id In(SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID IN (SELECT customer_id FROM `ak_customer_map` where PARENT_CUSTOMER_ID='".$id."') and GEO_LEVEL_ID='2')");
    $data=$query->rows; 
    
} else if($role_id1=='55'){ 
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo where geo_type=4 and state_id In(SELECT state_id FROM `ak_customer` where customer_id='".$id."' )");
     $data=$query->rows; 
} else if($role_id1=='73'){ 
     $query = $this->db->query("SELECT * FROM `ak_geo` where geo_type=4 and state_id in(select state_id from ak_customer where customer_id='".$id."') and act=1");
     $data=$query->rows; 
}  else {
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "geo where geo_type=4 and state_id In(SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2')");
    $data=$query->rows; 
}

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "geo (SID,GEO_NAME,GEO_TYPE,Nation_ID,STATE_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["GEO_NAME"])."','".$mcrt->encrypt($value["GEO_TYPE"])."','".$mcrt->encrypt($value["Nation_ID"])."','".$mcrt->encrypt($value["STATE_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//hq
 if($role_id1!='73'){ 
if($role_id1!='55' && $role_id1!='71'){ 
$role_id = $this->db->query("SELECT customer_group_id  FROM " . DB_PREFIX . "customer where customer_id = '".$id."' ");
$role_id1=$role_id->row["customer_group_id"];
if($role_id1=='49' || $role_id1=='60' || $role_id1=='61') {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "geo WHERE  ACT ='1' and SID in (SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='5' ) order by GEO_NAME asc");
$data=$query->rows; 
} else {
    $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "geo` where geo_type=5 and state_id In(SELECT GEO_ID  from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2')");
    $data=$query->rows; 
}
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "geo (SID,GEO_NAME,GEO_TYPE,Nation_ID,STATE_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["GEO_NAME"])."','".$mcrt->encrypt($value["GEO_TYPE"])."','".$mcrt->encrypt($value["Nation_ID"])."','".$mcrt->encrypt($value["STATE_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}
}

//end save geo

if($role_id1!='55' && $role_id1!='71'){
//save data product
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "product WHERE ACT='1' order by PRODUCT_NAME asc ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "product(SID,PRODUCT_NAME,PRODUCT_CATEGORY,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["PRODUCT_NAME"])."','".$mcrt->encrypt($value["PRODUCT_CATEGORY"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}


//end save product


//save data farmer
//$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer where CR_BY = '".$id."' ");
//$data=$query->rows; 

$role_id = $this->db->query("SELECT customer_group_id  FROM " . DB_PREFIX . "customer where customer_id = '".$id."' ");
$role_id1=$role_id->row["customer_group_id"];
if($role_id1=='48' || $role_id1=='55') {
   // $ff="SELECT *  FROM " . DB_PREFIX . "farmer where CR_BY IN (select CUSTOMER_ID from customer_map where PARENT_CUSTOMER_ID = '".$id."'";
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer where CR_BY IN (select CUSTOMER_ID from " . DB_PREFIX . "customer_map where PARENT_CUSTOMER_ID = '".$id."') order by CR_BY desc ");
    $data=$query->rows;
} else if($role_id1=='71') {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer where CR_BY IN (SELECT customer_id FROM `ak_customer_map` where PARENT_CUSTOMER_ID='".$id."'  or CUSTOMER_ID='".$id."')  order by CR_BY desc");
$data=$query->rows;
} else {
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer where CR_BY = '".$id."'  order by CR_BY desc");
$data=$query->rows;
}

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer (SID,FARMER_NAME,FAR_MOBILE ,CR_DATE,CR_BY,VILL_ID,DIST_ID,CAN_MLK_ID,FGM_ID,KEY_FARMER,MILKING_COWS_CNT,TOTAL_COWS,CURR_SUPPILER,DAILY_MILK_PROD,REMARKS,LAST_VISIT_ID,CAR_ID,FARMER_STATUS,APP_TRX_ID,LATT,LONGG,FAR_SEGMENT,FAR_POSSITION,FAR_CATEGORY,IMAGE,FAR_POS,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["FARMER_NAME"])."','".$mcrt->encrypt($value["FAR_MOBILE"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["DIST_ID"])."','".$mcrt->encrypt($value["CAN_MLK_ID"])."','".$mcrt->encrypt($value["FGM_ID"])."','".$mcrt->encrypt($value["KEY_FARMER"])."','".$mcrt->encrypt($value["MILKING_COWS_CNT"])."','".$mcrt->encrypt($value["TOTAL_COWS"])."','".$mcrt->encrypt($value["CURR_SUPPILER"])."','".$mcrt->encrypt($value["DAILY_MILK_PROD"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["LAST_VISIT_ID"])."','".$mcrt->encrypt($value["CAR_ID"])."','".$mcrt->encrypt($value["FARMER_STATUS"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["LATT"])."','".$mcrt->encrypt($value["LONGG"])."','".$mcrt->encrypt($value["FAR_SEGMENT"])."','".$mcrt->encrypt($value["FAR_POSSITION"])."','".$mcrt->encrypt($value["FAR_CATEGORY"])."','".$mcrt->encrypt($value["IMAGE"])."','".$mcrt->encrypt($value["FAR_POS"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
if($role_id1!='55' && $role_id1!='71'){
//save data farmer_log
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_log where CR_BY = '".$id."' ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_log (SID,FARMER_NAME,FAR_MOBILE ,CR_DATE,CR_BY,VILL_ID,DIST_ID,CAN_MLK_ID,FGM_ID,KEY_FARMER,MILKING_COWS_CNT,TOTAL_COWS,CURR_SUPPILER,DAILY_MILK_PROD,REMARKS,LAST_VISIT_ID,CAR_ID,FARMER_STATUS,APP_TRX_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["FARMER_NAME"])."','".$mcrt->encrypt($value["FAR_MOBILE"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["DIST_ID"])."','".$mcrt->encrypt($value["CAN_MLK_ID"])."','".$mcrt->encrypt($value["FGM_ID"])."','".$mcrt->encrypt($value["KEY_FARMER"])."','".$mcrt->encrypt($value["MILKING_COWS_CNT"])."','".$mcrt->encrypt($value["TOTAL_COWS"])."','".$mcrt->encrypt($value["CURR_SUPPILER"])."','".$mcrt->encrypt($value["DAILY_MILK_PROD"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["LAST_VISIT_ID"])."','".$mcrt->encrypt($value[" CAR_ID"])."','".$mcrt->encrypt($value["FARMER_STATUS"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}

//end save farmer






if($role_id1!='55' && $role_id1!='71'){
//save data channel_partner
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "channel_partner WHERE ACT='1' order by FIRM_NAME asc ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "channel_partner (SID,CHANNEL_CODE,CHANNEL_TYPE,FIRM_NAME,OWNER_NAME,MOBILE,EMAIL_ID,HO_ID,ZONE_ID,REGION_ID,AREA_ID,TERRITORY_ID,DMR_ID,DMR_NAME,FMR_ID,FMR_NAME,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CHANNEL_CODE"])."','".$mcrt->encrypt($value["CHANNEL_TYPE"])."','".$mcrt->encrypt($value["FIRM_NAME"])."','".$mcrt->encrypt($value["OWNER_NAME"])."','".$mcrt->encrypt($value["MOBILE"])."','".$mcrt->encrypt($value["EMAIL_ID"])."','".$mcrt->encrypt($value["HO_ID"])."','".$mcrt->encrypt($value["ZONE_ID"])."','".$mcrt->encrypt($value["REGION_ID"])."','".$mcrt->encrypt($value["AREA_ID"])."','".$mcrt->encrypt($value["TERRITORY_ID"])."','".$mcrt->encrypt($value["DMR_ID"])."','".$mcrt->encrypt($value["DMR_NAME"])."','".$mcrt->encrypt($value["FMR_ID"])."','".$mcrt->encrypt($value["FMR_NAME"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}


//end save channel_partner


//save data crop

$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "crop WHERE ACT='1' order by CROP_NAME asc ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "crop (SID,CROP_NAME,SEASON_NAME,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CROP_NAME"])."','".$mcrt->encrypt($value["SEASON_NAME"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//end save crop
}

//save data village
$role_id = $this->db->query("SELECT customer_group_id  FROM " . DB_PREFIX . "customer where customer_id = '".$id."' ");
$role_id1=$role_id->row["customer_group_id"];
if($role_id1=='49' || $role_id1=='60' || $role_id1=='61') {
$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where HQ_ID IN (SELECT GEO_ID from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='5')");
$data=$query->rows; 
} else if($role_id1=='47'){
    //$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where DISTRICT_ID IN (SELECT GEO_ID from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='4')");
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where STATE_ID IN (SELECT GEO_ID from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2')");
$data=$query->rows; 
} else if($role_id1=='71'){
    //$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where DISTRICT_ID IN (SELECT GEO_ID from " . DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='4')");
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where STATE_ID IN (SELECT GEO_ID from " . DB_PREFIX . "customer_emp_map where EMP_ID IN (SELECT customer_id FROM `ak_customer_map` where PARENT_CUSTOMER_ID='".$id."') and GEO_LEVEL_ID='2')");
$data=$query->rows; 
} else if($role_id1=='55' || $role_id1=='73'){
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "village where STATE_ID IN (SELECT state_id FROM `ak_customer` where customer_id='".$id."')");
$data=$query->rows;  
} else {
    $query = $this->db->query("SELECT * FROM ".DB_PREFIX . "village where HQ_ID IN (SELECT sid FROM ".DB_PREFIX . "geo where geo_type=5 and state_id In(SELECT GEO_ID from ".DB_PREFIX . "customer_emp_map where EMP_ID ='".$id."' and GEO_LEVEL_ID='2'))");
    $data=$query->rows;
}
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "village (SID,VILLAGE_NAME,VILLAGE_PIN_CODE,STATE_ID,TERRITORY_ID,DISTRICT_ID,HQ_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["VILLAGE_NAME"])."','".$mcrt->encrypt($value["VILLAGE_PIN_CODE"])."','".$mcrt->encrypt($value["STATE_ID"])."','".$mcrt->encrypt($value["TERRITORY_ID"])."','".$mcrt->encrypt($value["DISTRICT_ID"])."','".$mcrt->encrypt($value["HQ_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

if($role_id1!='55' && $role_id1!='71'){
//save data Retailer Type
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "retailer_type");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "retailer_type (SID,RETAILER_TYPE,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["RETAILER_TYPE"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data pos_status
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "pos_status");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "pos_status (SID,STATUS,ACT,COLOR_CODE,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["RETAILER_TYPE"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["COLOR_CODE"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data brand
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "brand");
$data=$query->rows; 

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "brand (SID,BRAND_NAME,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["BRAND_NAME"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}


//save data market
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "market");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "market (SID,MARKET_NAME,STATE_ID,TERRITORY_ID,DISTRICT_ID,HQ_ID,VILL_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["MARKET_NAME"])."','".$mcrt->encrypt($value["STATE_ID"])."','".$mcrt->encrypt($value["TERRITORY_ID"])."','".$mcrt->encrypt($value["DISTRICT_ID"])."','".$mcrt->encrypt($value["HQ_ID"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data brand
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "activity");
$data=$query->rows; 

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "activity (SID,ACTIVITY,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["ACTIVITY"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data ak_can_pos
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "can_pos where CR_BY = '".$id."' ");
$data=$query->rows; 

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "can_pos (SID,POS_NAME,POS_MOBILE,POS_MARKET,POS_VILL_ID,CR_BY,CR_DATE,IMAGE_URL,LATT,LONGG,ACT,POS_STATUS,BRANDS_AVAILABLE,EXISTIN_CAN_RELATION,POS_TYPE,STATUS_CHANGE_DATE,DIST_ID,MONTHLY_SALES,APP_TRX_ID,DEALER_ID,SUB_DEALER_ID,GROUP_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["POS_NAME"])."','".$mcrt->encrypt($value["POS_MOBILE"])."','".$mcrt->encrypt($value["POS_MARKET"])."','".$mcrt->encrypt($value["POS_VILL_ID"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["IMAGE_URL"])."','".$mcrt->encrypt($value["LATT"])."','".$mcrt->encrypt($value["LONGG"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["POS_STATUS"])."','".$mcrt->encrypt($value["BRANDS_AVAILABLE"])."','".$mcrt->encrypt($value["EXISTIN_CAN_RELATION"])."','".$mcrt->encrypt($value["POS_TYPE"])."','".$mcrt->encrypt($value["STATUS_CHANGE_DATE"])."','".$mcrt->encrypt($value["DIST_ID"])."','".$mcrt->encrypt($value["MONTHLY_SALES"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0','0','".$mcrt->encrypt($value["CUSTOMER_GROUP_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save pos_retailer
//$query = $this->db->query("SELECT customer_id,user_id,firstname,lastname  FROM " . DB_PREFIX . "customer where customer_group_id ='65' and district_id in(SELECT district_id  FROM " . DB_PREFIX . "customer where customer_id='".$id."')");
//$query = $this->db->query("SELECT sid,pos_name,pos_mobile FROM `ak_can_pos` where dist_id in(SELECT geo_id FROM `ak_customer_emp_map` where emp_id='".$id."' and geo_level_id='4')");
$query = $this->db->query("SELECT sid,pos_name,pos_mobile FROM `ak_can_pos` where dist_id in(select sid from ak_geo where state_id in (select geo_id from ak_customer_emp_map where geo_level_id=2 and emp_id='".$id."'))");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "pos_retailer (SID,POS_NAME,MOBILE,statusl) values('".$mcrt->encrypt($value["sid"])."','".$mcrt->encrypt($value["pos_name"])."','".$mcrt->encrypt($value["pos_mobile"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data can_pos_history
if($role_id1!='73'){
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "can_pos_history where CR_BY = '".$id."' ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "can_pos_history (SID,CAN_POS_ID,STATUS_CHANGE_FROM,STATUS_CHARGE_TO,CHANGE_DATE,CHANGED_BY,APP_TRX_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CAN_POS_ID"])."','".$mcrt->encrypt($value["STATUS_CHANGE_FROM"])."','".$mcrt->encrypt($value["STATUS_CHARGE_TO"])."','".$mcrt->encrypt($value["CHANGE_DATE"])."','".$mcrt->encrypt($value["CHANGED_BY"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
   $stmt->execute();
}
}


//save data attendance
if($role_id1!='73' && $role_id1!='47' && $role_id1!='71'){
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "attendance where USER_ID='".$id."'");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "attendance (SID,USER_ID,USER_NAME,CR_DATE,ACTIVITY_TYPE,REMARKS,APP_TRX_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["USER_ID"])."','".$mcrt->encrypt($value["USER_NAME"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["ACTIVITY_TYPE"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}

//save data can_user_visit

$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "can_user_visit");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "can_user_visit (SID,VISIT_TYPE,POS_ID,FARMER_ID,CR_DATE,USER_ID,REMARKS,APP_TRX_ID,NEXT_VISIT_DATE,status,PURPOSE,CONCERN,NEXT_STEP,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["VISIT_TYPE"])."','".$mcrt->encrypt($value["POS_ID"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt(date('Y-m-d',strtotime($value["CR_DATE"])))."','".$mcrt->encrypt($value["USER_ID"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["NEXT_VISIT_DATE"])."','".$mcrt->encrypt($value["status"])."','".$mcrt->encrypt($value["PURPOSE"])."','".$mcrt->encrypt($value["CONCERN"])."','".$mcrt->encrypt($value["NEXT_STEP"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

if($role_id1!='73'){
//save data can_mlk_center
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "can_mlk_center where CR_BY = '".$id."' ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "can_mlk_center (SID,MLK_CENTER_NAME,CONTACT_NUMBER ,DIST_ID,VILL_ID,IMAGE_URL,LATT,LONGG,MILK_DAILY_COLLECTION,COW_COLLECTION,BUFFALO_COLLECTION,NO_OF_FARMERS,CURRENT_FEED_COMPANY,NOTES,CR_BY,CR_DATE,ACT,APP_TRX_ID,HQ_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["MLK_CENTER_NAME"])."','".$mcrt->encrypt($value["CONTACT_NUMBER"])."','".$mcrt->encrypt($value["DIST_ID"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["IMAGE_URL"])."','".$mcrt->encrypt($value["LATT"])."','".$mcrt->encrypt($value["LONGG"])."','".$mcrt->encrypt($value["MILK_DAILY_COLLECTION"])."','".$mcrt->encrypt($value["COW_COLLECTION"])."','".$mcrt->encrypt($value["BUFFALO_COLLECTION"])."','".$mcrt->encrypt($value["NO_OF_FARMERS"])."','".$mcrt->encrypt($value["CURRENT_FEED_COMPANY"])."','".$mcrt->encrypt($value["NOTES"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["HQ_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}

//save data distribute_company
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "distribute_company");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "distribute_company (SID,DISTRIBUTE_COMPANY,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["DISTRIBUTE_COMPANY"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
if($role_id1!='73'){
//save data mcc_disrt_comp
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "mcc_disrt_comp where CR_BY = '".$id."' ");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "mcc_disrt_comp (SID,MCC_ID,MCC_DISTRIBUTE,ACT,CR_DATE, CR_BY,APP_TRX_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["MCC_ID"])."','".$mcrt->encrypt($value["MCC_DISTRIBUTE"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0')";
   $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
  
//save data mcc_current_feed
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "mcc_current_feed");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "mcc_current_feed (SID,CURRENT_FEED_COMPANY,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CURRENT_FEED_COMPANY"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

}
//save data mcc_current_feed
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "can_fgm_dtl");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "can_fgm_dtl (SID,USER_ID,USER_NAME,VILL_ID,CR_DATE,FARMER_CNT,REMARKS,APP_TRX_ID,IMAGE,LATT,LONGG,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["USER_ID"])."','".$mcrt->encrypt($value["USER_NAME"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["FARMER_CNT"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["IMAGE"])."','".$mcrt->encrypt($value["LATT"])."','".$mcrt->encrypt($value["LONGG"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data activity
$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "user_activity");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "user_activity(SID,USER_ACTIVITY,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["USER_ACTIVITY"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

//save data ak_retail_outlet
if($role_id1!='73'){

$role_id = $this->db->query("SELECT customer_group_id,district_id  FROM " . DB_PREFIX . "customer where customer_id = '".$id."' ");
$role_id1=$role_id->row["customer_group_id"];
$district_id = $role_id->row["district_id"];
if($role_id1=='60') {
  
    $query = $this->db->query("SELECT r.*  FROM " . DB_PREFIX . "retail_outlet r left join " . DB_PREFIX . "customer_outlet_map m on r.SID=m.OUTLET_ID where m.CUSTOMER_ID='".$id."' ");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "retail_outlet (SID,OUTLET_NAME,RETAIL_ID,CONTACT_NO,ADDRESS,DISTRICT_ID,PHOTO_PATH,REMARKS,CR_DATE,CR_BY,ACT,IMPORTANT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["OUTLET_NAME"])."','".$mcrt->encrypt($value["RETAIL_ID"])."','".$mcrt->encrypt($value["CONTACT_NO"])."','".$mcrt->encrypt($value["ADDRESS"])."','".$mcrt->encrypt($value["DISTRICT_ID"])."','".$mcrt->encrypt($value["PHOTO_PATH"])."','".$mcrt->encrypt($value["REMARKS"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["IMPORTANT"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

// save ak_farmer_retail_outlet
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_retail_outlet");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_retail_outlet (SID,FARMER_ID,APP_TRX_ID,OUTLET_ID,CR_BY,CR_DATE,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["OUTLET_ID"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["CR_DATE"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}


}
}

if($role_id1!='55' && $role_id1!='73'){
//save ak_customer_outlet_map
    if($role_id1!='71') {
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_retail_outlet where CUSTOMER_ID='".$id."'");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_retail_outlet(SID,CUSTOMER_ID,OUTLET_ID,DISTRICT_ID,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CUSTOMER_ID"])."','".$mcrt->encrypt($value["OUTLET_ID"])."','".$mcrt->encrypt($value["DISTRICT_ID"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
    
//save ak_outlet_stock
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "outlet_stock where CR_BY='".$id."'");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "outlet_stock(SID,OUTLET_ID,PRODUCT_ID,QUANTITY,CR_DATE,CR_BY,APP_TRX_ID,statusl,CONNECT) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["OUTLET_ID"])."','".$mcrt->encrypt($value["PRODUCT_ID"])."','".$mcrt->encrypt($value["QUANTITY"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["APP_TRX_ID"])."','0','".$mcrt->encrypt($value["CONNECT"])."')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
    }
//so

// save mas_can_baseline_dd
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "mas_can_baseline_dd order by APP_VARIABLE_ID asc");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "mas_can_baseline_dd (SID,DESCRIPTION,APP_VARIABLE_ID,TYPE,OPTION,PAR_ID,UNIT,ACT,MEAN,MANDATORY,CATEGORY,CATEGORY_DESCR,NEXT_ID,HEADING,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["DESCRIPTION"])."','".$mcrt->encrypt($value["APP_VARIABLE_ID"])."','".$mcrt->encrypt($value["TYPE"])."','".$mcrt->encrypt($value["OPTION"])."','".$mcrt->encrypt($value["PAR_ID"])."','".$mcrt->encrypt($value["UNIT"])."','".$mcrt->encrypt($value["ACT"])."','".$mcrt->encrypt($value["MEAN"])."','".$mcrt->encrypt($value["MANDATORY"])."','".$mcrt->encrypt($value["CATEGORY"])."','".$mcrt->encrypt($value["CATEGORY_DESCR"])."','".$mcrt->encrypt($value["NEXT_ID"])."','".$mcrt->encrypt($value["HEADING"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

// save mas_can_baseline_dtl
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "mas_can_baseline_dtl order by CR_DATE desc limit 6000"); 
    $data=$query->rows;



foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "mas_can_baseline_dtl (SID,FARMER_ID,FARMER_MOB,FARMER_NAME,EMP_ID,EMP_NAME,DIST_ID,VILL_ID,VILL_NAME,SBL_DATE,SBL_QUEST_ID,SBL_QUEST_DES,SBL_ANSWER_ID,SBL_ANSWER_ID_VALUE,CR_DATE,APP_TRX_ID,MOD_DATE,CowGroup,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt($value["FARMER_MOB"])."', '".$mcrt->encrypt($value["FARMER_NAME"])."','".$mcrt->encrypt($value["EMP_ID"])."','".$mcrt->encrypt($value["EMP_NAME"])."','".$mcrt->encrypt($value["DIST_ID"])."','".$mcrt->encrypt($value["VILL_ID"])."','".$mcrt->encrypt($value["VILL_NAME"])."','".$mcrt->encrypt($value["SBL_DATE"])."','".$mcrt->encrypt($value["SBL_QUEST_ID"])."','".$mcrt->encrypt($value["SBL_QUEST_DES"])."','".$mcrt->encrypt($value["SBL_ANSWER_ID"])."','".$mcrt->encrypt($value["SBL_ANSWER_ID_VALUE"])."','".$value["CR_DATE"]."','".$mcrt->encrypt($value["APP_TRX_ID"])."','".$mcrt->encrypt($value["MOD_DATE"])."','".$mcrt->encrypt($value["CowGroup"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
// save farmer_segment
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_segment");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_segment (SID,SEGMENT,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["SEGMENT"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

// save farmer_possition
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_possition");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_possition (SID,CUSTOMER_POSSITION,ACT,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CUSTOMER_POSSITION"])."','".$mcrt->encrypt($value["ACT"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

// save farmer_plan
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_plan");
    $data=$query->rows;


foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_plan (SID,CURRENT_SITUATION,CUSTOMER_GOAL,OPPORTUNITY,GOALS,FARMER_ID,APP_TRANS_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CURRENT_SITUATION"])."','".$mcrt->encrypt($value["CUSTOMER_GOAL"])."','".$mcrt->encrypt($value["OPPORTUNITY"])."','".$mcrt->encrypt($value["GOALS"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt($value["APP_TRANS_ID"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}

$log=new Log("syncTest.log");
// save farmer_product_detail
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_product_detail limit 10");
    $data=$query->rows;
$log->write("Test1");

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_product_detail (SID,TYPE,PRODUCT_NAME,PRODUCT_USAGE,FARMER_ID,TEMP_STATUS,FARMER_PLAN_ID,CR_DATE,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["TYPE"])."','".$mcrt->encrypt($value["PRODUCT_NAME"])."','".$mcrt->encrypt($value["PRODUCT_USAGE"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt($value["TEMP_STATUS"])."','".$mcrt->encrypt($value["FARMER_PLAN_ID"])."','".$mcrt->encrypt($value["CR_DATE"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
$log->write("Test2");
}

$log->write("Test3");
//save data customer
if($role_id1!='73') {
$query = $this->db->query("SELECT customer_id,firstname,lastname,customer_group_id,district_id  FROM " . DB_PREFIX . "customer where customer_group_id in(64,68,65)");
} else {
$query = $this->db->query("SELECT customer_id,firstname,lastname,customer_group_id,district_id  FROM " . DB_PREFIX . "customer limit 10");
}
$data=$query->rows; 

foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "customer (customer_id,Name,customer_group_id,district_id,statusl) values('".$mcrt->encrypt($value["customer_id"])."','".$mcrt->encrypt($value["firstname"].' '.$value["lastname"])."','".$mcrt->encrypt($value["customer_group_id"])."','".$mcrt->encrypt($value["district_id"])."','0')";
$log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
if($role_id1!='71' || $role_id1!='47'){
$query = $this->db->query("SELECT SID,CUSTOMER_ID,PARENT_CUSTOMER_ID,CUSTOMER_GROUP_ID  FROM " . DB_PREFIX . "customer_map");
$data=$query->rows; 
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "customer_map (SID,CUSTOMER_ID,PARENT_CUSTOMER_ID,CUSTOMER_GROUP_ID,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["CUSTOMER_ID"])."','".$mcrt->encrypt($value["PARENT_CUSTOMER_ID"])."','".$mcrt->encrypt($value["CUSTOMER_GROUP_ID"])."','0')";
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}
$log->write("Test4");

$log->write("Test9");
if($role_id1!='55' && $role_id1!='71'){
// save farmer_followup
    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "farmer_followup where CR_BY='".$id."'");
    $data=$query->rows;
$log->write("Test5");
foreach ($data as $value){
    $insert="insert into ".DB_PREFIX . "farmer_followup (SID,FARMER_ID,DISTRICT_ID,VILLAGE_ID,CR_BY,CR_DATE,TYPE,statusl) values('".$mcrt->encrypt($value["SID"])."','".$mcrt->encrypt($value["FARMER_ID"])."','".$mcrt->encrypt($value["DISTRICT_ID"])."','".$mcrt->encrypt($value["VILLAGE_ID"])."','".$mcrt->encrypt($value["CR_BY"])."','".$mcrt->encrypt($value["CR_DATE"])."','".$mcrt->encrypt($value["TYPE"])."','0')";
    $log->write($insert);
    $stmt = $file_db->prepare($insert);
    $stmt->execute();
}
}


$log->write("Test6");
$files_to_zip = $sqdb;
$log->write("Test10");
//if true, good; if false, zip creation failed
 $this->file_id=$fid.".zip";
$log->write($this->file_id);
  $result =  $this-> create_zip($files_to_zip,DIR_DOWNLOAD.$this->file_id);
$log->write($result);
unlink($sqdb);


 
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
    
    $file_db = null;
   return $result;

  }
  
catch(Exception $e) {
     return $e;
    }
    
    
}

    // creates a compressed zip file 
    public function create_zip($files,$destination,$overwrite = false) {

   try{
       
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
   
    //        //make sure the file exists
        if(file_exists($files)) {
                  $valid_files[] = $files;
        }
        else
        {
        echo "file is not found";
        }

        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true)
        {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $zip->addFile($file,"db.sqlite");
        }

        
        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return $destination;
    }
    catch(Exception $e) {
     return 'Message: '.$e->getMessage();
    }

}



}