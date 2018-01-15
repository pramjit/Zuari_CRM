
<?php echo $header;?>
<?php echo $column_left;  //print_r($lastpartyname); ?>

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
      <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">
        <i class="fa fa-reply">
        </i>
      </button>
      <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          <i class="fa fa-search">
          </i> 
          Search
        </h3>
      </div>
        
       <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-2 form-group required">
     <input class="form-control input-date" data-date-format="YYYY-MM-DD" type="text" id="from_date" onchange="clear_from_date()" name="from_date"  placeholder="From Date" value="<?php echo $lastfromdate; ?>"/> 
          <p id="from_date_p" style="display:none;color:red;">Required From Date</p> 

            </div>
            <div class="col-sm-2 form-group required">
              <input class="form-control input-date" type="text"  data-date-format="YYYY-MM-DD" id="to_date" onchange="clear_to_date()" name="to_date"  placeholder="To Date" value="<?php echo $lasttodate; ?>"/>
                <p id="to_date_p" style="display:none;color:red;">Required To Date</p>
            </div>
               <div class="col-sm-2 form-group required" style=" width: 250px;">
              <div class="">
       <select name="asm[]" onchange="getsodfc();" id="asm" class="form-control select2-selection select2-selection--multiple"  multiple="multiple"  data-placeholder="Select ASM DFC" >
                <option  value="">Select ASM DFC</option>
       <?php foreach($asm as $value) {  ?>
              <option value="<?php echo $value["customer_id"]; ?>" <?php for($i=0;$i<count($lastasm);$i++) { if($lastasm[$i]==$value["customer_id"]) { echo "selected"; } } ?>><?php echo $value["name"]?></option>
              <?php } ?>
              </select>
   <p id="asm_dfc_p" style="display:none;color:red;">Required ASM DFC</p> 
            </div>
          </div>  
            <div class="col-sm-2 form-group required" style=" width: 200px;">
              <div class="">
       <select name="so[]"  id="so" class="form-control select2-selection select2-selection--multiple"  multiple="multiple"  data-placeholder="Select DFC" >
                <option  value="">---Select DFC---</option>
       <?php foreach($so as $value) {  ?>
              <option value="<?php echo $value["customer_id"]; ?>" <?php for($i=0;$i<count($lastso);$i++) {  if($lastso[$i]==$value["customer_id"]) { echo "selected"; } } ?>><?php echo $value["name"]?></option>
              <?php } ?>
              </select>
   
            </div>
          </div>  
         <div class="col-sm-2 form-group required" style=" width: 200px;">
              <div class="">
       <select name="product[]"  id="product" class="form-control select2-selection select2-selection--multiple"  multiple="multiple"  data-placeholder="Select Product" >
               
       <?php foreach($product as $value) {  ?>
              <option value="<?php echo "'".$value["product_name"]."'"; ?>" <?php for($i=0;$i<count($lastproduct);$i++) { if($lastproduct[$i]=="'".$value["product_name"]."'") { echo "selected"; } } ?>><?php echo $value["product_name"]?></option>
              <?php } ?>
              </select>
   <p id="asm_dfc_p" style="display:none;color:red;">Required ASM DFC</p> 
            </div>
          </div> 
        <div class="col-sm-1">
          <button  id="searchbtn_order" class="btn btn-primary pull-right">
            <i class="fa fa-search">
            </i> Search
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div   class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-center" style="font-weight: bold">DFC Name</td>
            <td class="text-center" style="font-weight: bold">Date</td>
            <td class="text-center" style="font-weight: bold">Farmer Name </td>
             <td class="text-center" style="font-weight: bold">Customer Code</td>
            <td class="text-center" style="font-weight: bold">Dealer</td>
            <td class="text-center" style="font-weight: bold">Product Name</td>
            <td class="text-center" style="font-weight: bold">Product Qty</td>
          
          </tr>
        </thead>
        <?php if($ordersdata) { ?>
        <tbody>
          <?php 
foreach($ordersdata as $resultt){   ?>
          <tr>
          <td class="text-center">
              <?php echo $resultt['so_name']; ?>
            </td>
            <td class="text-center">
              <?php echo $resultt['date']; ?>
            </td>                  
            <td class="text-center">
              <?php echo $resultt['Farmer_name'];?>
            </td>
             <td class="text-center">
              <?php echo $resultt['customer_code'];?>
            </td>
            <td class="text-center">
              <?php echo $resultt['Dealer_name']; ?>
            </td>
            <td class="text-center">
              <?php echo $resultt['PRODUCT_NAME']; ?>
            </td>
             <td class="text-center">
              <?php echo $resultt['PRODUCT_USAGE']; ?>
            </td>
          </tr>
          <?php } ?>
        <tbody>
          <?php } else { ?>
          <tr>
            <td class="text-center" colspan="8">
              <?php echo $text_no_results; ?>
            </td>
          </tr>
          <?php } ?>
      </table>
    </div>
    <div class="row">
      <div class="col-sm-6 text-left">
        <?php echo $pagination; ?>
      </div>
      <div class="col-sm-6 text-right">
        <?php echo $results; ?>
      </div>
    </div>  
  </div>
</div>
</div>
</div> 
<?php echo $footer; ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$(function () {
$('.input-date').datepicker({ format: 'yyyy-mm-dd',autoclose: true});
$("#so").select2(); 
});
$("#asm").select2({ tags: true,
      placeholder: function(){
        $(this).data('placeholder');
    }
  
});
$("#product").select2({ tags: true,
      placeholder: function(){
        $(this).data('placeholder');
    }
  
});
});
</script>
<script type="text/javascript">
    $('#searchbtn_order').click(function() {
    var searchdate = $('#so').val();
      var asm = $('#asm').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var product = $('#product').val();
    /*
   if($('#so').val().length===0){
        $('#so').show();
        return false;
        }*/
     url='index.php?route=dfc/dfcorders',
     url += '&so='+searchdate,
      url += '&asmdfc='+asm,
     url += '&from_date='+from_date,
     url += '&to_date='+to_date ,
     url += '&product='+product ,
      location = url;
      
});
function clear_date(){
     $('#date_p').hide();
}

  function download(){
    var so = $('#so').val();
      var asm = $('#asm').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
     var product = $('#product').val();
    url = 'index.php?route=dfc/dfcorders/ordersdata_download',
    url += '&so='+so,
    url += '&asmdfc='+asm,
    url += '&from_date='+from_date,
    url += '&to_date='+to_date ,
    url += '&product='+product ,
   location = url;
  }
  function backbtn(){
    url = 'index.php?route=dfc/dfcorders';
    location = url;
  }
  
  function getsodfc(){
    var id=$('#asm').val();
   
   //  alert(id);
     $.ajax({ 
        type: 'post',
        url: 'index.php?route=dfc/dfcorders/getdfcso',
        data: 'id='+id,
        // dataType: 'json',
        cache: false,

        success: function(data) {
      
        $("#so").html(data);
        
        }

   });
}


function getDist(stid){
  alert(stid);
   /* Get from elements values */
    $.ajax({
        url: "index.php?route=call/missedcall/getDist",
        type: "post",
        //data: "stid="+stid ,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
            alert(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        alert();
           console.log(textStatus, errorThrown);
        }
    });  
  
  }


</script> 






