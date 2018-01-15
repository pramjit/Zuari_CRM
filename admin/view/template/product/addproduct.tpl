
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
          <?php if(isset($updatedata['SID'])) { ?>
           <button type="submit" id="updateretailer"  name="update" data-toggle="tooltip" title="update" class="btn btn-default" /><i class="fa fa-save"></i></button>
              <?php } else { ?>
        <button id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
            <?php    }  ?>
        <?php if(isset($updatedata['SID'])) { ?>
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
          <?php } else { ?>
           <button type="button" onclick="backbtn1()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
   <?php    }  ?>
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
        <form action="<?php if(isset($updatedata['SID'])) { echo $updateproduct; } else { echo $addproduct; } ?>" method="post" id="form-createproduct" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="sid" value="<?php echo $updatedata["SID"]?>">
            <div class="form-group required">
              <label class="col-sm-2 control-label" >Product Name</label>
              <div class="col-sm-4">
                  <input class="form-control" type="text" id="Product_Name" onchange="clear_Product_Name()"  name="product_name"  placeholder="Enter Product Name" value="<?php echo $updatedata["PRODUCT_NAME"];?>" />
              <p id="Product_Name_p" style="display:none;color:red;">Required Product  Name</p>
              </div>
            </div>
            <div class="form-group ">
              <label class="col-sm-2 control-label">SKU</label>
              <div class="col-sm-4">
               <input class="form-control" type="text" id="sku" onchange="clear_sku()"  name="sku"  placeholder="Enter SKU" value="<?php echo $updatedata["SKU"];?>"/>
               <p id="Product_Category_p" style="display:none;color:red;">Required SKU  </p>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label">UNIT</label>
              <div class="col-sm-4">
               <input class="form-control" type="text" id="unit" onchange="clear_unit()"  name="unit"  placeholder="Enter Unit" value="<?php echo $updatedata["UNIT"];?>"/>
               <p id="unit_p" style="display:none;color:red;">Required UNIT  </p>
              </div>
            </div>
           
               <div class="form-group required">
             <label class="col-sm-2 control-label">Photo</label>
               <div class="col-sm-4">
               <input class="form-control" type="file" id="file"  name="file"/>
              </div>
            </div>
           <div class="form-group">
              <label class="col-sm-2 control-label">Photo</label>
              <div class="col-sm-6">
                  <input type="hidden" name="last_image_name" value="<?php echo $updatedata['PRODUCT_IMAGE']; ?>">
                  <img src="http://192.168.1.159/aksha/system/upload/<?php echo $updatedata['PRODUCT_IMAGE']; ?>" style="height: 59px !important;
width: 60px !important;"></img>
                   
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
   
 if ($('#Product_Name').val().length === 0) {
     $('#Product_Name_p').show();
 }
 else  if ($('#unit').val().length === 0) {
     $('#unit_p').show();
     }
 else {
     var nametxt=document.getElementById('Product_Name').value;
     var nametxt1=document.getElementById('sku').value;
     var nametxt2=document.getElementById('unit').value;
     document.getElementById("form-createproduct").submit();
 }
    
});
$('#updateretailer').on('click', function() {
   
 if ($('#Product_Name').val().length === 0) {
     $('#Product_Name_p').show();
 }
 else  if ($('#unit').val().length === 0) {
     $('#unit_p').show();
     }
 else {
     var nametxt=document.getElementById('Product_Name').value;
     var nametxt1=document.getElementById('sku').value;
     var nametxt2=document.getElementById('unit').value;
     document.getElementById("form-createproduct").submit();
 }
    
});
//clear text
function clear_Product_Name()
{
  $('#Product_Name_p').hide();    
}
function clear_unit()
{
    $('#unit_p').hide();
}
function clear_Product_Act()
{
    $('#Product_Act_p').hide();
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
       function backbtn(){
    url = 'index.php?route=product/viewproduct&token='+getURLVar('token');
    location = url;
}
 function backbtn1(){
    url = 'index.php?route=product/addproduct&token='+getURLVar('token');
    location = url;
}
</script>