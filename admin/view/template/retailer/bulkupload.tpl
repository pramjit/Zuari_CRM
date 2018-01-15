<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-backup" data-toggle="tooltip" title="<?php echo $button_download; ?>" class="btn btn-default"><i class="fa fa-download"></i></button>
        <button type="submit" form="form-restore" data-toggle="tooltip" title="<?php echo $button_upload; ?>" class="btn btn-default"><i class="fa fa-upload"></i></button>
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
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-import"><?php echo $file_restore; ?></label>
            <div class="col-sm-10">
              <input type="file" name="import" id="input-import" />
            </div>
          </div>
        </form>
             <?php  if (isset($exceldisplay)) { ?>
        <form>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center">
                      Channel Code</td>
                  <td class="text-center">Channel Type</td>
                  <td class="text-left">Firm Name</td>
                  <td class="text-left">Owner Name</td>
                  <td class="text-left">Mobile No:</td>
                  <td class="text-right">Email ID</td>
                  <td class="text-left">DMR Name</td>
                  <td class="text-right">FMR Name</td>
                </tr>
              </thead>
              <tbody>
                  
        
                <?php foreach ($exceldisplay as $product) { ?>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center"><?php echo $product['0']; ?></td>
                  <td class="text-left"><?php echo $product['1']; ?></td>
                  <td class="text-left"><?php echo $product['2']; ?></td>
                  <td class="text-left"><?php echo $product['3']; ?></td>
                  <td class="text-right"></td>
                  <td class="text-left"><?php echo $product['1']; ?></td>
                  <td class="text-right"></td>
                </tr>
                <?php } ?>
                <?php 
              
                
                } else { ?>
                <tr>
                  <td class="text-center" colspan="8">Please upload excel file</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php  if(isset($exceldisplay))   echo '<div class="buttons">
  <div class="pull-right">
    <input type="button" value="Confirm" id="button-confirm" class="btn btn-primary" /></div></div>';
    ?>
        </form>
        
          
          
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
$('#button-confirm').on('click', function() {
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=dealer/bulkupload/confirm&token='+getURLVar('token'),
		cache: false,
		beforeSend: function() {
			$('#button-confirm').button('loading');
		},
		complete: function() {
			$('#button-confirm').button('reset');
		},		
		success: function(json) {
			            alert(json);
            if (json['redirect']) {
                location = json['redirect'];
            } else if (json['error']) {
                if (json['error']['warning']) {
alert(json['error']['warning']);                    
                }           
            } else {
      alert("done");          
            }

		}		
	});
});
//--></script> 