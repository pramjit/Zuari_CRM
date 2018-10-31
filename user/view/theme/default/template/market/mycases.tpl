
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
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr role="row" style="background: #12a4f4; color: #ffffff;">
                <th>SNO</th>
                <th>CASE ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADVISORY TYPE</th>
                <th>CREATE DATE</th>
                <th>DUE SINCE DAYS</th>
                <th>STATUS</th>
                <th>SOURCE</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <tfoot>
            <tr role="row" style="background: #12a4f4; color: #ffffff;">
                <th>SNO</th>
                <th>CASE ID</th>
                <th>NAME</th>
                <th>PHONE</th>
                <th>ADVISORY TYPE</th>
                <th>CREATE DATE</th>
                <th>DUE SINCE DAYS</th>
                <th>STATUS</th>
                <th>SOURCE</th>
                <th>DETAILS</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($MyCaseData);
            $n=1;
            foreach($MyCaseData as $result)
            {
            echo "<tr>";
            echo "<td>".$n."</td>";
            echo "<td>".$result['CASE_ID']."</td>";
            echo "<td>".$result['CASE_NAME']."</td>";
            echo "<td>".$result['CASE_MOB']."</td>";
            echo "<td>".$result['CASE_TYPE']."</td>";
            echo "<td>".$result['CR_DATE']."</td>";
            echo "<td>".$result['DAYS']."</td>";
            echo "<td>".$result['CASE_STATUS']."</td>";
            echo "<td>".$result['COMP_SRC']."</td>";
            echo "<td onclick='showcase(".$result['CASE_ID'].");' class='btn-default'><i class='fa fa-external-link' aria-hidden='true'></i></td>";
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
    <div class="modal-dialog modal-lg" style="width: 50% !important;">
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
    <!------------------- MODAL FOR COMPLAIN HISTORY -------------------------->
    <div class="modal fade" id="myModalHis" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">COMPLAINT HISTORY</h4>
        </div>
        <div class="modal-body com-history">
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
    <!------------------------ MODAL HISTORY END ---------------------------------->
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
    url: "index.php?route=market/mycases/prodlist",
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
    url: "index.php?route=market/mycases/history",
    data: "caseid="+cid,
    dataType: "text",
    success: function( data ) {
        //alert(data);
        $(".com-history").html(data);
        $('#myModalHis').modal('show');

    }
}); 
}
function SubMoFeed(CID){
    
    var mo_feed=$('#mo_feed').val();
    if(mo_feed.length==''){
        alert('Feedback required');
        return false;
    }
    var mo_sts=$('#mo_sts').val();
    if(mo_sts=='7'){
        alert('Select Status');
        return false;
    }
    var mo_case=$('#mo_case').val();
    
    var url="index.php?route=market/mycases/submodata&mo_case="+mo_case+"&mo_feed="+mo_feed+"&mo_sts="+mo_sts;
    $.ajax({
    type: "POST",
    url: url,
    contentType: false,
    cache : false,
    processData :false,
    dataType: "text",
    success: function(data) {
        $('#myModal').modal('hide');
        alert(data); 
        location.reload();

    }
});
    
}

function subaadata(){
    //alert('RA DATA');
    
    var data = new FormData();
    data.append('ra_file', $('#ra_doc')[0].files[0]);
    var ra_case = $('#ra_case').val();
    var ra_com = $('#ra_com').val();
    var ra_sts = $('#ra_sts').val();
    var url="index.php?route=market/mycases/subaadata&ra_case="+ra_case+"&ra_com="+ra_com+"&ra_sts="+ra_sts;
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

</script>
<script>
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
