<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
     <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Search</h3>
      </div>
          <div class="panel-body">
  
        <div class="well">
           <div class="row">
            <div class="col-sm-3 form-group required">
              
              <div class=" input-group date">
              <input class="form-control" data-date-format="YYYY-MM-DD" value="<?php echo $lastfromdate; ?>" type="text" id="from_date" onchange="clear_Group_Name()" name="from_date"  placeholder="From Date"/>              
              <span class="input-group-btn">
               <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
              </div>
              
              <div class="col-sm-3 form-group required">
              <div class="input-group date">
              <input class="form-control" type="text" value="<?php echo $lasttodate; ?>" data-date-format="YYYY-MM-DD" id="to_date"  name="to_date"  placeholder="To Date"/>
              
               <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
              </div>
            </div>
<div class="col-sm-3 form-group required">
    
       <select  id='fmr_name' name='fmr_name' class="custom-select"> 
           <option value=''>Please Select</option>
                   <?php foreach ($scheme as $options) { ?>
                    <option value="<?php echo $options['id']; ?>"><?php echo $options['sname']; ?></option>
                   <?php } ?>
       </select>
       <!--<input type="text" id="search-box" class="form-control" placeholder="Scheme Name" />-->
      <div id="suggesstion-box"></div>
          </div>
             <!-- <div class="col-sm-3 form-group required">
              <div class="">
       <select name="schemefilter" id="schemefilter" class="form-control" >
                <option  value="">---Scheme Name---</option>
                <?php foreach($schemelist as $value) { ?>
       <option value="<?php echo $value['id']; ?> " <?php foreach($lastschemeid as $v) { if($v["id"]==$value['id']) { echo 'selected'; } } ?>><?php echo $value['sname'] ;?></option>
              
              <?php } 
              ?>
               
              </select>
   
            </div>
          </div> -->
               
               <div class="col-sm-2">
                   <div class="form-group"></div>   
                   <button  id="searchbtn_scheme"  class="btn btn-primary pull-right" style=" margin-right:70px; margin-top:-15px;" ><i class="fa fa-search"></i>  Search</button>
             </div>
            
     
          </div>
        </div>
    
      </div>
    </div>
   
  <div class="page-header">
    <div class="container-fluid">
    <div class="pull-right">
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
  <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download"><i class="fa fa-download"></i></button>

      </div>
      <h1>View Scheme</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
         <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($errr) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $errr; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success1) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success1; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   
    
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  
                  <td class="text-center-name">Scheme Name </td>
                  <td class="text-center-name">Start Date </td>
                  <td class="text-center-name">End Date </td>
                  <td class="text-center-name">Products </td>
                   <td class="text-center-name">Action </td>
                </tr>
              </thead>
              <?php if($retailerdata) { ?>
              <tbody>
               
               <?php 
                 foreach($retailerdata as $resultt) { ?>
                <tr>
                  <td class="text-center"><?php echo $resultt['Scheme_Name']; ?></td>
                  <td class="text-center"><?php echo  $resultt['START_DATE']; ?></td>
                  <td class="text-center"><?php echo $resultt['END_DATE']; ?></td>
                 <td class="text-center"><?php echo $resultt['product_name']; ?></td>
               <td class="text-center"><a onclick="schemeredemption(<?php echo $resultt['id'] ?>);" style="color:rgb(102, 32, 62);cursor: pointer;" >Redemption</a></td>
                </tr>
                <?php 
                
                } ?>
              </tbody>
              <?php } else { ?>
              <tbody>
              <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                 </tbody>
               <?php    } ?>
            </table>
          </div>
        
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
$('.date').datetimepicker({
    pickTime: false
});
//--></script>
<script type="text/javascript">
function schemeredemption(id){
    url = 'index.php?route=scheme/schemeredemption&schemeredemptionid='+id+'&token='+getURLVar('token');
    location = url;
}

function backbtn(){
    url = 'index.php?route=scheme/viewscheme&token='+getURLVar('token');
    location = url;
}

$('#searchbtn_scheme').click(function() {
    var searchscheme = $('#fmr_name').val();
   var searcfromdate = $('#from_date').val();
   var searctodate = $('#to_date').val();
  
    url='index.php?route=scheme/viewscheme&token='+getURLVar('token'),
    url += '&fromdate='+searcfromdate,
    url += '&todate='+searctodate,
    url += '&schemename='+searchscheme,
    location = url;
      
});
function download(){
   var searchscheme = $('#fmr_name').val();
   var searcfromdate = $('#from_date').val();
   var searctodate = $('#to_date').val();
   url = 'index.php?route=scheme/viewscheme/scheme_download&token='+getURLVar('token');
   url += '&fromdate='+searcfromdate,
   url += '&todate='+searctodate,
   url += '&schemename='+searchscheme,
    location = url; 
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
       
       $(document).ready(function(){
	$("#search-box").keyup(function(id){
           // alert(id);
            
		$.ajax({
		type: "POST",
		url:'index.php?route=scheme/viewscheme/search&token='+getURLVar('token'),
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(view/image/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
                   // alert(data);
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});
function selectscheme(val) {
  
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script> 


<style>
    .text-center-name
    {
        font-weight: bold;
        color: #1e91cf;
        text-align: center;
        
    }

    </style>
    <style>
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0; width: 240px;}


</style>