
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
          <button  id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
        <button type="submit" form="form-restore" data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
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
        <h3 class="panel-title"><i class="fa fa-exchange"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $createVillage; ?>" method="post" id="form-createdealer" class="form-horizontal">            
           
            <div class="form-group required">
              <label class="col-sm-2 control-label" >Village Name</label>
              <div class="col-sm-4">
                  <input id="id" style="display: none" value="<?php echo $get_form_data[0]['SID']?>"/>
                  <input value="<?php echo $get_form_data[0]['Vname']?>"class="form-control" type="text" id="Village_Village_Name" onchange="clear_Village_Name()" onkeypress="return CheckIsCharacter(event,this);" name="village_name"  placeholder="Enter Village Name"/>
              <p id="Village_Village_Name_p" style="display:none;color:red;">Required Village Name</p>
              <p id="character" style="display:none;color:red;">only character</p>
              </div>
            </div>
        
            <div class="form-group required">
              <label class="col-sm-2 control-label">Village Pin Code</label>
              <div class="col-sm-4">
              <input value="<?php echo $get_form_data[0]['pincode']?>" type="text" id="Village_Pin_Code" onchange="clear_Village_Pin_Code()" onkeypress="return IsNumeric(event);" name="villagepin_code" class="form-control" placeholder="Enter Pin Code "/>
               <p id="Village_Pin_Code_p" style="display:none;color:red;">Required  Pin Code</p>
               <p id="number" style="display:none;color:red;">only digits (0 - 9)</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Select State</label>
              <div class="col-sm-4">
                <select  id="Select_Village_State" onchange="clear_Village_State()" name="select_village_state" class="form-control">
                <option  value="<?php echo $get_form_data[0]['STATE_ID']?>"> <?php echo $get_form_data[0]['StateName']?></option>
                <!--<option  value=""> Select State</option>-->
                 <?php foreach ($dp_village_state as $options) { ?>
                   <?php if ($options['id'] == $user_group_id) { ?>
                   <option value="<?php echo $options['_id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                   <?php } else { ?>
                   <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                   <?php } ?>
                   <?php } ?>
               </select>
                  <p id="Select_Village_State_p" style="display:none;color:red;">Required Select State</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">District Name</label>
              <div class="col-sm-4">
              <select  id="Select_Village_District_Name" onchange="clear_Village_District_Name()" name="district_name" class="form-control">
                <option  value="<?php echo $get_form_data[0]['DISTRICT_ID']?>"><?php echo $get_form_data[0]['DistrictName']?></option>
              </select>
               <p id="Select_Village_District_Name_p" style="display:none;color:red;">Required Select District Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Select Dealer</label>
              <div class="col-sm-4">
                <select id="Select_Village_Dealer" onchange="clear_Village_Dealer()" name="dealer_id" class="form-control">
                 <option  value="<?php echo $get_form_data[0]['Dealer_id']?>"> <?php echo $get_form_data[0]['FirmName']?></option>
                 <?php foreach ($dp_select_dealer as $options) { ?>
                   <?php if ($options['id'] == $user_group_id) { ?>
                   <option value="<?php echo $options['_id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                   <?php } else { ?>
                   <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                   <?php } ?>
                   <?php } ?>
               </select>
               <p id="Select_Village_Dealer_p" style="display:none;color:red;">Required Select Dealer</p>
              </div>
            </div>
            
	  
            
        </form>
     
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">
 $('#button_save').on('click', function() {
   
 if ($('#Village_Village_Name').val().length ===0) {
     $('#Village_Village_Name_p').show();
 }
 
 else if($('#Village_Pin_Code').val().length===0){
        $('#Village_Pin_Code_p').show();
        }
        
 else if($('#Select_Village_State').val().length===0){
        $('#Select_Village_State_p').show();
        }
 //else if($('#Select_Village_District_Name').val().length===0){
       // $('#Select_Village_District_Name_p').show();
       // }
 else if($('#Select_Village_Dealer').val().length===0){
        $('#Select_Village_Dealer_p').show();
        }
        
    
 
 else {
     var nametxt_Village_Village_Name=document.getElementById('Village_Village_Name').value;
     var nametxt_Village_Pin_Code=document.getElementById('Village_Pin_Code').value;
     var nametxt_village_State=document.getElementById('Select_Village_State').value;
     var nametxt_district_Name=document.getElementById('Select_Village_District_Name').value;
     var nametxt_Village_Dealer=document.getElementById('Select_Village_Dealer').value;
      var id =document.getElementById('id').value;
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=village/editvillage/updateVillage&token='+getURLVar('token'),
                data: {name:nametxt_Village_Village_Name,sid:id,pincode:nametxt_Village_Pin_Code,state:nametxt_village_State,district:nametxt_district_Name,dealer:nametxt_Village_Dealer},
        dataType: 'json',
		cache: false,
		beforeSend: function() {
			$('#button-nation').button('loading');
		},
		complete: function() {
			$('#button-nation').button('reset');
		},		
		success: function(json) {
			           
            if (json['redirectf']) {
                location = json['redirectf'];
            } else if (json['error']) {
                if (json['error']['warning']) {
                 alert(json['error']['warning']);                    
                }           
            }
		}
               
	});
 }
    
});
//clear text
function clear_Village_Name()
{
    $('#Village_Village_Name_p').hide();
}
function clear_Village_Pin_Code()
{
    $('#Village_Pin_Code_p').hide();
}
function clear_Village_State()
{
    $('#Select_Village_State_p').hide();
    var state1=document.getElementById('Select_Village_State').value;
   // alert(state1);
  
        $.ajax({ 
		type: 'post',
		url: 'index.php?route=village/createVillage/DropDownState&token='+getURLVar('token'),
                data: 'state='+state1,
               // dataType: 'json',
		cache: false,
		
		success: function(data) {
		 
                  $("#Select_Village_District_Name").html(data);
              
                   
               
		}
                      
               
	});
 
}
function clear_Village_District_Name()
{
    $('#Select_Village_District_Name_p').hide();
}
function clear_Village_Dealer()
{
    $('#Select_Village_Dealer_p').hide();
}

 var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            document.getElementById("number").style.display = ret ? "none" : "inline";
            return ret;
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
       
       
</script>