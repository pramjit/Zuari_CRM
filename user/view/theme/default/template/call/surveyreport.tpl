<?php echo $header; ?>
<?php echo $column_left; ?>
  

<div id="content">
 <div class="top-bar clearfix">
	<div class="page-title">
	    
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text'].'/'; ?></a>
        <?php } ?>
	</div>
	    <ul class="right-stats hidden-xs" id="mini-nav-right">
		<button type="button" onclick="backbtn('<?php echo $lastso;?>')"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default"><i class="fa fa-reply"></i></button>
               <!-- <button  id="downloadattendance" class="btn btn-default"><i class="fa fa-download"></i>  </button>--->
            </ul>
            
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
      
      
    </div>
    
    <div   class="panel panel-default">
        <div class="panel-body">
          
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              
              <tbody>
                  <input type="hidden" name="farmerid" value="<?php echo $lastfarmerid?>">
                  <input type="hidden" name="lastso" value="<?php echo $lastso; ?>">
                <?php if ($surveydata) { ?>
                <?php $i=1; foreach ($surveydata as $value) {  ?>
                <tr>
                   
                  <td class="text-left" style="font-weight:bold"><?php echo $value["SBL_QUEST_ID"].'.  '.$value['SBL_QUEST_DES'];  ?></td>
                </tr>
                 <tr>
                     <!---<td class="text-left"><?php echo '<b>Ans-</b>  '.is_array(json_decode($value['SBL_ANSWER_ID_VALUE']))?'<b>Ans-</b>  '.$value['SBL_ANSWER_ID_VALUE']:print_r(json_decode($value['SBL_ANSWER_ID_VALUE'])); ?></td>------->
                <td class="text-left">
                    <?php if(is_array(json_decode($value['SBL_ANSWER_ID_VALUE']))) {
                   $json_array = json_decode($value['SBL_ANSWER_ID_VALUE'], true);
                    //echo "<br /><br /><br /><br />";
                  //print_r($json_array);
                   echo "<table border='3'><thead><th>Ingredient</th><th>Kg</th></thead><th></th><tbody>";
                        foreach($json_array as $key=>$val){
                            
                            if(!empty($val['Text'])) {
                    echo "<tr><td>".$val['Text']."</td><td>".$val['Num']."</td></tr>";
                            } else {
                                
                     echo "<tr><td>".$val['name']."</td><td>".$val['Num']."</td></tr>";            
                            }
                        }
                        echo "</tbody></table>";
                    } else {  echo '<b>Ans-</b>  '.$value['SBL_ANSWER_ID_VALUE']; }  ?>
                </td>
                </tr>
                <?php $i++; } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        
       <!-- <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>  ---->
        </div>
       </div>
  </div>
</div> 

<?php echo $footer; ?>
<script type="text/javascript"><!--
$(function () {
$('.input-date').datepicker({ format: 'yyyy-mm-dd',autoclose: true});

})
//--></script>
<script type="text/javascript">
    
 $('#searchbtn').on('click', function() {

   
    url = 'index.php?route=techreport/customerfarmer';
    
   
    var filter_so = $('#cus_so').val();
     var filter_farmer = $('#cus_farmer').val();
    
    alert(filter_so);
   
    if (filter_so) {
        url += '&filter_so=' + encodeURIComponent(filter_so);
        
    }  
    if(filter_farmer) {
        
        url += '&filter_farmer=' + encodeURIComponent(filter_farmer);
    }
   
   
   
                
    location = url;
});

// download
$('#downloadattendance').on('click', function() {

   
   url = 'index.php?route=report/farmerdlrept/marketpos_download';
    var filter_fdate_id = $('input[name=\'from_date\']').val();
    var filter_tdate_id = $('input[name=\'to_date\']').val();
    var filter_market_pos = $('#market_pos').val();
   
   
     
    if (filter_fdate_id && filter_tdate_id) {
        url += '&filter_from_date=' + encodeURIComponent(filter_fdate_id);
        url += '&filter_to_date=' + encodeURIComponent(filter_tdate_id);
    }  
    if(filter_market_pos) {
        
        url += '&filter_market_pos=' + encodeURIComponent(filter_market_pos);
    }
    
   location = url;             
    
});
//end download

//pdf upload
function uploadpdffile(sid){
    //alert(sid);
    var vefile = document.getElementById('vefile'+sid).files.length;
   
    if(vefile=='0'){
        alert("Please Choose Pdf File");
        return false;
    } 
    if(vefile=='1'){
     document.getElementById("form-uploadpdf"+sid).submit();
    }
}

 function uploadFile(sid){
     
document.getElementById("vefile"+sid).click();
}
//end pdf upload
function showfarmersurvey(id){
   var res = id.split("_"); 
      url = 'index.php?route=techreport/surveyreport';
        url += '&farmerid=' + res[0];
        url += '&lastso=' + res[1];
        url += '&lastfarmerid=' + res[2];
    
    
   location = url;     
}
function backbtn(lastso){
   // alert(lastso);
    url = 'index.php?route=dfc/dfcreports';
    url += '&so=' + lastso;
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
        url: 'index.php?route=report/farmerdlrept/getmdo',
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
