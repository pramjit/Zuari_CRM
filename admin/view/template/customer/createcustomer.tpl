
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $createcustomer;?>" method="post" id="form-createcustomer" class="form-horizontal">
         
           <div class="col-sm-4"> 
               
            <div class="form-group required">
              <label class="col-sm-4 control-label" >First Name</label>
              <div class="col-sm-8">
              <input class="form-control" type="text" id="First_Name" onchange="clear_First_Name()" onkeypress="return CheckIsCharacter(event,this);" name="first_name"  placeholder="Enter first name"/>
              <p id="First_Name_p" style="display:none;color:red;">Required First Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Last Name</label>
              <div class="col-sm-8">
              <input type="text" id="Last_Name" onchange="clear_Last_Name()" onkeypress="return CheckIsCharacter(event,this);" name="last_name" class="form-control" placeholder="Enter last name "/>
               <p id="Last_Name_p" style="display:none;color:red;">Required Last Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Mobile(user id)</label>
              <div class="col-sm-8">
              <input type="text" id="Email_ID" onchange="clear_Email_ID()" maxlength="10" onkeypress="return IsNumeric(event);" name="email" class="form-control" placeholder="Enter user id "/>
               <p id="Email_ID_p" style="display:none;color:red;">Required User Id</p> 
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">Password</label>
              <div class="col-sm-8">
              <input type="password" id="Password" onchange="clear_Password()" name="password" class="form-control" placeholder="Enter password "/>
               <p id="Password_p" style="display:none;color:red;">Required Password</p>
               <div id="divpass"></div>
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">Confirm Password</label>
              <div class="col-sm-8">
              <input type="password" id="ConfirmPassword" onchange="clear_ConfirmPassword()" name="confirm_password" class="form-control" placeholder="Enter Confirm Password "/>
               <p id="ConfirmPassword_p" style="display:none;color:red;">Required Confirm Password</p>
               <p id="PasswordMatch" style="display:none;color:red;">Passwords do not match!</p>
              </div>
            </div>
            
            <div class="form-group ">
              <label class="col-sm-4 control-label">Telephone</label>
              <div class="col-sm-8">
              <input type="text" maxlength="10" id="Telephone" onchange="clear_Telephone()" onkeypress="return IsNumeric(event);" name="telephone" class="form-control" placeholder="Enter telephone "/>
               
              </div>
            </div>
               
            <div class="form-group">
              <label class="col-sm-4 control-label">Address</label>
              <div class="col-sm-8">
              <input type="text" id="Address" onchange="clear_Address()" name="address" class="form-control" placeholder="Enter address "/>
               <p id="Address_p" style="display:none;color:red;">Required Address</p>
              </div>
            </div>
            
          <div class="form-group required">
              <label class="col-sm-4 control-label">Group</label>
              <div class="col-sm-8">
              <select  id="group_role" onchange="clear_Group()" name="group_role" class="form-control">
                <option  value=""> Select group</option>
                <?php $i=1; foreach ($dpcustomer as $options) { ?>
                 <?php if ($options['id'] == $user_group_id) { ?>
                 <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                 <?php } else { ?>
                 <option value="<?php echo $options['id']; ?>_<?php echo $i;?>"><?php echo $options['name']; ?></option>
                 <?php } ?>
                 <?php $i++; } ?>
              </select>
              
               <p id="Group_p" style="display:none;color:red;">Required group</p>
              </div>
            </div>
           </div>  
            
            
            
           <div class="col-sm-4">
               
            <div class="form-group required">
              <label class="col-sm-4 control-label">Nation</label>
              <div class="col-sm-8">
               <select  id="nation_id" onchange="clear_nation(this.value)" name="nation_id" class="form-control">
                 <option  value="">Select nation</option>
                <?php foreach ($dpnation as $options) { ?>
                <?php if ($options['id'] == $user_group_id) { ?>
                <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                <?php } ?>
                <?php } ?>
               </select>
                  <p id="nation_id_p" style="display:none;color:red;">Required  Nation</p>
              </div>
            </div> 
               
            <!---<div class="form-group required">
            <label class="col-sm-4 control-label">Zone</label>
            <div class="col-sm-8">
            <select name="zone_id" onchange="clear_zone()" id="zone_id" class="form-control">
                <option  value="0">Select zone</option>
                <?php foreach ($dpzone as $options) { ?>
                <?php if ($options['id'] == $user_group_id) { ?>
                <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select> 
            <p id="zone_p" style="display:none;color:red;">Required  Zone</p>
            </div>
            </div>
               
            <div class="form-group required">
              <label class="col-sm-4 control-label">Region</label>
              <div class="col-sm-8">
            <select name="region_id" onchange="clear_region()" id="region_id" class="form-control">
                <option  value="">Select region</option>
                <?php foreach ($dpregion as $options) { ?>
                <?php if ($options['id'] == $user_group_id) { ?>
                <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
                  <p id="region_p" style="display:none;color:red;">Required  Region</p>
              </div>
            </div> -----> 
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">State</label>
              <div class="col-sm-8">
                 <select name="state_id" onchange="clear_state(this.value)" id="state_id" class="form-control">
                <option  value="">Select state</option>
                
              </select>
                  <p id="state_p" style="display:none;color:red;">Required  State</p>
              </div>
            </div>
               
           <!---  <div class="form-group required">
              <label class="col-sm-4 control-label">Area</label>
              <div class="col-sm-8">
             <select name="area_id" onchange="clear_area()" id="area_id" class="form-control">
                <option  value="">Select area</option>
                <?php foreach ($dparea as $options) { ?>
                <?php if ($options['id'] == $user_group_id) { ?>
                <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                <?php } ?>
                <?php } ?>
             </select>
                  <p id="area_p" style="display:none;color:red;">Required  area</p>
              </div>
            </div>---->
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">Territory</label>
              <div class="col-sm-8">
              <select name="territory_id" onchange="clear_territory(this.value)" id="territory_id" class="form-control">
                <option  value="">Select territory</option>
                
              </select>
              <p id="territory_p" style="display:none;color:red;">Required  territory</p>
              </div>
            </div> 
               
             <div class="form-group required">
              <label class="col-sm-4 control-label">District</label>
              <div class="col-sm-8">
                <select name="district_id" onchange="clear_district(this.value)" id="district_id" class="form-control">
                <option  value="">Select district</option>
                
              </select>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div> 
           
            <div class="form-group required">
              <label class="col-sm-4 control-label">HQ</label>
              <div class="col-sm-8">
             <select name="hq_id" onchange="clear_hq()" id="hq_id" class="form-control">
                <option  value="">Select HQ</option>
                
             </select>
                  <p id="hq_p" style="display:none;color:red;">Required  HQ</p>
              </div>
            </div>
           <div class="form-group required" id="retailerdiv">
              <label class="col-sm-4 control-label">Retailer</label>
              <div class="col-sm-8">
                
                   <select name="retailer[]" onchange="clear_retailer();" id="retailer" class="form-control select2-selection select2-selection--multiple"  multiple="multiple" data-placeholder="Select Retailer">
                <option  value="">Select Retailer </option>
               
               
            </select> 
                  <p id="retailer_p" style="display:none;color:red;">Required  Retailer</p>
              </div>
            </div>
               
            <div class="form-group required">
              <label class="col-sm-4 control-label">Status</label>
              <div class="col-sm-8">
                <select  id="Status" onchange="clear_status()" name="status" class="form-control">
                 <option  value="">Select status</option>
                 <option  value="1">Enable</option>
                 <option  value="0"> Disable</option>
               </select>
                  <p id="status_p" style="display:none;color:red;">Required  Status</p>
              </div>
            </div>
           
                   
           </div>
            <div class="col-sm-4">
                <div  id="group_hide"></div>
            </div>
        </form>
     
      </div>
    </div>
      
  </div>
    
</div>
<script type="text/javascript" src="view/javascript/bootstrap/js/select2.js"></script>
<?php echo $footer; ?>

<script type="text/javascript">
    $( document ).ready(function() {
   
  $("#retailer").select2({ tags: true,
      placeholder: function(){
        $(this).data('placeholder');
    }
  
});
});
 $('#button_save').on('click', function() {
var group= $('#group_role').val();
var nation= $('#nation_id').val();
var zone= $('#zone_id').val();
var region= $('#region_id').val();
var state= $('#state_id').val();
var area= $('#area_id').val();
var territory= $('#territory_id').val();
var district= $('#district_id').val();
var hq_id  = $('#hq_id').val();
var res = group.split("_");
var retailer=$('#retailer').val();
/*
 if ($("#Password").filter(function () {
        return this.value.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8})$/);
    })) {
        $("#divpass").text("pass");
    } else {
        $('#Password_p').show();
    }
        */
//alert(res[1]);
if ($('#First_Name').val().length ===0) {
     $('#First_Name_p').show();
     return false;
 }

else if($('#Last_Name').val().length===0){
        $('#Last_Name_p').show();
        return false;
        }
    
 else if($('#Email_ID').val().length===0){
        $('#Email_ID_p').show();
        return false;
        }
 else if($('#Password').val().length===0){
        $('#Password_p').show();
        return false;
        }
 else if($('#ConfirmPassword').val().length===0){
        $('#ConfirmPassword_p').show();
        return false;
        }
 
        
 


alert(res[0]);
  if($('#group_role').val().length===0){
        $('#Group_p').show();
        return false;
        }
        
        
//for KTMDO validation
 else if(res[0]==="60" && nation==""){
    $('#nation_id_p').show();
    return false;
 }

else if(res[0]==="60" && nation!="" && state=="" ){
    $('#state_p').show();
    return false;
 }
else if(res[0]==="60" && nation!="" && state!="" && territory=="" ){
    $('#territory_p').show();
    return false;
 }
 else if(res[0]==="60" && nation!="" && state!="" && territory!="" && district=="" ){
    $('#district_p').show();
    return false;
 }
 else if(res[0]==="60" && nation!=="" && state!=="" && territory!=="" && district!=="" && hq_id===""){
    $('#hq_p').show();
    return false;
 }
 else if(res[0]==="60" && nation!=="" && state!=="" && territory!=="" && district!=="" && retailer===""){
    $('#retailer_p').show();
    return false;
 }
 
 
 //for MDO validation
 else if(res[0]==="49" && nation==""){
    $('#nation_id_p').show();
    return false;
 }

else if(res[0]==="49" && nation!="" && state=="" ){
    $('#state_p').show();
    return false;
 }
else if(res[0]==="49" && nation!="" && state!="" && territory=="" ){
    $('#territory_p').show();
    return false;
 }
 else if(res[0]==="49" && nation!="" && state!="" && territory!="" && district=="" ){
    $('#district_p').show();
    return false;
 }
 else if(res[0]==="49" && nation!=="" && state!=="" && territory!=="" && district!=="" && hq_id===""){
    $('#hq_p').show();
    return false;
 }
 
 
 // ASM validation
 else if(res[0]==="48" && nation==""){
    $('#nation_id_p').show();
    return false;
 }

else if(res[0]==="48" && nation!="" && state=="" ){
    $('#state_p').show();
    return false;
 }
 
 else if($('#Status').val().length===0){
        $('#status_p').show();
        return false;
        }
/*
else if($('#group1').val().length!=0"){
        $('#Group1_p').show();
        }
*/
/*
 else {
     
     
     document.getElementById("form-createcustomer").submit();
     
 }
 */
 
 else {

try{

var selects = document.getElementsByTagName('select');
var sel;
var relevantSelects = [];
var selc=selects.length;


for(var z=0; z<selects.length; z++){
   
if((z=='8' && res[0]==60) || (z=='9' && res[0]==60) || (z=='8' && res[0]==49) || (z=='9' && res[0]==49) || (z=='8' && res[0]==48) ){
sel = selects[z];
var name = sel.getAttribute("name");
if(name.indexOf("group[]")!=-1)
{

var y = sel.options[sel.selectedIndex].value;

if( y=="")
{
$('#Group_s').text('Please '+sel.options[sel.selectedIndex].text.toLowerCase());
$('#Group_s').show(); 
return false; 
}
}
}
}


}catch(e){alert(e);}


// if(document.getElementById("button_save").click){

document.getElementById("form-createcustomer").submit();
//} 
}
 
 
    
});

$(document).ready(function(){
 $('#retailerdiv').hide();
$('#group_role').on('change',function(){    
  var query = $(this).val(); 
   $('#group_hide').show();
   $('#group_hide').html('');
   if(query != '')  
           {  
                $.ajax({  
                    url: 'index.php?route=customer/createcustomer/groupDropdown&token='+getURLVar('token'),  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                        
                         $('#group_hide').html(data['data']);
                         
                          
                     }  
                });  
           }  
    
})
});
//clear text
function clear_First_Name()
{
    $('#First_Name_p').hide();
}
function clear_Last_Name()
{
    $('#Last_Name_p').hide();
}
function clear_retailer(){
     $('#retailer_p').hide();
}
function clear_Email_ID()
{
$('#Email_ID_p').hide();
   
//var email = $("#Email_ID").val();
//var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
///if (filter.test(email)) 
   // {
   //$("#emailmatch").hide();
   //$('#Email_ID_p').hide();
    //return true;
    //}
//else
   // {
   // $('#emailmatch').show();
   // $('#Email_ID_p').hide();
    //return false;
    //}
  
}
function clear_Password()
{
    $('#Password_p').hide();
    //var hh = this.value.match(/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8})$/);
    //alert(hh);
     //$('#Password_p').show();   
}
function clear_ConfirmPassword()
{
    //$('#ConfirmPassword_p').hide();
     $("#ConfirmPassword_p").hide();
    var password = $("#Password").val();
    var confirmPassword = $("#ConfirmPassword").val();
    if (password != confirmPassword)
        $("#PasswordMatch").show();
    else if (password = confirmPassword)
        $("#PasswordMatch").hide();
       
    else
       $('#ConfirmPassword_p').hide();
}
function clear_Telephone()
{
$('#Telephone_p').hide();
}

function clear_Address()
{
$('#Address_p').hide();
}
function clear_status()
{
    $('#status_p').hide();
}

function clear_Group()
{
    $('#Group_p').hide();
    var group= $('#group_role').val();
    var res = group.split("_");
   if(res[1]==4){
       $('#retailerdiv').show();
   } else {
       $('#retailerdiv').hide();
   }
   
}

function clear_nation(data)
{
    //alert(data);
     $('#nation_id_p').hide();
     
      var nation=data;
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=geo/addgeo/getterritorystate&token='+getURLVar('token'),
        data: 'nation='+nation,
        // dataType: 'json',
        cache: false,

        success: function(data) {

        // alert(data);
        $("#state_id").html(data);
        
        }


   });
     
     
}
function clear_zone()
{
     $('#zone_p').hide();
}
function clear_region()
{
     $('#region_p').hide();
}
function clear_state(data)
{
    //alert(data);
     $('#state_p').hide();
     var state_id=data;
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=geo/addgeo/getdistrict_territory&token='+getURLVar('token'),
        data: 'state_id='+state_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

         //alert(data);
        $("#territory_id").html(data);
        
        }


   });
}

function clear_hq()
{
     $('#hq_p').hide();
}
function clear_territory(data)
{
     $('#territory_p').hide();
     
      var territory_id=data;
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=geo/addgeo/getTerritory_District&token='+getURLVar('token'),
        data: 'territory_id='+territory_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

      //   alert(data);
        $("#district_id").html(data);
        
        }


   });
     
     
}

function clear_district(data)
{
    //alert(data);
     $('#district_p').hide();
      var district_id=data;
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=geo/addgeo/gethq&token='+getURLVar('token'),
        data: 'district_id='+district_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

         //alert(data);
         var data2=data.split("|");
         //alert(data2[0]);
        $("#hq_id").html(data2[0]);
        $("#retailer").html(data2[1]);
        
        }


   });
     
     
     
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
            var ret = ((keyCode >= 48 && keyCode <= 57 || keyCode == 46) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById("number").style.display = ret ? "none" : "inline";
            return ret;
        }
        

</script>

