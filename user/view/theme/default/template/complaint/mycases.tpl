
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
        <?php echo $breadcrumb['text'].'/'; ?>
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
            echo "<td onclick='showform(".$result['MOBILE'].");'>".$result['MOBILE']."</td>";
            echo "<td>".$result['STATE']."</td>";
            echo "<td>".$result['DATE_RECEIVED']."</td>";
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
</div>
</div>
        <div class="col-sm-8">
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
                <label class="col-md-2 btn-default" for="selectbasic">USER</label>
                <div class="col-md-3">
                    <select id="emp-sts" name="emp-sts" class="form-control" onchange="empsts(this.value);">
                        <option value="0">Select</option>
                        <?php foreach($CallUsr as $usr){ ?>
                            <option value="<?php echo $usr['SID']; ?>"><?php echo $usr['NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" value="SUBMIT">
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
                                    <input type="text" class="form-control" id="RID" onkeypress="return isAlphabets(event)"  placeholder="*DEALER/FRANCHISE ID"  disabled />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="RMobile" onkeypress="return isNumber(event)" MaxLength="10" placeholder="MOBILE NO" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="RName" placeholder="*DEALER/FRANCHISE NAME" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <select class="form-control  " name="account" id="Rselstate" onchange="Pdist(this.value)">
                                        <option>*SELECT STATE</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control " name="account" id="Rseldist">
                                        <option>*SELECT DISTRICT</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="RAddress" placeholder="ADDRESS" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="RPincode" onkeypress="return isNumber(event)" MaxLength="6"  placeholder="PINCODE" >
                                </div>
                            </div>
                        </fieldset>
                            
                            
                        <!--#############Farmer Profile################## -->    
                        <fieldset class="far-tab">
                        <!-- Text input-->
                            <div class="form-group">
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Father Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="selmob" name="textinput" type="text" placeholder="Mobile" class="form-control input-md" readonly="readonly">
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
                                <input id="textinput" name="textinput" type="text" placeholder="Address" class="form-control input-md">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Pincode" class="form-control input-md">
                            </div>
                             <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Alt. Contact Number" class="form-control input-md">
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
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
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
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Total Acreage" class="form-control input-md">
                            </div>
                           <!-- <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Crop-II" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
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
                                <textarea class="form-control" id="textarea" name="textarea">Complaints Detail</textarea>
                            </div>
                           <!--  <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>-->
                            </div>
                        </fieldset>
                        </div>
                        
                        <!------***********-----Enquiry Form-----**********------->
                        <div class="tab-pane" id="3a">
                        <fieldset>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-4">
                                  
                                    <input class="form-control" id="Ename" placeholder="*FARMER NAME"  onkeypress="return isAlphabets(event)" type="text">
                               
                            </div>
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="Efname" placeholder="FATHER NAME" onkeypress="return isAlphabets(event)"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                 
                                    <input class="form-control" id="Evillage" placeholder="*VILLAGE"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="Epost" placeholder="POST"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="Etehsil" placeholder="TEHSIL"  type="text">
                                
                            </div>
                            <div class="col-md-4">
                                     
                                        <input class="form-control" id="Epin"  onkeypress="return isNumber(event)" maxlength="6" placeholder="*PIN CODE"  type="text"/>
                                    
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
                                   
                                    <input class="form-control" id="Emob1" onkeypress="return isNumber(event)" MaxLength="10" placeholder="*MOBILE NO.1"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">        
                            <div class="col-md-4">
                                    
                                    <input class="form-control" id="Emob2" onkeypress="return isNumber(event)" MaxLength="10" placeholder="MOBILE NO.2"  type="text">
                                
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
                                    
                                    <input class="form-control" id="Eacerage" placeholder="ACREAGE" onkeypress="return isNumber(event)"  type="text">
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            
                            <div class="col-md-4">
                                   
                                    <input class="form-control" id="Etacerage" onkeypress="return isNumber(event)" placeholder="TOTAL ACREGES"  type="text">
                                
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
                                        
                                        <input class="form-control" id="Edetails" placeholder="DETAILS"  type="text">
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                                <div class="col-md-4">
                                       
                                        <textarea class="form-control" id="Eproblem" placeholder="*ENQUIRY DESCRIPTION/PROBLEM" ></textarea>
                                   
                                </div>
                                <div class="col-md-4">
                                       
                                         <input class="form-control" id="Esource" placeholder="SOURCE"  type="text">
                                    
                                </div>
                                <div class="col-md-4">
                                       
                                        <textarea class="form-control" id="Eresolution" placeholder="*RESOLUTION PROVIDED "></textarea>
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                                <div class="col-md-4">
                                       
                                        <select class="form-control" id="Estatus" onchange="statusclose(this.value)" placeholder="STATUS">
                                            <option value="0">SELECT STATUS</option>
                                            <option value="1">CLOSED</option>
                                            <option value="2">FORWARDED</option>
                                        </select>
                                    
                                </div>
                                <div class="col-md-4">
                                      
                                        <input class="form-control" id="Erewponcedate" placeholder="SME RESPONSE DATE"  type="text">
                                    
                                </div>
                                <div class="col-md-4">
                                      
                                        <input class="form-control" id="Eoutbound" placeholder="*RESOLUTION PROVIDED (OUTBOUND CALL : AGENT)"  type="text">
                                    
                                </div>
                            </div>
                        
                            <div class="form-group">
                                
                               
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <input type='reset' value='Reset' name='reset'  class="btn btn-primary m-b" id="Ereset" />
                                    <input type="button"  class="btn btn-primary m-b" id="Eenquirysubmit" onclick="return Eenqsubmit()" value="Submit"/>
                                </div>
                            </div>
                       

                        <!-- Text input-->
                        
                        </fieldset>
                        </div>
                    </div>
                </div>
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
function showform(mob){
     $("#profile").html("<i class='fa fa-refresh fa-spin fa fa-fw margin-bottom'></i><span>Calling...&nbsp;&nbsp;:"+mob+"</span><hr><br>");
     $("#selmob").val(mob);
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
    //alert(stsid);
    if(cstsid==25)
    {
        $(".formdata-sub").show();
        $("#A").hide();
        $("#B").hide();
        $(".pro-act").hide();
        $("#C").show();
        
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
        
        $("#C").hide();
        $("#C").removeClass("active");
        $("#3a").removeClass("active");
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
            
        }
        if(estsid==2)
        {
            $(".far-tab").hide();
            $(".del-tab").show();
        }
    }
</script>
<script>
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
</script> 
