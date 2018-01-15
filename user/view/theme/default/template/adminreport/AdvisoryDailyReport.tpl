
<?php echo $header; $sid="";?>
<?php echo $column_left; //echo "<pre>"; print_r($advdata); ?>
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
      <button type="button" onclick="backbtn();"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-primary                                                                                                                                            ">
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
          Call Center Executive Report
        </h3>
      </div>
        
       <div class="panel-body">
        <div class="well">
          <div class="row">
                <div class="col-sm-2" form-group required  >
                  <select class="form-control" id="exid" name="exid" onchange="clear_agent_name();">
                      <option value="">SELECT EXECUTIVE</option>
                      <?php
                      foreach ($AgentList as $Ex){
                          echo '<option value='.$Ex['EX_ID'].'>'.strtoupper($Ex['EX_NAME']).'</option>';
                      }
                      ?>
                      
                  </select>
                  <p id="agent_name_p" style="display:none;color:red;">Required Agent Name</p>
                </div>
                <div class="col-sm-2" form-group required  >
                  <select class="form-control" id="callid" name="callid" onchange="clear_agent_name();">
                      <option value="">SELECT CALL TYPE</option>
                      <option value="1">ADVISORY CALL</option>
                      <option value="2">COMPLAINT CALL</option>
                  </select>
                  <p id="agent_name_p" style="display:none;color:red;">Required Agent Name</p>
                </div>
                <div class="col-sm-2 form-group required">
                <input class="form-control input-date" data-date-format="YYYY-MM-DD" type="text" id="from_date" onchange="clear_from_date()" name="from_date"  placeholder="DATE FROM" value="<?php echo $lastfromdate; ?>"/> 
                    <p id="from_date_p" style="display:none;color:red;">Required From Date</p> 
                </div>
                <div class="col-sm-2 form-group required">
                    <input class="form-control input-date" type="text"  data-date-format="YYYY-MM-DD" id="to_date" onchange="clear_to_date()" name="to_date"  placeholder="DATE TO" value="<?php echo $lasttodate; ?>"/>
                    <p id="to_date_p" style="display:none;color:red;">Required To Date</p>
                </div>
                
        <div class="col-sm-2">
            <button  name="View Details" class="btn btn-primary pull-right" onclick="RecordList();"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;SHOW DETAILS</button>
        </div>
        <div class="col-sm-2">
            <button  name="View Record" class="btn btn-warning pull-right" onclick="download();"><i class="fa fa-download"></i>&nbsp;DOWNLOAD</button>
        </div>      
      </div>
    </div>
  </div>
</div>
<div class="table-responsive tbl-data" width="100%">
   
</div>  
</div>
</div>
 <!------------------- MODAL FOR PRODUCT LIST -------------------------->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 75% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">COMPLAINT DETAILS</h4>
        </div>
        <div class="com-details">
       
        </div>
      </div>
    </div>
    </div>
    <!------------------------ MODAL END ---------------------------------->
<?php echo $footer;  ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<script src="user/view/javascript/alertify/alertify.js"></script>
<link href="user/view/javascript/alertify/alertify.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
$( document ).ready(function() 
{
    $('#example').DataTable({
        "order": [] ,
        "pageLength": 25
} );
$('.input-date').datepicker({ format: 'yyyy-mm-dd',autoclose: true});
});
</script>



<script>
     function clear_agent_name()
    {
         $('#agent_name_p').hide();
    }
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
       var from_date = $('#from_date').val();
       var to_date = $('#to_date').val();
       
       if($('#from_date').val().length===0){
        $('#from_date_p').show();
        }else if($('#to_date').val().length===0){
        $('#to_date_p').show();
        }else 
        {
         url = 'index.php?route=adminreport/complainthistory',
         url += '&from_date='+from_date,
         url += '&to_date='+to_date ,
         location = url;
        }
 
       
    }
    
    
    
function download()
{
   var exid=$('#exid').val();
    if(exid==''){
        alertify.error('Please Select An Executive');
        return false;
    }
    
    var callid=$('#callid').val();
    if(callid==''){
        alertify.error('Please Select Call Type');
        return false;
    }
    var frmdt   = $('#from_date').val();
    var todt    = $('#to_date').val();
            url = 'index.php?route=adminreport/AdvisoryDailyReport/downloadExcel',
            url += '&exid='+exid,
            url += '&callid='+callid,
            url += '&frmdt='+frmdt,
            url += '&todt='+todt,
            location = url;
}
  
  function backbtn()
  {
    url = 'index.php?route=common/dashboard';
    location = url;
  }
function RecordList(){
    var exid=$('#exid').val();
    if(exid==''){
        alertify.error('Please Select An Executive');
        return false;
    }
    
    var callid=$('#callid').val();
    if(callid==''){
        alertify.error('Please Select Call Type');
        return false;
    }
    var frmdt = $('#from_date').val();
    var todt = $('#to_date').val();
    $.ajax({
        type: "POST",
        url: "index.php?route=adminreport/AdvisoryDailyReport/RecordList",
        data:  {exid: exid, callid: callid, frmdt: frmdt, todt: todt},
        dataType: "text",
        success: function(data) 
        {
            //alert(data);
            $('.tbl-data').html(data);
            $('#example').DataTable({
            "order": [] ,
            "pageLength": 25
            } );

        }
    });
}
function CaseHistory(CaseId){
    //alert(CaseId);
    $.ajax({
    type: "POST",
    url: "index.php?route=adminreport/complainthistory/history",
    data: "caseid="+CaseId,
    dataType: "text",
    success: function( data ) {
       //alert(data);
       $(".com-details").html(data);
       $('#myModal').modal('show');
    }
}); 
    
}
</script> 
