<?php echo $header; ?>
<?php echo $column_left; ?>
<!-- Main Container Start -->
<!-- Top Bar Starts -->
<div class="top-bar clearfix">
  <div class="page-title">
    <h4>
      <div class="fs1" aria-hidden="true" data-icon="&#xe007;">
      </div>Dashboard
    </h4>
  </div>
  <ul class="right-stats hidden-xs" id="mini-nav-right">
    <li class="reportrange btn btn-success">
      <i class="fa fa-calendar">
      </i>
      <span>
      </span> 
      <b class="caret">
      </b>
    </li>
    <!--<li>
<a href="#" class="btn btn-info sb-open-right  sb-close">
<div class="fs1" aria-hidden="true" data-icon="&#xe06a;"></div>
</a>
</li>-->
  </ul>
</div>
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
        <div class="col-sm-3 form-group required" >
          <div class="">
            <select name="year"  id="year" class="form-control">
              <option value="">Select Year
              </option>
              <option value="2017">2017
              </option>
            </select> 
          </div>
        </div>  
        <div class="col-sm-3 form-group required" >  
          <div class="">
            <select name="month" id="month" class="form-control">
              <option value="">Select Month
              </option>
              <option value="1">January
              </option>
              <option value="2">February
              </option>
              <option value="3">March
              </option>
              <option value="4">April
              </option>
              <option value="5">May
              </option>
              <option value="6">June
              </option>
              <option value="7">July
              </option>
              <option value="8">August
              </option>
              <option value="9">September
              </option>
              <option value="10">October
              </option>
              <option value="11">November
              </option>
              <option value="12">December
              </option>
            </select> 
            <p id="Group_Name_p" style="display:none;color:red;">Required customer group Name
            </p>
          </div>
        </div>
        <div class="col-sm-2">
          <button  id="searchbtn_order" class="btn btn-primary pull-right">
            <i class="fa fa-search">
            </i> Search
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-center" style="font-weight: bold">DFC Name
            </td>
            <td class="text-center" style="font-weight: bold">Total No. of Farmers
            </td>
            <td class="text-center" style="font-weight: bold">Order Volume
            </td>
            <td class="text-center" style="font-weight: bold">No. of Visits
            </td>
            <td class="text-center" style="font-weight: bold">No. of Surveys
            </td>
          </tr>
        </thead>
        <tbody>
          <?php if ($geo) { ?>
          <?php foreach ($geo as $geos) { ?>
          <tr>
            <td class="text-left">
              <?php echo $geos['Market_Name']; ?>
            </td>
            <td class="text-left">
              <?php echo $geos['Mdo']; ?>
            </td>                  
            <td class="text-right">
              <?php echo $geos['Pos_added']; ?>
            </td>
            <td class="text-right">
              <?php echo $geos['Milk_Collection_Added']; ?>
            </td>
            <td class="text-right">
              <?php echo $geos['Farmer_added']; ?>
            </td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="text-center" colspan="8">
              <?php echo $text_no_results; ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
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
    <div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Traffic Sources
												</h5>

												<div class="widget-toolbar no-border">
													<div class="inline dropdown-hover">
														<button class="btn btn-minier btn-primary">
															This Week
															<i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
														</button>

														<ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
															<li class="active">
																<a href="#" class="blue">
																	<i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
																	This Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Week
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	This Month
																</a>
															</li>

															<li>
																<a href="#">
																	<i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
																	Last Month
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><canvas class="flot-overlay" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><div class="legend"><div style="position: absolute; width: 93px; height: 110px; top: 15px; right: -30px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div></div></td><td class="legendLabel">social networks</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden"></div></div></td><td class="legendLabel">search engines</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden"></div></div></td><td class="legendLabel">ad campaigns</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden"></div></div></td><td class="legendLabel">direct traffic</td></tr><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden"></div></div></td><td class="legendLabel">other</td></tr></tbody></table></div></div>

													<div class="hr hr8 hr-double"></div>

													<div class="clearfix">
														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
																&nbsp; likes
															</span>
															<h4 class="bigger pull-right">1,255</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
																&nbsp; tweets
															</span>
															<h4 class="bigger pull-right">941</h4>
														</div>

														<div class="grid3">
															<span class="grey">
																<i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
																&nbsp; pins
															</span>
															<h4 class="bigger pull-right">1,050</h4>
														</div>
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div>
</div>

<?php echo $footer; ?>
