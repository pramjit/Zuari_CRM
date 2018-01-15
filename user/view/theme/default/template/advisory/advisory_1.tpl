
<?php echo $header;?>
<?php echo $column_left;  //print_r($pagination); ?>
<style type="text/css">
    .btn-default {
    background-color: #d4eaf7;
    border-color: #d4eaf7;
    color: #53acdf;
    padding: 10px 10px;
    text-align: center;
}
.col-md-4 , .col-md-8 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    padding-top: 10px;
   
}
.disabled {
   color: darkgrey;
   background-color: grey;
}
.name
{
    width:50%;
}
</style>
    
<div id="content">
  <div class="top-bar clearfix">
    <div class="page-title">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text']; ?>
      </a>
      <?php } ?>
    </div>
    <ul class="right-stats hidden-xs" id="mini-nav-right">
      <button type="button" onclick="backbtn();"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">
        <i class="fa fa-reply">
        </i>
      </button>
    <!--  <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>-->
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
<div   class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6" >
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>MOBILE</th>
                <th>CASE ID</th>
                <th>DATE</th>
                <th>CASE_PIN</th>
                <th>NO OF ATTEMPT</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>MOBILE</th>
                <th>CASE ID</th>
                <th>DATE</th>
                <th>CASE_PIN</th>
                <th>NO OF ATTEMPT</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($AdvData as $result)
            {
                
            echo "<tr>";
            echo "<td class='text-center' style='cursor: pointer; font-weight:bold; color:blue;' onclick='showform(".$result['FAR_MOB'].");'>".$result['FAR_MOB']."</td>";
            
              echo "<td>".$result['CASE_ID']."</td>";
              echo "<td>".$result['CR_DATE']."</td>";
              echo "<td>".$result['CASE_PIN']."</td>";
              echo "<td>".$result['CALL_COUNT']."</td>";
             
           // echo "<td>".$result['FAR_MOB']."</td>";
           
           
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
</div>
</div>
     
     <div class="col-sm-6">
       <form id="clfrm" name="clfrm">  
        
           
           <div class="col-md-5">   
			<input type="hidden" name="mob" id="mob" value="">
             <select class="form-control" name="compsts" id="compsts" onchange="showbox(this.value);">
              <option value=""> Select Status</option>
            <?php 
            foreach($statuslist as $result)
            {?>
               <option value="<?php echo $result["STATUS_ID"]; ?>"><?php echo $result["STATUS_NAME"]; ?></option>  
            
           <?php }
           ?>
           </select>
           <p id="status_p" style="display:none;color:red;">Please Select Status</p> 
         </div>
         <div class="col-md-5">
           <input type="button" id="regcom" name="regcom" class="btn btn-primary" value="Update Status" onclick="updateStatus();"  style="    padding: 6px 40px !important; font-size: 18px;">
         </div>
            </form>
        </div>
        
        </div>  
    </div>
   
</div>
</div>
</div> 
<?php echo $footer; ?>
<style type="text/css">
.abc{   color: #F00;
        padding-top: 10px;
        position: absolute;
        left: 5px;
        font-size: 20px;
}
</style>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<script src="user/view/javascript/alertify/alertify.js"></script>
<link href="user/view/javascript/alertify/alertify.css" rel="stylesheet" type="text/css"/>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

    $("#clfrm").hide();
 
    
    
    $("#callsts").hide();
    $("#regcom").hide();
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
function showform(mob){
     $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
     $("#caseid").val(mob);
     $('#mob').val(mob);
   
      $("#clfrm").show();
      $("#regcom").show();
}

  //*************** Back to Dashboard *****************//
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  function showbox(cid){
     $('#status_p').hide();
   
  }
  function updateStatus()
  {
    var statusid=$('#compsts').val();
    var mob=$('#mob').val();
       if($('#compsts').val().length===0){
        $('#status_p').show();
        }else
        {
            
     $.ajax({
     type: "POST",
     url: "index.php?route=advisory/advisory/updatestatus",
     data:  {statusid: statusid, mob: mob},
     dataType: "text",
     success: function(data) 
     {
       alert(data);
       location.reload("index.php?route=advisory/advisory");

    }
});
}
  
  }
  
</script> 
