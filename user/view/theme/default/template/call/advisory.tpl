
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
            <div class="col-md-5">
                <div id="profile" style="font-size: 18px;font-weight: bold;color: #337ab7;"></div>
                <div class="clearfix"></div>
                <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>CASE ID</th>
                <th>MOBILE</th>
				<th>STATE</th>
                <th>PIN</th>
                <!--<th>STATUS</th>-->
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
			echo "<td>".$result['STATE']."</td>";
            echo "<td>".$result['CASE_PIN']."</td>";
            
            echo "</tr>";
            }
           ?>
        </tbody>
    </table>
</div>
</div>
        
        <div class="col-sm-7">
            
                <div class="col-md-12"  style="font-size: 18px;font-weight: bold;color: #337ab7;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Complaints form </div>
                <div class="col-md-12"><br /><hr></div>
                <div class="col-md-4"> 
                    <button class="btn btn-warning play-audio" style="padding: 7px 65px !important; font-size: 18px;" onclick="PlayAudio();"><i class='fa fa-volume-up' aria-hidden='true'></i>&nbsp;&nbsp;Play</button>
                </div>
    <form id="clfrm" name="clfrm">           
                <div class="col-md-4">    
                    <select class="form-control" name="compsts" id="compsts" onchange="showbox(this.value);">
                        <option value="">Select Complaints Category</option>
                        <option value="Crop_Nutrition">Crop Nutrition</option>
                        <option value="Crop_Protection">Crop Protection</option>
                        <option value="Seed">Seed</option>
                        <option value="Soil">Soil</option>
                        <option value="Irrigation">Irrigation</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-4"> 
                    <input type="hidden" class="form-control" name="Crop_Nutrition_Type" id="Crop_Nutrition_Type" value="Crop Nutrition" readonly="readonly">
                    <input type="hidden" class="form-control" name="Crop_Protection_Type" id="Crop_Protection_Type" value="Crop Protection" readonly="readonly">
                    <input type="hidden" class="form-control" name="Seed_Type" id="Seed_Type" value="Seed" readonly="readonly">
                    <input type="hidden" class="form-control" name="Soil_Type" id="Soil_Type" value="Soil" readonly="readonly">
                    <input type="hidden" class="form-control" name="Irrigation_Type" id="Irrigation_Type" value="Irrigation" readonly="readonly">
                    <input type="text" class="form-control" name="Others_Type" id="Others_Type" value="" placeholder="Enter Category Name">
					<input type="text" class="form-control" name="crop_Details_Nurtition" id="crop_Details_Nurtition" value="" placeholder="Crops Name...">
                    <input type="text" class="form-control" name="crop_Details_Protection" id="crop_Details_Protection" value="" placeholder="Crops Name...">
                    <input type="text" class="form-control" name="crop_Details_Seed" id="crop_Details_Seed" value="" placeholder="Crops Name...">
                    <input type="text" class="form-control" name="crop_Details_Soil" id="crop_Details_Soil" value="" placeholder="Crops Name...">
                    <input type="text" class="form-control" name="crop_Details_Irrigation" id="crop_Details_Irrigation" value="" placeholder="Crops Name...">
                    <input type="text" class="form-control" name="crop_Details_Others" id="crop_Details_Others" value="" placeholder="Crops Name...">
                </div>
                <div class="col-md-12"><br /><hr></div>
                <div class="col-md-12">
                    
                    <input type="hidden" name="caseid" id="caseid" value="" class="form-control">
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Crop_Nutrition_Data" name="Crop_Nutrition_Data" placeholder="Crop Nutrition Complaint details..."></textarea>
                    
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Crop_Protection_Data" name="Crop_Protection_Data" placeholder="Crop Protection Complaint details..."></textarea>
                    
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Seed_Data" name="Seed_Data" placeholder="Seed Complaint details..."></textarea>
                    
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Soil_Data" name="Soil_Data" placeholder="Soil Complaint details..."></textarea>
                    
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Irrigation_Data" name="Irrigation_Data" placeholder="Irrigation Complaint details..."></textarea>
                    
                    
                    <textarea style="min-height:300px!important;" class="form-control" id="Others_Data" name="Others_Data" placeholder="Others Complaint details..."></textarea>
                </div>
                
                <div class="col-md-12"><br /></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    
                    <select class="form-control" name="callsts" id="callsts" onchange="actSubmit(this.value);" >
                        <option value="">Select Call Status</option>
                        <?php print_r($CallSts);
                            foreach ($CallSts as $sts){
                                echo '<option value="'.$sts['STATUS_ID'].'">'.$sts['STATUS_NAME'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="button" id="regcom" name="regcom" class="btn btn-primary" value="Submit Data" onclick="SaveFeedback();" style="    padding: 6px 40px !important; font-size: 18px;" disabled="disabled">
                </div>
            </form>
        </div>
        
        </div>  
    </div>
    <!------------------- MODAL FOR PRODUCT LIST -------------------------->
    <div class="modal fade" id="myModal" role="dialog">
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
	$("#crop_Details_Nurtition").hide();
    $("#crop_Details_Protection").hide();
    $("#crop_Details_Seed").hide();
    $("#crop_Details_Soil").hide();
    $("#crop_Details_Irrigation").hide();
    $("#crop_Details_Others").hide();	
    $(".play-audio").hide();
    $("#clfrm").hide();
    $("#Crop_Nutrition_Type").hide();
    $("#Crop_Nutrition_Data").hide();
    
    $("#Crop_Protection_Type").hide();
    $("#Crop_Protection_Data").hide();
    
    $("#Seed_Type").hide();
    $("#Seed_Data").hide();
    
    $("#Soil_Type").hide();
    $("#Soil_Data").hide();
    
    $("#Irrigation_Type").hide();
    $("#Irrigation_Data").hide();
    
    $("#Others_Type").hide();
    $("#Others_Data").hide();
    
    
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
    $.ajax({
    type: "POST",
    url: "index.php?route=call/advisory/advrecord",
    data: "caseid="+mob,
    dataType: "text",
    success: function( data ) {
        console.log(data);
        if(data=='NA'){
            $(".play-audio").show();
            $(".play-audio").prop("disabled",true);
        }
        else
        {
            $(".play-audio").show();
            $(".play-audio").prop("disabled",false);
            $('.audio-data').html(data);
        }
    }
});
     $("#clfrm").show();
}
function SaveFeedback(){
    var serlizedata = $("#clfrm").serialize();
        console.log(serlizedata);
        var url="index.php?route=call/advisory/savefeedback";
        console.log(url);
        $.post(url, serlizedata, function (data) {
            console.log(data);
            alert(data);
            //alertify.success(data); 
            location.reload();
        });
      
    }

  //*************** Back to Dashboard *****************//
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  function showbox(cid){
    //alert(cid);
    if(cid=='Crop_Nutrition')
    {
		$("#crop_Details_Nurtition").show();
		$("#crop_Details_Protection").hide();
		$("#crop_Details_Seed").hide();
		$("#crop_Details_Soil").hide();
		$("#crop_Details_Irrigation").hide();
		$("#crop_Details_Others").hide();
		
        $("#Crop_Nutrition_Type").show();
        $("#Crop_Nutrition_Data").show();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").show();
        $("#regcom").show();
    }
    if(cid=='Crop_Protection')
    {
		$("#crop_Details_Protection").show();
		$("#crop_Details_Nurtition").hide();
		$("#crop_Details_Seed").hide();
		$("#crop_Details_Soil").hide();
		$("#crop_Details_Irrigation").hide();
		$("#crop_Details_Others").hide();
	  
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").show();
        $("#Crop_Protection_Data").show();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").show();
        $("#regcom").show();
     }
    if(cid=='Seed')
    {
		$("#crop_Details_Seed").show();
		$("#crop_Details_Nurtition").hide();
		$("#crop_Details_Protection").hide();
		$("#crop_Details_Soil").hide();
		$("#crop_Details_Irrigation").hide();
		$("#crop_Details_Others").hide();
		
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").show();
        $("#Seed_Data").show();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").show();
        $("#regcom").show();
    }
    if(cid=='Soil')
    {
		$("#crop_Details_Seed").hide();
        $("#crop_Details_Nurtition").hide();
		$("#crop_Details_Protection").hide();
        $("#crop_Details_Soil").show();
		$("#crop_Details_Irrigation").hide();
		$("#crop_Details_Others").hide();
		
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").show();
        $("#Soil_Data").show();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").show();
        $("#regcom").show();
     }
    if(cid=='Irrigation')
    {
		$("#crop_Details_Seed").hide();
        $("#crop_Details_Nurtition").hide();
		$("#crop_Details_Protection").hide();
        $("#crop_Details_Soil").hide();
		$("#crop_Details_Irrigation").show();
		$("#crop_Details_Others").hide();
		
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").show();
        $("#Irrigation_Data").show();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").show();
        $("#regcom").show();
     }
    if(cid=='Others')
    {
		$("#crop_Details_Seed").hide();
        $("#crop_Details_Nurtition").hide();
		$("#crop_Details_Protection").hide();
        $("#crop_Details_Soil").hide();
		$("#crop_Details_Irrigation").hide();
		$("#crop_Details_Others").show();
		
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").show();
        $("#Others_Data").show();
        
        $("#callsts").show();
        $("#regcom").show();
     }
     if(cid=='')
    {
        $("#Crop_Nutrition_Type").hide();
        $("#Crop_Nutrition_Data").hide();
        
        $("#Crop_Protection_Type").hide();
        $("#Crop_Protection_Data").hide();

        $("#Seed_Type").hide();
        $("#Seed_Data").hide();

        $("#Soil_Type").hide();
        $("#Soil_Data").hide();

        $("#Irrigation_Type").hide();
        $("#Irrigation_Data").hide();

        $("#Others_Type").hide();
        $("#Others_Data").hide();
        
        $("#callsts").hide();
        $("#regcom").hide();
     }
  }
  function actSubmit(csts){
      //alert(csts);
      if(csts!==''){
          $("#regcom").prop("disabled",false);
      }
      else{
          $("#regcom").prop("disabled",true);
      }
  }
  function PlayAudio(){
  $('#myModal').modal('show');
  }
</script> 
