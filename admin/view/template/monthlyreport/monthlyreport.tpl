<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
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
          
            
            
              
              <div class="col-sm-3 form-group required">
              <div class="">
               <select name="type" onchange="getmdo(this.value)" id="type" class="form-control">
                  <option value="">Select Type</option>
                 
                   <option value="Farmer"<?php if($type=='Farmer') { echo 'selected'; } ?> >Farmer</option>
                   <option value="POS" <?php if($type=='POS') { echo 'selected'; } ?> >POS</option>
                   <option value="MCC" <?php if($type=='MCC') { echo 'selected'; } ?> >MCC</option>
                   <option value="FGM" <?php if($type=='FGM') { echo 'selected'; } ?> >FGM</option>
                  
              </select> 
              </div>
             </div>     
               
               
             <div class="col-sm-3 form-group required">  
              <div class="">
               <select name="month" id="month" class="form-control">
                  <option value="">Select Month</option>
                  
                   <option value="01"<?php if($month=='01') { echo 'selected'; } ?> >January</option>
                   <option value="02"<?php if($month=='02') { echo 'selected'; } ?> >February</option>
                   <option value="03"<?php if($month=='03') { echo 'selected'; } ?> >March</option>
                   <option value="04"<?php if($month=='04') { echo 'selected'; } ?> >April</option>
                   <option value="05"<?php if($month=='05') { echo 'selected'; } ?> >May</option>
                   <option value="06"<?php if($month=='06') { echo 'selected'; } ?> >june</option>
                   <option value="07"<?php if($month=='07') { echo 'selected'; } ?> >July</option>
                   <option value="08"<?php if($month=='08') { echo 'selected'; } ?> >August</option>
                   <option value="09"<?php if($month=='09') { echo 'selected'; } ?> >September</option>
                   <option value="10"<?php if($month=='10') { echo 'selected'; } ?> >October</option>
                   <option value="11"<?php if($month=='11') { echo 'selected'; } ?> >November</option>
                   <option value="12"<?php if($month=='12') { echo 'selected'; } ?> >December</option>
                   
                   
                   
                  
                 
              </select> 
              <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name</p>
              </div>
              </div>
               <div class="form-group required">
                   <div class="col-sm-2">
                     <button  id="searchbtn" class="btn btn-primary pull-right"><i class="fa fa-search"></i>  Search</button>
                   </div>
              <div class="col-sm-2">
                   <button  id="downloadattendance" class="btn btn-default pull-right"><i class="fa fa-download"></i>  Dowland</button>
               </div>
                   
                    
          </div>
              
          </div>
            
           
        </div>
    
      </div>
    </div>
     <?php if ($geo) { ?>
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                 
                  <td class="text-left">
                    <a href="#" class="">Market</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">MDO</a>
                  </td>
                  
                  <td class="text-left">
                    <a href="#" class="">Activity</a>
                   </td>
                  
                  
                   <td class="text-left">
                    <a href="#" class="">01</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">02</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">03</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">04</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">05</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">06</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">07</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">08</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">09</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">10</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">11</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">12</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">13</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">14</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">15</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">16</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">17</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">18</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">19</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">20</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">21</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">22</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">23</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">24</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">25</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">26</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">27</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">28</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">29</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">30</a>
                  </td>
                  <td class="text-left">
                    <a href="#" class="">31</a>
                  </td>
                  
                 
                  
                 
                 
                  
                </tr>
              </thead>
              <tbody>
                <?php if ($geo) { ?>
                <?php foreach ($geo as $geos) { ?>
                <tr>
                    
                  <td class="text-left"><?php echo $geos['Market_Name']; ?></td>
                  <td class="text-right"><?php echo $geos['Mdo']; ?></td>
                  <td class="text-left"><?php echo $geos['Activity']; ?></td>
                  <td class="text-left"><?php echo $geos['01']; ?></td>
                  <td class="text-left"><?php echo $geos['02']; ?></td>
                  <td class="text-right"><?php echo $geos['03']; ?></td>
                  <td class="text-right"><?php echo $geos['04']; ?></td>
                  <td class="text-right"><?php echo $geos['05']; ?></td>
                  <td class="text-right"><?php echo $geos['06']; ?></td>
                  <td class="text-right"><?php echo $geos['07']; ?></td>
                  <td class="text-right"><?php echo $geos['08']; ?></td>
                  <td class="text-right"><?php echo $geos['09']; ?></td>
                  <td class="text-right"><?php echo $geos['10']; ?></td>
                  <td class="text-right"><?php echo $geos['11']; ?></td>
                  <td class="text-right"><?php echo $geos['12']; ?></td>
                  <td class="text-right"><?php echo $geos['13']; ?></td>
                  <td class="text-right"><?php echo $geos['14']; ?></td>
                  <td class="text-right"><?php echo $geos['15']; ?></td>
                  <td class="text-right"><?php echo $geos['16']; ?></td>
                  <td class="text-right"><?php echo $geos['17']; ?></td>
                  <td class="text-right"><?php echo $geos['18']; ?></td>
                  <td class="text-right"><?php echo $geos['19']; ?></td>
                  <td class="text-right"><?php echo $geos['20']; ?></td>
                  <td class="text-right"><?php echo $geos['21']; ?></td>
                  <td class="text-right"><?php echo $geos['22']; ?></td>
                  <td class="text-right"><?php echo $geos['23']; ?></td>
                  <td class="text-right"><?php echo $geos['24']; ?></td>
                  <td class="text-right"><?php echo $geos['25']; ?></td>
                  <td class="text-right"><?php echo $geos['26']; ?></td>
                  <td class="text-right"><?php echo $geos['27']; ?></td>
                  <td class="text-right"><?php echo $geos['28']; ?></td>
                  <td class="text-right"><?php echo $geos['29']; ?></td>
                  <td class="text-right"><?php echo $geos['30']; ?></td>
                  <td class="text-right"><?php echo $geos['31']; ?></td>
                  
                  
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
        
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>  
        </div>
       </div>
     <?php } ?>
  </div>
</div> 

<?php echo $footer; ?>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});
//--></script>
<script type="text/javascript">
    
 $('#searchbtn').on('click', function() {

   
    url = 'index.php?route=Report/monthlyreport&token='+getURLVar('token');
    
    var type = $('#type').val();
    var month = $('#month').val();
    alert(type);
    alert(month);
    if (type) {
        url += '&filter_type=' + encodeURIComponent(type);
       
    }  
    if(month) {
        
        url += '&filter_month=' + encodeURIComponent(month);
    }
           
    location = url;
});

// download
$('#downloadattendance').on('click', function() {

   
   url = 'index.php?route=Report/monthlyreport/monthlyreport_download&token='+getURLVar('token');
   
     var type = $('#type').val();
    var month = $('#month').val();
    
    if (type) {
        url += '&filter_type=' + encodeURIComponent(type);
        
    }  
    if(month) {
        
       url += '&filter_month=' + encodeURIComponent(month);
    }
    
   location = url;             
    
});
//end download

function backbtn(){
    url = 'index.php?route=Report/monthlyreport&token='+getURLVar('token');
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
       
       function getmdo(state_id){
          
        $.ajax({ 
        type: 'post',
        url: 'index.php?route=Report/attendancereport/getmdo&token='+getURLVar('token'),
        data: 'state='+state_id,
        // dataType: 'json',
        cache: false,

        success: function(data) {

        //alert(data);
        $("#mdo").html(data);
        
        }


   });
           
   }
</script> 