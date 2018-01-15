<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $dealer; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $customer; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $farmer; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $jeepcampaign; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $product; ?></div>
    </div>
  </div>
</div>
<?php echo $footer; ?>