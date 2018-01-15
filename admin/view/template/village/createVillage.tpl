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
              <input class="form-control" type="text" id="Village_Village_Name" onchange="clear_Village_Name()" onkeypress="return CheckIsCharacter(event,this);"  name="village_name"  placeholder="Enter Village Name"/>
              <p id="Village_Village_Name_p" style="display:none;color:red;">Please Fill Village Name</p>
              <p id="character" style="display:none;color:red;">only character</p>
                  <div id="result"></div>
              </div>
            </div>
        
            <div class="form-group required">
              <label class="col-sm-2 control-label">Village Pin Code</label>
              <div class="col-sm-4">
              <input type="text" maxlength="6" id="Village_Pin_Code" onchange="clear_Village_Pin_Code()" onkeypress="return IsNumeric(event);" name="villagepin_code" class="form-control" placeholder="Enter Pin Code "/>
               <p id="Village_Pin_Code_p" style="display:none;color:red;">Please Fill  Pin Code</p>
               <p id="number" style="display:none;color:red;">only digits (0 - 9)</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Select State</label>
              <div class="col-sm-4">
                <select  id="Select_Village_State" onchange="clear_Village_State()" name="select_village_state" class="form-control">
                 <option  value=""> Select State</option>
                 <?php foreach ($dp_village_state as $options) { ?>
                   <?php if ($options['id'] == $user_group_id) { ?>
                   <option value="<?php echo $options['_id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                   <?php } else { ?>
                   <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                   <?php } ?>
                   <?php } ?>
               </select>
                  <p id="Select_Village_State_p" style="display:none;color:red;">Please Select State</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Select Territory</label>
              <div class="col-sm-4">
                <select  id="select_Village_Territory" onchange="clear_Village_Territory();" name="select_village_Territory" class="form-control">
                 <option  value="">Select Territory</option>
                </select>
                  <p id="Select_Village_Territory_p" style="display:none;color:red;">Please Select Territory</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">District Name</label>
              <div class="col-sm-4">
              <select  id="Select_Village_District_Name" onchange="clear_Village_District_id()" name="district_name" class="form-control">
                <option  value=""> Select District</option>
                
              </select>
               <p id="Select_Village_District_Name_p" style="display:none;color:red;">Please Select District Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Select Head Quater</label>
              <div class="col-sm-4">
                <select id="Select_Village_hq" onchange="clear_Village_Hq()" name="hq_id" class="form-control">
                 <option  value=""> Select HQ </option>
                </select>
               <p id="Select_Village_Dealer_p" style="display:none;color:red;">please Select HQ</p>
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
 
 else if($('#select_Village_Territory').val().length===0){
        $('#Select_Village_Territory_p').show();
        }   
 else if($('#Select_Village_District_Name').val().length===0){
       $('#Select_Village_District_Name_p').show();
        }       
 else if($('#Select_Village_hq').val().length===0){
        $('#Select_Village_Dealer_p').show();
        }
        
 else {
     
     var nametxt_Village_Village_Name=document.getElementById('Village_Village_Name').value;
     var nametxt_Village_Pin_Code=document.getElementById('Village_Pin_Code').value;
     var nametxt_village_State=document.getElementById('Select_Village_State').value;
     var nametxt_Village_Territory=document.getElementById('select_Village_Territory').value;
     
     var nametxt_district_Name=document.getElementById('Select_Village_District_Name').value;
     var nametxt_Village_hq=document.getElementById('Select_Village_hq').value;
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=village/createVillage/addVillage&token='+getURLVar('token'),
                data: {name:nametxt_Village_Village_Name,pincode:nametxt_Village_Pin_Code,state:nametxt_village_State,terr:nametxt_Village_Territory,district:nametxt_district_Name,hq:nametxt_Village_hq},
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

$(document).ready(function(){  
      $('#Village_Village_Name').keyup(function(){  
           var query = $(this).val(); 
           if(query != '')  
           {  
                $.ajax({  
                    url: 'index.php?route=village/createVillage/autoSearch&token='+getURLVar('token'),  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#result').fadeIn();
                          $("#result").html(data);
                         //alert(data);
                          
                     }  
                });  
           }  
      });  
      $(document).on('click', '#li', function(){  
          $('#Village_Village_Name').val($(this).text()); 
           $('#result').fadeOut();  
      });  
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
		 
                  $("#select_Village_Territory").html(data);
              
                   
               
		}
                      
               
	});
 
}

function clear_Village_Territory(){

 $('#Select_Village_Territory_p').hide();
    var terr=document.getElementById('select_Village_Territory').value;
    //alert(terr);
        $.ajax({ 
		type: 'post',
		url: 'index.php?route=village/createVillage/DropDownterritory&token='+getURLVar('token'),
                data: 'territory='+terr,
               // dataType: 'json',
		cache: false,
		
		success: function(data) {
		 //alert(data);
                  $("#Select_Village_District_Name").html(data);
              
                   
               
		}
                      
               
	});



}
function clear_Village_District_id(){

$('#Select_Village_District_Name_p').hide();
    var district=document.getElementById('Select_Village_District_Name').value;
   // alert(district);
        $.ajax({ 
		type: 'post',
		url: 'index.php?route=village/createVillage/DropDownDistrict&token='+getURLVar('token'),
                data: 'district='+district,
               // dataType: 'json',
		cache: false,
		
		success: function(data) {
		// alert(data);
                  $("#Select_Village_hq").html(data);
              
                   
               
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