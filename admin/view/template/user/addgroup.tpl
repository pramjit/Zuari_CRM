
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button  type="submit" id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $addgroup; ?>" method="post" id="form-createdealer" class="form-horizontal">
            
            <div class="form-group required">
              <label class="col-sm-2 control-label" >Group Name</label>
              <div class="col-sm-4">
                  <input class="form-control" type="text" id="Group_Name" onchange="clear_Group_Name()" name="group_name"  placeholder="Enter Group Name"/>
                  <p id="Product_Name_p" style="display:none;color:red;">Required Product  Name</p>
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
                  <td style="width: 1px;" class="text-center">SN</td>
                  <td style="width: 1px;"class="text-center">Group Name</td>
                  <td style="width: 1px;"class="text-center">Edit</td>
           
                </tr>
              </thead>
              <tbody>
                <?php if ($groupnameshow) { ?>
                <?php foreach ($groupnameshow as $product) { ?>
               
                <tr>
                  
                  
                  <td class="text-left"><?php echo $product['id']; ?></td>
                  <td class="text-left"><?php echo $product['name']; ?></td>
                  <td class="text-right"><a href="<?php echo $product['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
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
  </div>
</div>
<?php echo $footer; ?>

