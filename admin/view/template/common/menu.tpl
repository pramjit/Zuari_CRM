<ul id="menu">
   
  <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i> <span><?php echo $text_dashboard; ?></span></a></li>
  
  <li id="catalog">
      <a class="parent"><i class="fa fa-users fa-fw"></i> <span><?php echo $text_retailer; ?></span></a>
    <ul>
     <!--- <li><a href="<?php echo $bulkdealer; ?>"><?php echo $text_bulk_dealer ?></a></li>--->
      <li><a href="<?php echo $createretailer; ?>"><?php echo $text_create_retailer ?></a></li>
     <li><a href="<?php echo $searchdealer; ?>"><?php echo $text_search_dealer ?></a></li>
      <li><a href="<?php echo $retailerregistration; ?>"><?php echo $text_retailer_registration ?></a></li>
        <li><a href="<?php echo $searchretailer; ?>"><?php echo $text_search_retailer ?></a></li>
    </ul>
  </li>
  <li id="village">
      <a class="parent"><i class="fa fa-vimeo-square fa-fw"></i> <span><?php echo $text_village; ?></span></a>
      <ul>
      <li><a href="<?php echo $createVillage; ?>"><?php echo $text_create_village ?></a></li>
      <li><a href="<?php echo $searchvillage; ?>"><?php echo $text_search_village ?></a></li>
      </ul>
  </li>
  
  <li id="product">
      <a class="parent"><i  class="fa fa-gift fa-fw"></i> <span><?php echo $text_product; ?></span></a>
      <ul>
      <li><a href="<?php echo $addproduct; ?>"><?php echo $text_add_product ?></a></li>
 <li><a href="<?php echo $searchproduct; ?>"><?php echo $text_search_product ?></a></li>      </ul>
  </li>
  
 <!--- <li id="crop">
      <a class="parent"><i class="fa fa-crop fa-fw"></i> <span><?php echo $text_crop; ?></span></a>
      <ul>
      <li><a href="<?php echo $addcrop; ?>"><?php echo $text_add_crop ?></a></li>
      <li><a href="<?php echo $searchcrop; ?>"><?php echo $text_search_crop ?></a></li>
      </ul>
  </li>---->
  
  <li id="geo">
      <a class="parent"><i class="fa  fa-globe fa-fw"></i> <span><?php echo $text_geo; ?></span></a>
      <ul>
      <li><a href="<?php echo $addgeo; ?>"><?php echo $text_add_geo ?></a></li>
    <!---  <li><a href="<?php echo $searchgeo; ?>"><?php echo $text_search_geo ?></a></li>---->
      </ul>
  </li>
    <li id="user">
      <a class="parent"><i class="fa fa-user fa-user"></i> <span><?php echo $text_user; ?></span></a>
      <ul>
     <!--- <li><a href="<?php echo $createuser; ?>"><?php echo $text_create_user ?></a></li>
      <li><a href="<?php echo $addgroup; ?>"><?php echo $text_add_group ?></a></li>---->
      <li><a href="<?php echo $createcustomer; ?>"><?php echo $text_create_customer ?></a></li>
     <!--- <li><a href="<?php echo $addgroupcustomer; ?>"><?php echo $text_add_group_customer ?></a></li>---->
      </ul>
    </li>
     <li id="user">
      <a class="parent"><i class="fa fa-user fa-user"></i> <span><?php echo $text_farmer; ?></span></a>
      <ul>
     <li><a href="<?php echo $farmerregistration; ?>"><?php echo $text_farmer_registration ?></a></li>
     <li><a href="<?php echo $searchfarmer; ?>"><?php echo $text_search_farmer?></a></li>
      <li><a href="<?php echo $farmerregistrationExcel; ?>"><?php echo $text_farmer_registrationExcel; ?></a></li>
      </ul>
    </li>
    <li id="user">
      <a class="parent"><i class="fa fa-user fa-user"></i> <span><?php echo $text_delar; ?></span></a>
      <ul>
     <li><a href="<?php echo $delarregistration; ?>"><?php echo $text_delar_registration; ?></a></li>
     <li><a href="<?php echo $searchdealerreg; ?>"><?php echo $text_search_dealerreg; ?></a></li>
      <li><a href="<?php echo $subdealar; ?>"><?php echo $text_subdelar; ?></a></li>
      <li><a href="<?php echo $searchsubdealerreg; ?>"><?php echo $text_search_subdealerreg; ?></a></li>
      </ul>
    </li>
     <li id="catalog">
      <a class="parent"><i class="fa fa-users fa-fw"></i> <span><?php echo $text_pos; ?></span></a>
    <ul>

      <li><a href="<?php echo $posregistration; ?>"><?php echo $text_pos_registration; ?></a></li>
        <li><a href="<?php echo $searchpos; ?>"><?php echo $text_search_pos; ?></a></li>
    </ul>
  </li>
    
    <li id="user">
      <a class="parent"><i class="fa fa-user fa-user"></i> <span><?php echo $text_scheme; ?></span></a>
      <ul>
     <li><a href="<?php echo $scheme_master; ?>"><?php echo $text_scheme_master; ?></a></li>
     <li><a href="<?php echo $searchscheme; ?>"><?php echo $text_search_scheme; ?></a></li>
   
      </ul>
    </li>
    
    <li id="user">
      <a class="parent"><i class="fa fa-user fa-user"></i> <span><?php echo $text_report; ?></span></a>
      <ul>
      <li><a href="<?php echo $mdoReport; ?>"><?php echo $text_mdo_report ?></a></li>
     <li><a href="<?php echo $monthlyreport; ?>"><?php echo $text_monthly_report; ?></a></li>
     <li><a href="<?php echo $marketreport; ?>"><?php echo $text_market_report; ?></a></li>
    
    <li><a href="<?php echo $marketwiseposreport; ?>"><?php echo $text_market_wise_pos_report; ?></a></li>
     <li><a href="<?php echo $milkclocdailyreport; ?>"><?php echo $text_milk_collc_daily_report; ?></a></li>
       <li><a href="<?php echo $fgmdlreport; ?>"><?php echo $text_fgm_detail_report; ?></a></li>
       <li><a href="<?php echo $farmerdlreport; ?>"><?php echo $text_farmer_detail_report; ?></a></li>
       <li><a href="<?php echo $marketactivityrepo; ?>"><?php echo $text_market_activity_report; ?></a></li>
       <li><a href="<?php echo $fgm_farmer_detail_report; ?>"><?php echo $text_fgm_farmer_detail_report; ?></a></li>
      </ul>
    </li>
  
</ul>
