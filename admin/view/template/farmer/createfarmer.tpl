<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  
  <div class="page-header">
    <div class="container-fluid">
        
       <div class="pull-right">
           <?php //if(isset($farmerdata['SID'])) { ?>
          <!--- <button type="submit" id="updatefarmer"  name="update" data-toggle="tooltip" title="update" class="btn btn-default" /><i class="fa fa-save"></i></button>--->
           <?php //} else { ?>
          <?php  if($checkdata=='0' || $checkdata=='0') { ?>
           <button type="submit" id="insertfarmer"  name="submit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default" /><i class="fa fa-save"></i></button>
            <?php    }  ?>
    <!-- <button  name="save" id="button_save" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
        <button type="button" form="form-restore" data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>-->
       <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>

      </div>
      <h1>Create Farmer</h1>
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
      <!----------------------------------New-Searching------------------------------->
      <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Farmer</h3>
      </div>
      <div class="panel-body">
  
        <div class="well">
           <div class="row">
           
               <div class="col-sm-3" style=" margin-left: 300px;">
              <div class="form-group" >
                <label class="control-label" for="input-status">Search Mobile Number (User Id)</label>
  <input id="search_id" name="search_id" maxlength="10" onkeypress="return IsNumeric(event);" class="form-control" type="text" placeholder="Search Mobile Number (User Id) " value="<?php echo $farmerdata['FAR_MOBILE'];?>"/>
              </div>
             
             </div>
               
               <div class="col-sm-2">
                   <div class="form-group"></div>   
                   <button  id="searchbtn" onclick="getfarmerdata();" class="btn btn-primary pull-right" style=" margin-right:70px; margin-top:8px;" ><i class="fa fa-search"></i>  Search</button>
             </div>
            
     
          </div>
        </div>
    
      </div>
    </div>
      <!----------------------------------New-Searching-End------------------------------>
    <div class="panel panel-default">
        <div class="panel-heading" style=" margin-right: 700px;">
<h3 class="panel-title"><i class="fa fa-exchange"></i> Create Farmer</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $createcustomer;?>" method="post" id="form-createfarmer" class="form-horizontal" enctype="multipart/form-data">
         
           <div class="col-sm-4"> 
            <div class="form-group required">
              <label class="col-sm-4 control-label" >Farmer Name</label>
              <div class="col-sm-8">
                  <input class="form-control" type="text" id="First_Name" onchange="clear_First_Name()"  name="first_name"  placeholder="Enter first name" value="<?php echo $farmerdata['FARMER_NAME'];?>"  <?php  if($checkdata!='0' || $farmerdata['FARMER_NAME']) { ?> readonly <?php } ?>/>
              <p id="First_Name_p" style="display:none;color:red;">Required Farmer Name</p>
              </div>
            </div>
         
            <div class="form-group required">
              <label class="col-sm-4 control-label">Mobile(user id)</label>
              <div class="col-sm-8">
              <input type="text" id="Email_ID" onchange="clear_Email_ID(this.value)" maxlength="10" onkeypress="return IsNumeric(event);" name="email" class="form-control" placeholder="Enter user id " value="<?php echo $farmerdata['FAR_MOBILE'];?>" <?php  if($checkdata!='0' || $farmerdata['FAR_MOBILE'] ) { ?> readonly <?php } ?>/>
               <p id="Email_ID_p" style="display:none;color:red;">Required User Id</p> 
                <p id="Email_ID_q" style="display:none;color:red;">Please Enter 10 digit User Id</p>
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">Password</label>
              <div class="col-sm-8">
              <input type="password" id="Password" onchange="clear_Password()" name="password" class="form-control" placeholder="Enter password " <?php  if($checkdata!='0') { ?> readonly <?php } ?>/>
               <p id="Password_p" style="display:none;color:red;">Required Password</p>
               <div id="divpass"></div>
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-4 control-label">Confirm Password</label>
              <div class="col-sm-8">
              <input type="password" id="ConfirmPassword" onchange="clear_ConfirmPassword()" name="confirm_password" class="form-control" placeholder="Enter Confirm Password " <?php  if($checkdata!='0') { ?> readonly <?php } ?>/>
               <p id="ConfirmPassword_p" style="display:none;color:red;">Required Confirm Password</p>
               <p id="PasswordMatch" style="display:none;color:red;">Passwords do not match!</p>
              </div>
            </div>
           </div>  
            
            <div class="col-sm-4">
                 <div class="form-group required">
              <label class="col-sm-4 control-label">District</label>
               <div class="col-sm-8">
    <select name="district_id" onchange="clear_district(this.value)" id="district_id" class="form-control" <?php  if($checkdata!='0' || $farmerdata['DIST_ID']) { ?> disabled <?php } ?>>
                <option  value="">Select district</option>
                <?php foreach ($dpdistrictfar as $options) { ?>
    <option value="<?php echo $options['id']; ?>"<?php if($options['id']==$farmerdata["DIST_ID"]) { echo 'selected'; } ?> ><?php echo $options['name']; ?></option>
                <?php } ?>
              </select>
                   <?php  if(!empty($farmerdata['DIST_ID'])) { ?>
    <input type="hidden" name="district_id" value="<?php  echo $farmerdata['DIST_ID']; ?>">
                   <?php } ?>
               <p id="district_p" style="display:none;color:red;">Required  district</p>
              </div>
            </div> 
               
                  <div class="form-group required">
              <label class="col-sm-4 control-label" >Village</label>
              <div class="col-sm-8">
                    <select name="village_name" onchange="clear_village_name();" id="village_name" class="form-control"  data-placeholder="Select Village" <?php  if($checkdata!='0' || $farmerdata['VILL_ID']) { ?> disabled <?php } ?>>
                <option  value="">Select Village </option>
                <?php  //print_r($village);
                  foreach($village as $value) {  ?>
 <option value="<?php echo $value['SID']; ?>" <?php if($farmerdata['VILL_ID']==$value['SID']) { echo 'selected'; }  ?> ><?php echo $value['VILLAGE_NAME']; ?></option>
                  <?php }  ?>
               
            </select> 
            <?php  if(!empty($farmerdata['VILL_ID'])) { ?>
    <input type="hidden" name="village_name" value="<?php  echo $farmerdata['VILL_ID']; ?>">
                   <?php } ?>
                 
              <p id="Village_p" style="display:none;color:red;">Required Village </p>
              </div>
            </div>
                 <div class="form-group required">
              <label class="col-sm-4 control-label">Status</label>
              
              <div class="col-sm-8">
                <select  id="Status" onchange="clear_status()" name="status" class="form-control"  <?php  if($checkdata!='0') { ?> disabled <?php } ?>>
                 <option   value="">Select status</option>
                 <option  value="1">Enable</option>
                 <option   value="0"> Disable</option>
               </select>
                  <p id="status_p" style="display:none;color:red;">Required  Status</p>
              </div>
            </div>
            </div>
        </form>
     
      </div>
      
    </div>
      
  </div>
    
