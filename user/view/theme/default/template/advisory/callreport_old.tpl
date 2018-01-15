
<?php echo $header;?>
<?php echo $column_left; //echo "<pre>"; print_r($fdata); ?>

<div id="content">
  <div class="top-bar clearfix">
    <div class="page-title">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text'].'/'; ?>
      </a>
      <?php } ?>
    </div>
    <ul class="right-stats hidden-xs" id="mini-nav-right">
      <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">
        <i class="fa fa-reply">
        </i>
      </button>
      <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>
    </ul>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
      <i class="fa fa-exclamation-circle">
      </i> 
      <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;
      </button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success">
      <i class="fa fa-check-circle">
      </i> 
      <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;
      </button>
    </div>
    <?php } ?>
    <!--<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          <i class="fa fa-search">
          </i> 
          Search
        </h3>
      </div>
        
       <div class="panel-body">
        <div class="well">
         <div class="row">
             <div class="col-sm-2 form-group required">
            <input class="form-control input-date" data-date-format="YYYY-MM-DD" type="text" id="from_date" onchange="clear_from_date()" name="from_date"  placeholder="From Date" value="<?php echo $lastfromdate; ?>"/> 
            <p id="from_date_p" style="display:none;color:red;">Required From Date</p> 

            </div>
            <div class="col-sm-2 form-group required">
              <input class="form-control input-date" type="text"  data-date-format="YYYY-MM-DD" id="to_date" onchange="clear_to_date()" name="to_date"  placeholder="To Date" value="<?php echo $lasttodate; ?>"/>
                <p id="to_date_p" style="display:none;color:red;">Required To Date</p>
            </div>
             <div class="col-sm-2" form-group required  >
                  <select class="form-control" id="state_name" onchange="clear_state_name();">
                      <option value="">Select State</option>
                       <option value="null">All State</option>
                     <?php foreach($state as $state1){?>
                     <option value="<?php echo $state1["GEO_ID"]; ?>"<?php if($state1["GEO_ID"]==$statev) { echo 'selected'; } ?>><?php echo $state1["NAME"]; ?></option>
                         
                    <?php } ?>
                  </select>
                  <p id="state_name_p" style="display:none;color:red;">Required State Name</p>
              </div>
             <div class="col-sm-2" form-group required  >
                  <select class="form-control" id="complain_name" onchange="clear_complain_name();">
                      <option value="">Select Complain</option>
                       <option value="null">All Complain</option>
                       <?php foreach($comcat as $comcat1){?>
                     <option value="<?php echo $comcat1["SID"]; ?>"<?php if( $comcat1["SID"]==$complainv) { echo 'selected'; } ?>><?php echo $comcat1["COMP_CATG"]; ?></option>
                         
                    <?php } ?>
                  </select>
                  <p id="complain_name_p" style="display:none;color:red;">Required Complain Name</p>
              </div>
             <div class="col-sm-2" form-group required  >
                  <select class="form-control" id="pendding_name" onchange="clear_pendding_name();">
                      <option value="">Select Pending </option>
                       <option value="null">All Pending </option>
                      <?php foreach($pendding as $comcatt1){?>
                     <option value="<?php echo $comcatt1["sid"]; ?>"<?php if($comcatt1["sid"]==$penddingv) { echo 'selected'; } ?>><?php echo $comcatt1["case_status"]; ?></option>
                         
                    <?php } ?>
                  </select>
                  <p id="pendding_name_p" style="display:none;color:red;">Required Pending Name</p>
              </div>
            
                
        <div class="col-sm-2 form-group required">
          <button  id="searchbtn" class="btn btn-primary pull-right" onclick="searchRecords();">
            <i class="fa fa-search">
            </i> Search
          </button>
        </div>
      </div>
    </div>
  </div>
