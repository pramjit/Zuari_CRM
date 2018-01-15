<?php echo $header; ?><?php echo $column_left;  ?>
<div id="content">
  
  <div class="page-header">
    <div class="container-fluid">
        
       <div class="pull-right">
           
           <button type="submit" id="insertscheme"  name="submit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default" /><i class="fa fa-save"></i></button>
        
       <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>

      </div>
      <h1>Scheme Redemption</h1>
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
        <div class="panel-heading" >
<h3 class="panel-title"><i class="fa fa-exchange"></i> Scheme Redemption</h3>
      </div>
      <div class="panel-body">
          <form action="<?php echo $schemeredemptiondata;?>" method="post" id="form-scheme" class="form-horizontal" enctype="multipart/form-data" onsubmit="return ValidData();">
            <input type="hidden" name="sid" value="<?php echo $redemptiondata['sid'];?>">

         
            <div class="row">
                     <div class="col-sm-4"> 
            <div class="form-group required">
              <label class="col-sm-4 control-label" >Scheme Name</label>
              <div class="col-sm-8">
                  <input class="form-control" type="text" id="scheme_Name" onchange="clear_scheme_Name()"  name="scheme_Name"  placeholder="Enter scheme name" value="<?php echo $redemptiondata['Scheme_Name'];?>" readonly/>
              <p id="scheme_Name_p" style="display:none;color:red;">Required Scheme Name</p>
              </div>
            </div>
         
            <div class="form-group required date">
              <label class="col-sm-4 control-label">Date From</label>
              <div class="col-sm-8">
                  <input type="text" id="date_from" onchange="clear_date_from(this.value)"  name="date_from" class="form-control fa fa-calendar" placeholder="Enter From Date" value="<?php echo $redemptiondata['Start_Date'];?>" disabled />
               <p id="date_from_p" style="display:none;color:red;">Required From Date</p> 
                
              </div>
              
            </div>
              

                <div class="form-group required">
                <label class="col-sm-4 control-label">Product</label>
                <div class="col-sm-8">
                    <select required  name="product_id[]" onchange="clear_product(this.value);" id="product_id" class="form-control select2-selection select2-selection--multiple"  multiple="multiple">
                      <option  value="">Select Product</option>
                    <?php foreach($product as $options) { ?>
             <option value="<?php echo $options['SID'].'-'.$options['PRODUCT_NAME']; ?>"<?php //foreach($proqty as $value) { if($options['SID']==$value["PRODUCT_ID"]) { echo 'selected'; } } ?> ><?php echo $options['PRODUCT_NAME']; ?></option>
                    <?php } ?>
                     </select>
                    <input type="text" name="oldprocount" id="oldprocount" value="<?php echo count($proqty);?>">
                <p id="product_p" style="display:none;color:red;">Required Product</p>
                </div>
            </div> 
     
             
             
           </div>  
            
        <div class="col-sm-4">
         
           
            <div class="form-group required">
              <label class="col-sm-4 control-label">Gift</label>
              <div class="col-sm-8">
                  <input type="text" id="gft" onchange="clear_gft(this.value)"  name="gft" class="form-control" placeholder="Enter Gift" value="<?php echo $redemptiondata['Gift'];?>" readonly />
               <p id="gft_p" style="display:none;color:red;">Required Gift</p> 
                
              </div>
            </div> 
          
                <div class="form-group required date">
              <label class="col-sm-4 control-label">Date To</label>
              <div class="col-sm-8">
                  <input type="text" id="date_to" onchange="clear_date_to(this.value)"  name="date_to" class="form-control" value="<?php echo $redemptiondata['End_date'];?>" disabled />
               <p id="date_to_p" style="display:none;color:red;">Required To Date</p> 
                
              </div>
            </div> 
              <div class="form-group required">
              <label class="col-sm-4 control-label">Points</label>
              <div class="col-sm-8">
                  <input type="text" id="Points" onchange="clear_points(this.value)"  name="Points" class="form-control"  value="<?php echo $redemptiondata['points'];?>" readonly/>
               <p id="Points_p" style="display:none;color:red;">Required Points</p> 
                
              </div>
             
            </div>
        
           
       </div>
            </div>
                 <hr/>
                  <?php foreach($proqty as $result) { ?>
            <div class="row">
                 <div class="col-sm-4">
                     <div class="form-group">
                         <label class="col-sm-4 control-label">Product</label>
                           <div class="col-sm-8">
                               <input class=" form-control" type="text" name="product_id1" id="product_id1" value="<?php echo $result['product_name']; ?>" readonly/>
                           </div>
                         
                     </div>
            </div>   
           <div class="col-sm-4">
               <div class="form-group" style="margin-left:0;">
              <label class="col-sm-4 control-label" >Quantity</label>
              <div class="col-sm-8">
                  <input type="hidden" name="points_id[]" id="points_id" value="<?php echo $result['points_id']; ?>">
                   <input class=" form-control" type="text" id="quantity" onchange="clear_scheme_Name()"  name="scheme_Name"  value="<?php echo $result['quantity']; ?>"/>
              </div>
               </div>
            </div> 
            </div>
                  <?php } ?>
                  
            <div class="row">
                <div class="col-sm-4">
                      <div class="row">
          </div> 
   
            <div id="qqqtttyyypppppppp">
            </div>  
                </div>
                <div class="col-sm-4">
                     <div id="qqqtttyyy">
             </div>
                </div>
            </div>
            
        </form>
     
      </div>
      
    </div>
      
  </div>
    
