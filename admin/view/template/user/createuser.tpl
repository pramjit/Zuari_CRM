
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
        <form action="<?php echo $createuser; ?>" method="post" id="form-createdealer" class="form-horizontal">
         
           
             
                         
            <div class="form-group required">
              <label class="col-sm-2 control-label" >First Name</label>
              <div class="col-sm-4">
                  <input class="form-control" type="text" id="First_Name" onchange="clear_First_Name()" onkeypress="return CheckIsCharacter(event,this);" name="first_name"  placeholder="Enter First Name"/>
                  <p id="First_Name_p" style="display:none;color:red;">Required First  Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-4">
              <input type="text" id="Last_Name" onchange="clear_Last_Name()" onkeypress="return CheckIsCharacter(event,this);" name="last_name" class="form-control" placeholder="Enter Last Name "/>
               <p id="Last_Name_p" style="display:none;color:red;">Required Last Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label" >Email ID</label>
              <div class="col-sm-4">
                  <input class="form-control" type="email" id="Email_ID" onchange="clear_Email_ID()" name="email_id"  placeholder="Enter Email ID"/>
                  <p id="Email_ID_p" style="display:none;color:red;">Required Email ID</p>
                  <p id="emailmatch" style="display:none;color:red;">Email not valid</p>
              </div>
            </div>
             <div class="form-group required">
              <label class="col-sm-2 control-label" >Password</label>
              <div class="col-sm-4">
                  <input class="form-control" type="password" id="Password" onchange="clear_Password()" name="password"  placeholder="Enter Password"/>
                  <p id="Password_p" style="display:none;color:red;">Required Password</p>
              </div>
            </div>
             <div class="form-group required">
              <label class="col-sm-2 control-label" >Confirm Password</label>
              <div class="col-sm-4">
                  <input class="form-control" type="password" id="ConfirmPassword" onchange="clear_ConfirmPassword()" name="confirmpassword"  placeholder="Enter Confirm Password"/>
                  <p id="ConfirmPassword_p" style="display:none;color:red;">Required Confirm Password</p>
                  <p id="PasswordMatch" style="display:none;color:red;">Passwords do not match!</p>
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-2 control-label" >Status</label>
              <div class="col-sm-4">
                <select name="status" onchange="clear_Status()" id="Status" class="form-control">
                 <option  value="-1">Select Status</option>
                 <option  value="1">Enable</option>
                 <option  value="0">Disable</option>
                </select>
                  <p id="Status_p" style="display:none;color:red;">Required Status</p>
              </div>
            </div>
            
             <div class="form-group required">
              <label class="col-sm-2 control-label" >Group</label>
              <div class="col-sm-4">
                <select name="group" onchange="clear_Group()" id="Group" class="form-control">
                 <option  value="">Select Group</option>
                 <?php foreach ($dpgroup as $options) { ?>
                 <?php if ($options['id'] == $user_group_id) { ?>
                 <option value="<?php echo $options['id']; ?>" selected="selected"><?php echo $options['name']; ?></option>
                 <?php } else { ?>
                 <option value="<?php echo $options['id']; ?>"><?php echo $options['name']; ?></option>
                 <?php } ?>
                 <?php } ?>
                </select>
                  <p id="Group_p" style="display:none;color:red;">Required Group</p>
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
   
 if ($('#First_Name').val().length ===0) {
     $('#First_Name_p').show();
 }
 
 else if($('#Last_Name').val().length===0){
        $('#Last_Name_p').show();
        }
        
 else if($('#Email_ID').val().length===0){
        $('#Email_ID_p').show();
        }
 else if($('#Password').val().length===0){
        $('#Password_p').show();
        }
 else if($('#ConfirmPassword').val().length===0){
        $('#ConfirmPassword_p').show();
        }
        
 else if($('#Status').val().length===0){
        $('#Status_p').show();
        }
        
 else if($('#Group').val().length===0){
        $('#Group_p').show();
        }
 
    
 
 else {
     var First_Name=document.getElementById('First_Name').value;
     var Last_Name=document.getElementById('Last_Name').value;
     var Email_ID=document.getElementById('Email_ID').value;
     var Password=document.getElementById('Password').value;
     var Status=document.getElementById('Status').value;
     var Group=document.getElementById('Group').value;
     
    
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=user/createuser/addUser&token='+getURLVar('token'),
                data: {name:First_Name,lastname:Last_Name,email:Email_ID,password:Password,status:Status,group:Group},
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
function clear_First_Name()
{
    $('#First_Name_p').hide();
}
function clear_Last_Name()
{
    $('#Last_Name_p').hide();
}
function clear_Email_ID()
{
    //$('#Email_ID_p').hide();
var email = $("#Email_ID").val();
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if (filter.test(email)) 
    {
   $("#emailmatch").hide();
   $('#Email_ID_p').hide();
    return true;
    }
else 
    {
    $('#emailmatch').show();
    $('#Email_ID_p').hide();
    return false;
    }
}
function clear_Password()
{
    $('#Password_p').hide();
}
function clear_ConfirmPassword()
{   //$('#ConfirmPassword_p').hide();
    var password = $("#Password").val();
    var confirmPassword = $("#ConfirmPassword").val();
    if (password != confirmPassword)
        $("#PasswordMatch").show();
    else if (password = confirmPassword)
        $("#PasswordMatch").hide();
    else
       $('#ConfirmPassword_p').hide();
    
}

function clear_Status()
{
    $('#Status_p').hide();
}

function clear_Group()
{
    $('#Group_p').hide();
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
