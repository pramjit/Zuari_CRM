
 <?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
           <?php if(isset($updatedata['SID'])) { ?>
 <button  id="updateretailer"  name="update" data-toggle="tooltip" title="update" class="btn btn-default" /><i class="fa fa-save"></i></button>
      <?php } else { ?>
        <button id="button_save" form="form-backup" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
         <?php  }  ?>
        
        
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
        <h3 class="panel-title"><i class="fa fa-exchange"></i>Create POS</h3>
      </div>
      <div class="panel-body">
     
        <form action="<?php if(isset($updatedata['SID'])) { echo $updateretailer; } else { echo $createcustomer; } ?>" method="post" id="form-createcustomer" class="form-horizontal">
         <input type="hidden" value="<?php echo $updatedata['SID']; ?>" name="SID"> 
           <div class="col-sm-4"> 
               
            <div class="form-group required">
              <label class="col-sm-4 control-label" >POS Name</label>
              <div class="col-sm-8">
              <input class="form-control" type="text" id="pos_name" onchange="clear_pos_name()"  name="pos_name"  placeholder="Enter Pos Name" value="<?php echo $updatedata["POS_NAME"];?>"/>
              <p id="pos_name_p" style="display:none;color:red;">Required Pos Name</p>
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Pos Mobile</label>
              <div class="col-sm-8">
                   <?php if(isset($updatedata['SID'])) { ?>
              <input type="text" id="pos_mobile" onchange="clear_pos_mobile()" maxlength="10" onkeypress="return IsNumeric(event);" name="pos_mobile" class="form-control" value="<?php echo $updatedata["POS_MOBILE"];?>" readonly/>
                 <?php } else { ?>
             <input type="text" id="pos_mobile" onchange="clear_pos_mobile()" maxlength="10" onkeypress="return IsNumeric(event);" name="pos_mobile" class="form-control" placeholder="Enter Mobile Number" />
                    <?php    }  ?>
               <p id="pos_mobile_p" style="display:none;color:red;">Required Pos Mobile Number</p> 
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-sm-4 control-label">Monthly Income</label>
              <div class="col-sm-8">
              <input type="text" id="income" onchange="clear_income()" onkeypress="return IsNumeric(event);" name="income" class="form-control" placeholder="Enter Monthly Income" value="<?php echo $updatedata["MONTHLY_SALES"];?>"/>
               <p id="income_p" style="display:none;color:red;">Required Monthly Income</p> 
              </div>
            </div>
             
          
           </div>  
           <div class="col-sm-4">
            <div class="form-group required">
              <label class="col-sm-4 control-label">District</label>
              <div class="col-sm-8">
               <select  id="district_id" onchange="clear_district(this.value)" name="district_id" class="form-control">
                 <option  value="">Select District</option>
                <?php foreach ($dpdistrict as $options) { ?>
                <option value="<?php echo $options['id']; ?>" <?php if($options['id']==$updatedata["DIST_ID"]) { echo 'selected'; } ?> ><?php echo $options['name']; ?></option>
                <?php } ?>
               </select>
                  <p id="district_id_p" style="display:none;color:red;">Required  District</p>
              </div>
            </div> 
             <div class="form-group required">
              <label class="col-sm-4 control-label">Market</label>
              
              <div class="col-sm-8">
                <select name="market_id" onchange="clear_market(this.value)" id="market_id" class="form-control" >
                <option  value="">Select Market</option>
                 <?php foreach ($dphq as $options) { ?>
                <option value="<?php echo $options['SID']; ?>" <?php if($options['SID']==$updatedata["POS_MARKET"]) { echo 'selected'; } ?> ><?php echo $options['GEO_NAME']; ?></option>
                <?php } ?>
              </select>
                  <p id="market_p" style="display:none;color:red;">Required Market</p>
              </div>
            </div>
        
           </div>
        </form>
     
      </div>
    </div>
      
  </div>
    
</div>
<script type="text/javascript" src="view/javascript/bootstrap/js/select2.js"></script>
<?php echo $footer; ?>

<script type="text/javascript">
    
 $('#button_save').on('click', function() {

if ($('#pos_name').val().length ===0) {
     $('#pos_name_p').show();
     return false;
 }

else if($('#pos_mobile').val().length===0){
        $('#pos_mobile_p').show();
        return false;
        }
    
 else if($('#district_id').val().length===0){
        $('#district_id_p').show();
        return false;
        }
 
 else {

try{

var selects = document.getElementsByTagName('select');
var sel;
var relevantSelects = [];
var selc=selects.length;


for(var z=0; z<selects.length; z++){
   
if((z=='8' && res[0]==60) || (z=='9' && res[0]==60) || (z=='8' && res[0]==49) || (z=='9' && res[0]==49) || (z=='8' && res[0]==48) ){
sel = selects[z];
var name = sel.getAttribute("name");
if(name.indexOf("group[]")!=-1)
{

var y = sel.options[sel.selectedIndex].value;

if( y=="")
{
$('#Group_s').text('Please '+sel.options[sel.selectedIndex].text.toLowerCase());
$('#Group_s').show(); 
return false; 
}
}
}
}


}catch(e){alert(e);}


// if(document.getElementById("button_save").click){

document.getElementById("form-createcustomer").submit();
//} 
}
 
 
    
});
 $('#updateretailer').on('click', function() {
if ($('#pos_name').val().length ===0) {
     $('#pos_name_p').show();
     return false;
 }
 else if($('#district_id').val().length===0){
        $('#district_id_p').show();
        return false;
        }
  else if($('#income').val().length===0){
        $('#income_p').show();
        return false;
        }
 
 else {

try{

var selects = document.getElementsByTagName('select');
var sel;
var relevantSelects = [];
var selc=selects.length;


for(var z=0; z<selects.length; z++){
   
if((z=='8' && res[0]==60) || (z=='9' && res[0]==60) || (z=='8' && res[0]==49) || (z=='9' && res[0]==49) || (z=='8' && res[0]==48) ){
sel = selects[z];
var name = sel.getAttribute("name");
if(name.indexOf("group[]")!=-1)
{

var y = sel.options[sel.selectedIndex].value;

if( y=="")
{
$('#Group_s').text('Please '+sel.options[sel.selectedIndex].text.toLowerCase());
$('#Group_s').show(); 
return false; 
}
}
}
}


}catch(e){alert(e);}


// if(document.getElementById("button_save").click){

document.getElementById("form-createcustomer").submit();
//} 
}
 
 
    
});


function clear_pos_name()
{
    $('#pos_name_p').hide();
}
function clear_pos_mobile()
{
    $('#pos_mobile_p').hide();
}

function clear_district(data)
{
     $('#district_id_p').hide();
      var district=data;
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=pos/posregistration/getdistrict_hq&token='+getURLVar('token'),
        data: 'district='+district,
        cache: false,
        success: function(data) {
        $("#market_id").html(data);
        
        }


   });
     
     
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
  var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57 || keyCode == 46) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById("number").style.display = ret ? "none" : "inline";
            return ret;
        }
        

</script>
