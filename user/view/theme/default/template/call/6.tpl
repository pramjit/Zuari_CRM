
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
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Mobile</th>
                <th>State</th>
                <th>Date</th>
                <th>Status</th>
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($misscallData as $result)
            {
            echo "<tr>";
            echo "<td onclick='showform(".$result['MOBILE'].");'>".$result['MOBILE']."</td>";
            echo "<td>".$result['STATE']."</td>";
            echo "<td>".$result['DATE_RECEIVED']."</td>";
            echo "<td>".$result['STATUS']."</td>";
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
                                    <input type="text" class="form-control" id="del-id" name="del-id" placeholder="*DEALER/FRANCHISE ID" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-mob" name="del-mob" MaxLength="10" placeholder="MOBILE NO" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-name" name="del-name" placeholder="*DEALER/FRANCHISE NAME" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                <select id="dselst" name="dselst" class="form-control select2" onchange="dshowdist(this.value);">
                                    <option value="">Select State</option>
                                    <?php foreach($StateData as $state){ ?>
                                    <option value="<?php echo $state['GEO_ID']; ?>"><?php echo $state['NAME']; ?></option>
                                    <?php } ?>
                                </select>
                                </div>
                                <div class="col-md-4" id="ddist-data">
                                <select id="dseldt" name="dseldt" class="form-control select2-selection--single">
                                    <option value="">Select District</option>
                                   
                                </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-add" name="del-add" placeholder="ADDRESS" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="del-pin" name="del-pin" MaxLength="6"  placeholder="PINCODE" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46" >
                                </div>
                            </div>
                        </fieldset>
                            
                            
                        <!--#############Farmer Profile################## -->    
                        <fieldset class="far-tab">
                        <!-- Text input-->
                            <div class="form-group">
                            <div class="col-md-4">
                                <input id="far-name" name="far-name" type="text" placeholder="Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="far-fa-name" name="far-fa-name" type="text" placeholder="Father Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="far-mob" name="far-mob" type="text" placeholder="Mobile" class="form-control input-md" readonly="readonly">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                            <div class="col-md-4">
                                <select id="selst" name="selst" class="form-control select2" onchange="showdist(this.value);">
                                    <option value="">Select State</option>
                                    <?php foreach($StateData as $state){ ?>
                                    <option value="<?php echo $state['GEO_ID']; ?>"><?php echo $state['NAME']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4" id="dist-data">
                                <select id="seldt" name="seldt" class="form-control select2-selection--single">
                                    <option value="">Select District</option>
                                   
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input id="far-add" name="far-add" type="text" placeholder="Address" class="form-control input-md">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="far-pin" name="far-pin" type="text" placeholder="Pincode" class="form-control input-md" maxlength="6" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46">
                            </div>
                             <div class="col-md-4">
                                 <input id="far-alt-no" name="far-alt-no" type="text" placeholder="Alt. Contact Number" class="form-control input-md" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46">
                            </div>
                            <div class="col-md-4">
                                <select id="crop1" name="crop1" class="form-control select2">
                                    <option value="">Select Crop-I</option>
                                    <?php foreach($CropData as $crop){ ?>
                                    <option value="<?php echo $crop['CROP_ID']; ?>"><?php echo $crop['CROP_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="corp1-acr" name="corp1-acr" type="text" placeholder="Acreage" class="form-control input-md" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46">
                            </div>
                             <div class="col-md-4">
                                 <select id="crop2" name="crop2" class="form-control select2">
                                    <option value="">Select Crop-II</option>
                                    <?php foreach($CropData as $crop){ ?>
                                    <option value="<?php echo $crop['CROP_ID']; ?>"><?php echo $crop['CROP_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input id="crop2-acr" name="crop2-acr" type="text" placeholder="Acreage" class="form-control input-md" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="far-tot-acr" name="far-tot-acr" type="text" placeholder="Total Acreage" class="form-control input-md" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.keyCode==8 || event.keyCode==46">
                            </div>
                           <div class="col-md-8">
                               <textarea class="form-control" id="far-remarks" name="far-remarks" placeholder="Remarks..."></textarea>
                            </div>
                           <!-- <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>-->
                            </div>
                        </fieldset>
                        </div>
                        
                        <!------***********-----Complaints Form-----**********------->
                        
                        <div class="tab-pane" id="2a">
                        <fieldset>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <select id="procat" name="procat" class="form-control select2" onchange="showpro(this.value);">
                                    <option value="0">Select Product Category</option>
                                    <?php foreach($ProdCatData as $pcat){ ?>
                                    <option value="<?php echo $pcat['PRODUCT_ID']; ?>"><?php echo $pcat['PRODUCT_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                             <div class="col-md-4" id="prod-data">
                                <select id="prodata" name="prodata" class="form-control select2">
                                    <option value="0">Select Product</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="comcat" name="comcat" class="form-control select2" onchange="showcomp(this.value);">
                                    <option value="0">Complaint Category</option>
                                     <?php foreach($CompCatData as $comp){ ?>
                                    <option value="<?php echo $comp['SID']; ?>"><?php echo $comp['COMP_CATG']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4" id="comp-data">
                                <select id="comdata" name="comdata" class="form-control select2">
                                    <option value="0">Complaint Sub Category</option>
                                </select>
                            </div>
                           <div class="col-md-8">
                               <textarea class="form-control" id="comdtls" name="comdtls" placeholder="Complaint Detail"></textarea>
                            </div>
                           <!--  <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>-->
                            </div>
                        </fieldset>
                        </div>
                        
                        <!------***********-----Enquiry Form-----**********------->
                       <!-- <div class="tab-pane" id="3a">
                        <fieldset>
                        <div class="form-group">
                            <div class="col-md-4">
                                  
                                    <input class="form-control" id="en-far-name" name="en-far-name" placeholder="*FARMER NAME" type="text">
                               
                            </div>
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="en-far-fa-name" name="en-far-fa-name" placeholder="FATHER NAME" type="text">
                                
                            </div>
                            <div class="col-md-4">
                                 
                                    <input class="form-control" id="en-far-vil" name="en-far-vil" placeholder="*VILLAGE"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="en-post" name="en-post" placeholder="POST"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="en-tehsil" name="en-tehsil" placeholder="TEHSIL"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                     
                                        <input class="form-control" id="en-pin" name="en-pin"  onkeypress="return isNumber(event)" maxlength="6" placeholder="*PIN CODE"  type="text"/>
                                    
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4">
                            <select id="eselst" name="eselst" class="form-control select2" onchange="eshowdist(this.value);">
                                    <option value="">Select State</option>
                                    <?php foreach($StateData as $state){ ?>
                                    <option value="<?php echo $state['GEO_ID']; ?>"><?php echo $state['NAME']; ?></option>
                                    <?php } ?>
                            </select>
                            </div>
                            <div class="col-md-4" id="edist-data">
                                <select id="eseldt" name="eseldt" class="form-control select2-selection--single">
                                    <option value="">Select District</option>
                                   
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="en-far-mob" name="en-far-mob" onkeypress="return isNumber(event)" MaxLength="10" placeholder="*MOBILE NO.1"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">        
                            <div class="col-md-4">
                                    
                                    <input class="form-control" id="en-far-mob2" name="en-far-mob2" onkeypress="return isNumber(event)" MaxLength="10" placeholder="MOBILE NO.2"  type="text">
                                
                            </div>
                          
                            <div class="col-md-4">
                                 <select id="ecrop" name="ecrop" class="form-control select2">
                                    <option value="">*Select Crop</option>
                                    <?php foreach($CropData as $crop){ ?>
                                    <option value="<?php echo $crop['CROP_ID']; ?>"><?php echo $crop['CROP_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                    
                                    <input class="form-control" id="ecrop-acr" name="ecrop-acr" placeholder="ACREAGE" onkeypress="return isNumber(event)"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="ecrop-tot-acr" name="ecrop-tot-acr" onkeypress="return isNumber(event)" placeholder="TOTAL ACREGES"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                <select id="eprocat" name="eprocat" class="form-control select2" onchange="eshowpro(this.value);">
                                    <option value="0">Select Product Category</option>
                                    <?php foreach($ProdCatData as $pcat){ ?>
                                    <option value="<?php echo $pcat['PRODUCT_ID']; ?>"><?php echo $pcat['PRODUCT_DESC']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                             <div class="col-md-4" id="eprod-data">
                                <select id="eprodata" name="eprodata" class="form-control select2">
                                    <option value="0">Select Product</option>
                                </select>
                            </div>
                            
                            </div>
                        
                            <div class="form-group">
                                <div class="col-md-4">
                                   
                                    <select class="form-control select2" id="ecat" name="ecat"  placeholder="*ENQUIRY CATEGORY">
                                        <option value="0">SELECT  CATEGORY</option>
                                        <?php foreach($EnqCatData as $ecat){ ?>
                                        <option value="<?php echo $ecat['SID']; ?>"><?php echo $ecat['CATEGORY_NAME']; ?></option>
                                        <?php } ?>
                                    </select>
                               
                                </div>
                                <div class="col-md-4">
                                       
                                          <select class="form-control select2" id="etyp" name="etyp"  placeholder="*ENQUIRY TYPE">
                                                <option value="0">ENQUIRY TYPE</option>
                                                <?php foreach($EnqTypData as $etyp){ ?>
                                                <option value="<?php echo $etyp['SID']; ?>"><?php echo $etyp['ENQUIRY_TYPE']; ?></option>
                                                <?php } ?>
                                          </select>
                                    
                                </div>
                                <div class="col-md-4">
                                        
                                        <input class="form-control" id="en-dtls" name="en-dtls"  placeholder="DETAILS"  type="text">
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                                <div class="col-md-4">
                                       
                                        <textarea class="form-control" id="en-desc" name="en-desc" placeholder="*ENQUIRY DESCRIPTION/PROBLEM" ></textarea>
                                   
                                </div>
                                <div class="col-md-4">
                                       
                                         <input class="form-control" id="en-src" name="en-src" placeholder="SOURCE"  type="text">
                                    
                                </div>
                                <div class="col-md-4">
                                       
                                        <textarea class="form-control" id="en-res" name="en-res" placeholder="*RESOLUTION PROVIDED "></textarea>
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                                <div class="col-md-4">
                                       
                                        <select class="form-control" id="en-sts" name="en-sts" placeholder="STATUS">
                                            <option value="0">SELECT STATUS</option>
                                            <option value="1">CLOSED</option>
                                            <option value="2">FORWARDED</option>
                                        </select>
                                    
                                </div>
                                <div class="col-md-4">
                                      
                                        <input class="form-control" id="en-res-dt" name="en-res-dt" placeholder="SME RESPONSE DATE"  type="text">
                                    
                                </div>
                                <div class="col-md-4">
                                      
                                        <input class="form-control" id="en-res-sol" name="en-res-sol" placeholder="*RESOLUTION PROVIDED (OUTBOUND CALL : AGENT)"  type="text">
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                               
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <input type='reset' value='Reset' name='reset'  class="btn btn-primary m-b" id="Ereset" />
                                    <input type="button"  class="btn btn-primary subenqdata" onclick="subenqdata();" value="Submit"/>
                                </div>
                            </div>
                       

                        
                        
                        </fieldset>
                        </div>-->
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
function showform(mob){
     $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
     $("#far-mob").val(mob);
     $("#formdata").show();
}
function showdist(stid){
  //alert(stid);
   
    $.ajax({
    type: "POST",
    url: "index.php?route=call/missedcall/distlist",
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
    url: "index.php?route=call/missedcall/edistlist",
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
    url: "index.php?route=call/missedcall/ddistlist",
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
    url: "index.php?route=call/missedcall/prodlist",
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
    url: "index.php?route=call/missedcall/eprodlist",
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
    url: "index.php?route=call/missedcall/complist",
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
          alert('Profile - Name required');
          return false;
      }
      if(gffname=="")
      {
          alert('Profile - Father Name required');
          return false;
      }
      if(gstate=="")
      {
          alert('Profile - Select State');
          return false;
      }
      if(gdist=="")
      {
          alert('Profile - Select District');
          return false;
      }
      if(gaddrs=="")
      {
          alert('Profile - Address required');
          return false;
      }
      if(gpin=="")
      {
          alert('Profile - Pincode required');
          return false;
      }
       if(gcrop1=="")
      {
          alert('Complaint Section - Select Crop-I');
          return false;
      }
      if(gcropacr1=="")
      {
          alert('Complaint Section - Crop-I Acr. required');
          return false;
      }
      if(gtotacr=="")
      {
          alert('Complaint Section - Total Acr. required');
          return false;
      }
      if(gremarks=="")
      {
          alert('Complaint Section - Remarks required');
          return false;
      }
     }
     //NETWORK Validation End
     
     if(calstsid==2 && empstsid==1)//Complaints 
     {
      if(gfname=="")
      {
          alert('Profile - Name required');
          return false;
      }
      if(gffname=="")
      {
          alert('Profile - Father Name required');
          return false;
      }
      if(gstate=="")
      {
          alert('Profile - Select State');
          return false;
      }
      if(gdist=="")
      {
          alert('Profile - Select District');
          return false;
      }
      if(gaddrs=="")
      {
          alert('Profile - Address required');
          return false;
      }
      if(gpin=="")
      {
          alert('Profile - Pincode required');
          return false;
      }
       if(gcrop1=="")
      {
          alert('Complaint Section - Select Crop-I');
          return false;
      }
      if(gcropacr1=="")
      {
          alert('Complaint Section - Crop-I Acr. required');
          return false;
      }
      if(gtotacr=="")
      {
          alert('Complaint Section - Total Acr. required');
          return false;
      }
      if(gremarks=="")
      {
          alert('Complaint Section - Remarks required');
          return false;
      }
      if(gpcat=="0")
      {
          alert('Complaint Section - Select Product Category');
          return false;
      }
      if(gpdata=="0")
      {
          alert('Complaint Section - Select Product');
          return false;
      }
      if(gccat=="0")
      {
          alert('Complaint Section - Select Complaint Category');
          return false;
      }
      if(gcdata=="0")
      {
          alert('Complaint Section - Select Complaint Sub-category');
          return false;
      }
      if(gdtls=="")
      {
          alert('Complaint Section - Complaint Details Required');
          return false;
      }
           
     }
     
     
     
     
      var serlizedata = $("#clfrm").serialize();
      console.log(serlizedata);
      var url="index.php?route=call/missedcall/saveform";
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
        var url="index.php?route=call/missedcall/saveform";
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
