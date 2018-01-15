
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
            <div class="col-md-4">
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>CASE ID</th>
                <th>MOBILE</th>
                <th>CASE_PIN</th>
                <th>COUNT</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($AdvData as $result)
            {
            echo "<tr>";
            echo "<td class='text-center' style='cursor: pointer; font-weight:bold; color:blue;' onclick='showform(".$result['CASE_ID'].");'>".$result['CASE_ID']."</td>";
            echo "<td>".$result['FAR_MOB']."</td>";
            echo "<td>".$result['CASE_PIN']."</td>";
            echo "<td>".$result['CALL_COUNT']."</td>";
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
</div>
</div>
            <div id="clfrm">
        <div class="col-sm-8">
            
                <div class="col-md-12"  style="font-size: 18px;font-weight: bold;color: #337ab7;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Remarks</div>
                
                <div class="col-md-12"><br /><hr></div>
                <div class="col-md-12">
                    <input type="hidden" name="caseid" id="caseid" value="" class="form-control">
                    <textarea class="form-control" id="comdtls" name="comdtls" placeholder="Remarks..."></textarea>
                </div>
                
                <div class="col-md-12"><br /></div>
                <div class="col-md-4">
                    <button class="btn btn-warning" disabled="disabled" style="padding: 7px 65px !important; font-size: 18px;"><i class='fa fa-volume-up' aria-hidden='true'></i>&nbsp;&nbsp;Play</button>
                </div>
                <div class="col-md-4">
                    
                    <select class="form-control" name="callsts" id="callsts" >
                        <option value="">Select Call Status</option>
                        <?php print_r($CallSts);
                            foreach ($CallSts as $sts){
                                echo '<option value="'.$sts['STATUS_ID'].'">'.$sts['STATUS_NAME'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="button" id="regcom" name="regcom" class="btn btn-primary" value="Submit Data" onclick="SaveFeedback();" style="    padding: 6px 52px !important; font-size: 18px;">
                </div>
            
        </div>
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
   /* $.ajax({
    type: "POST",
    url: "index.php?route=call/advisory/farmerprofile",
    data: "mob="+mob,
    dataType: "text",
    success: function( data ) {

        $(".far-tab").html(data);
        $("#state").select2({  width: '100%', height: '100%' });
        $("#majorcrop1").select2({  width: '100%', height: '100%' });
        $("#majorcrop2").select2({  width: '100%', height: '100%' });
        $("#majorcrop3").select2({  width: '100%', height: '100%' });
        
        
    }
});*/
     $("#clfrm").show();
}
function SaveFeedback(){
        
        var caseid=$("#caseid").val();
        var comdtls=$("#comdtls").val();
        if(comdtls==""){comdtls="NA";}
        var callsts=$("#callsts").val();
        if(callsts==""){
            alert('Select Call Status');
            return false;
        }
        $.ajax({
        type: "POST",
        url: "index.php?route=call/advisory/savefeedback",
        data: "caseid="+caseid+"&comdtls="+comdtls+"&callsts="+callsts,
        dataType: "text",
        success: function( data ) {
                        alert(data);
                        location.reload();
        }
    });
}
  //*************** Back to Dashboard *****************//
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
