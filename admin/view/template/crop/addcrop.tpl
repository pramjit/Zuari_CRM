
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button  form="form-backup" id="button_save" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $addcrop; ?>" method="post" id="form-createdealer" class="form-horizontal">
         
           
             
                         
            <div class="form-group required">
              <label class="col-sm-2 control-label" >Crop Name</label>
              <div class="col-sm-4">
                  <input class="form-control" type="text" id="Crop_Name" onchange="clear_Crop_Name()" onkeypress="return CheckIsCharacter(event,this);" name="crop_name"  placeholder="Enter Crop Name"/>
              <p id="Crop_Name_p" style="display:none;color:red;">Required Crop Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-2 control-label">Season Name</label>
              <div class="col-sm-4">
              <input type="text" id="Crop_Season_Name" onchange="clear_Season_Name()" onkeypress="return CheckIsCharacter(event,this);" name="season_name"  class="form-control" placeholder="Enter Season Name "/>
               <p id="Crop_Season_Name_p" style="display:none;color:red;"> Season Name Required</p>
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
   
 if ($('#Crop_Name').val().length == 0) {
     $('#Crop_Name_p').show();
 }
 
 else if($('#Crop_Season_Name').val().length==0){
        $('#Crop_Season_Name_p').show();
        }
        
 else if($('#Crop_Act').not(':checked').length){
        $('#Crop_Act_p').show();
        }
        
    
 
 else {
     var nametxt=document.getElementById('Crop_Name').value;
     var nametxt1=document.getElementById('Crop_Season_Name').value;
     
     
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=crop/addcrop/addCrop&token='+getURLVar('token'),
                data: {name:nametxt,crop:nametxt1},
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
            } else {
     
      document.getElementById('Crop_Name').value="";
      document.getElementById('Crop_Season_Name').value="";
      document.getElementById('Crop_Act').checked="";
      
            }

		}		
	});
 }
    
});
//clear txt

function clear_Crop_Name()
{
    $('#Crop_Name_p').hide();
}
function clear_Season_Name()
{
    $('#Crop_Season_Name_p').hide();
}
function clear_Crop_Act()
{
    $('#Crop_Act_p').hide();
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