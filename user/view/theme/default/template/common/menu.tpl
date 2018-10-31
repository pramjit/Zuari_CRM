<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title><?php echo $heading_title;?></title>
		<meta name="description" content="<?php echo $heading_title;?>" />
		<meta name="keywords" content="" />
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
                               
                                <span><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;HOME</span>
                                </a>
                            </li>
                            <?php
                            //USER ADMIN
                            if($roleid=="1"){ ?>
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADMIN REPORT</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $missedcall; ?>'>
                                    <span>MISSED CALL</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $whatscall; ?>'>
                                    <span>WHATSAPP CALL</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $advisory; ?>'>
                                    <span>ADVISORY REPORT</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $complain; ?>'>
                                    <span>COMPLAIN REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>  
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CALL CENTER</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $farmercalldata; ?>'>
                                    <span>MISSED CALL</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $reviewdata; ?>'>
                                    <span>REVIEW CALL </span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $feedbackdata; ?>'>
                                    <span>FEEDBACK CALL </span>
                                </a>
                                </li>

                                <li>
                                <a href='<?php echo $advisorydata; ?>'>
                                    <span>ADVISORY CALL </span>
                                </a>
                                </li>

                                </ul>
                            </li> 
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;RESOLUTION</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $RA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $RA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li> 
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;APPROVAL</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADVISORY</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AD_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AD_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>
							<li>
                                <a href='<?php echo $CALL_REPORT; ?>'>
                                    <span><span><i class="fa fa-fire" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CALL REPORT</span>
                                </a>
                                </li>
                            <?php }?>
                            <?php 
                            //USER MDO
                            if($roleid=="2"){ ?>
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADMIN REPORT</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $missedcall; ?>'>
                                    <span>MISSED CALL</span>
                                </a>
                                </li>
                                </ul>
                            </li>  
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CALL CENTER</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $farmercalldata; ?>'>
                                    <span>MISSED CALL</span>
                                </a>
                                </li>
                                </ul>
                            </li> 
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;RESOLUTION</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $RA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $RA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li> 
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;APPROVAL</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADVISORY</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AD_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AD_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>
                            <?php }?>
                            <?php 
                            //USER APPROVAL AUTHORITY
                            if($roleid=="3"){ ?>
                           
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;APPROVAL</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li>
                            
                            <?php }?>
                            <?php 
                            //USER RESOLUTION AUTHORITY
                            if($roleid=="4"){ ?>
                           
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;RESOLUTION</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $RA_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $RA_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $RA_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                </ul>
                            </li> 
                            <?php }?>
                            <?php 
                            // USER CALL CENTER
                            if($roleid=="5"){ ?>
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CALL CENTER</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $farmercalldata; ?>'>
                                    <span>MISSED CALL </span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $reviewdata; ?>'>
                                    <span>REVIEW CALL </span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $feedbackdata; ?>'>
                                    <span>FEEDBACK CALL </span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $advisorydata; ?>'>
                                    <span>ADVISORY CALL </span>
                                </a>
                                </li>
				<li>
                                <a href='<?php echo $otherscall; ?>'>
                                    <span>OTHERS CALL </span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $appserdata; ?>'>
                                    <span>APP SERVICE DATA </span>
                                </a>
                                </li>
                                </ul>
                            </li> 
                            <?php }?>
                            <?php 
                            // USER ADVISORY AUTHORITY
                            //echo $roleid;
                            if($roleid=="6"){ ?>
                            
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADVISORY</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $AD_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $AD_PENDING_CASES; ?>'>
                                    <span>PENDING ADVISORY</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_MY_CASES; ?>'>
                                    <span>PENDING APPROVAL</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $AD_COMPLAINT; ?>'>
                                    <span>COMPLAIN ADVISORY</span>
                                </a>
                                </li>
                               <!-- <li>
                                <a href='<?php echo $AD_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AD_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>-->
                                </ul>
                            </li>
                            <?php }?>
							 <?php 
                           //START CRM ADMIN
                            if($roleid=="7"){ ?>
                            
                            <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADV. REPORT-I</span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
                                <!-- <li>
                                <a href='<?php echo $AD_DASHBOARD; ?>'>
                                    <span>DASHBOARD</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                               <li>
                                <a href='<?php echo $AD_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $AD_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $AD_HEAD; ?>'>
                                    <span>HEAD WISE</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $advisory; ?>'>
                                    <span>ADVISORY REPORT</span>
                                </a>
                                </li>
								 <li>
                                <a href='<?php echo $AD_FARMER; ?>'>
                                    <span>ADVISORY COMPLAINT REPORT</span>
                                </a>
                                </li>
								
                                </ul>
                                </li>
								<li>
                                <a href='<?php echo $CALL_REPORT; ?>'>
                                    <span><span><i class="fa fa-fire" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CALL REPORT</span>
                                </a>
                                </li>
                               <li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-fire" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;COMPLAINT</span>
                                </a>
                                <ul>
                                <li>
                                <a href='<?php echo $COM_DETAILS; ?>'>
                                    <span>COMPLAIN DETAILS</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $complain; ?>'>
                                    <span>COMPLAIN REPORT</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $COM_FARMER; ?>'>
                                    <span>FARMER COMPLAINT REPORT</span>
                                </a>
                                </li>
                                <!--<li>
                                <a href='<?php echo $COM_MY_CASES; ?>'>
                                    <span>MY CASES</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $COM_ALL_CASES; ?>'>
                                    <span>ALL CASES</span>
                                </a>
                                </li>
                               
                                <li>
                                <a href='<?php echo $COM_REPORT; ?>'>
                                    <span>REPORT</span>
                                </a>
                                </li>-->
                                </ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;STATE VS TYPE OF CALL</span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE_DETAILS; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;STATE VS STATUS OF FARMER </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY_3; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_TOTAL_DETAIL_3; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;ADVISORY CALL STATUS </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY_4; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE_DETAILS_4; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;PENDING AT ADVISORY </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY_6; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE_DETAILS_6; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;OPEN VS CLOSE SPLIT </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY_7; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE_DETAILS_7; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;CATEGORYWISE ADVISORY SPLIT </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_TOTAL_SUMMARY_5; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
								<li>
                                <a href='<?php echo $ADV_STATE_DETAILS_5; ?>'>
                                    <span>DETAILS</span>
                                </a>
                                </li>
								</ul>
                            </li>
							<li class="has-sub">
                                <a href="">
                                
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;COMPLAINT STATUS REPORT </span>
                                </a>
                                <ul>
								<li>
                                <a href='<?php echo $ADV_STATE_SUMMARY_8; ?>'>
                                    <span>SUMMARY</span>
                                </a>
                                </li>
				<li>
                                <a href='<?php echo $ADV_STATE_DETAIL_8; ?>'>
                                    <span>OPEN COMPLAINT STATUS</span>
                                </a>
                                </li>
                                <li>
                                <a href='<?php echo $ADV_STATE_HISTORY_8; ?>'>
                                    <span>COMPLAINT HISTORY</span>
                                </a>
                                </li>
				</ul>
                            </li>
							
                            <?php }?>
                            </ul>
			</div>
			<!-- Menu End -->
	</aside>
            
		