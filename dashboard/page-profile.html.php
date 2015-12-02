<!DOCTYPE html>
<html lang="en">

	<head>
	
		<!-- Basic -->
    	<meta charset="UTF-8" />
    	<?php session_start();?>
		<title>Clemson Jail</title>
		
		<!-- Mobile Metas -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
		<!-- Import google fonts -->
        <link href="http://fonts.useso.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css" />
        
		<!-- Favicon and touch icons -->
		<link rel="shortcut icon" href="assets/ico/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/ico/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="assets/ico/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="assets/ico/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="assets/ico/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="assets/ico/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="assets/ico/apple-touch-icon-152x152.png" />
		
	    <!-- start: CSS file-->
		
		<!-- Vendor CSS-->
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/vendor/skycons/css/skycons.css" rel="stylesheet" />
		<link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		
		<!-- Plugins CSS-->
		<link href="assets/plugins/bootkit/css/bootkit.css" rel="stylesheet" />
		<link href="assets/plugins/fullcalendar/css/fullcalendar.css" rel="stylesheet" />
		<link href="assets/plugins/magnific-popup/css/magnific-popup.css" rel="stylesheet" />
		<link href="assets/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css" rel="stylesheet" />					
		
		<!-- Theme CSS -->
		<link href="assets/css/jquery.mmenu.css" rel="stylesheet" />
		
		<!-- Page CSS -->		
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/add-ons.min.css" rel="stylesheet" />
		
		<!-- end: CSS file-->	
	    
		
		<!-- Head Libs -->
		<script src="assets/plugins/modernizr/js/modernizr.js"></script>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->		
		
	</head>
	
	<body>
	
		<!-- Start: Header -->
		<div class="navbar" role="navigation">
			<div class="container-fluid container-nav">
				<!-- Navbar Action -->
				<ul class="nav navbar-nav navbar-actions navbar-left">
					<li class="visible-md visible-lg"><a href="page-profile.html.php#" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
					<li class="visible-xs visible-sm"><a href="page-profile.html.php#" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>			
				</ul>
				<!-- Navbar Left -->
				<div class="navbar-left">
					<!-- Search Form -->					
					<form class="search navbar-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>						
					</form>
				</div>
				<!-- Navbar Right -->
				<div class="navbar-right">
				</div>
				<!-- End Navbar Right -->
			</div>		
		</div>
		<!-- End: Header -->
		
		<!-- Start: Content -->
		<div class="container-fluid content">	
			<div class="row">
			
				<!-- Sidebar -->
				<div class="sidebar">
					<div class="sidebar-collapse">
						<!-- Sidebar Header Logo-->
						<div class="sidebar-header">
							<img src="assets/img/logo.png" class="img-responsive" alt="" />
						</div>
						<!-- Sidebar Menu-->
						<div class="sidebar-menu">						
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-sidebar">
									<?php include "./icon/index.php"; ?>
									<div class="divider2"></div>
									<li >
										<a href="index.php">
											<i class="fa fa-laptop" aria-hidden="true"></i><span>Dashboard</span>
										</a>
									</li>
									<li class="active">
										<a href="page-profile.html.php">
											<i class="fa fa-tasks" aria-hidden="true"></i><span>Profile</span>
										</a>
									</li>
									<?php if($_SESSION["position"] != 'warden') echo "<li ><a href='page-summary.html.php'><i class='glyphicon glyphicon-pencil' aria-hidden='true'></i><span>Summary</span></a></li>"; ?>
									<?php if($_SESSION["position"] != 'warden') echo "<li ><a href='page-evaluation.html.php'><i class='glyphicon glyphicon-eye-open' aria-hidden='true'></i><span>Evaluation</span></a></li>"; ?>
									<li >
										<a href="../logout.php">
											<i class="glyphicon glyphicon-off" aria-hidden="true"></i><span>Log Out</span>
										</a>
									</li>
									
								</ul>
							</nav>
						</div>
						<!-- End Sidebar Menu-->
					</div>
					<!-- Sidebar Footer-->
					<div class="sidebar-footer">	
						<ul class="sidebar-terms">
							<li><a href="index.php#">Terms</a></li>
							<li><a href="index.php#">Privacy</a></li>
							<li><a href="index.php#">Help</a></li>
							<li><a href="index.php#">About</a></li>
						</ul>
						<div class="copyright text-center">
							<small> <i class="fa fa-coffee"></i> Collect from <a href="http://www.clemson.edu/" title="clemson" target="_blank">Clemson University</a></small>
						</div>					
					</div>
					<!-- End Sidebar Footer-->
				</div>
				<!-- End Sidebar -->			
		
				<!-- Main Page -->
				<div class="main ">
					<!-- Page Header -->
					<div class="page-header">
						<div class="pull-left">
							<ol class="breadcrumb visible-sm visible-md visible-lg">								
								<li><a href="index.php"><i class="icon fa fa-home"></i>Home</a></li>
								<li class="active"><i class="fa fa-tasks"></i>Profile</li>
							</ol>						
						</div>
						<div class="pull-right">
							<h2>Profile</h2>
						</div>					
					</div>
					<!-- End Page Header -->
					<div class="row profile">
						<div class="col-lg-5 col-md-5 col-sm-5">
							<div class="panel">
							<?php include "./profileeditpanel/info.php";?>
							</div>							
						</div>
						
						<div class="col-lg-7 col-md-7 col-sm-7">
							

							<?php include "./profileeditpanel/edit_info.php"; ?>

						</div>
					</div>	
				</div>
				<!-- End Main Page -->		
		
				<!-- Usage -->
				<!-- End Usage -->
			
			</div>
		</div><!--/container-->
		
		
		<!-- Modal Dialog -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title bk-fg-primary">Modal title</h4>
					</div>
					<div class="modal-body">
						<p class="bk-fg-danger">Here settings can be configured...</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div><!-- End Modal Dialog -->		
		
		<div class="clearfix"></div>		
		
		
		<!-- start: JavaScript-->
		
		<!-- Vendor JS-->				
		<script src="assets/vendor/js/jquery.min.js"></script>
		<script src="assets/vendor/js/jquery-2.1.1.min.js"></script>
		<script src="assets/vendor/js/jquery-migrate-1.2.1.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendor/skycons/js/skycons.js"></script>	
		
		<!-- Plugins JS-->
		<script src="assets/plugins/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>
		<script src="assets/plugins/moment/js/moment.min.js"></script>	
		<script src="assets/plugins/fullcalendar/js/fullcalendar.min.js"></script>			
		<script src="assets/plugins/magnific-popup/js/magnific-popup.js"></script>
		<script src="assets/plugins/sparkline/js/jquery.sparkline.min.js"></script>
		
		<!-- Theme JS -->		
		<script src="assets/js/jquery.mmenu.min.js"></script>
		<script src="assets/js/core.min.js"></script>
		
		<!-- Pages JS -->
		<script src="assets/js/pages/profile.js"></script>
		
		<!-- end: JavaScript-->
		
	</body>
	
</html>