</div>-->
      <div class="table-responsive">
            <table class="table display" id="example">
            <thead>
            <tr style="background: #515151; color: #ffffff !important;">
            <td>S No.</td>
            <td >DATE</td>
            <td >MOBILE NO.</td>
            <td >TYPE OF CALLS</td>
            <td >ZONE</td>
            <td >STATE</td>
            <td >DISTRICT</td>
            <td >NEW/EXITING</td>
            
             
            
            </tr>
              </thead>
              <tbody>
                <?php if($orders){
                //print_r($orders);die;
                $a='1';
                foreach($orders as $order){
             
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $a; ?></td>
                        <td class="text-left"><?php echo $order['CR_DATE'];?></td>
                        <td class="text-left"><?php echo $order['MOBILE'];?></td>
                        <td class="text-left"><?php echo $order['CALL_STATUS'];?></td>
                        <td class="text-left"><?php echo $order['ZONE'];?></td>
                        <td class="text-left"><?php echo $order['STATE'];?></td>
                        <td class="text-left"><?php echo $order['REGION'];?></td>
                        <td class="text-left"><?php echo $order['FAR_LIVE'];?></td>
                          
                
                    </tr>			
		<?php
                    $a++;
                    }
		}
                ?>                      
              </tbody>
            </table>
        </div>

    

<?php echo $footer; ?>

<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>


<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
$( document ).ready(function() 
{
    $('#example').DataTable({

  "pageLength": 25
  
  
} );
});
</script>

<script type="text/javascript">
$(function () {

$('.input-date').datepicker({ format: 'yyyy-mm-dd',autoclose: true});

});
</script>
<script type="text/javascript">
    $(document).ready(function()
    {
    $('#example').DataTable();
   } );
    $('#searchbtn_order').click(function() {
   
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    
   if($('#from_date').val().length===0){
        $('#from_date_p').show();
        return false;
        }
        if($('#to_date').val().length===0){
        $('#to_date_p').show();
        return false;
        }
     url='index.php?route=report/missedcall',
     
     
     url += '&from_date='+from_date,
     url += '&to_date='+to_date ,
     
      location = url;
      
});
  function clear_state_name()
    {
         $('#state_name_p').hide();
    }/*function clear_complain_name()
    {
         $('#complain_name_p').hide();
    }
    function clear_pendding_name()
    {
         $('#pendding_name_p').hide();
    }*/
    
    function clear_from_date()
    {
         $('#from_date_p').hide();
    }
     function clear_to_date()
    {
         $('#to_date_p').hide();
    }
    function searchRecords()
    {  
      if($('#from_date').val().length===0){
        $('#from_date_p').show();
        }else if($('#to_date').val().length===0){
        $('#to_date_p').show();
        }/*else if ($('#state_name').val().length ===0) {
        $('#state_name_p').show();
        }else if ($('#complain_name').val().length ===0) {
        $('#complain_name_p').show();
         }else if ($('#pendding_name').val().length ===0) {
        $('#pendding_name_p').show();
     }*/else 
     {
           var from_date = $('#from_date').val();
           var to_date = $('#to_date').val();
           var state = $('#state_name').val();
           var complain = $('#complain_name').val();
           var pendding = $('#pendding_name').val();
           url='index.php?route=complaint/complaindetails',
           url += '&from_date='+from_date,
           url += '&to_date='+to_date ,
           url += '&state='+state ,
           url += '&complain='+complain ,
           url += '&pendding='+pendding ,
           location = url;
           
           
     }
 
       
    }
  function download(){
           var from_date = $('#from_date').val();
           var to_date = $('#to_date').val();
           var state = $('#state_name').val();
           var complain = $('#complain_name').val();
           var pendding = $('#pendding_name').val();
           url='index.php?route=advisory/callreport/downloadexcel',
           url += '&from_date='+from_date,
           url += '&to_date='+to_date ,
           url += '&state='+state ,
           url += '&complain='+complain ,
           url += '&pendding='+pendding ,
           location = url;
  }
 function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  

</script> 






