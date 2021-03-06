
 <?php echo $header; ?><?php echo $column_left;?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
            <?php if(isset($updatedata['customer_id'])) { ?>
 <button type="submit" id="updateretailer"  name="update" data-toggle="tooltip" title="update" class="btn btn-default" /><i class="fa fa-save"></i></button>
      <?php } else { ?>
        <button id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
         <?php  }  ?>
                <?php if(isset($updatedata['customer_id'])) { ?>
       <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
         <?php } else { ?>
              <button type="button" onclick="backbtn()1"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
                  <?php    }  ?>
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
 <form action="<?php if(isset($updatedata['customer_id'])) { echo $updateretailer; } else { echo $createretailer; } ?>" method="post" id="form-createcustomer" class="form-horizontal">
     <input type="hidden" value="<?php echo $updatedata['customer_id']; ?>" name="customer_id">
           <div class="col-sm-4"> 
               
            <div class="form-group required">
              <label class="col-sm-4 control-label" >Retailer First Name</label>
              <div class="col-sm-8">
                  <?php if(isset($updatedata['customer_id'])) { ?>
         <input class="form-control" type="text" id="retailer_f_name" onchange="clear_First_Name()" onkeypress="return CheckIsCharacter(event,this);" name="retailer_f_name"  placeholder="Enter first name" value="<?php echo $updatedata["firstname"];?>" readonly/>
           <?php } else { ?>
        <input class="form-control" type="text" id="retailer_f_name" onchange="clear_First_Name()" onkeypress="return CheckIsCharacter(event,this);" name="retailer_f_name"  placeholder="Enter first name" value="<?php echo $updatedata["firstname"];?>"/>
           <?php    }  ?>

              <p id="retailer_f_name_p" style="display:none;color:red;">Required First Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Retailer Last Name</label>
              <div class="col-sm-8">
            <?php if(isset($updatedata['customer_id'])) { ?>
                  <input type="text" id="retailer_l_name" onchange="clear_Last_Name()" onkeypress="return CheckIsCharacter(event,this);" name="retailer_l_name" class="form-control" placeholder="Enter last name " value="<?php echo $updatedata["lastname"];?>" readonly/>
                <?php } else { ?>
       <input type="text" id="retailer_l_name" onchange="clear_Last_Name()" onkeypress="return CheckIsCharacter(event,this);" name="retailer_l_name" class="form-control" placeholder="Enter last name " value="<?php echo $updatedata["lastname"];?>"/>
         <?php    }  ?>

               <p id="retailer_l_name_p" style="display:none;color:red;">Required Last Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Mobile(user id)</label>
              <div class="col-sm-8">
                      <?php if(isset($updatedata['customer_id'])) { ?>
                  <input type="text" id="retailer_mobile_number" onchange="clear_mobile_number()" maxlength="10" onkeypress="return IsNumeric(event);" name="retailer_mobile_number" class="form-control" placeholder="Enter user id " value="<?php echo $updatedata["email"];?>" readonly/>
                     <?php } else { ?>
           <input type="text" id="retailer_mobile_number" onchange="clear_mobile_number()" maxlength="10" onkeypress="return IsNumeric(event);" name="retailer_mobile_number" class="form-control" placeholder="Enter user id " value="<?php echo $updatedata["email"];?>">
                          <?php    }  ?>
               <p id="retailer_mobile_number_p" style="display:none;color:red;">Required User Id</p> 
               <p id="retailer_mobile_number_q" style="display:none;color:red;">Please Enter 10 digit User Id</p>
               <p id="retailer_mobile_number_r" style="display:none;color:red;">Valid User User Id</p>

              </div>
            </div>
         <?php if(!isset($updatedata['customer_id'])) { ?>
             <div class="form-group required">
              <label class="col-sm-4 control-label">Password</label>
              <div class="col-sm-8">
              <input type="password" id="Password" onchange="clear_Password()" name="password"  value="<?php echo $updatedata["password"];?>" class="form-control" placeholder="Enter password"/>
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
                 <?php }  ?>
            
            <div class="form-group ">
              <label class="col-sm-4 control-label">Telephone</label>
              <div class="col-sm-8">
              <input type="text" maxlength="10" id="retailer_telephone" onchange="clear_telephone()" onkeypress="return IsNumeric(event);" name="retailer_telephone" class="form-control" placeholder="Enter telephone " value="<?php echo $updatedata["telephone"];?>"/>
               <p id="retailer_telephone_p" style="display:none;color:red;">Required Telephone Number</p> 
              </div>
            </div>
               
            <div class="form-group">
              <label class="col-sm-4 control-label">Address</label>
              <div class="col-sm-8">
                  <textarea id="retailer_address" onchange="clear_Address()" name="retailer_address" class="form-control" placeholder="Enter address " style="width:550px; height:80px;"/><?php echo $updatedata["address"];?></textarea>
               <p id="retailer_address_p" style="display:none;color:red;">Required Address</p>
              </div>
            </div>
           </div>  
            
            
            
           <div class="col-sm-4">
                <div class="form-group required">
              <label class="col-sm-4 control-label" >Customer Code</label>
              <div class="col-sm-8">
                     <?php if(isset($updatedata['customer_id'])) { ?>
        <input class="form-control" type="text" id="customer_code" onchange="clear_Customer_Code()" name="customer_code"  placeholder="Enter Customer Code" value="<?php echo $updatedata["sap_id"];?>" readonly/>
           <?php } else { ?>
                <input class="form-control" type="text" id="customer_code" onchange="clear_Customer_Code()" name="customer_code"  placeholder="Enter Customer Code" value="<?php echo $updatedata["sap_id"];?>"/>
           <?php } ?>

          <p id="customer_code_p" style="display:none;color:red;">Required Customer Code</p>
              </div>
            </div>
               <div class="form-group required">
                <label class="col-sm-4 control-label">District</label>
              <div class="col-sm-8">
                <select name="district_id" onchange="clear_district(this.value)" id="district_id" class="form-control">
                <option  value="">Select district</option>
                <?php
                foreach ($district as $value) {   
                ?>
            <option  value="<?php echo $value['id'] ?>"<?php if($value['id']==$updatedata["district_id"]) { echo 'selected'; } ?> ><?php echo $value['name'] ?></option>
                <?php } ?>
              </select>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div>
               <!-- <div class="form-group required">
                <label class="col-sm-4 control-label">SO</label>
              <div class="col-sm-8">
                <select name="so" onchange="clear_so(this.value)" id="so" class="form-control">
                <option  value="">Select SO</option>
                
              </select>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div> 
                <div class="form-group required">
                <label class="col-sm-4 control-label">ASM</label>
              <div class="col-sm-8">
                <select name="asm" onchange="clear_asm(this.value)" id="asm" class="form-control">
                <option  value="">Select ASM </option>
                
              </select>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div>-------------> 
              <label class="col-sm-4 control-label">Status</label>
              <div class="col-sm-8">
                  
                <select  id="retaile_status" onchange="clear_status()" name="retaile_status" class="form-control">
                 <option  value="">Select status</option>
                 <option  value="1" <?php if($updatedata["status"]=='1') { echo 'selected'; } ?> >Enable</option>
                 <option  value="0" <?php if($updatedata["status"]=='0') { echo 'selected'; } ?>> Disable</option>
               </select>
                  <p id="retaile_status_p" style="display:none;color:red;">Required  Status</p>
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
var user_id=$('#retailer_mobile_number').val();

