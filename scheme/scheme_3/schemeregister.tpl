<?php echo $header; ?><?php echo $column_left;  ?>
<div id="content">
  
  <div class="page-header">
    <div class="container-fluid">
        
       <div class="pull-right">
           <button type="submit" id="insertscheme"  name="submit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default" /><i class="fa fa-save"></i></button>
        
       <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>

      </div>
      <h1>Scheme Register</h1>
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
        <div class="panel-heading" style=" margin-right: 700px;">
<h3 class="panel-title"><i class="fa fa-exchange"></i> Scheme Register</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $createscheme;?>" method="post" id="form-scheme" class="form-horizontal" enctype="multipart/form-data">
         
           <div class="col-sm-4"> 
            <div class="form-group required">
              <label class="col-sm-4 control-label" >Scheme Name</label>
              <div class="col-sm-8">
                  <input class="form-control" type="text" id="scheme_Name" onchange="clear_scheme_Name()"  name="scheme_Name"  placeholder="Enter scheme name" value="<?php echo $farmerdata['FARMER_NAME'];?>" />
              <p id="scheme_Name_p" style="display:none;color:red;">Required Scheme Name</p>
              </div>
            </div>
         
            <div class="form-group required date">
              <label class="col-sm-4 control-label">Date From</label>
              <div class="col-sm-8">
              <input type="text" id="date_from" onchange="clear_date_from(this.value)"  name="date_from" class="form-control fa fa-calendar" placeholder="Enter From Date" value="<?php echo $farmerdata['FAR_MOBILE'];?>" />
              
             
               <p id="date_from_p" style="display:none;color:red;">Required From Date</p> 
                
              </div>
              
            </div>
              
            <div class="form-group required date">
              <label class="col-sm-4 control-label">Date To</label>
              <div class="col-sm-8">
              <input type="text" id="date_to" onchange="clear_date_to(this.value)"  name="date_to" class="form-control" placeholder="Enter From Date" value="<?php echo $farmerdata['FAR_MOBILE'];?>" />
               <p id="date_to_p" style="display:none;color:red;">Required To Date</p> 
                
              </div>
            </div>   
            
             
           </div>  
            
        <div class="col-sm-4">
            <div class="form-group required">
                <label class="col-sm-4 control-label">Product</label>
                <div class="col-sm-8">
                    <select name="product_id" onchange="clear_product(this.value)" id="product_id" class="form-control">
                      <option  value="">Select Product</option>
                    <?php foreach($product as $options) { ?>
                         <option value="<?php echo $options['SID']; ?>"<?php if($options['SID']==$farmerdata["DIST_ID"]) { echo 'selected'; } ?> ><?php echo $options['PRODUCT_NAME']; ?></option>
                    <?php } ?>
                     </select>
                  
                <p id="product_p" style="display:none;color:red;">Required  Product</p>
                </div>
            </div> 
            <div class="form-group required">
              <label class="col-sm-4 control-label">Quantity</label>
              <div class="col-sm-8">
              <input type="text" id="qty" onchange="clear_qty(this.value)"  name="qty" class="form-control" placeholder="Enter Quantity" value="<?php echo $farmerdata['FAR_MOBILE'];?>" />
               <p id="qty_p" style="display:none;color:red;">Required Quantity</p> 
                
              </div>
            </div> 
            <div class="form-group required">
              <label class="col-sm-4 control-label">Points</label>
              <div class="col-sm-8">
              <input type="text" id="Points" onchange="clear_points(this.value)"  name="Points" class="form-control" placeholder="Enter Quantity" value="<?php echo $farmerdata['FAR_MOBILE'];?>" />
               <p id="Points_p" style="display:none;color:red;">Required Points</p> 
                
              </div>
            </div> 
            
                
       </div>
        </form>
     
      </div>
      
    </div>
      
  </div>
    
</div>


<?php echo $footer; ?>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});
//--></script>
<script type="text/javascript">
  
   $('#form-scheme').submit(function(event){


if ($('#scheme_Name').val().length ===0) {
     $('#scheme_Name_p').show();
     return false;
 }

 else if($('#date_from').val().length===0){
        $('#date_from_p').show();
        return false;
        }
     
 else if($('#date_to').val().length===0){
        $('#date_to_p').show();
        return false;
        }
 else if($('#product_id').val().length===0){
    
        $('#product_p').show();
        return false;
        }
  else if ($('#qty').val().length ===0) {
     $('#qty_p').show();
     return false;
 }    
  else if ($('#Points').val().length ===0) {
     $('#Points_p').show();
     return false;
 }
 
document.getElementById("form-scheme").submit();

});
 function clear_scheme_Name(){
      $('#scheme_Name_p').hide();
 }
  function clear_date_from(){
    $('#date_from_p').hide();
 }
  function clear_date_to(){
      $('#date_to_p').hide();
 }
 function clear_product(){
      $('#product_p').hide();
 }
 function clear_qty(){
      $('#qty_p').hide();
 }
 function clear_points(){
      $('#Points_p').hide();
 }
function backbtn(){
   url = 'index.php?route=farmer/farmerregistration&token='+getURLVar('token');
    location = url;
}
</script>
    
