<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
        <button id="upload"  data-toggle="tooltip" title="<?php echo $button_upload; ?>" class="btn btn-success"><i class="fa fa-upload"></i></button>
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
          
         
<form action="<?php echo $excelupload; ?>" method="post" enctype="multipart/form-data" id="form-restore" class="form-horizontal">
    
        <div class="col-sm-12">
              <p style="color: #070707;font-size: 14px;"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Strictly use the Pre-Defined format for uploading Dealer Data.</p>
              <p style="color: #070707;font-size: 14px;"> <i class="fa fa-check" aria-hidden="true"></i>&nbsp;Download the predefined format from here. &nbsp;<i onclick="downloadexlformate();" style="color:red" class="fa fa-download" aria-hidden="true"></i></p>
              <p style="color: #070707;font-size: 14px;"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Please add value of all mandatory fields </p>
              <p style="color: #070707;font-size: 14px;"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Mandatory Fields : </p>
              <p style="color: #070707;font-size: 14px;margin-left: 2%">1. Channel_Code </p>
              <p style="color: #070707;font-size: 14px;margin-left: 2%">2. Firm_Name  </p>
              <p style="color: #070707;font-size: 14px;margin-left: 2%">3. Owner_Name</p>
              <p style="color: #070707;font-size: 14px;margin-left: 2%">4 Mobile Number Should be of 10 digit</p>
        </div>

        <div class="form-group">
            <label style="padding-top: 2px" class="col-sm-2 control-label" for="input-import"><?php echo $file_restore; ?></label>
            <div class="col-sm-4">
                <input style="display: inline-block" id="choosefile" type="file" name="import" id="input-import" />
                <p id="choosefile_p" style="display:none;color:red;">Please choose file</p>
                <p id="choosefile_xl" style="display:none;color:red;">Please choose xls & xl file</p>
            </div>
        </div>
</form>  
 </div>
        
   
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>



<script type="text/javascript">
 
$('#upload').on('click', function() {

if($('#choosefile').val().lenght !==''){
       $('#choosefile_p').show();  
   }
   
 if($('#choosefile').val().length>0){
     
       var mas_file= $('#choosefile').val();
       var fileExtension = mas_file.substr(mas_file.length - 4);
       
       if(fileExtension==='.xls' || fileExtension==='.xl'){
          $('#choosefile_p').hide();
          $('#choosefile_xl').hide();
          document.getElementById("form-restore").submit();
          return false;
       }
       else{
          $('#choosefile_p').hide();
          $('#choosefile_xl').show();
       }     
 }

 });
function downloadexlformate(){

    url = 'index.php?route=dealer/bulkupload/downloadexlformate&token='+getURLVar('token');     
    location = url;
}

</script>