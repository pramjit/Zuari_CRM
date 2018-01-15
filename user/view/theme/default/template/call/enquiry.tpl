
<?php echo $header;?>
<?php echo $column_left;  //print_r($pagination); ?>
<style type="text/css">
    .btn-default {
    background-color: #d4eaf7;
    border-color: #d4eaf7;
    color: #53acdf;
    padding: 10px 10px;
    text-align: center;
}
.col-md-4 , .col-md-8 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    padding-top: 10px;
}
</style>
    
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
    <!--  <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>-->
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
<div   class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="table-responsive">
                   <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mobile</th>
                <th>State</th>
                <th>Date</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Mobile</th>
                <th>State</th>
                <th>Date</th>
                
            </tr>
        </tfoot>
        <tbody>
            <?php
            //print_r($misscallData);
            foreach($misscallData as $result)
            {
            ?>
            <tr>
                <td style="background: #12a4f4;color: #ffffff;font-weight: bold;text-align: center;" onclick="OpenForm(<?php echo $result['MOBILE']; ?>);"><?php echo $result['MOBILE']; ?></td>
                <td><?php echo $result['STATE']; ?></td>
                <td><?php echo $result['DATE_RECEIVED']; ?></td>
               
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</div>
        <div class="col-sm-8">
            <div class="table-responsive" id="formdata">
                <div class="form-group">
                <label class="col-md-2 btn-default" for="selectbasic">STATUS</label>
                <div class="col-md-3">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="0">Select</option>
                    </select>
                </div>
                <label class="col-md-2 btn-default" for="selectbasic">USER</label>
                <div class="col-md-3">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                        <option value="0">Select</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" value="SUBMIT">
                </div>
                </div>
                
                <div class="clearfix"><br/><hr/><br/></div>
                
                <div id="exTab1">	
                    <ul  class="nav nav-pills">
                    <li class="active">
                        <a  href="#1a" data-toggle="tab" >Profile of Mobile Number :&nbsp;&nbsp;<span id="profile"></span></a>
                    </li>
                    <li>
                        <a href="#2a" data-toggle="tab">Complaint Details</a>
                    </li>
                    </ul>
                    <div class="tab-content clearfix" style="padding: 0px!important;">
                        <div class="tab-pane active" id="1a">
                        <fieldset>
                        <!-- Text input-->
                            <div class="form-group">
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Father Name" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="selmob" name="textinput" type="text" placeholder="Mobile" class="form-control input-md" readonly="readonly">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Select State</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Select District</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Address" class="form-control input-md">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Pincode" class="form-control input-md">
                            </div>
                             <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Alt. Contact Number" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Select Crop-I</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>
                             <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Select Crop-II</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Total Acreage" class="form-control input-md">
                            </div>
                           <!-- <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Crop-II" class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>-->
                            </div>
                        </fieldset>
                        </div>
                        <div class="tab-pane" id="2a">
                        <fieldset>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Product Category</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                             <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Product Name</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Complaint Category</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                            </div>
                        <!-- Text input-->
                            <div class="form-group">
                           
                            <div class="col-md-4">
                                <select id="selectbasic" name="selectbasic" class="form-control">
                                    <option value="1">Complaint Sub Category</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                           <div class="col-md-8">
                                <textarea class="form-control" id="textarea" name="textarea">Complaints Detail</textarea>
                            </div>
                           <!--  <div class="col-md-4">
                                <input id="textinput" name="textinput" type="text" placeholder="Acreage" class="form-control input-md">
                            </div>-->
                            </div>
                        </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>  
    </div>
</div>
</div>
</div> 
<?php echo $footer; ?>
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $("#formdata").hide();
    $('#example').dataTable({
"bPaginate": true,
"bLengthChange": false,
"bFilter": true,
"bInfo": false,
"bAutoWidth": true,
"dom": '<"top"f>rt<"bottom"p><"clear">',
"oLanguage": {"sSearch": "Search&nbsp;&nbsp;"}});
} );
</script>
<script type="text/javascript">
    $('#searchbtn_order').click(function() {
   
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    
   if($('#from_date').val().length===0){
        $('#from_date_p').show();
        return false;
        }
        if($('#to_date').val().length===0){
        $('#to_date_p').show();
        return false;
        }
     url='index.php?route=report/missedcall',
     
     
     url += '&from_date='+from_date,
     url += '&to_date='+to_date ,
     
      location = url;
      
});
function clear_date(){
     $('#date_p').hide();
}

  function download(){
    
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
     
    url = 'index.php?route=report/missedcall/misscall_download',
   
    url += '&from_date='+from_date,
    url += '&to_date='+to_date ,
   
   location = url;
  }
  function backbtn(){
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  
  
  function OpenForm(mob){

   $("#profile").html(mob);
   $("#selmob").val(mob);
   $("#formdata").show();
  }
</script> 






