<?php echo $header; ?>
<?php echo $column_left;   ?>
  

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
                <input id="villagefilter" name="villagefilter" class="form-control" type="text" placeholder="Search Village"/>
              </div>
             
             </div>
               <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-status">Market</label>
                <select name="market" id="market" class="form-control">
                    <option value="">Select Market</option>
                    <?php foreach($market as $mt) { ?>
                    <option value="<?php echo $mt["sid"]?>"><?php echo $mt["geo_name"]?></option>
                    <?php } ?>
                </select>
              </div>
             
             </div>
               
               <div class="col-sm-2">
                   <div class="form-group"></div>   
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
                  
                  
                  <td class="text-center" style="font-weight: bold"><a > Village Name</a></td>
                  <td class="text-center" style="font-weight: bold"><a > Village Pin code</a></td>
                  <td class="text-center" style="font-weight: bold"><a > State</a></td>
                  <td class="text-center" style="font-weight: bold"><a > Territory</a></td>
                  <td class="text-center" style="font-weight: bold"><a > District</a></td>
                  <td class="text-center" style="font-weight: bold"><a > Market</a></td>
                  <td class="text-center" style="font-weight: bold"><a > Date</a></td>
                  
                </tr>
              </thead>
              <tbody>
                <?php if ($villages) { ?>
                <?php foreach ($villages as $village) { ?>
                <tr>
                 
                  <td class="text-left"><?php echo $village['village_name']; ?></td>
                  <td class="text-right"><?php echo $village['village_pin_code']; ?></td>
                  <td class="text-left"><?php echo $village['state_name']; ?></td>
                  <td class="text-left"><?php echo $village['territory_name']; ?></td>
                  <td class="text-left"><?php echo $village['district_name']; ?></td>
                   <td class="text-left"><?php echo $village['hq_name']; ?></td>
                  <td class="text-right"><?php echo date('d-m-Y',strtotime($village['cr_date'])); ?></td>
                  
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
    
    var village = $('#village').val();
    alert(village);
    if (filter_order_id) {
        url += '&filter_village_name=' + encodeURIComponent(village);
    }
    
    
   
    
    
    
   
                
    location = url;
});
//--></script> 