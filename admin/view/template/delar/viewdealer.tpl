<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
            <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download"><i class="fa fa-download"></i></button>

      </div>
      <h1><?php echo 'Dealer View' ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   
    
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  
                 
                  <td class="text-left">
                    <a >First Name</a>
                  </td>
                    <td class="text-left">
                    <a >Last Name</a>
                  </td>
                   
                  <td class="text-left">
                    <a >User Id</a>
                    </td>
                     <td class="text-left">
                    <a >Telephone No:</a>
                  </td>
                  
                  <td class="text-left">
                    <a >Address</a>
                  </td>
                   <td class="text-left">
                    <a >Customer Code</a>
                  </td>
                
                   <td class="text-left">
                    <a >District</a>
                  </td>
                
                  <td class="text-left">
                    <a >Action</a>
                  </td>
                 
                </tr>
              </thead>
              <?php if($retailerdata) { ?>
              <tbody>
               
               <?php 
                 foreach($retailerdata as $resultt){   ?>
                <tr>
                  <td class="text-left"><?php echo $resultt['firstname']; ?></td>
                  <td class="text-left"><?php echo $resultt['lastname']; ?></td>
                  <td class="text-left"><?php echo  $resultt['email']; ?></td>
                  <td class="text-left"><?php echo $resultt['telephone'];?></td>
                 <td class="text-left"><?php echo $resultt['address']; ?></td>
                  <td class="text-left"><?php echo $resultt['sap_id']; ?></td>
                 <td class="text-left"><?php echo $resultt['district_id']; ?></td>
                  <td class="text-left"><a onclick="updateretailerreg(<?php echo $resultt['customer_id'] ?>);" style="color:rgb(102, 32, 62);cursor: pointer;" >Edit</a></td>
                  
                </tr>
               <?php }  ?>
               
              </tbody>
              <?php } else { ?>
              <tbody>
              <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                 </tbody>
               <?php } ?>
            </table>
          </div>
        
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>  
        </div>
       </div>
  </div>
</div> 

<?php echo $footer; ?>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});
//--></script>
<script type="text/javascript">
    
 $('#searchbtn').on('click', function() {

   
    url = 'index.php?route=Report/attendancereport&token='+getURLVar('token');
    
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_state_id = $('#state').val();
   
    var filter_mdo_id = $('#mdo').val();
    var filter_act_id = $('#act').val();
    if (filter_fdate_id && filter_tdate_id) {
        url += '&filter_from_date=' + encodeURIComponent(filter_fdate_id);
        url += '&filter_to_date=' + encodeURIComponent(filter_tdate_id);
    }  
    if(filter_state_id) {
        
        url += '&filter_state_id=' + encodeURIComponent(filter_state_id);
    }
    if(filter_mdo_id) {
        
        url += '&filter_mdo_id=' + encodeURIComponent(filter_mdo_id);
    }
    if(filter_act_id) {
        
        url += '&filter_act_id=' + encodeURIComponent(filter_act_id);
    }
   
                
    location = url;
});

function updateretailerreg(customerid){
    //alert(customerid);
    url = 'index.php?route=delar/delarregistration&customeridupdate='+customerid+'&token='+getURLVar('token');
    location = url;
}
// download
$('#downloadattendance').on('click', function() {

   
   url = 'index.php?route=Report/attendancereport/atten_download&token='+getURLVar('token');
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_state_id = $('#state').val();
   
    var filter_mdo_id = $('#mdo').val();
    var filter_act_id = $('#act').val();
    alert(filter_fdate_id);
    if (filter_fdate_id && filter_tdate_id) {
        url += '&filter_from_date=' + encodeURIComponent(filter_fdate_id);
        url += '&filter_to_date=' + encodeURIComponent(filter_tdate_id);
    }  
    if(filter_state_id) {
        
        url += '&filter_state_id=' + encodeURIComponent(filter_state_id);
    }
    if(filter_mdo_id) {
        
        url += '&filter_mdo_id=' + encodeURIComponent(filter_mdo_id);
    }
    if(filter_act_id) {
        
        url += '&filter_act_id=' + encodeURIComponent(filter_act_id);
    } 
   location = url;             
    
});
//end download

function backbtn(){
    url = 'index.php?route=delar/viewdealer&token='+getURLVar('token');
    location = url;
}
function download(){
     url = 'index.php?route=delar/viewdealer/dealar_download&token='+getURLVar('token');
    location = url; 
}
function CheckIsCharacter(e,t){
         try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                   
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
       }
       
       function getmdo(state_id){
          
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=Report/attendancereport/getmdo&token='+getURLVar('token'),
        data: 'state='+state_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

        //alert(data);
        $("#mdo").html(data);
        
        }


   });
           
   }
</script> 