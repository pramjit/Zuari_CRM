<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      
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
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
  
        <div class="well">
           <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                
                
                <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
                <input id="input_status" onkeypress="return CheckIsCharacter(event,this);" name="input_status" class="form-control" type="text" placeholder="Search Geo"/>
              </div>
              <button  id="search"  class="btn btn-primary pull-right"><i class="fa fa-search"></i>Search</button>
             </div>
     
          </div>
        </div>
    
      </div>
    </div>
    
    <div   class="panel panel-default">
        <div class="panel-body">
          <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-right"><?php if ($sort == 'o.order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sid; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>"><?php echo $column_sid; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_geo_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_geo_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_geo_type; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_geo_type; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_nation; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_nation; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_state; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_state; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_act; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_act; ?></a>
                    <?php } ?></td>
                  
                 
                 
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($geo) { ?>
                <?php foreach ($geo as $geos) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($geos['SID'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $crops['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $crops['order_id']; ?>" />
                    <?php } ?>
                    <input type="hidden" name="shipping_code[]" value="<?php echo $crops['shipping_code']; ?>" /></td>
                  <td class="text-right"><?php echo $geos['SID']; ?></td>
                  <td class="text-left"><?php echo $geos['NAME']; ?></td>
                  <td class="text-left"><?php echo $geos['GTYPE']; ?></td>
                   <td class="text-left"><?php echo $geos['NATIONID']; ?></td>
                    <td class="text-left"><?php echo $geos['STATEID']; ?></td>
                  <td class="text-right"><?php echo $geos['ACT']; ?></td>
                  <td class="text-right"><a href="<?php echo $crops['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a> <a href="<?php echo $editvillage; ?>&id=<?php echo $crops['SID'];?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="<?php echo $crops['delete']; ?>" id="button-delete<?php echo $order['order_id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
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
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>  
        </div>
       </div>
  </div>
</div> 
<?php echo $footer; ?>

<script type="text/javascript"><!--
$('#search').on('click', function() {
    url = 'index.php?route=village/searchvillage&token=<?php echo $token; ?>';
    
    var filter_order_id = $('input[name=\'input_status\']').val();
    
    if (filter_order_id) {
        url += '&filter_village_name=' + encodeURIComponent(filter_order_id);
    }
    
    
   
    
    
    
   
                
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
//--></script> 