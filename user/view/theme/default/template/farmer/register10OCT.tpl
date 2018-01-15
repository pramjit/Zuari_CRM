
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
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($misscallData as $result)
            {
            echo "<tr>";
            echo "<td class='text-center' style='cursor: pointer; font-weight:bold; color:blue;' onclick='showform(".$result['MOBILE'].");'>".$result['MOBILE']."<br />PIN : ".$result['PIN']."</td>";
            echo "<td>".$result['STATE']."</td>";
            echo "<td>".$result['DATE_RECEIVED']."</td>";
            echo "<td>".$result['STATUS'].": (".$result['TOT_ATTEMPT'].")</td>";
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
</div>
</div>
        <div class="col-sm-8">
            
            <form name="callform" id="clfrm">
            <div class="table-responsive">
                <div class="form-group" id="formdata">
                <label class="col-md-2 btn-default">STATUS</label>
                <div class="col-md-3">
                    <select id="call-sts" name="call-sts" class="form-control"  onchange="callsts(this.value);">
                        <option value="0">Select</option>
                        <?php foreach($CallSts as $sts){ ?>
                            <option value="<?php echo $sts['STATUS_ID']; ?>"><?php echo $sts['STATUS_NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="pro-act">
                <div class="pro-emp">
                <label class="col-md-2 btn-default" for="selectbasic">USER</label>
                <div class="col-md-3">
                    <select id="emp-sts" name="emp-sts" class="form-control" onchange="empsts(this.value);">
                        <option value="0">Select</option>
                        <?php foreach($CallUsr as $usr){ ?>
                            <option value="<?php echo $usr['SID']; ?>"><?php echo $usr['NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                </div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-primary subprodata" value="SUBMIT" onclick="subprodata();">
                </div>
                </div>
                </div>
                <div class="clearfix"><br/><hr/><br/></div>
                <div id="loader" class="text-center" style="display:none;"><img src="user/view/img/loading3.gif"></div>
                <div id="exTab1" class="formdata-sub">	
                    <ul  class="nav nav-pills">
                        <li class="active" id="A">
                        <a href="#1a" data-toggle="tab">PROFILE DETAILS</a>
                    </li>
                    <li id="B">
                        <a href="#2a" data-toggle="tab">COMPLAINT DETAILS</a>
                    </li>
                    <li id="C">
                        <a href="#3a" data-toggle="tab">ENQUIRY DETAILS</a>
                    </li>
                    </ul>
                    <div class="tab-content clearfix" style="padding: 0px!important;">
                        
                       <!------***********-----Profile Form-----**********------->
                       <div class="tab-pane active" id="1a">
                       <!--##############Dealer Profile##################-->     
                       <fieldset class="del-tab">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control" id="del-id" name="del-id" placeholder="*DEALER/FRANCHISE ID" />
                                    <div class="abc">*</div>
                                    <input type="text" class="form-control" id="del-firm" name="del-firm" placeholder="FIRM NAME" />
                                </div>
                                <div class="col-md-4">
                                    <div class="abc">*</div>
                                    <input type="text" class="form-control" id="del-name" name="del-name" placeholder="NAME OF COMPLAINANT" />
                                </div>
                                <div class="col-md-4">
                                    <div class="abc">*</div>
                                    <input type="text" class="form-control" id="del-mob" name="del-mob" MaxLength="10" placeholder="MOBILE NO" readonly="readonly"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <div class="abc">*</div>
                                <select id="dselst" name="dselst" class="form-control select2" onchange="dshowdist(this.value);">
                                    <option value="">SELECT STATE</option>
                                    <?php foreach($StateData as $state){ ?>
                                    <option value="<?php echo $state['GEO_ID']; ?>"><?php echo $state['NAME']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="col-md-4" id="ddist-data">
                                    <div class="abc">*</div>
                                <select id="dseldt" name="dseldt" class="form-control select2-selection--single">
                                    <option value="">SELECT DISTRICT</option>
                                   
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="abc">*</div>
                                <select id="del-cat" name="del-cat" class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="1">DEALER</option>
                                    <option value="2">RETAILER</option>
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-add" name="del-add" placeholder="DEALER LOCATION" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control" id="del-pin" name="del-pin" MaxLength="6"  placeholder="PINCODE" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46" >
                                    <div class="abc">*</div>
                                    <input type="text" class="form-control" id="del-adv-code" name="del-adv-code" MaxLength="10"  placeholder="DEALER ADVENTZ CODE">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-mfm-code" name="del-mfm-code" placeholder="DEALER MFMS CODE">
                                </div>
                                <div class="col-md-8">
                                    <div class="abc">*</div>
                                    <textarea class="form-control" id="del_remarks" name="del_remarks" placeholder="Remarks..."></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <!--#############Farmer Profile Start################## -->    
                        <fieldset class="far-tab">
                        
                        </fieldset>
                        <!--#############Farmer Profile End################## --> 
                        </div>
                        <!------***********-----Complaints Form-----**********------->
                        <div class="tab-pane" id="2a">
                        <fieldset>
                        <!-- Text input-->
                            <div class="form-group" id="com-sec">
                            <div class="col-md-4">
                                <div class="abc">*</div>
                                <select id="comcat" name="comcat" class="form-control select2" onchange="showcomp(this.value);">
                                    <option value="0">Complaint Category</option>
                                     <?php foreach($CompCatData as $comp){ ?>
                                    <option value="<?php echo $comp['SID']; ?>"><?php echo $comp['COMP_CATG']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="abc">*</div>
                                <div id="comp-data">
                                <select id="comdata" name="comdata" class="form-control select2">
                                    <option value="0">Complaint Sub Category</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            </div>
                        <div class="clearfix"></div>
                        <!-- Text input-->
                            <div class="form-group" id="pro-sec">
                                <div class="col-md-4">
                                <div class="abc">*</div>
                                <div id="prod-grp">
                                <select id="progrp" name="progrp" class="form-control select2" onchange="showprocat(this.value);">
                                    <option value="">Select Product Group</option>
                                    <?php foreach($ProdCatData as $pcat){ ?>
                                    <option value="<?php echo $pcat['PRODUCT_ID']; ?>"><?php echo $pcat['PRODUCT_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                </div>
                            
                            <div class="col-md-4">
                                <div class="abc">*</div>
                                <div id="prod-cat">
                                <select id="procat" name="procat" class="form-control select2">
                                    <option value="">Select Product Category</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="abc">*</div>
                                <div id="prod-data">
                                <select id="pro-name" name="pro-name" class="form-control select2">
                                    <option value="">Select Product</option>
                                </select>
                                </div>
                            </div>
                                </div>
                            <div class="form-group" id="pro-sub-sec">
                            <div class="col-md-4" id="prod-brand">
                                <input type="text" class="form-control" id="pro-brand" name="pro-brand"  placeholder="Product Brand">
                                
                            </div>
                            
                            <div class="col-md-4">
                                <select id="pro-imp" name="pro-imp" class="form-control select2">
                                    <option value="">Is Imported</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="pro-batch" name="pro-batch"  placeholder="Batch Number">
                            </div>
                                </div>
                            <div class="form-group" id="pro-sub-sec2">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="pro-plant" name="pro-plant"  placeholder="Manufacturing Plant">
                                
                            </div>
                            
                                <div class="col-md-4">
                                <input type="text" class="form-control" id="pro-pkg-my" name="pro-pkg-my"  placeholder="Month/Year of Manufacture/Packiging">
                                
                            </div>
							<div class="col-md-4"></div>
                            </div>
                        <div class="clearfix"></div>
						<div class="form-group">
                            <div class="col-md-8">
                                <div class="abc">*</div>
                                <textarea class="form-control" id="comdtls" name="comdtls" placeholder="Complaint Detail"></textarea>
                            </div>
                            </div>
                            
                        </fieldset>
                        </div>
                     </div>
                </div>
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
    $("#formdata").hide();
    $(".formdata-sub").hide();
    $(".del-tab").hide();
    $(".far-tab").hide();
    $(".com-tab").hide();
    $(".enq-tab").hide();
    $(".pro-act").hide();
    $(".subprodata").hide();
    $("#state").select2({  width: '100%', height: '100%' });
    $("#district").select2({  width: '100%', height: '100%' });
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
function showregion(zoid){//Geting Region From Zone
    
    //alert(zoid);
    
     $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/regionlist",
    data: "zoid="+zoid,
    dataType: "text",
    success: function( data ) {

        $("#regi-data").html(data);
        $("#district").select2();
        

    }
}); 
}


function showform(mob){
     $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
     $('#del-mob').val(mob);
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/farmerprofile",
    beforeSend : function(){
                $('#loader').show();
                $('.nav-pills').hide();
                $('.tab-content').hide();
            },  
    data: "mob="+mob,
    dataType: "text",
    success: function( data ) {
        $('#loader').hide();
        $('.nav-pills').show();
        $('.tab-content').show();
        $(".far-tab").html(data);
        $("#state").select2({  width: '100%', height: '100%' });
        $("#district").select2({  width: '100%', height: '100%' });
        $("#majorcrop1").select2({  width: '100%', height: '100%' });
        $("#majorcrop2").select2({  width: '100%', height: '100%' });
        $("#majorcrop3").select2({  width: '100%', height: '100%' });
        
        
    }
});
     $("#formdata").show();
}
function showdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/distlist",
    data: "stsid="+stid,
    dataType: "json",
    success: function(data) {
           // alert(data.zodata);
        $("#dist-data").html(data.dtdata);
        $("#zone-data").html(data.zodata);
        $("#regi-data").html(data.rgdata);
        $("#prod-grp").html(data.progrp);
        $("#prod-cat").html(data.procat);
        $("#prod-data").html(data.prodat);
        $("#district").select2();
        

    }
}); 
}
function showmo(dtid){
  //alert(dtid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/molist",
    data: "dtid="+dtid,
    dataType: "text",
    success: function(data) {
        //alert(data);
           // alert(data.zodata);
        $("#mo-data").html(data);
        //$("#mo-data").select2({  width: '100%', height: '100%' });
    
    }
}); 
}


function eshowdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/edistlist",
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
    url: "index.php?route=farmer/register/ddistlist",
    data: "stsid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#ddist-data").html(data);
        $("#dseldt").select2();

    }
}); 
}
function showpro(catid){
    var stid=$('#state').val();
    //alert (catid);
    //alert (stid);
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/prodlist",
    data: "catid="+catid+"&stid="+stid,
    dataType: "text",
    success: function( data ) {

        $("#prod-data").html(data);
        $("#pro-name").select2({  width: '100%', height: '100%' });
       

    }
}); 
}
function showbrand(proid){
    //alert (proid);
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/prodbrand",
    data: "proid="+proid,
    dataType: "text",
    success: function( data ) {

        $("#prod-brand").html(data);
        $("#prodata").select2();

    }
}); 
}



function showprocat(grid){
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/prodcat",
    data: "grid="+grid,
    dataType: "text",
    success: function( data ) {

        $("#prod-cat").html(data);
        $("#prodata").select2();

    }
}); 
}
function eshowpro(catid){
    $.ajax({
    type: "POST",
    url: "index.php?route=farmer/register/eprodlist",
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
    url: "index.php?route=farmer/register/complist",
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
        $('#com-sec').show();
        $('#pro-sub-sec').show();
        $('#pro-sub-sec2').show();
        $("#B").html('<a href="#2a" data-toggle="tab">COMPLAINTS DETAILS</a>');
        $("#B").show();
        $("#A").addClass("active");
        $("#1a").addClass("active");
        
        $(".subprodata").hide();
        
        $("#C").hide();
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        if(emp==1||emp==2){ empsts(emp); }
    }
    else if(cstsid==29){
        
        $(".formdata-sub").hide();
        $(".pro-act").show();
        $(".pro-emp").show();
        
        $("#A").show();
        $('#com-sec').hide();
        $('#pro-sub-sec').hide();
        $('#pro-sub-sec2').hide();
        $("#B").html('<a href="#2a" data-toggle="tab">PRODUCT DETAILS</a>');
        $("#B").show();
        $("#A").addClass("active");
        $("#1a").addClass("active");
        
        $(".subprodata").hide();
        
        $("#C").hide();
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        if(emp==1||emp==2){ empsts(emp); }
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
        if(emp==1||emp==2){ empsts(emp); }
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
            $(".formdata-sub").show();
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
      
      var gzone=$("#zone").val();
      var gregion=$("#region").val();
      var gstate=$("#state").val();
      var gdist=$("#district").val();
      var gmooffice=$("#mooffice").val();
      
      var gffn=$("#farmerfirstname").val();
      var gfmn=$("#farmermiddlename").val();
      var gfln=$("#farmerlastname").val();
      
      var gfv=$("#farmervillage").val();
      var gft=$("#farmertaluka").val();
      var gfm=$("#farmermobile").val();
      
      var gipf=$("#isprogressivefarmer").val();
      var gmc1=$("#majorcrop1").val();
      var gma1=$("#acreage1").val();
      var gmc2=$("#majorcrop2").val();
      var gma2=$("#acreage2").val();
      var gmc3=$("#majorcrop3").val();
      var gma3=$("#acreage3").val();
      var gremarks=$("#remarks").val();
      
      var gpgrp=$("#progrp").val();
      var gpcat=$("#procat").val();
      var gpdata=$("#pro-name").val();
      var gccat=$("#comcat").val();
      var gcdata=$("#comdata").val();
      var gdtls=$("#comdtls").val();
      
      
      var delfirm=$("#del-firm").val();
      var delname=$("#del-name").val();
      var delmobi=$("#del-mob").val();
      var delstat=$("#dselst").val();
      var deldist=$("#dseldt").val();
      var deladvz=$("#del-adv-code").val();
      var delrmks=$("#del-remarks").val();
      
     if((calstsid==29 || calstsid==30 || calstsid==31 || calstsid==32 || calstsid==33 || calstsid==34 || calstsid==36) && empstsid==1 )
     {
      if(gzone=="")
      {
          alertify.error('Profile Details - Zone required');
          return false;
      }
      if(gregion=="")
      {
          alertify.error('Profile Details - Region required');
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
      if(gmooffice=="")
      {
          alertify.error('Profile Details - Mo Office required');
          return false;
      }
      if(gffn=="")
      {
          alertify.error('Profile Details - First Name required');
          return false;
      }
       if(gfmn=="")
      {
          alertify.error('Profile Details - Middle Name required');
          return false;
      }
       if(gfln=="")
      {
          alertify.error('Profile Details - Last Name required');
          return false;
      }
       if(gfv=="")
      {
          alertify.error('Profile Details - Farmer village required');
          return false;
      }
      if(gft=="")
      {
          alertify.error('Profile Details - Farmer Taluka Required');
          return false;
      }
      if(gfm=="")
      {
          alertify.error('Profile Details - Farmer Mobile required');
          return false;
      }
      if(gipf=="")
      {
          alertify.error('Profile Details - Select Is Progressive Farmer');
          return false;
      }
      if(gmc1=="")
      {
          alertify.error('Profile Details - Select Crop1');
          return false;
      }
      if(gma1=="")
      {
          alertify.error('Profile Details - Crop1 Acreage required');
          return false;
      }
     
      if(gremarks=="")
      {
          alertify.error('Profile Details - Remarks required');
          return false;
      }
     }
     //******************************* DEALER VALIDATION NEW ******************************//
     if((calstsid==29 || calstsid==30 || calstsid==31 || calstsid==32 || calstsid==33 || calstsid==34 || calstsid==36) && empstsid==2 )
     {
      
      if(delfirm=="")
      {
          alertify.error('Profile Details - Firm name required');
          return false;
      }
      if(delname=="")
      {
          alertify.error('Profile Details - Complainant name required');
          return false;
      }
      if(delmobi=="")
      {
         alertify.error('Profile Details - Dealer Mobile Required');
          return false;
      }
      if(delstat=="")
      {
          alertify.error('Profile Details - Select State');
          return false;
      }
      if(deldist=="")
      {
          alertify.error('Profile Details - Select District');
          return false;
      }
      if(deladvz=="")
      {
          alertify.error('Profile Details - Adventz Code Required');
          return false;
      }
       if(delrmks=="")
      {
          alertify.error('Profile Details - Remarks Required');
          return false;
      }
       
     }
     //******************************* DEALER VALIDATION NEW END******************************//
     //NETWORK Validation End
     if(calstsid==29 && empstsid==1){//Complaints 
     
      if(gzone=="")
      {
        alertify.error('Profile Details - Zone required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gregion=="")
      {
        alertify.error('Profile Details - Region required');
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
      if(gmooffice=="")
      {
        alertify.error('Profile Details - Mo Office required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gffn=="")
      {
        alertify.error('Profile Details - First Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfmn=="")
      {
        alertify.error('Profile Details - Middle Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfln=="")
      {
        alertify.error('Profile Details - Last Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfv=="")
      {
        alertify.error('Profile Details - Farmer village required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gft=="")
      {
        alertify.error('Profile Details - Farmer Taluka Required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gfm=="")
      {
        alertify.error('Profile Details - Farmer Mobile required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gipf=="")
      {
        alertify.error('Profile Details - Select Is Progressive Farmer');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gmc1=="")
      {
        alertify.error('Profile Details - Select Crop1');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gma1=="")
      {
        alertify.error('Profile Details - Crop1 Acreage required');
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
     /* Complaint Section Validation */
     
      
      if(gpgrp=="0" || gpgrp=="")
      {
        alertify.error('Product Section - Select Product Group');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpcat=="0" || gpcat=="")
      {
        alertify.error('Product Section - Select Product Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpdata=="0" || gpdata=="")
      {
        alertify.error('Product Section - Select Product');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      
      if(gdtls=="")
      {
        alertify.error('Product Section - Complaint Details Required');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
           
     }
     //******************************* DEALER WITH NON-PRODUCT********************************//
     if(calstsid==29 && empstsid==2){//Complaints 
     
      if(delfirm=="")
      {
        alertify.error('Profile Details - Firm name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(delname=="")
      {
        alertify.error('Profile Details - Complainant name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(delstat=="")
      {
        alertify.error('Profile Details - Select State');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(deldist=="")
      {
        alertify.error('Profile Details - Select District');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(deladvz=="")
      {
        alertify.error('Profile Details - Adventz Code required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      
      if(delrmks=="")
      {
        alertify.error('Profile Details - Remarks required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      
     /* Complaint Section Validation */
     
      
      if(gpgrp=="0" || gpgrp=="")
      {
        alertify.error('Product Section - Select Product Group');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpcat=="0" || gpcat=="")
      {
        alertify.error('Product Section - Select Product Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpdata=="0" || gpdata=="")
      {
        alertify.error('Product Section - Select Product');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      
      if(gdtls=="")
      {
        alertify.error('Product Section - Complaint Details Required');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
           
     }
     //******************************* DEALER WITH NON-PRODUCT END****************************//
     if(calstsid==2 && empstsid==1){//Complaints 
     
     if(gzone=="")
      {
        alertify.error('Profile Details - Zone required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gregion=="")
      {
        alertify.error('Profile Details - Region required');
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
      if(gmooffice=="")
      {
        alertify.error('Profile Details - Mo Office required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gffn=="")
      {
        alertify.error('Profile Details - First Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfmn=="")
      {
        alertify.error('Profile Details - Middle Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfln=="")
      {
        alertify.error('Profile Details - Last Name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
       if(gfv=="")
      {
        alertify.error('Profile Details - Farmer village required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gft=="")
      {
        alertify.error('Profile Details - Farmer Taluka Required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gfm=="")
      {
        alertify.error('Profile Details - Farmer Mobile required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gipf=="")
      {
        alertify.error('Profile Details - Select Is Progressive Farmer');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gmc1=="")
      {
        alertify.error('Profile Details - Select Crop1');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(gma1=="")
      {
        alertify.error('Profile Details - Crop1 Acreage required');
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
     /* Complaint Section Validation */
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
      if(gpgrp=="0" || gpgrp=="")
      {
        alertify.error('Complaint Section - Select Product Group');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpcat=="0" || gpcat=="")
      {
        alertify.error('Complaint Section - Select Product Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpdata=="0" || gpdata=="")
      {
        alertify.error('Complaint Section - Select Product');
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
     //************************* COMPLAINT DEALER VALIDATTION *********************//
     if(calstsid==2 && empstsid==2){//Complaints 
     
      if(delfirm=="")
      {
        alertify.error('Profile Details - Firm name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(delname=="")
      {
        alertify.error('Profile Details - Complainant name required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(delstat=="")
      {
        alertify.error('Profile Details - Select State');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(deldist=="")
      {
        alertify.error('Profile Details - Select District');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(deladvz=="")
      {
        alertify.error('Profile Details - Adventz Code required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
      if(delrmks=="")
      {
        alertify.error('Profile Details - Remarks required');
        $("#B").removeClass("active");
        $("#2a").removeClass("active");
        $("#A").addClass("active");
        $("#1a").addClass("active")
        return false;
      }
     /* Complaint Section Validation */
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
      if(gpgrp=="0" || gpgrp=="")
      {
        alertify.error('Complaint Section - Select Product Group');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpcat=="0" || gpcat=="")
      {
        alertify.error('Complaint Section - Select Product Category');
        $("#A").removeClass("active");
        $("#1a").removeClass("active");
        $("#B").addClass("active");
        $("#2a").addClass("active")
        return false;
      }
      if(gpdata=="0" || gpdata=="")
      {
        alertify.error('Complaint Section - Select Product');
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
     //************************* COMPLAINT DEALER VALIDATTION *********************//
        var serlizedata = $("#clfrm").serialize();
        console.log(serlizedata);
     
      var url="index.php?route=farmer/register/saveform";
      console.log(url);
      $.post(url, serlizedata, function (data) {
      console.log(data);
        if(data==1){
            alert('Record Saved Successfully');
            location.reload();
        }
        if(data==0){
            alert('Check Form! Some error occoured');
        }
      
    });
     
      
  }
  //*************** Submit Enquiry Data ***************//
  function subenqdata(){
    alert('Subenq Data');
    var serlizedata = $("#clfrm").serialize();
    console.log(serlizedata);
    //var url="index.php?route=farmer/register/saveform";
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
