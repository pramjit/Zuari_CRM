

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title><?php echo $heading_title;?></title>
		<meta name="description" content="<?php echo $heading_title;?>" />
		<meta name="keywords" content="Admin, Dashboard,Milk,Cow" />
		<meta name="author" content="Akshamaala" />
		<link rel="shortcut icon" href="img/favicon.ico">
		
		<!-- Bootstrap CSS -->
		<link href="user/view/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <link href="user/view/css/jquery-customselect.css" rel="stylesheet" media="screen">
		<!-- Animate CSS -->
		<link href="user/view/css/animate.css" rel="stylesheet" media="screen">

		<!-- date range -->
		<link rel="stylesheet" type="text/css" href="user/view/css/daterange.css">

		<!-- Main CSS -->
		<link href="user/view/css/main.css" rel="stylesheet" media="screen">

		<!-- Slidebar CSS -->
		<link rel="stylesheet" type="text/css" href="user/view/css/slidebars.css">

		<!-- Font Awesome -->
		<link href="user/view/fonts/font-awesome.min.css" rel="stylesheet">

		<!-- Metrize Fonts -->
		<link href="user/view/fonts/metrize.css" rel="stylesheet">

		<!-- HTML5 shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->

	</head>  

	<body>
<aside id="sidebar">

			<!-- Logo starts -->
			<a href="#" class="logo">
				<img src="user/view/img/logo.png" alt="<?php echo $name; ?>">
                                
			</a>
			<!-- Logo ends -->

			<!-- Menu start -->
			<div id='menu'>
				<ul>
					<li class='highlight'>
						<a href='<?php echo $home; ?>'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe007;"></div>
							<span><?php echo $text_dashboard;?></span>
						</a>
					</li>
                                        <?php if($roleid=='62') { ?>
                                        <li class=''>
						<a href='<?php echo $techreport; ?>'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span>Farmer Survey</span>
						</a>
						<!--<ul>
                                                    
                                                     <li><a href="<?php echo $techreport; ?>">Report</a></li>
						</ul>--->
					</li>
                                        <?php } else if($roleid=='70') {  ?>
                                        
                                       
                                       
                                         <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_retailer; ?></span>
						</a>
						<ul>
                                                    
                                                     <li><a href="<?php echo $retailerregistration; ?>"><?php echo $text_farmer_registration; ?></a></li>
                                                      <li><a href="<?php echo $viewretailer; ?>"><?php echo $text_view_retailer; ?></a></li>

						</ul>
					</li>
                                         <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_farmer; ?></span>
						</a>
						<ul>
                                                    
                                                     <li><a href="<?php echo $farmerregistration; ?>"><?php echo $text_farmer_registration; ?></a></li>
						</ul>
					</li>
                                         <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_delar; ?></span>
						</a>
						<ul>
                                                    
                                                     <li><a href="<?php echo $delarregistration; ?>"><?php echo $text_delar_registration; ?></a></li>
                                                     <li><a href="<?php echo $subdealar; ?>"><?php echo $text_subdelar; ?></a></li>
						</ul>
					</li>
                                        
                                        <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_report; ?></span>
						</a>
						<ul>
                                                    
                                                     <li><a href="<?php echo $cargill_admin_report; ?>">Report</a></li>
						</ul>
					</li>
                                        <li class='has-sub'>
            <a href='#'>
              <div class="fs1" aria-hidden="true" data-icon="&#xe052;">
              </div>
              <span>
                <?php echo $user_text_report; ?>
              </span>
            </a>
            <ul>
              <li>
                <a href="<?php echo $user_dealer; ?>">
                  <?php echo $user_text_dealer; ?>
                </a>
              </li>
              <li>
                <a href="<?php echo $user_subdealer; ?>">
                  <?php echo $user_text_subdealer; ?>
                </a>
              </li>
              <li>
                <a href="<?php echo $user_retailer; ?>">
                  <?php echo $user_text_retail; ?>
                </a>
              </li>
            </ul>
          </li>
                                        
                                        <?php } else if($roleid=='64') { ?>
                                             <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span>Dealer</span>
						</a>
						<ul>
                                                    
                                                     <li><a href="#">Report</a></li>
						</ul>
					    </li>
                                        <?php } else if($roleid=='68') { ?>
                                             <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span>Subdealer</span>
						</a>
						<ul>
                                                    
                                                     <li><a href="#">Report</a></li>
						</ul>
					</li>
                                            
                                       <?php } else if($roleid=='65') { ?>
                                         <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span>Retailer</span>
						</a>
						<ul>
                                                    
                                                     <li><a href="#">Report</a></li>
						</ul>
					</li>
                                       <?php } else if($roleid=='67') { ?>
                                        <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span>Farmer</span>
						</a>
						<ul>
                                                    
                                                     <li><a href="#">Report</a></li>
						</ul>
					</li>
                                       <?php } else if($roleid=='55') { ?>
                                        
                                         <?php } else if($roleid=='71') { ?>
                                        <li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_report; ?></span>
						</a>
						<ul>
                                                    <li><a href="<?php echo $asmreport; ?>"><?php echo $text_asmreport ?></a></li>
                                                </ul>    
					</li> 
         <li class='has-sub'>
            <a href='#'>
              <div class="fs1" aria-hidden="true" data-icon="&#xe052;">
              </div>
              <span>
                <?php echo $text_dfc; ?>
              </span>
            </a>
            <ul>
              <li>
                <a href="<?php echo $dfcreport; ?>">
                  <?php echo $text_dfc_report; ?>
                </a>
              </li>
               <li>
                <a href="<?php echo $dfcorder; ?>">
                  <?php echo $text_dfc_order; ?>
                </a>
              </li>
              <li>
                <a href="<?php echo $visit; ?>">
                  <?php echo $text_visit; ?>
                </a>
              </li>
            </ul>    
          </li>   
                                       <?php } else if($roleid=='72') { ?>
                                           
                                           
          <li class='has-sub'>
            <a href='#'>
              <div class="fs1" aria-hidden="true" data-icon="&#xe052;">
              </div>
              <span>
                Stock 
              </span>
            </a>
            <ul>
              <li>
                <a href="<?php echo $stockupdate; ?>">
                  Stock update
                </a>
              </li>
             
            </ul>    
          </li>
           <li>
            <a href='<?php echo $loginreport; ?>'>
              <div class="fs1" aria-hidden="true" data-icon="&#xe052;">
              </div>
              <span>
                <?php echo $text_login_report; ?>
              </span>
            </a>
          </li>
                                           
                                           <?php } else { ?>
					<li class='has-sub'>
						<a href='#'>
							<div class="fs1" aria-hidden="true" data-icon="&#xe052;"></div>
							<span><?php echo $text_report; ?></span>
						</a>
						<ul>
                                                    <li><a href="<?php echo $mdoReport; ?>"><?php echo $text_mdo_report ?></a></li>
					            <li><a href="<?php echo $monthlyreport; ?>"><?php echo $text_monthly_report; ?></a></li>
                                                    <li><a href="<?php echo $marketreport; ?>"><?php echo $text_market_report; ?></a></li>		
						    <li><a href="<?php echo $marketwiseposreport; ?>"><?php echo $text_market_wise_pos_report; ?></a></li>	
                                                    <li><a href="<?php echo $milkclocdailyreport; ?>"><?php echo $text_milk_collc_daily_report; ?></a></li>
                                                    <li><a href="<?php echo $fgmdlreport; ?>"><?php echo $text_fgm_detail_report; ?></a></li>
                                                    <li><a href="<?php echo $farmerdlreport; ?>"><?php echo $text_farmer_detail_report; ?></a></li>
                                                     <li><a href="<?php echo $marketactivityrepo; ?>"><?php echo $text_market_activity_report; ?></a></li>
						</ul>
					</li>
					
                                        <?php } ?>
					
					
					
					
					
				</ul>
			</div>
			<!-- Menu End -->

			

		</aside>
            
		