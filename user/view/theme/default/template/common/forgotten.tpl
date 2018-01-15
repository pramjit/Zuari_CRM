<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="user/view/img/favicon.ico">
		
		<!-- Bootstrap CSS -->
		<link href="user/view/css/bootstrap.min.css" rel="stylesheet" media="screen">

		<!-- Animate CSS -->
		<link href="user/view/css/animate.css" rel="stylesheet" media="screen">

		<!-- date range -->
		<link rel="stylesheet" type="text/css" href="user/view/css/daterange.css">

		<!-- Main CSS -->
		<link href="user/view/css/main.css" rel="stylesheet" media="screen">
		
		
	</head>
	<body>

<div id="content">
  <div class="container-fluid"><br />
    <br />
    <div class="row">
      <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-repeat"></i> <?php echo $heading_title; ?></h1>
          </div>
          <div class="panel-body">
            <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php } ?>
            <form <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group">
                <label for="input-email">Registered Mail Id</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                  <input type="text" name="email"  placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                </div>
              </div>
              <div class="text-right">
                  <button type="submit" class="btn btn-primary" value="<?php echo $button_continue; ?>">Continue</button>
                <a href="<?php echo $back; ?>" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_back; ?>" class="btn btn-default">Back</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>