
<?php echo $header; $sid="";?>
<?php echo $column_left; //echo "<pre>"; print_r($advdata); ?>
<style type="text/css">
  
</style>
    
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
          <i class="fa fa-search">
          </i> 
          Search
        </h3>
      </div>
        
       <div class="panel-body">
        <div class="well">
          <div class="row">
             <!--<div class="col-sm-3" form-group required  >
                  <select class="form-control" id="agent_name" onchange="clear_agent_name();">
                      <option value="">Select Agent</option>
                       <option value="1">1</option>
                  </select>
                  <p id="agent_name_p" style="display:none;color:red;">Required Agent Name</p>
              </div>-->
            <div class="col-sm-5 form-group required">
            <input class="form-control input-date" data-date-format="YYYY-MM-DD" type="text" id="from_date" onchange="clear_from_date()" name="from_date"  placeholder="From Date" value="<?php echo $lastfromdate; ?>"/> 
          <p id="from_date_p" style="display:none;color:red;">Required From Date</p> 

            </div>
            <div class="col-sm-5 form-group required">
              <input class="form-control input-date" type="text"  data-date-format="YYYY-MM-DD" id="to_date" onchange="clear_to_date()" name="to_date"  placeholder="To Date" value="<?php echo $lasttodate; ?>"/>
                <p id="to_date_p" style="display:none;color:red;">Required To Date</p>
            </div>
                
        <div class="col-sm-2">
          <button  id="searchbtn" class="btn btn-primary pull-right" onclick="searchRecords();">
            <i class="fa fa-search">
            </i> Search
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="table-responsive" width="100%">
  <table class="table display" id="example">
     <thead>
       <tr style="background: #515151; color: #ffffff !important;">
           <th>S NO.</th>
           <th>STATE</th>
           <th>FARMER NOT RESPONDING</th>
           <th>CLOSED</th>
           <th>PENDING APPROVAL</th>
           <th>PENDING AT ADVISORY</th>
           <th>PENDING AT CC</th>
           <th>GRAND TOTAL</th>

          
       </tr>
        </thead>
           <tbody>
                <?php if($farmerSummary){
                $a='1';
               
		foreach($farmerSummary as $order){
                    $totOrder=$order['FARMER NOT RESPONDING']+$order['CLOSED']+$order['PENDING APPROVAL']+$order['PENDING ADVISORY']+$order['PENDING CC'];
                    $totA=$totA+$totOrder;
                    $gtot=$gtot+$order['FARMER NOT RESPONDING'];
                    $totC= $totC+$order['CLOSED'];
                    $totS=$totS+$order['PENDING APPROVAL'];
                    $totN=$totN+$order['PENDING ADVISORY'];
                    $totT=$totT+$order['PENDING CC'];
                    ?>
                    <tr>
                        <td ><?php echo $a; ?></td>
                        <td ><?php echo $order['STATENAME'];?></td>
                        <td ><?php echo $order['FARMER NOT RESPONDING'];?></td>
                        <td ><?php echo $order['CLOSED'];?></td>
                        <td ><?php echo $order['PENDING APPROVAL'];?></td>
                        <td ><?php echo $order['PENDING ADVISORY'];?></td>
                        <td ><?php echo $order['PENDING CC'];?></td>
                        <td ><?php echo $totOrder;?></td>
                        
                        
                        

                        
                      
                    </tr>			
		<?php
                    $a++;
                    }?>
                    <tr>
                        <td class="text-right"><b>Total :</b></td>
                        <td></td>
                        <td ><b><?php echo $gtot; ?></b></td>
                        <td ><b><?php echo $totC; ?></b></td>
                        <td ><b><?php echo $totS; ?></b></td>
                        <td ><b><?php echo $totN; ?></b></td>
                        <td ><b><?php echo $totT; ?></b></td>
                        <td ><b><?php echo $totA; ?></b></td>
		<?php }
                ?>                      
              </tbody>
</table>
 </div>  
</div>
         
</div>

 <?php echo $footer;  ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
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
         url = 'index.php?route=adminreport/farmersummaryreport4',
         url += '&from_date='+from_date,
         url += '&to_date='+to_date ,
         location = url;
        }
 
       
    }
    
    
    
function download()
{
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
 
    
       if($('#from_date').val().length===0){
        $('#from_date_p').show();
        }else if($('#to_date').val().length===0){
        $('#to_date_p').show();
        }else 
        {
            url = 'index.php?route=adminreport/farmersummaryreport4/downloadExcel',
            url += '&from_date='+from_date,
            url += '&to_date='+to_date ,
            location = url;
        }
  }
  
  function backbtn()
  {
    url = 'index.php?route=common/dashboard';
    location = url;
  }
   function showData(caseid)
   {
    $.ajax({
    type: "POST",
    url: "index.php?route=approval/allcases/dataList",
    data: "caseid="+caseid,
    dataType: "text",
    success: function(data)
    {
       
        $('#myModal').modal('toggle');
        $("#myModeldata").html(data);
       
       
        

    }
}); 
   }
   function showData1(caseid)
   {
       
    $.ajax({
    type: "POST",
    url: "index.php?route=approval/allcases/viewData",
    data: "caseid="+caseid,
    dataType: "text",
    success: function(data)
    {
      
      $('#myModal1').modal('toggle');
      $("#myModeldata1").html(data);
       
       
        

    }
}); 
   }
   
   
   
   
</script> 
