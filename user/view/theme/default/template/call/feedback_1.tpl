
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
                <th>Mobile</th>
                <th>State</th>
                <th>Date</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Mobile</th>
                <th>State</th>
                <th>Date</th>
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($misscallData as $result)
            {
            echo "<tr>";
            echo "<td class='text-center' style='cursor: pointer; font-weight:bold; color:blue;'  onclick='showform(".$result['CASE_ID'].");'>".$result['MOBILE']."</td>";
            echo "<td>".$result['STATE']."</td>";
            echo "<td>".$result['DATE_RECEIVED']."</td>";
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
    $("#formdata").hide();
    $(".formdata-sub").hide();
    $(".del-tab").hide();
    $(".far-tab").hide();
    $(".com-tab").hide();
    $(".enq-tab").hide();
    $(".pro-act").hide();
    $(".subprodata").hide();
    $("#selst").select2({  width: '100%', height: '100%' });
    $("#seldt").select2({  width: '100%', height: '100%' });
    $("#eselst").select2({  width: '100%', height: '100%' });
    $("#eseldt").select2({  width: '100%', height: '100%' });
    $("#dselst").select2({  width: '100%', height: '100%' });
    $("#dseldt").select2({  width: '100%', height: '100%' });
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
function showform(caseid){
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/retrivedata",
    data: "caseid="+caseid,
    dataType: "text",
    success: function( data ) {
        $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
        $(".retrive-data").html(data);
        $("#far-mob").val(mob);
        $("#formdata").show();
    
        $("#selst").select2({  width: '100%', height: '100%' });
        $("#seldt").select2({  width: '100%', height: '100%' });
        $("#eselst").select2({  width: '100%', height: '100%' });
        $("#eseldt").select2({  width: '100%', height: '100%' });
        $("#dselst").select2({  width: '100%', height: '100%' });
        $("#dseldt").select2({  width: '100%', height: '100%' });
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
    }
    }); 
}
function showdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/distlist",
    data: "stsid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#dist-data").html(data);
        $("#seldt").select2();
        

    }
}); 
}
function eshowdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/edistlist",
    data: "stsid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#edist-data").html(data);
        $("#eseldt").select2();

    }
}); 
}
function dshowdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/ddistlist",
    data: "stsid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#ddist-data").html(data);
        $("#dseldt").select2();

    }
}); 
}
function showpro(catid){
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/prodlist",
    data: "catid="+catid,
    dataType: "text",
    success: function( data ) {

        $("#prod-data").html(data);
        $("#prodata").select2();

    }
}); 
}
function eshowpro(catid){
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/eprodlist",
    data: "catid="+catid,
    dataType: "text",
    success: function( data ) {

        $("#eprod-data").html(data);
        $("#eprodata").select2();

    }
}); 
}
function showcomp(comid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/feedback/complist",
    data: "comid="+comid,
    dataType: "text",
    success: function( data ) {

        $("#comp-data").html(data);
        $("#comdata").select2();

    }
}); 
}

function callsts(cstsid){
    //alert(stsid);
    if(cstsid==25)
    {
        $(".formdata-sub").show();
        $("#A").hide();
        $("#B").hide();
        $(".pro-act").hide();
        $(".2a").hide();
        $("#C").show();
        
        
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        
        $("#C").addClass("active");
        $("#3a").addClass("active");
    }
    else{
        $(".formdata-sub").show();
        $(".pro-act").show();
        $("#A").show();
        $("#B").show();
        $("#A").addClass("active");
        $("#1a").addClass("active");
        
        $(".subprodata").hide();
        
        $("#C").hide();
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
    }
}

</script>
<script type="text/javascript">
    function empsts(estsid){
        //alert(estsid);
        if(estsid==1)
        {
            $(".del-tab").hide();
            $(".far-tab").show();
            $(".subprodata").show();
            
        }
        if(estsid==2)
        {
            $(".far-tab").hide();
            $(".del-tab").show();
            $(".subprodata").show();
        }
    }
</script>
<script type="text/javascript">
  //*************** Submit Profile Data ***************//
  function subfeedbackdata(){
      //alert('Subpro Data');
      /*validation start*/
      
      
      var serlizedata = $("#clfrm").serialize();
      console.log(serlizedata);
      var url="index.php?route=call/feedback/savefeedback";
      console.log(url);
     
      $.post(url, serlizedata, function (data) {
      console.log(data);
      alert(data); 
      location.reload();
      });
     
      
  }
  //*************** Submit Enquiry Data ***************//
  function subenqdata(){
      alert('Subenq Data');
      var serlizedata = $("#clfrm").serialize();
      console.log(serlizedata);
        var url="index.php?route=call/feedback/saveform";
        console.log(url);
        $.post(url, serlizedata, function (data) {
            console.log(data);
        });
      
  }
  //*************** Back to Dashboard *****************//
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
