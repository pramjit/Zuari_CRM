
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
      <?php $n=0;
      foreach ($breadcrumbs as $breadcrumb) { if($n>0){ echo " > ";} ?>
      
      <a href="<?php echo $breadcrumb['href']; ?>">
        <?php echo $breadcrumb['text']; ?>
        
      </a>
      <?php $n++;} ?>
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
            <div class="col-md-12">
                
                <div class="clearfix"></div>
                <div class="table-responsive">
                   <table id="example" class="table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr role="row" style="background: #12a4f4; color: #ffffff;">
                <th>SNO</th>
                <th>CASE ID</th>
                <th>PIN</th>
                <th>MOBILE</th>
                <th>CREATE DATE</th>
               
            </tr>
        </thead>
       
        <tbody>
            <?php
            //print_r($MyCaseData);
            $n=1;
            foreach($MyCaseData as $result)
            {
            echo "<tr>";
            echo "<td>".$n."</td>";
            echo "<td onclick='CaseDetails(".$result['CASE_ID'].")' style='color:blue;font-weight:bold;cursor:pointer;'>".$result['CASE_ID']."</td>";
            echo "<td>".$result['CASE_PIN']."</td>";
            echo "<td>".$result['CASE_MOB']."</td>";
            echo "<td>".$result['CASE_DATE']."</td>";
            echo "</tr>";
            $n++;
            }
           ?>
        </tbody>
    </table>
