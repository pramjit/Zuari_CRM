
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
    <div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>MOBILE</th>
                <th>PIN</th>
                <th>ATTEMPT</th>
                <th>DATE</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>MOBILE</th>
                <th>PIN</th>
                <th>ATTEMPT</th>
                <th>DATE</th>
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($ServiceData as $result)
            {
            echo "<tr>";
            echo "<td class='text-center' style='cursor: pointer; font-weight:bold; color:blue;'  onclick='showform(".$result['MOB'].','.$result['SID'].','.$result['PIN'].");'>".$result['MOB']."</td>";
            echo "<td>".$result['PIN']."</td>";
            echo "<td>".$result['TOT_ATTEMPT']."</td>";
            echo "<td>".$result['CR_DATE']."</td>";
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
    </div>
</div>
        <div class="retrive-data">
                
        </div>   
            
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
        $("#app-sd").select2({  width: '100%', height: '100%' });
        $("#app-dd").select2({  width: '100%', height: '100%' });
        $("#app-md").select2({  width: '100%', height: '100%' });

        $("#example").dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
            "dom": '<"top"f>rt<"bottom"p><"clear">',
            "oLanguage": {
            "sSearch": "Search&nbsp;&nbsp;:&nbsp;&nbsp;"}
        });
    });
function showform(mob,caseid,casepin){
    //alert(mob+' , '+caseid);
    $.ajax({
    type: "POST",
    url: "index.php?route=call/appservice/retrivedata",
    data: "caseid="+caseid+"&casepin="+casepin,
    dataType: "text",
    success: function( data ) {
        $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
        $(".retrive-data").html(data);
        $("#app-sd").select2({  width: '100%', height: '100%' });
        $("#app-dd").select2({  width: '100%', height: '100%' });
        }
    }); 
}
function showdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/appservice/distlist",
    data: "stsid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#dist-data").html(data);
        $("#app-dd").select2({  width: '100%', height: '100%' });
        

    }
}); 
}
function showmo(dtid){
  //alert(dtid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/appservice/molist",
    data: "dtsid="+dtid,
    dataType: "text",
    success: function( data ) {

        $("#mo-data").html(data);
        $("#app-md").select2();

    }
}); 
}
function ShowAns(ans){
    //alert(ans);
    if(ans=="1"){
        $('#ans-div').show();
    }
    else{
        $('#ans-div').hide();
    }
}
function showpro(catid){
    $.ajax({
    type: "POST",
    url: "index.php?route=call/appservice/prodlist",
    data: "catid="+catid,
    dataType: "text",
    success: function( data ) {

        $("#prod-data").html(data);
        $("#prodata").select2();

    }
}); 
}
function upappdata(){
    $('.upappdata').hide();
    var call_sts=$("#app-cal").val();
    if(!call_sts){
        alert('Select Call Status'); 
        $('.upappdata').show();
        return false;
    }
    if(call_sts==1){
        var appcid=$("#app-cid").val();
        var appsd=$('#app-sd').val();
        if(!appsd){ alert('Select State'); $('.upappdata').show(); return false;}
        var appdd=$('#app-dd').val();
        if(!appdd){ alert('Select District'); $('.upappdata').show(); return false;}
        var appser=$('#app-ser').val();
        if(!appser){ alert('Select Query Type'); $('.upappdata').show(); return false;}
        var appmd=$('#app-md').val();
        if(!appmd && appser!=2){ alert('Select Mo'); $('.upappdata').show(); return false;}
        var appusr=$('#app-usr').val();
        var apppro=$('#app-pro').val();
        var appsto=$('#app-sto').val();
        var appqty=$('#app-qty').val();
        var appodr=$('#app-odr').val();
        var appqry=$('#app-qry').val();
        var appans=$('#app-ans').val();
        if(!appans){ alert('Select Is Answered?'); $('.upappdata').show(); return false;}
        var appsol=$('#app-sol').val();
        if(!appsol && appans==1){ alert('Feedback required'); $('.upappdata').show(); return false;}
        var appupby=$('#app-odr').val();
    }
  
    var serlizedata = $("#appfrm").serialize();
    alert(serlizedata);
    return false;
    var url="index.php?route=call/appservice/SaveFormData";
    $.post(url, serlizedata, function (data) {
        console.log(data);
        alert(data); 
        location.reload();
    });
}
</script>

<script type="text/javascript">
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
