
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
      <form method="post" id="form_createretailer" class="form-horizontal" enctype="multipart/form-data">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
           <?php if(isset($retailerupdatedata['SID'])) { ?>
          <button type="submit" id="updateretailer"  name="update" data-toggle="tooltip" title="update" class="btn btn-default" /><i class="fa fa-save"></i></button>
           <?php } else { ?>
           <button type="submit" id="retailerimg"  name="submit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default" /><i class="fa fa-save"></i></button>
            <?php    }  ?>
    <!-- <button  name="save" id="button_save" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>--->
        <button type="button" form="form-restore" data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
      </div>
      <h1>Retailer Outlet</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>">Retailer Outlet</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" form="form-backup" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-exchange"></i> Retailer Outlet</h3>
      </div>
      <div class="panel-body">
            <div class="col-sm-6">    
                
            <div class="form-group required">
              <label class="col-sm-3 control-label" >Outlet Name</label>
              <div class="col-sm-6">
                  <input class="form-control" id="outlet_name" onchange="clear_outlet_name();" type="text" name="outlet_name" value="<?php echo $retailerupdatedata["OUTLET_NAME"];?>"  placeholder="Enter Outlet Name "/>
                  <p id="outlet_name_p" style="display:none;color:red;">Required Outlet Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-3 control-label">Outlet Id</label>
              <div class="col-sm-6">
                  <input type="text" name="outlet_id" id="outlet_id" onchange="clear_outlet_id();"class="form-control" value="<?php echo $retailerupdatedata["RETAIL_ID"];?>" placeholder="Enter Retailer Id"/>
                  <p id="outlet_id_p" style="display:none;color:red;">Required Outlet Id</p>
              </div>
            </div>
            
           <div class="form-group required">
              <label class="col-sm-3 control-label">Mobile No:</label>
              <div class="col-sm-6">
                  <input class="form-control" maxlength="10" type="text" id="mobile_number" onkeypress="return IsNumeric(event);" onchange="clear_mobile_number();" value="<?php echo $retailerupdatedata["CONTACT_NO"];?>" name="mobile_number"  placeholder="Enter Mobile Number"/>
                  <p id="mobile_number_p" style="display:none;color:red;">Required Mobile No:</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-3 control-label">Address</label>
              <div class="col-sm-6">
                  <input class="form-control" type="text" id="address" onchange="clear_address();"  name="address" value="<?php echo $retailerupdatedata["ADDRESS"];?>" placeholder="Enter Address " />
                  <p id="address_p" style="display:none;color:red;">Required Address</p>
              </div>
            </div>
            
            
  
            </div>
            <div class="col-sm-6">
             
               
             <div class="form-group required">
              <label class="col-sm-3 control-label">District</label>
              <div class="col-sm-6">
                <select name="district_id" onchange="clear_district(this.value)" id="district_id" class="form-control">
                <option  value="">Select district</option>
                <?php foreach ($dpdistrict as $options) { ?>
                <option value="<?php echo $options['id']; ?>" <?php if($options['id']==$retailerupdatedata["DISTRICT_ID"]) { echo 'selected'; } ?> ><?php echo $options['name']; ?></option>
                <?php } ?>
              </select>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div> 
               
            
                  
	    <div class="form-group required">
              <label class=" col-sm-3 control-label">Village</label>
                <div class="col-sm-6">
                    
            <select name="village_name[]" onchange="clear_village_name();" id="village_name" class="form-control select2-selection select2-selection--multiple"  multiple="multiple" data-placeholder="Select Village">
                <option  value="">Select Village </option>
                <?php  
                  foreach($village as $value) {  ?>
          <option value="<?php echo $value['SID']; ?>" <?php foreach($villageid as $vid) { if($vid['VILLAGE_ID']==$value['SID']) { echo 'selected'; } } ?> ><?php echo $value['VILLAGE_NAME']; ?></option>
                
                  <?php }    ?>
               
            </select> 
                    
            <p id="clear_village_name_p" style="display:none;color:red;">Required Village</p>
                </div>
            </div>
                
	  <!---  <div class="form-group required">
              <label class="col-sm-3 control-label">Email ID</label>
              <div class="col-sm-6">
                  <input class="form-control" type="text" id="email_id" onchange="clear_email_id();" name="email_id" placeholder="Enter Email ID" />
                   <p id="email_id_p" style="display:none;color:red;">Required Email ID</p>
                   <p id="emailmatch" style="display:none;color:red;">Email not valid</p>
              </div>
            </div>--->
                
                
	    <div class="form-group">
              <label class="col-sm-3 control-label">Remarks</label>
              <div class="col-sm-6">
                  <input class="form-control" type="text" value="<?php echo $retailerupdatedata["REMARKS"];?>" id="remarks"  name="remarks" placeholder="Enter Remarks" />
                   
              </div>
            </div>
          
          <div class="form-group">
              <label class="col-sm-3 control-label">Important</label>
              <div class="col-sm-6">
                 <select name="important" class="form-control" id="important">
                     <option value="1">Yes</option>>
                     <option value="0">No</option>>
                  </select>   
                   
              </div>
            </div>
           
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Photo</label>
              <div class="col-sm-6">
                  <input class="form-control" type="file" id="file"  name="file"  />
                   
              </div>
            </div>
          <?php if(isset($retailerupdatedata['SID'])) { ?>
          <div class="form-group">
              <label class="col-sm-3 control-label">Photo</label>
              <div class="col-sm-6">
                  
                  <img src="http://192.168.1.159/aksha/system/upload/<?php echo $retailerupdatedata['PHOTO_PATH']; ?>" style="height: 59px !important;
width: 60px !important;"></img>
                   
              </div>
            </div>
          <?php } ?>
            </div>
          
      
     
      </div>
    </div>
  </div>
      </form>
    
