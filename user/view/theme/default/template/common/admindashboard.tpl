<?php echo $header; ?>
<?php echo $column_left; ?>
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
.bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body 
{
    background-color: #00C0EF !important;
}
.info-box-icon {
    border-radius: 2px 0px 0px 2px;
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    background: rgba(0, 0, 0, 0.2) none repeat scroll 0% 0%;
}
.info-box-content {
    padding: 5px 10px;
    margin-left: 90px;
}
.info-box-text {
    text-transform: uppercase;
}
.progress-description, .info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.info-box-number {
    display: block;
    font-weight: bold;
    font-size: 18px;
}
.info-box .progress, .info-box .progress .progress-bar {
    border-radius: 0px;
}
.info-box .progress {
    background: rgba(0, 0, 0, 0.2) none repeat scroll 0% 0%;
    margin: 5px -10px;
    height: 2px;
}
.progress, .progress > .progress-bar, .progress .progress-bar, .progress > .progress-bar .progress-bar {
    border-radius: 1px;
}
.progress, .progress > .progress-bar {
    box-shadow: none;
}
.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #F5F5F5;
    border-radius: 4px;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1) inset;
}
.progress-description {
    margin: 0px;
}
.progress-description, .info-box-text {
    display: block;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.bg-aqua, .bg-blue, .bg-light-blue, .bg-green, .bg-navy, .bg-teal, .bg-olive, .bg-lime, .bg-orange, .bg-fuchsia, .bg-purple, .bg-maroon, .bg-black, .bg-red-active, .bg-yellow-active, .bg-aqua-active, .bg-blue-active, .bg-light-blue-active, .bg-green-active, .bg-navy-active, .bg-teal-active, .bg-olive-active, .bg-lime-active, .bg-orange-active, .bg-fuchsia-active, .bg-purple-active, .bg-maroon-active, .bg-black-active, .callout.callout-danger, .callout.callout-warning, .callout.callout-info, .callout.callout-success, .alert-success, .alert-danger, .alert-error, .alert-warning, .alert-info, .label-danger, .label-info, .label-warning, .label-primary, .label-success, .modal-primary .modal-body, .modal-primary .modal-header, .modal-primary .modal-footer, .modal-warning .modal-body, .modal-warning .modal-header, .modal-warning .modal-footer, .modal-info .modal-body, .modal-info .modal-header, .modal-info .modal-footer, .modal-success .modal-body, .modal-success .modal-header, .modal-success .modal-footer, .modal-danger .modal-body, .modal-danger .modal-header, .modal-danger .modal-footer {
    color: #FFF !important;
}
.bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
    background-color: #00A65A !important;color: #ffffff;
}
.bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #F39C12 !important; color: #ffffff;
}
.bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
        background-color: #777777 !important;    color: #ffffff;
}
</style>
<!-- Main Container Start -->
    <!-- Top Bar Starts -->
 <div id="content">
    <div class="top-bar clearfix">
         <!--   <div class="page-title">
	<h4><div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>Dashboard</h4>
	</div>
        <ul class="right-stats hidden-xs" id="mini-nav-right">
    <button type="button" onclick="backbtn();"   data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">
        <i class="fa fa-reply">
        </i>
      </button>
    <button type="button" onclick="download()"   data-toggle="tooltip" title="Download" class="btn btn-download">
        <i class="fa fa-download">
        </i>
      </button>
    </ul>
       
    </div>-->
     
<!-- Top Bar Ends -->

				

 </div>		
    <br><br>                  
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
 <!--Start Body -->
        <div class="row">
        <!-- ==========================================TOTAL CALL ========================================== -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Missed Call </span>
                <span class="info-box-number">
                    <?php  echo $Allmissedcall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Incoming Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        <!-- ==========================================TOTAL ADVISORY CALL ========================================== -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Advisory Call</span>
                <span class="info-box-number"> <?php echo $AdvisoryCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Direct Call
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
         <!-- ==========================================TOTAL COMPLAINT CALL ========================================== -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Farmer Call</span>
                <span class="info-box-number"><?php echo $ComplainCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Direct Call
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
           <!-- ==========================================TOTAL ANSWERED CALL ========================================== -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Answered Call</span>
                <span class="info-box-number"><?php  echo $AnsweredCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                Total Calls
                </span>
              </div>
              
              <!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        </div>
        <br />
         <!-- ========================================== STAGE -2  ========================================== -->
        <div class="row">
    
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Advisory Call </span>
                <span class="info-box-number">
                    <?php  echo $AltAdvisoryCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Redirect Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Dunning Call</span>
                <span class="info-box-number"> <?php echo $DunningCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">App Service</span>
                <span class="info-box-number"><?php echo $AppCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
       
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Retailer Call</span>
                <span class="info-box-number"><?php echo $RetCall; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                Total Calls
                </span>
              </div>
              
              <!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        </div>
        <br />
        <!-- ========================================== STAGE -3  ========================================== -->
        <div class="row">
    
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Advisory Answered </span>
                <span class="info-box-number">
                    <?php  echo $AltAdvisoryCallAns; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Dunning Answered</span>
                <span class="info-box-number"> <?php echo $DunningCallAns; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">App Service Answered</span>
                <span class="info-box-number"><?php echo $AppCallAns; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
       
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Retailer Answered</span>
                <span class="info-box-number"><?php echo $RetCallAns; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                Total Calls
                </span>
              </div>
              
              <!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        </div>
        <br />
        <div class="row">
    
     
       
         
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Missed Call In &nbsp;<?php echo date('F Y'); ?></span>
                <span class="info-box-number"><?php echo $CurMissed; ?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-phone-square"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Call Answered In &nbsp;<?php echo date('F Y'); ?></span>
                <span class="info-box-number"><?php echo $CurAnswered;?></span>
                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
               Total Calls
                </span>
              </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
          </div><!-- /.col -->
        
        </div>
        <br>
        
        <br>

 <!--new Model-->
 
 
</div>
<?php echo $footer;  ?>
     <link rel="stylesheet" href="user/view/javascript/bootstrap/css/bootstrap.min.css">
<script src="user/view/javascript/bootstrap/js/select2.js"></script>
<link href="user/view/javascript/bootstrap/css/select2.css" rel="stylesheet" type="text/css"/>

<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>



<script>
 

  function backbtn()
  {
    url = 'index.php?route=common/dashboard';
    location = url;
  }
  
  
</script> 
