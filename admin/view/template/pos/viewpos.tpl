<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
     <!----------------------------------New-Searching------------------------------->
      <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i>Search</h3>
      </div>
          <div class="panel-body">
        <div class="well">
           <div class="row">
           
               <div class="col-sm-3" style=" margin-left: 300px;height:20px;">
              <div class="form-group" >
                  
                <label class="control-label" for="input-status">Search Mobile Number</label>
  <input id="search_id" name="search_id" maxlength="10" onchange="clear_mobile_number()" onkeypress="validate(event)" class="form-control" type="text" placeholder="Search Mobile Number" value="<?php echo $data['mob']; ?>"/>

     <p id="search_id_p" style="display:none;color:red;">Required Mobile Number</p> 
               <p id="search_id_q" style="display:none;color:red;">Please Enter 10 digit Mobile Number</p>
               <p id="search_id_r" style="display:none;color:red;">Valid Mobile Number</p>
              </div>
             
             </div>
               
               <div class="col-sm-2">
                   <div class="form-group"></div>   
                   <button  id="searchbtn_retailer" onclick="" class="btn btn-primary pull-right" style=" margin-right:70px; margin-top:8px;" ><i class="fa fa-search"></i>  Search</button>
             </div>
            
     
          </div>
        </div>
    
      </div>
    </div>
      <!----------------------------------New-Searching-End------------------------------>
    
  <div class="page-header">
      
    <div class="container-fluid">
        

      <div class="pull-right">
        
          <button type="button" onclick="backbtn()"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
  <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download"><i class="fa fa-download"></i></button>

      </div>
      <h1>View POS</h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($errr1) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i><?php echo $errr1; ?>  
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success1) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success1; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
   
    
    <div  class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-left">
                    <a >Pos Name</a>
                  </td>
                    <td class="text-left">
                    <a >Pos Mobile No.</a>
                  </td>
                   
                  <td class="text-left">
                    <a >District</a>
                    </td>
                     <td class="text-left">
                    <a >Market</a>
                  </td>
                  
                  <td class="text-left">
                    <a >Monthly Income</a>
                  </td>
                  
                  <td class="text-left">
                    <a >Action</a>
                  </td>
                 
                </tr>
              </thead>
              <?php if($retailerdata) { ?>
              <tbody>
               
               <?php 
                 foreach($retailerdata as $resultt){   ?>
                <tr>
                  <td class="text-left"><?php echo $resultt['POS_NAME']; ?></td>
                  <td class="text-left"><?php echo $resultt['POS_MOBILE']; ?></td>
                  <td class="text-left"><?php echo  $resultt['DIST_ID']; ?></td>
                  <td class="text-left"><?php echo $resultt['POS_MARKET'];?></td>
                 <td class="text-left"><?php echo $resultt['MONTHLY_SALES']; ?></td>
                  <td class="text-left"><a onclick="updateretailerreg(<?php echo $resultt['SID'] ?>,<?php echo $resultt['dis'] ?>);" style="color:rgb(102, 32, 62);cursor: pointer;" >Edit</a></td>
                  
                </tr>
               <?php }  ?>
            
              </tbody>
              <?php } else { ?>
              <tbody>
              <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                 </tbody>
               <?php } ?>
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

<script type="text/javascript">
    
function updateretailerreg(SID,dis){
   
    url = 'index.php?route=pos/posregistration&customeridupdate='+SID+'&dis='+dis+'&token='+getURLVar('token');
    location = url;
}
function backbtn(){
    url = 'index.php?route=pos/viewpos&token='+getURLVar('token');
    location = url;
}
function download(){
      var searchmob = $('#search_id').val();
     url = 'index.php?route=pos/viewpos/customer_download&token='+getURLVar('token');
     url += '&mob='+searchmob;
    location = url; 
}
$('#searchbtn_retailer').click(function() {
    var searchmob = $('#search_id').val();
    if($('#search_id').val().length===0){
        $('#search_id_p').show();
        return false;
        }
        else if(searchmob.length!==10){
   $('#search_id_q').show(); 
   return false;
} 
 else if(searchmob==0000000000){
   $('#search_id_r').show(); 
   return false;
}
 //alert(searchmob);
     url='index.php?route=pos/viewpos&token='+getURLVar('token'),
     url += '&retailermobile='+searchmob;
      location = url;
      
});
function clear_mobile_number(){
     $('#search_id_p').hide();
     $('#search_id_q').hide();
      $('#search_id_r').hide();
  
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
   function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script> 