</div>

<script type="text/javascript" src="view/javascript/bootstrap/js/select2.js"></script>
<?php echo $footer; ?>

<script type="text/javascript">
  
   $('#form-createfarmer').submit(function(event){
var user_id=$('#Email_ID').val();

if ($('#First_Name').val().length ===0) {
     $('#First_Name_p').show();
     return false;
 }

 else if($('#Email_ID').val().length===0){
        $('#Email_ID_p').show();
        return false;
        }
 else if(user_id.length!==10){
   $('#Email_ID_q').show(); 
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
  else if ($('#district_id').val().length ===0) {
     $('#district_p').show();
     return false;
 }    
  else if ($('#village_name').val().length ===0) {
     $('#Village_p').show();
     return false;
 }
 else if($('#Status').val().length===0){
        $('#status_p').show();
        return false;
        }
 else {
       $.ajax({
            url         : 'index.php?route=farmer/farmerregistration/addfarmer&token='+getURLVar('token'),// $( this ).attr('action'),
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
            {
            //alert(data);
              if(data == 0)
              {
                 //alert('hjh');  
                  alert('Mobile Number Already Exist!');
              }         
            else{
                alert('Data Saved Sucessfully!');
            }
               // $('#search_id').val(' ');
               // $('#First_Name').val(' ');
               // $('#Email_ID').val(' ');
               // $('#Password').val(' ');
               // $('#ConfirmPassword').val(' ');
                //$('#district_id').val(' ');
               // $('#village_name').val(' ');
                // $('#Status').val(' ');
              url = 'index.php?route=farmer/farmerregistration&token='+getURLVar('token');
              location = url;

            },
            error: function(error)
            {


            }
        });  
      
  

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


document.getElementById("form-createcustomer").submit();

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
function clear_First_Name()
{
    $('#First_Name_p').hide();
}

function clear_Email_ID(mobile)
{
    /*
   $.ajax({  //duplicate mobile number
                    url: 'index.php?route=farmer/farmerregistration/checkMobileNumber&token='+getURLVar('token'),
                    method:"POST",  
                    data:{mobile:mobile},  
                     success:function(data)  
                     {  
                        alert(data);
                        $('#Email_ID').val('');
                          
                     }  
                }); */
$('#Email_ID_p').hide();
$('#Email_ID_q').hide();
   

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
function clear_district()
{
    $('#district_p').hide();
    
}

function clear_village_name()
{
    $('#Village_p').hide();
}
function clear_status()
{
    $('#status_p').hide();
}


 $('#searchbtn').click(function() {

    var searchmob = $('#search_id').val();
   //alert(searchmob);
     url='index.php?route=farmer/farmerregistration&token='+getURLVar('token'),
     url += '&farmermobile='+searchmob;
      location = url;
   
   
});


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
 function clear_district(id)
{
    //alert(id);
$('#district_p').hide();
   $.ajax({ 
        type: 'post',
        url: 'index.php?route=farmer/farmerregistration/getdistrictvillage&token='+getURLVar('token'),
        data: 'district_id='+id,
        // dataType: 'json',
        cache: false,

        success: function(data) {
//alert(data);
      // var data2=data.split("|");
         
        // $("#village_name").html(data2[0]);
        $("#village_name").html(data);
        }


   });

}
function backbtn(){
   url = 'index.php?route=farmer/farmerregistration&token='+getURLVar('token');
    location = url;
}
</script>
    