if ($('#retailer_f_name').val().length ===0) {
     $('#retailer_f_name_p').show();
 }

else if($('#retailer_l_name').val().length===0){
        $('#retailer_l_name_p').show();
        return false;
        }
     
    
 else if($('#retailer_mobile_number').val().length===0){
        $('#retailer_mobile_number_p').show();
        return false;
        }
        else if(user_id.length!==10){
   $('#retailer_mobile_number_q').show(); 
   return false;
} 
 else if(user_id==0000000000){
   $('#retailer_mobile_number_r').show(); 
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
else if($('#retailer_telephone').val().length===0){
        $('#retailer_telephone_p').show();
        return false;
        }
else if($('#retailer_address').val().length===0){
        $('#retailer_address_p').show();
        return false;
        }
 else if($('#customer_code').val().length===0){
        $('#customer_code_p').show();
        return false;
        }
else if($('#district_id').val().length===0){
        $('#district_p').show();
        return false;
        }
else if($('#retaile_status').val().length===0){
        $('#retaile_status_p').show();
        return false;
        }

 
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
$('#updateretailer').on('click', function() {
var user_id=$('#retailer_mobile_number').val();

if ($('#retailer_f_name').val().length ===0) {
     $('#retailer_f_name_p').show();
 }

else if($('#retailer_l_name').val().length===0){
        $('#retailer_l_name_p').show();
        return false;
        }
     
    
 else if($('#retailer_mobile_number').val().length===0){
        $('#retailer_mobile_number_p').show();
        return false;
        }
        else if(user_id.length!==10){
   $('#retailer_mobile_number_q').show(); 
   return false;
}
 else if(user_id==0000000000){
   $('#retailer_mobile_number_r').show(); 
   return false;
} 
 
else if($('#retailer_telephone').val().length===0){
        $('#retailer_telephone_p').show();
        return false;
        }
else if($('#retailer_address').val().length===0){
        $('#retailer_address_p').show();
        return false;
        }
        else if($('#customer_code').val().length===0){
        $('#customer_code_p').show();
        return false;
        }
else if($('#district_id').val().length===0){
        $('#district_p').show();
        return false;
        }
else if($('#retaile_status').val().length===0){
        $('#retaile_status_p').show();
        return false;
        }

 
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
    $('#retailer_f_name_p').hide();
}
function clear_Last_Name()
{
    $('#retailer_l_name_p').hide();
}
function clear_mobile_number(){
     $('#retailer_mobile_number_p').hide();
     $('#retailer_mobile_number_q').hide();
      $('#retailer_mobile_number_r').hide();
  
}

function clear_Password()
{
    $('#Password_p').hide();
}
function clear_ConfirmPassword()
{
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
function clear_telephone()
{
$('#retailer_telephone_p').hide();
 }
function clear_Address()
{
$('#retailer_address_p').hide();
}
function clear_Customer_Code()
{
$('#customer_code_p').hide();
}
function clear_district(id)
{
    //alert(id);
$('#district_p').hide();
   $.ajax({ 
        type: 'post',
        url: 'index.php?route=retailer/retailerregistration/getsoasm&token='+getURLVar('token'),
        data: 'district_id='+id,
        // dataType: 'json',
        cache: false,

        success: function(data) {
//alert(data);
       var data2=data.split("|");
         
        $("#so").html(data2[0]);
        $("#asm").html(data2[1]);
        }


   });

}


function clear_status()
{
$('#retaile_status_p').hide();
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
        function backbtn(){
   url = 'index.php?route=retailer/retailerregistration&token='+getURLVar('token');
    location = url;
}
  function backbtn1(){
   url = 'index.php?route=retailer/viewretailerreg&token='+getURLVar('token');
    location = url;
}
        

</script>