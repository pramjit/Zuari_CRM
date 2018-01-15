<?php echo $header; ?>
<?php echo $column_left; ?>

<!-- Main Container Start -->
    <!-- Top Bar Starts -->
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
    <br><br>                  
  
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-danger" >
                    <div class="panel-heading">
                        <div class="panel-title"><p style="color:darkolivegreen"><b>Password Change</b></p></div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id;?>" >   
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="new_password" type="password" class="form-control" name="new_password" placeholder="Enter New Password"  onchange="clear_password_name();" required>
                            </div>
                           
                                 <p id="password_p" style="display:none;color:red;">Required New Password</p>
                            <div style="margin-bottom: 25px" class="input-group">
                               
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="re_password" type="password" class="form-control" name="re_password" placeholder="Re Enter Password" onchange="clear_repassword_name();" required>
                           
                            </div>
                                 <p id="repassword_p" style="display:none;color:red;">Required New Re Password</p>     

                         


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <a id="btn-update" href="#" class="btn btn-success" onclick="updatePassword();">Update Password </a>
                                     
                                    </div>
                                </div>


                               
                            </form>     



                        </div>                     
                    </div>  
        </div>
         
    </div>
    
 </div>   
 <!--new Model-->
 
 
</div>
<?php echo $footer;  ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


<script>

  function clear_password_name()
    {
         $('#password_p').hide();
    }
     function clear_repassword_name()
    {
         $('#repassword_p').hide();
    }

  function backbtn()
  {
      
    url = "index.php?route=common/dashboard";
    location = url;
  }
  function updatePassword()
  {
         var new_pass=document.getElementById("new_password").value;
         var re_pass=document.getElementById("re_password").value;
         var userid=document.getElementById("userid").value;
    if ($('#new_password').val().length ===0) 
    {
        $('#password_p').show();
    }else if ($('#re_password').val().length ===0) 
    {
        $('#repassword_p').show();
    }else if(new_pass!=re_pass)
        {
            alert("Password and Re Password Dose Not Matched");
        }else 
        {
            $.ajax({
           type: "POST",
           url: "index.php?route=common/changepassword/abc",
           data: {new_pass: new_pass, userid: userid},
           dataType: "text",
           success: function( data ) {
            alert(data);
           window.location.href='index.php?route=common/dashboard';

           }
       }); 
    }
 }
  
</script> 