</div>
</div>
  
    <!------------------- MODAL FOR PRODUCT LIST -------------------------->
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Submit Review</h4>
        </div>
        <div class="col-md-4">
            <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
        </div>
        <div class="col-md-4"> 
            <button class="btn btn-warning play-audio" style="padding: 7px 65px !important; font-size: 18px;" onclick="PlayAudio();"><i class='fa fa-volume-up' aria-hidden='true'></i>&nbsp;&nbsp;Play</button>
        </div>
        <div class="col-md-4">
            <input type="button" id="regcom" name="regcom" class="btn btn-primary" value="Submit Approve" onclick="SaveFeedback();" style="padding: 6px 35px !important; font-size: 18px;">
        </div>
        <div class="clearfix"></div>
        <form id="advfrm" name="advfrm">   
                <input type="hidden" class="form-control" name="caseid" id="caseid" value="">
                <div id="CN"></div>
                <div id="CP"></div>
                <div id="CD"></div>
                <div id="SL"></div>
                <div id="IR"></div>
                <div id="OT"></div>
        </form>
        <div class="clearfix"></div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
    <!------------------------ MODAL END ---------------------------------->
    <!------------------- MODAL FOR PRODUCT LIST -------------------------->
    <div class="modal fade" id="myModalAudio" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 25% !important;">
      <div class="modal-content">
       
        <div class="audio-data">
            
        </div>
      </div>
    </div>
    </div>
    <!------------------------ MODAL END ----------------------------------> 
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
    $(document).ready(function(){
    $("#formdata").hide();
    $(".formdata-sub").hide();
    $(".del-tab").hide();
    $(".far-tab").hide();
    $(".com-tab").hide();
    $(".enq-tab").hide();
    $("#selst").select2({  width: '100%', height: '100%' });
    $("#seldt").select2({  width: '100%', height: '100%' });
    $("#eselst").select2({  width: '100%', height: '100%' });
    $("#eseldt").select2({  width: '100%', height: '100%' });
    $("#crop1").select2({  width: '100%', height: '100%' });
    $("#crop2").select2({  width: '100%', height: '100%' });
    $("#ecrop").select2({  width: '100%', height: '100%' });
    $("#procat").select2({  width: '100%', height: '100%' });
    $("#prodata").select2({  width: '100%', height: '100%' });
    $("#eprocat").select2({  width: '100%', height: '100%' });
    $("#eprodata").select2({  width: '100%', height: '100%' });
    $("#comcat").select2({  width: '100%', height: '100%' });
    $("#comdata").select2({  width: '100%', height: '100%' });
    $("#ecat").select2({  width: '100%', height: '100%' });
    $("#etyp").select2({  width: '100%', height: '100%' });
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
function showcase(caseid){
    //alert(caseid);
    $.ajax({
    type: "POST",
    url: "index.php?route=advisory/mycases/prodlist",
    data: "caseid="+caseid,
    dataType: "text",
    success: function( data ) {

        $(".com-details").html(data);
        $('#myModal').modal('show');

    }
}); 

}


function viewhistory(cid){
    //alert('CaseID'+cid);
     $.ajax({
    type: "POST",
    url: "index.php?route=advisory/mycases/history",
    data: "caseid="+cid,
    dataType: "text",
    success: function( data ) {
        //alert(data);
        $(".com-history").html(data);
        $('#myModalHis').modal('show');

    }
}); 
}


function subradata(){
    //alert('RA DATA');
    
    var data = new FormData();
    data.append('ra_file', $('#ra_doc')[0].files[0]);
    var ra_case = $('#ra_case').val();
    var ra_com = $('#ra_com').val();
    var ra_sts = $('#ra_sts').val();
    var url="index.php?route=advisory/mycases/subradata&ra_case="+ra_case+"&ra_com="+ra_com+"&ra_sts="+ra_sts;
    console.log(data);
    console.log(url);
    $.ajax({
    type: "POST",
    url: url,
    data: data,
    contentType: false,
    cache : false,
    processData :false,
    dataType: "text",
    success: function( data ) {
        $('#myModal').modal('hide');
        alert(data); 
        location.reload();

    }
}); 
}
function approve(csid){
    var rmks = 'NA';
      $.ajax({
    type: "POST",
    url: "index.php?route=advisory/mycases/approve&csid="+csid+"&rmks="+rmks,
    //data: "csid="+csid+"&rmks="+rmks,
    contentType: false,
    cache : false,
    processData :false,
    dataType: "text",
    success: function( data ) {
        $('#myModal').modal('hide');
        alert(data); 
        location.reload();

    }
}); 
    
}
function editapprove(csid){
    
    var rmks = $("#adv-remarks").val();
   // alert(csid);
    //alert(rmks);
     $.ajax({
    type: "POST",
    url: "index.php?route=advisory/mycases/approve&csid="+csid+"&rmks="+rmks,
    //data: "csid="+csid+"&rmks="+rmks,
    contentType: false,
    cache : false,
    processData :false,
    dataType: "text",
    success: function( data ) {
        $('#myModal').modal('hide');
        alert(data); 
        location.reload();

    }
}); 
    
}


function CaseDetails(mob){
    //alert(caseid);
    console.log(mob);
    $("#profile").html("Case Id&nbsp;&nbsp;:"+mob+"</span><hr><br>");
    $("#caseid").val(mob);
    $.ajax({
    type: "POST",
    url: "index.php?route=advisory/mycases/advrecord",
    data: "caseid="+mob,
    dataType: "json",
    success: function( data ) {
        
        console.log(data);
        
            $("#CN").html(data.CN);
            $("#CP").html(data.CP);
            $("#CD").html(data.CD);
            $("#SL").html(data.SL);
            $("#IR").html(data.IR);
            $("#OT").html(data.OT);
        
        if(data.AD=='NA'){
            $(".play-audio").show();
            $(".play-audio").prop("disabled",true);
        }
        else
        {
            $(".play-audio").show();
            $(".play-audio").prop("disabled",false);
            $('.audio-data').html(data.AD);
        }
    }
});
        $("#advfrm").show();
        $("#regcom").show();
        $('#myModal').modal('show');
}
function PlayAudio(){
  $('#myModalAudio').modal('show');
  }
function SaveFeedback(){
    var serlizedata = $("#advfrm").serialize();
        console.log(serlizedata);
        var url="index.php?route=advisory/mycases/savefeedback";
        console.log(url);
        $.post(url, serlizedata, function (data) {
            console.log(data);
            alert(data);
            //alertify.success(data); 
            location.reload();
        });
      
    }

</script>
<script>
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