</div>

<?php echo $footer; ?>

<script type="text/javascript" src="view/javascript/bootstrap/js/select2.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
   $("#village_name").select2({ tags: true,
      placeholder: function(){
        $(this).data('placeholder');
    }
  
});

 $('#form_createretailer').submit(function(event) {
     if ($('#outlet_name').val().length ===0) {
     $('#outlet_name_p').show();
     return false;
 }
 
 else if($('#outlet_id').val().length===0){
        $('#outlet_id_p').show();
        return false;
        }
 else if($('#mobile_number').val().length===0){
        $('#mobile_number_p').show();
        return false;
        }
 else if($('#address').val().length===0){
        $('#address_p').show();
        return false;
        }

 else if($('#district_id').val().length===0){
        $('#district_p').show();
        return false;
        }
        
 else if($('#village_name').val().length===0){
        $('#clear_village_name_p').show();
        return false;
        } else {
   $.ajax({
            url         : 'index.php?route=retailer/createretailer/createretailer&token='+getURLVar('token'),// $( this ).attr('action'),
            type        : "POST",
            data        :  new FormData(this),
            contentType : false,
            cache       : false,
            processData :false,
            beforeSend  : function()
            {
              $(".processing").show();
              
            },
             success: function (data)
            { alert('Data Saved Sucessfully!');
                 location.reload();
             

            },
            error: function(error)
            {


            }
        });       
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    }
    });
});


  $('#button_save_test').on('click', function() {
   
 if ($('#outlet_name').val().length ===0) {
     $('#outlet_name_p').show();
 }
 
 else if($('#outlet_id').val().length===0){
        $('#outlet_id_p').show();
        }
 else if($('#mobile_number').val().length===0){
        $('#mobile_number_p').show();
        }
 else if($('#address').val().length===0){
        $('#address_p').show();
        }

 else if($('#district_id').val().length===0){
        $('#district_p').show();
        }
        
 else if($('#village_name').val().length===0){
        $('#clear_village_name_p').show();
        }
 

        
    
 
 else {
     
     var serlizedata = $('#form-createretailer').serialize();
        alert(serlizedata);


      var url = 'index.php?route=retailer/createretailer/createretailer&token='+getURLVar('token');
    
       $.post(url, serlizedata, function (data) {

       if (data.err !== null) {
       alert(data.err);
       }

       if (data.nop !== null) {
	   try{
	   alert(data.nop);

		}
		catch(e){alert(e);}
	  // alertify.success(data.nop);
       }
});
     
 /*
     var outlet_name=document.getElementById('outlet_name').value;
     var outlet_id=document.getElementById('outlet_id').value;
     var mobile_number=document.getElementById('mobile_number').value;
     var address=document.getElementById('address').value;
     var district_id=document.getElementById('district_id').value;
     //var village_name=document.getElementByName("village_name").value;
     var remarks=document.getElementById('remarks').value;
      var village_name=$("#village_name").val();
   //alert(village_name);
     
     
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=retailer/createretailer/createretailer&token='+getURLVar('token'),
                data: {outlet_name:outlet_name,outlet_id:outlet_id,mobile_number:mobile_number,address:address,district_id:district_id,village_name:village_name,remarks:remarks},
        //dataType: 'json',
		cache: false,
		beforeSend: function() {
			//$('#button-nation').button('loading');
		},
				
		success: function(json) {
                    alert(json);
			           
            if (json['redirectf']) {
                location = json['redirectf'];
            } 
            else if (json['error']) {
                if (json['error']['warning']) {
                alert(json['error']['warning']);                    
                }           
            } else {
     
     document.getElementById('channel_code').value="";
     document.getElementById('channel_type').value="";
     document.getElementById('firm_name').value="";
     document.getElementById('owner_name').value="";
     document.getElementById('mobile_number').value="";
     document.getElementById('email_id').value="";
     document.getElementById('dmr_name').value="";
     document.getElementById('fmr_name').value="";
      
            } 

		}		
	});
        
        */
 }
    
});
//clear text



function clear_district(district_id)
{
    $('#district_p').hide();
     
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=retailer/createretailer/getvillage&token='+getURLVar('token'),
        data: 'district_id='+district_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

         //alert(data);
        $("#village_name").html(data);
         $("#village_name").select2({ tags: true,
             placeholder: function(){
        $(this).data('placeholder');
    } });
        
        }


   });
}

function clear_outlet_name(){
      $('#outlet_name_p').hide();
}
function clear_outlet_id(){
      $('#outlet_id_p').hide();
}
function clear_mobile_number(){
      $('#mobile_number_p').hide();
}
function clear_address(){
      $('#address_p').hide();
}

function clear_village_name(){
      $('#clear_village_name_p').hide();
}

function CheckIsCharacter(e,t){
         try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                   
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
       }
  var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
</script>