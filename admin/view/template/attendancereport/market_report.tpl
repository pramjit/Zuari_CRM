<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
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
          
            
            <div class="col-sm-3 form-group required">
              
              <div class=" input-group date">
              <input class="form-control" data-date-format="YYYY-MM-DD" value="<?php echo $lastfromdate; ?>" type="text" id="Group_Name" onchange="clear_Group_Name()" name="from_date"  placeholder="From Date"/>              
              <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
              </div>
              
              <div class="col-sm-3 form-group required">
              <div class="input-group date">
              <input class="form-control" type="text" value="<?php echo $lasttodate; ?>" data-date-format="YYYY-MM-DD" id="Group_Name" onchange="clear_Group_Name()" name="to_date"  placeholder="To Date"/>
              
               <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
            </div>
              <div class="col-sm-3 form-group required">
              <div class="">
               <select name="state" onchange="getmdo(this.value)" id="state" class="form-control">
                  <option value="">Select Territory</option>
                   <?php foreach($state as $value) { ?>
                   <option value="<?php echo $value['SID']; ?>" <?php if($laststate==$value['SID']) { echo 'selected'; } ?> ><?php echo $value['GEO_NAME']; ?></option>
                  <?php } ?>
              </select> 
              </div>
             </div>     
               
               
             <div class="col-sm-3 form-group required">  
              <div class="">
               <select name="mdo" id="mdo" class="form-control">
                  <option value="">Select Market</option>
                   <?php foreach($hq as $value) { ?>
                   <option value="<?php echo $value['SID']; ?>" <?php if($lastmdo==$value['SID']) { echo 'selected'; } ?> ><?php echo $value['GEO_NAME']; ?></option>
                  <?php } ?>
                 
              </select> 
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
              </div>
              
          </div>
            
            <div class="row">
                 <div class="col-sm-3 form-group required" style="float: left">  
              <div class="">
                
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
                </div>
                <div class="form-group required">   
              <div class="">
                   <button  id="downloadattendance" class="btn btn-default pull-right"><i class="fa fa-download"></i>  Download</button>
                  <button  id="searchbtn" class="btn btn-primary pull-right"><i class="fa fa-search"></i>  Search</button>
                 
              </div>
                    
          </div>
                
            </div>
        </div>
    
      </div>
    </div>
     <?php if($geo) { ?>
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  
                 
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_mdo_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_mdo_name; ?></a>
                    <?php } ?></td>
                  
                   <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_market; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_market; ?></a>
                    <?php } ?></td>
                   
                  <td class="text-left"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_date; ?></a>
                    <?php } ?></td>
                  
                  <td class="text-left"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_act; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_act; ?></a>
                    <?php } ?></td>
                 
                </tr>
              </thead>
              <tbody>
               
                <?php if ($geo) { ?>
                <?php foreach ($geo as $geos) { ?>
                <tr>
                  
                 
                  
                  <td class="text-left"><?php echo $geos['Mdo']; ?></td>
                  <td class="text-left"><?php echo $geos['Market_Name']; ?></td>
                  <td class="text-left"><?php echo $geos['cr_date']; ?></td>
                  <td class="text-left"><?php echo $geos['count']; ?></td>
                 
                  
                </tr>
                <?php } ?>
                <?php }else { ?>
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
        </div>
       </div>
      <?php } ?>
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

   
    url = 'index.php?route=Report/marketreport&token='+getURLVar('token');
    
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_state_id = $('#state').val();
    var filter_mdo_id = $('#mdo').val();
    
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
    
   
                
    location = url;
});

// download
$('#downloadattendance').on('click', function() {

   
   url = 'index.php?route=Report/marketreport/atten_download&token='+getURLVar('token');
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_state_id = $('#state').val();
    var filter_mdo_id = $('#mdo').val();
    
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
   location = url;             
    
});
//end download

function backbtn(){
    url = 'index.php?route=Report/marketreport&token='+getURLVar('token');
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
       
       function getmdo(territory_id){
        // alert(territory_id);
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=Report/marketreport/gethq&token='+getURLVar('token'),
        data: 'territory='+territory_id,
        //dataType: 'json',
        cache: false,

        success: function(data) {

        
        $("#mdo").html(data);
        
        }


   });
           
   }
   
  

</script> 