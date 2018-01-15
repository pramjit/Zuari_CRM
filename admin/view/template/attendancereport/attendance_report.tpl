
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button   id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $addgroupcustomer; ?>" method="post" id="form-addgroupcustomer" class="form-horizontal">
            
            <div class="form-group required">
              <label class="col-sm-1 control-label" >Date</label>
              <div class="col-sm-2">
              <input class="form-control" type="text" id="Group_Name" onchange="clear_Group_Name()" name="from_date"  placeholder="From Date"/>
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
              <div class="col-sm-2">
              <input class="form-control" type="text" id="Group_Name" onchange="clear_Group_Name()" name="to_date"  placeholder="To Date"/>
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
              
              <div class="col-sm-2">
               <select name="state" id="state" class="form-control">
                  <option value="">Select State</option>>
              </select> 
              </div>
              <div class="col-sm-2">
               <select name="mdo" id="mdo" class="form-control">
                  <option value="">Select MDO</option>>
              </select> 
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
              
              <div class="col-sm-2">
              <select name="act" id="act" class="form-control">
                  <option value="">Activity Type</option>>
              </select>    
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
            </div>
            
        </form>
          
     
      </div>
    </div>
    
    
   
    <div class="panel panel-default">
        <div class="panel-body">
           
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center">District</td>
                  <td style="width: 1px;"class="text-center">Market</td>
                  <td style="width: 1px;"class="text-center">Mdo Name</td>
                  <td style="width: 1px;"class="text-center">Date</td>
                  <td style="width: 1px;"class="text-center">ACT</td>
                  <td style="width: 1px;"class="text-center">Remarks</td>
           
                </tr>
              </thead>
              <tbody>
                <?php if ($attendanceReport) { ?>
                <?php foreach ($attendanceReport as $product) { ?>
               
                <tr>
                  
                  
                  <td class="text-left"><?php echo $product['district_name']; ?></td>
                  <td class="text-left"><?php echo $product['hq_name']; ?></td>
                  <td class="text-left"><?php echo $product['user_name']; ?></td>
                  <td class="text-left"><?php echo $product['cr_date']; ?></td>
                  <td class="text-left"><?php echo $product['user_activity']; ?></td>
                  <td class="text-left"><?php echo $product['remarks']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        
        </div>
       </div>
      
      <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
    
    
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript">   
 $('#button_save').on('click', function() {
   
 if ($('#Group_Name').val().length ===0) {
     $('#Group_Name_p').show();
 }
 
  else if ($('#add_level').val().length ===0) {
     $('#add_level_p').show();
 }
 
 
 else {
     var name=document.getElementById('Group_Name').value;
     var level=document.getElementById('add_level').value;
     
	$.ajax({ 
		type: 'post',
		url: 'index.php?route=customer/addgroupcustomer/addGroup&token='+getURLVar('token'),
                data: {name:name,addlevel:level},
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
 function clear_Group_Name()
{
 $('#Group_Name_p').hide();
}

function clear_add_level()
{
 $('#add_level_p').hide();
}
</script>