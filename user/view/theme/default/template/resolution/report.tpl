
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
            <div class="col-md-12">
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>MOBILE</th>
                    <th>STATE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                        //print_r($misscallData);
                    foreach($misscallData as $result)
                    {
                        echo "<tr>";
                        echo "<td class='text-center'>".$result['MOBILE']."</td>";
                        echo "<td class='text-center'>".$result['STATE']."</td>";
                        echo "<td class='text-center'>".$result['DATE_RECEIVED']."</td>";
                        echo "<td class='text-center'>".$result['STATUS']."</td>";
                        echo "<td class='text-center'>".$result['MOBILE']."</td>";
                        echo "<td class='text-center'>".$result['STATE']."</td>";
                        echo "<td class='text-center'>".$result['DATE_RECEIVED']."</td>";
                        echo "<td class='text-center'>".$result['STATUS']."</td>";
                        echo "<td class='text-center'>".$result['MOBILE']."</td>";
                        echo "<td class='text-center'>".$result['STATE']."</td>";
                        echo "<td class='text-center'>".$result['DATE_RECEIVED']."</td>";
                        echo "<td class='text-center'>".$result['STATUS']."</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>  
    </div>
</div>
</div>
</div> 
<?php echo $footer; ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script src="user/view/javascript/alertify/alertify.js"></script>
<link href="user/view/javascript/alertify/alertify.css" rel="stylesheet" type="text/css"/>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>
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
"sSearch": "Search&nbsp;&nbsp;:&nbsp;&nbsp;"},
"dom": 'Bfrtip',
"buttons": [{ extend: 'excelHtml5', title:  function(){
                var d = moment().format('MMM_D_YYYY');
                //var n = d.getTime();
                return 'Missedcall :' + d;
            }},{ extend: 'pdfHtml5',title: 'Missedcall'}]
});


});
function showform(mob){
     $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
     $("#far-mob").val(mob);
     $("#formdata").show();
}
function showdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=resolution/report/distlist",
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
    url: "index.php?route=resolution/report/edistlist",
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
    url: "index.php?route=resolution/report/ddistlist",
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
    url: "index.php?route=resolution/report/prodlist",
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
    url: "index.php?route=resolution/report/eprodlist",
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
    url: "index.php?route=resolution/report/complist",
    data: "comid="+comid,
    dataType: "text",
    success: function( data ) {

        $("#comp-data").html(data);
        $("#comdata").select2();

    }
}); 
}

function callsts(cstsid){
    var emp = $("#emp-sts").val();
    
    if(cstsid==4 || cstsid==5 || cstsid==6 || cstsid==11 || cstsid==12 || cstsid==13 || cstsid==14 || cstsid==17 || cstsid==22 || cstsid==23 )
    {
        $(".formdata-sub").hide();
        $("#A").hide();
        $("#B").hide();
        $("#C").hide();
        $(".pro-act").show();
        $(".pro-emp").hide();
        $(".subprodata").show();
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
    }
    else if(cstsid==2){
        
        $(".formdata-sub").hide();
        $(".pro-act").show();
        $(".pro-emp").show();
        
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
        if(emp==1){ empsts(emp); }
    }
    else{
        
        $(".formdata-sub").hide();
        $(".pro-act").show();
        $(".pro-emp").show();
        
        $("#A").show();
        $("#B").hide();
        $("#A").addClass("active");
        $("#1a").addClass("active");
        
        $(".subprodata").hide();
        
        $("#C").hide();
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        if(emp==1){ empsts(emp); }
    }
}

</script>
<script type="text/javascript">
    function empsts(estsid){
        //alert(estsid);
        if(estsid==1)
        {
            $(".formdata-sub").show();
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
  function subprodata(){
      //alert('Subpro Data');
      /*validation start*/
      var calstsid=$("#call-sts").val();
      var empstsid=$("#emp-sts").val();
      
      var gfname=$("#far-name").val();
      var gffname=$("#far-fa-name").val();
      var gstate=$("#selst").val();
      var gdist=$("#seldt").val();
      var gaddrs=$("#far-add").val();
      var gpin=$("#far-pin").val();
      var gcrop1=$("#crop1").val();
      var gcropacr1=$("#corp1-acr").val();
      var gtotacr=$("#far-tot-acr").val();
      var gremarks=$("#far-remarks").val();
      var gpcat=$("#procat").val();
      var gpdata=$("#prodata").val();
      var gccat=$("#comcat").val();
      var gcdata=$("#comdata").val();
      var gdtls=$("#comdtls").val();
      
     if((calstsid==29 || calstsid==30 || calstsid==31 || calstsid==32 || calstsid==33 || calstsid==34) && empstsid==1 )
     {
      if(gfname=="")
      {
          alertify.error('Profile Details - Name required');
          return false;
      }
      if(gffname=="")
      {
          alertify.error('Profile Details - Father Name required');
          return false;
      }
      if(gstate=="")
      {
         alertify.error('Profile Details - Select State');
          return false;
      }
      if(gdist=="")
      {
          alertify.error('Profile Details - Select District');
          return false;
      }
      if(gaddrs=="")
      {
          alertify.error('Profile Details - Address required');
          return false;
      }
      if(gpin=="")
      {
          alertify.error('Profile Details - Pincode required');
          return false;
      }
       if(gcrop1=="")
      {
          alertify.error('Profile Details - Select Crop - I');
          return false;
      }
      if(gcropacr1=="")
      {
          alertify.error('Profile Details - Crop - I Acreage required');
          return false;
      }
      if(gtotacr=="")
      {
          alertify.error('Profile Details - Total Acreage required');
          return false;
      }
      if(gremarks=="")
      {
          alertify.error('Profile Details - Remarks required');
          return false;
      }
     }
     //NETWORK Validation End
     
     if(calstsid==2 && empstsid==1)//Complaints 
     {
      if(gfname=="")
      {
        alertify.error('Profile Details - Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gffname=="")
      {
        alertify.error('Profile Details - Father Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gstate=="")
      {
        alertify.error('Profile Details - Select State');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gdist=="")
      {
        alertify.error('Profile Details - Select District');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gaddrs=="")
      {
        alertify.error('Profile Details - Address required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gpin=="")
      {
        alertify.error('Profile Details - Pincode required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gcrop1=="")
      {
        alertify.error('Profile Details - Select Crop - I');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gcropacr1=="")
      {
        alertify.error('Profile Details - Crop - I Acreage required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gtotacr=="")
      {
        alertify.error('Profile Details - Total Acreage required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gremarks=="")
      {
        alertify.error('Profile Details - Remarks required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }      
      
      if(gpcat=="0")
      {
        alertify.error('Complaint Section - Select Product Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpdata=="0")
      {
        alertify.error('Complaint Section - Select Product');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gccat=="0")
      {
        alertify.error('Complaint Section - Select Complaint Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gcdata=="0")
      {
        alertify.error('Complaint Section - Select Complaint Sub-category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gdtls=="")
      {
        alertify.error('Complaint Section - Complaint Details Required');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
           
     }
     
     
     
     
      var serlizedata = $("#clfrm").serialize();
      console.log(serlizedata);
      var url="index.php?route=resolution/report/saveform";
      console.log(url);
      $.post(url, serlizedata, function (data) {
      console.log(data);
      alertify.success(data); 
      location.reload();
        });
      
      
  }
  //*************** Submit Enquiry Data ***************//
  function subenqdata(){
      alert('Subenq Data');
      var serlizedata = $("#clfrm").serialize();
      console.log(serlizedata);
        var url="index.php?route=resolution/report/saveform";
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
