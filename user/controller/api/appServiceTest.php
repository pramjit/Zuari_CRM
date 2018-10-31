<?php
class ControllerApiappServiceTest extends Controller {
        public function index(){
            
        
        function SaveAppData($target_url,$data){
        //$post['AppData']= json_encode($data);
        $post= json_encode($data);
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$response=curl_exec ($ch);
	curl_close ($ch);
        return $response;
        }
        
        // Api Service Url
        //$target_url="http://zuari.akshapp.com/index.php?route=api/appService"; 
        $target_url="http://192.168.1.159/CRM/index.php?route=api/appService";
        // Data Sent to the service
        // Service Type
        //1-Product Purchase Intent Given,  (Service Query)
        //2-Agro Advisory Request Raised,   (Assign to Advisory on State Basis)
        //3-Product Purchase Interest Shown,(Purchase Interest)
        //4-Test Email
        $data = array( "ServiceType"=>"4",
            "StateId"=>"Delhi",
            "Mobile"=>"1212232334",
            "CustomerName"=>"Test User",
            "ProductId"=>"11",
            "ProductName"=>"Mango",
            "StoreId"=>"11",
            "Quantity"=>"5",
            "OrderId"=>"1000",
            "QueryId"=>"1",
            "QueryText"=>"Product Purchase Intent Given",
            "ImageUrl1"=>"http://abc.com/image/image.png",
            "ImageUrl2"=>"http://abc.com/image/image.png",
            "TestName"=>"Test Mail"
                );
        echo SaveAppData($target_url,$data);

      }  
}



/*
 */
        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. and the at sign '@' is required before the
         * file name.
         */
/*	
 */
