<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Zuari - CRM</title>

    <!-- Bootstrap core CSS -->
    <link href="user/view/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="user/view/vendor/bootstrap/css/full-slider.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    /* Temporary fix for img-fluid sizing within the carousel */
    
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }
    </style>
    <style type="text/css">
a { 
	text-decoration:none; 
	color:#ffffff;
}

h1 {
	font: 4em normal Arial, Helvetica, sans-serif;
	padding: 20px;	margin-top: 100px;
	text-align:center;
}

h1 small{
	font: 0.2em normal  Arial, Helvetica, sans-serif;
	text-transform:uppercase; letter-spacing: 0.2em; line-height: 5em;
	display: block;
}

.content {width: 960px; margin: 0 auto; overflow: hidden;}

#top-stuff {
	left:0;
	position:fixed;
	top:0;
	width:100%;
	z-index:12;
}

#top-bar-out {
	display:block;
	position:relative;
	width:100%;
	height:40px;
	background: -moz-linear-gradient(center top, #333333, #111111);
	background: -webkit-gradient(linear, left top, left bottom, from(#333333), to(#111111));
	background:  -o-linear-gradient(top, #333333, #111111);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#333333', EndColorStr='#111111');
	box-shadow:0 1px 2px #666666;
	-webkit-box-shadow: 0 1px 2px #666666;
}

.active-links {
	position:absolute;
	right:8px;
	top:0;
}
#container {
    width:780px;
    margin:0 auto;
    position: relative;
}

#topnav {
    text-align:right;
}

#session {
	cursor: pointer;
    display: inline-block;
    height: 38px;
    padding: 7px 20px;
    vertical-align: top;
    white-space: nowrap;
    background: #0275d8;
    box-shadow: 1px 1px 10px #111111;
    border-radius: 20px
}

#session.active, #session:hover {
	background:rgba(255,255,255,0.1);
	color:fff;
	height:40px;
}


a#signin-link {
	color:#bababa;
	position:relative;
}

a#signin-link em {
	font-size:10px;
	font-style:normal;
	margin-right:4px;
}

a#signin-link strong {
	color:#fff;
}

#signin-dropdown {
    background-color: rgba(2, 90, 165, 0.81);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    box-shadow: 0 1px 2px #666666;
    -webkit-box-shadow: 0 1px 2px #666666;
    min-height: 200px;
    min-width: 250px;
    position: absolute;
    right: 0;
    display: none;
    top: 46px;
    color: #ffffff;
}

#signin-dropdown form{
	cursor:pointer;
	padding:10px;
	text-align:left;
}

#signin-dropdown .textbox span { color:#BABABA;}
#signin-dropdown .textbox input { width:200px; }

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
}

form.signin .remb { 
	padding:9px 0; 
	position:relative; 
	text-align:right;
}

form.signin .remb .remember { 
	text-align:left; 
	position:absolute; 
	left:0;
}

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:4px 7px;
	margin:0;
	font:12px; 
}

.button:hover { background:#ddd; }

</style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="#">ZUARI CRM</a>
			<div class="text-right" style="width:200%; color:#f00f00;"><?php echo $error_warning; ?> </div>
			<div class="text-right" style="width:300%; color:#00F025;"><?php echo $success; ?> </div>
            <div class="collapse navbar-collapse" id="navbarExample">
                <div class="active-links">
            <div id="session">
            <a id="signin-link" href="#">
            	<strong>SIGN IN</strong>
            </a>
            </div>
            	<div id="signin-dropdown">
        	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="wrapper">
			<div id="box" class="animated bounceIn">
				<div id="top_header">
					<!--<a href="#">
						<img class="logo" src="user/view/img/logo.png" alt="logo">
					</a>-->
                                        <p><?php echo $text_login; ?></p>
				</div>
				<div id="inputs">
					<div class="form-control">
                                            <input type="text" class="form-control" name="email" placeholder="Mobile No / Email Id" required="required">
						<i class="fa fa-envelope-o"></i>
					</div>
					<div class="form-control">
						<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off"  required="required">
                                                <input type="hidden" name="login_type" value="2">
						<i class="fa fa-key"></i>
					</div>
                                        <div class="form-control">
					<input type="submit" class="btn-block form-control" value="SUBMIT" style="background: #025aa5;    color: #ffffff;    padding: 5px 10px;    box-shadow: 1px 1px 5px #292b2c;    border-radius: 5px;    font-weight: bold;">
                                        </div>
				</div>
				<div id="bottom">
					
					<a class="right_a" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
				</div>
			</div>
		</form>
         		</div>
        		</div>
            </div>
        </div>
    </nav>

    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <!--    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('user/view/css/image.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>CRM</h3>
                        <p>Customer Relationship Management</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below
                <div class="carousel-item" style="background-image: url('user/view/css/image2.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>VOC</h3>
                        <p>Voice of Customer</p>
                    </div>
                </div> -->
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <!-- Footer -->
    <footer class="py-5 bg-inverse">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Zuari 2017</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="user/view/vendor/jquery/jquery.min.js"></script>
    <script src="user/view/vendor/tether/tether.min.js"></script>
    <script src="user/view/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
$(document).ready(function () {
$('.active-links').click(function () {
        if ($('#signin-dropdown').is(":visible")) {
            $('#signin-dropdown').hide()
			$('#session').removeClass('active');
        } else {
            $('#signin-dropdown').show()
			$('#session').addClass('active');
        }
		return false;
    });
	$('#signin-dropdown').click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#signin-dropdown').hide();
		$('#session').removeClass('active');
    });
});     
</script>

</body>

</html>