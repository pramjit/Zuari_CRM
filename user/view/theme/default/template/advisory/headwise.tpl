
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
             <div class="col-sm-4" form-group required  >
                  <select class="form-control" id="advhead_name" onchange="clear_state_name();">
                      <option value="<?php echo $headVData;?>"><?php echo $headV;?></option>
                      <option value="">All Advisory Head</option>
                      <option value="Crop Nutrition">Crop Nutrition</option>
                      <option value="Crop Protection">Crop Protection</option>
                      <option value="no conversation">no conversation</option>
                      <option value="Seed">Seed</option>
                      <option value="Irrigation">Irrigation</option>
                      <option value="Others">Others</option>
                 </select>
                  <p id="state_name_p" style="display:none;color:red;">Required State Name</p>
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
</div>
      <div class="table-responsive" width="100%">
          <table class="table display" id="example">
         <thead>
          <tr style="background: #515151; color: #ffffff !important;">
           <td >S No.</td>
           <td style="width:10%;">Date</td>
           <td >Mobile No.</td>
           <td> Advisory Head</td>
           <td >Advisory Head Content</td>
           <td >Zone</td>
           <td>State</td>
           <td >Region</td>
            
       </tr>
        </thead>
              <tbody>
                <?php if($head){
                $a='1';
		foreach($head as $order){
                ?>
                    <tr>
                        <td ><?php echo $a; ?></td>
                        <td ><?php echo $order['CR_DATE'];?></td>
                        <td ><?php echo $order['MOBILE'];?></td>
                        <td ><?php echo $order['ADV_HEAD'];?></td>
                        <td ><?php echo $order['ADV_HEAD_DETAILS'];?></td> 
                        <td ><?php echo $order['ZONE'];?></td>
                        <td ><?php echo $order['STATE'];?></td>
                        <td ><?php echo $order['REGION'];?></td>
                        
                      
                    </tr>			
		<?php
                    $a++;
                    }
		}
                ?>                      
              </tbody>
            </table>
        </div>
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

  "pageLength": 10
  
  
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
           var advhead_name = $('#advhead_name').val();
          
         
           url='index.php?route=advisory/headwise',
           url += '&from_date='+from_date,
           url += '&to_date='+to_date ,
           url += '&advhead_name='+advhead_name ,
          
           location = url;
           
           
     }
 
       
    }
  function download(){
           var from_date = $('#from_date').val();
           var to_date = $('#to_date').val();
           var advhead_name = $('#advhead_name').val();
          
         
           url='index.php?route=advisory/headwise/downloadExcel',
           url += '&from_date='+from_date,
           url += '&to_date='+to_date ,
           url += '&advhead_name='+advhead_name ,
          
           location = url;
  }
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  

</script> 