</div>




<?php echo $footer; ?>
<script type="text/javascript" src="view/javascript/bootstrap/js/select2.js"></script>
<script type="text/javascript">
$('.date').datetimepicker({
    pickTime: false
});
</script>
<script name="text/javascript">
 function ValidData(){
   
    var pid = $('#product_id').val(); 
    if(!pid)
    {
        alert('Select Product');
        return false;
    }
     var quantity = $('#quantity').val();
     if(!quantity)
    {
        alert('Fill Quantity ');
        return false;
    }
        var c=pid.length;
        for (i = 0; i < c; i++) { 
            var fields = pid[i].split('-');
            var fldqty = 'qty'+fields[0];
            var curqty = $('#'+fldqty).val(); 
            if(!curqty)
            {
                alert('Fill Quantity');
                return false;
            }
        }
    
     return true;
 }
</script>
<script type="text/javascript">
    $("#product_id").select2({ tags: true,
      placeholder: function(){
        $(this).data('placeholder');
    }
  
});
 

 function clear_product(id){
     //alert(id);
     if (id == ''){
         $('#qqqtttyyy').html('');
         $('#qqqtttyyypppppppp').html('');  
     } else {
         alert('dgfdg');
         //$('#qqqtttyyy').hide();
          //  $('#qqqtttyyypppppppp').hide();  
     }
     var iiiddd=$('#product_id').val();
    // var oldprocount=$('#oldprocount').val();
   //  alert(iiiddd);
     var c=iiiddd.length;
     //c=c-oldprocount;
     alert(c);
     alert(iiiddd);
   
     var d='';
     var d1='';
    for (i = 0; i < c; i++) { 
         var fields = iiiddd[i].split('-');
   // alert(fields[1]);
    d+='<div class="form-group required" style="margin-left:0;">';
             d+='<label class="col-sm-4 control-label" >Quantity</label>';
              d+='<div class="col-sm-8">';
              d+='<input type="hidden" name="points_id[]" id="points_id" value="qty'+iiiddd[i]+'">';
              d+='<input type="text" id="qty'+fields[0]+'" onchange="clear_qty(this.value)"  name="qty'+fields[0]+'" class="form-control" placeholder="Enter Quantity" value="" />';
               d+='<p id="qty_p" style="display:none;color:red;">Required Quantity</p> ';
                
             d+='</div>';
            d+='</div> ';
            
            d1+='<div class="form-group required">';
             d1+='<label class="col-sm-4 control-label">Product</label>';
              d1+='<div class="col-sm-8">';
              
              d1+='<input type="text" id="qty'+iiiddd[i]+'" onchange="clear_qty(this.value)"  name="qty'+iiiddd[i]+'" class="form-control" placeholder="Enter Quantity" value="'+fields[1]+'" readonly/>';
               d1+='<p id="qty_p" style="display:none;color:red;">Required Quantity</p> ';
                
            d1+='</div>';
            d1+='</div> ';
          
             $('#qqqtttyyy').html(d);
            $('#qqqtttyyypppppppp').html(d1);
    }
  
    
      $('#product_p').hide();
 }
 function clear_qty(){
      $('#qty_p').hide();
 }

function backbtn(){
   url = 'index.php?route=scheme/viewscheme&token='+getURLVar('token');
    location = url;
}
</script>


<style>
    hr {
   width:100%;
    border: 1px solid #595959;
}
    </style>
    
