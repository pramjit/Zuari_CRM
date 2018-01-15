
<?php echo $header;?>
<?php echo $column_left;  //print_r($pagination); ?>

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
    <div class="panel panel-default">
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
            <div class="col-sm-3 form-group required">
     <input class="form-control input-date" data-date-format="YYYY-MM-DD" type="text" id="from_date" onchange="clear_from_date()" name="from_date"  placeholder="From Date" value="<?php echo $lastfromdate; ?>"/> 
          <p id="from_date_p" style="display:none;color:red;">Required From Date</p> 

            </div>
            <div class="col-sm-3 form-group required">
              <input class="form-control input-date" type="text"  data-date-format="YYYY-MM-DD" id="to_date" onchange="clear_to_date()" name="to_date"  placeholder="To Date" value="<?php echo $lasttodate; ?>"/>
                <p id="to_date_p" style="display:none;color:red;">Required To Date</p>
            </div>
                
        <div class="col-sm-2">
          <button  id="searchbtn_order" class="btn btn-primary pull-right">
            <i class="fa fa-search">
            </i> View
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div   class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="example">
        <thead>
          <tr>
            <td class="text-center" style="font-weight: bold">SL NO</td>
            <td class="text-center" style="font-weight: bold">MOBILE NO</td>
            <td class="text-center" style="font-weight: bold">STATE</td>
            <td class="text-center" style="font-weight: bold">CALL TYPE</td>
            <td class="text-center" style="font-weight: bold">CALL STATUS</td>
            <td class="text-center" style="font-weight: bold">CREATE DATE</td>
            <td class="text-center" style="font-weight: bold">CYCLE DAYS</td>
           </tr>
        </thead>
        <?php if($misscallData) { ?>
        <tbody>
            <?php 
          
            $sno=1;
            foreach($misscallData as $resultt){   ?>
            <tr>
                <td class="text-center">
                    <?php echo $sno;?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['FAR_MOB'];?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['STATE']; ?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['CALL_TYPE']; ?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['COM_CASE_STATUS'];?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['CASE_CR_DATE']; ?>
                </td>
                <td class="text-center">
                    <?php echo $resultt['CYCLE_DAYS']; ?>
                </td> 
            </tr>
            <?php $sno++; } ?>
        <tbody>
        <?php } else { ?>
          <tr>
            <td class="text-center" colspan="8">
              <?php echo $text_no_results; ?>
            </td>
          </tr>
          <?php } ?>
    </table>
    </div>
    
  </div>
</div>
</div>
</div> 
<?php echo $footer; ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(function () {

$('.input-date').datepicker({ autoclose: true, format: 'yyyy-mm-dd'});
$("#example").dataTable({
"bPaginate": true,
"bLengthChange": false,
"bFilter": true,
"bInfo": false,
"bAutoWidth": true,
"dom": '<"top"f>rt<"bottom"p><"clear">',
"oLanguage": {
"sSearch": "Search&nbsp;&nbsp;:&nbsp;&nbsp;"}});

});
</script>
<script type="text/javascript">
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
     url='index.php?route=report/complain',
     
     
     url += '&from_date='+from_date,
     url += '&to_date='+to_date ,
     
      location = url;
      
});
function clear_date(){
     $('#date_p').hide();
}

  function download(){
    
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
     
    url = 'index.php?route=report/complain/misscall_download',
   
    url += '&from_date='+from_date,
    url += '&to_date='+to_date ,
   
   location = url;
  }
  function backbtn(){
    url = 'index.php?route=report/complain';
    location = url;
  }
  

</script> 






