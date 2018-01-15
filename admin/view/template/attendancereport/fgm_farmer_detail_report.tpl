<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
          <button  id="downloadfgmfarmer" class="btn btn-default pull-right" title="Download"><i class="fa fa-download"></i> </button>
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
  
        <div class="well">
           <div class="row">
          
            
            <div class="col-sm-2 form-group required">
              
              <div class=" input-group date">
              <input class="form-control" data-date-format="YYYY-MM-DD" value="<?php echo $lastfromdate; ?>" type="text" id="Group_Name" onchange="clear_Group_Name()" name="from_date"  placeholder="From Date"/>              
              <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
              </div>
              
              <div class="col-sm-2 form-group required">
              <div class="input-group date">
              <input class="form-control" type="text" value="<?php echo $lasttodate; ?>" data-date-format="YYYY-MM-DD" id="Group_Name" onchange="clear_Group_Name()" name="to_date"  placeholder="To Date"/>
              
               <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
            </div>
              <div class="col-sm-2 form-group required">
              <div class="">
               <select name="market" onchange="getmdo(this.value)" id="market" class="form-control">
                  <option value="">Select Market</option>
                   <?php foreach($market as $value) { ?>
                   <option value="<?php echo $value['SID']; ?>" <?php if($lastmarket==$value['SID']) { echo 'selected'; } ?> ><?php echo $value['GEO_NAME']; ?></option>
                  <?php } ?>
              </select> 
              </div>
             </div>     
               <div class="col-sm-2 form-group required">
              <div class="">
               <select name="mdo_name"  id="mdo_id" class="form-control">
                  <option value="">Select Mdo</option>
                   <?php foreach($mdo as $value) { ?>
                   <option value="<?php echo $value['customer_id']; ?>" <?php if($lastmdo==$value['customer_id']) { echo 'selected'; } ?> ><?php echo $value['name']; ?></option>
                  <?php } ?>
              </select> 
              </div>
             </div>  
               <div class="col-sm-2 form-group required">
              <div class="">
              <button  id="searchbtn" class="btn btn-primary pull-right"><i class="fa fa-search"></i>  Search</button>
              </div>
             </div>
           
              
          </div>
            
           
        </div>
    
      </div>
    </div>
    
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left"><a>Market Name</a></td>
                  <td class="text-left"><a>MDO Name </a></td>
                  <td class="text-left"><a>Fgm_Id</a></td>
                  <td class="text-left"><a>Fgm Date</a></td>
                  <td class="text-left"><a>Farmer Name </a></td>
                  <td class="text-left"><a>No of Milking Cow</a></td>
                  <td class="text-left"><a>Total  No of Cow</a></td>
                  <td class="text-left"><a>Daily Milk (In Ltrs)</a></td>
                   
     
                </tr>
              </thead>
              <tbody>
                   
                <?php if ($resultdata) { ?>
                    
                <?php  foreach ($resultdata as $geos) { ?>
                <tr>
                  <td class="text-left"><?php echo $geos['Market_name']; ?></td>                  
                  <td class="text-right"><?php echo $geos['Mdo']; ?></td>
                  <td class="text-left"><?php echo $geos['FGM_ID']; ?></td>
                   <td class="text-left"><?php echo $geos['Fgm_date']; ?></td>
                    <td class="text-left"><?php echo $geos['farmer_name']; ?></td>
                  <td class="text-right"><?php echo $geos['MILKING_COWS_CNT']; ?></td>
                   <td class="text-right"><?php echo $geos['TOTAL_COWS']; ?></td>
                   <td class="text-right"><?php echo $geos['DAILY_MILK_PROD']; ?></td>
 
                  
                </tr>
                <?php 
              
                } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div> 
             <!-- model for image1--->

<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div style="width:70%;margin-top: 30%;margin-left: 30%;" id="successmessage" class="modal-content">
<div class="modal-header" style="background-color: #1a3d5c;">
<label style="text-align: center;margin:-3%;width: 100%;color:white" class="col-md-6">View Image</label>
<button style="margin: -3%;color: white" type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">

<div class="row">
<div style="height:251px" id="img1"></div>
</div>
</div>

<div class="modal-footer" style=" background-color: #1a3d5c;">
</div>

</div>

</div>
</div>
<!-- end model---> 
        </div>
       </div>
  </div>
</div> 

<?php echo $footer; ?>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});
function onimage(id) {
var imgage1=$("#myImg"+id).attr('src');
var imgpath=[];
var img='<img src="'+ imgage1 +'">';
imgpath.push('<img class="thumbnail" style=" width: 414px;height: 259px;" id="viewimage" src="'+ imgage1 +'">');
$('#img1').html(imgpath);
$('#myModal1').modal();
}
//--></script>
<script type="text/javascript">
    
 $('#searchbtn').on('click', function() {

   
    url = 'index.php?route=Report/fgmfarmerdetailreport&token='+getURLVar('token');
    
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_market = $('#market').val();
     var filter_mdo = $('#mdo_id').val();
    
    
   if(filter_fdate_id=='' && filter_tdate_id!=''){
       
       alert('Select "From Date" and "To Date both" !');
   }
   if(filter_fdate_id!='' && filter_tdate_id==''){
       
       alert('Select "From Date" and "To Date both" !');
   }
   
    if (filter_fdate_id && filter_tdate_id) {
        url += '&filter_from_date=' + encodeURIComponent(filter_fdate_id);
        url += '&filter_to_date=' + encodeURIComponent(filter_tdate_id);
    }  
    if(filter_market) {
        
        url += '&filter_market=' + encodeURIComponent(filter_market);
    }
     if(filter_mdo) {
        
        url += '&filter_mdo=' + encodeURIComponent(filter_mdo);
    }
   
   
   
                
    location = url;
});

// download
$('#downloadfgmfarmer').on('click', function() {

   
   url = 'index.php?route=Report/fgmfarmerdetailreport/fgmfarmerreport_download&token='+getURLVar('token');
    
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_market = $('#market').val();
     var filter_mdo = $('#mdo_id').val();
    
    
   if(filter_fdate_id=='' && filter_tdate_id!=''){
       
       alert('Select "From Date" and "To Date both" !');
   }
   if(filter_fdate_id!='' && filter_tdate_id==''){
       
       alert('Select "From Date" and "To Date both" !');
   }
   
    if (filter_fdate_id && filter_tdate_id) {
        url += '&filter_from_date=' + encodeURIComponent(filter_fdate_id);
        url += '&filter_to_date=' + encodeURIComponent(filter_tdate_id);
    }  
    if(filter_market) {
        
        url += '&filter_market=' + encodeURIComponent(filter_market);
    }
     if(filter_mdo) {
        
        url += '&filter_mdo=' + encodeURIComponent(filter_mdo);
    }
   
   location = url;             
    
});
//end download

function backbtn(){
    url = 'index.php?route=Report/fgmfarmerdetailreport&token='+getURLVar('token');
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
       
       function getmdo(market_id){
         // alert(market_id);
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=Report/fgmfarmerdetailreport/getmdo&token='+getURLVar('token'),
        data: 'hq='+market_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

        //alert(data);
        $("#mdo_id").html(data);
        
        }


   });
           
   }
</script> 