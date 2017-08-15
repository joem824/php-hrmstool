<?php 
	session_start();
?>

<!DOCTYPE html>

<html>
<head runat="server">
	<title>
		<?php
			if (isset($_GET["page"])) {
				$page = $_GET["page"];
				echo ucwords($page);
			}
		?>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Icon -->
	<link rel="shortcut icon" type="file-content-type" href="images/HT Icon.ico" />
	<!-- Bootstrap 3.3.6 -->
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link href="dist/css/AdminLTE.css" rel="stylesheet" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" />

	<!-- jQuery 2.2.3 -->
	<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="plugins/jQueryUI/jquery-ui.js"></script>
	<script src="plugins/moment/moment.js"></script>

	<link href="plugins/bootstrap-table/bootstrap-table.css" rel="stylesheet" />
	<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
	<link href="plugins/select2/select2.min.css" rel="stylesheet" >
	<link href="plugins/iCheck/all.css" rel="stylesheet" >
	<link href="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" >

	<style type="text/css">
		<?php
			if (isset($_GET["page"])) {
				$page = $_GET["page"];
				include("css/" .$page. ".css");
			}
		?>
	</style>

</head>

<body class="hold-transition skin-black sidebar-mini sidebar-collapse">
	<div class="wrapper">
		
		<header class="main-header black-bg">
			<!-- Logo -->
			<a href="" class="logo">
				<span class="logo-mini">HT</span>
				<span class="logo-lg">HRMS Tool</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top black-bg">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			    </a>
			    <div class="navbar-custom-menu">
        			<ul class="nav navbar-nav">
			          	<li>
			            	<a class="label" id="lblUser">
			            		<i class="fa fa-user-circle" style="font-size: 1.5em;"></i>&nbsp;
              					<span class="hidden-xs"></span>
			            	</a>
			          	</li>
        				<li><a id="btnSignOut" type="button" class="btn btn-link"><i class="fa fa-sign-out"></i></a></li>
        			</ul>
      			</div>
			</nav>
		</header>

		<aside class="main-sidebar black">
			<section class="sidebar black">
				<ul class="sidebar-menu">
					<li class="treeview">
						<a href="#">
							<i class="fa fa-address-book"></i>
							<span>Users</span>
							<span class="pull-right-container">
				            	<i class="fa fa-angle-left pull-right"></i>
				            </span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="index.php?page=users"><i class="fa fa-user"></i><span>Users List</span></a>
							</li>
							<!-- <li>
								<a href="index.php?page=roster"><i class="fa fa-user-plus"></i><span>Add Users</span></a>
							</li> -->
							<li>
								<a href="index.php?page=roster"><i class="fa fa-users"></i><span>Roster Update</span></a>
							</li>
						</ul>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-clock-o"></i>
							<span>Logs</span>
							<span class="pull-right-container">
				            	<i class="fa fa-angle-left pull-right"></i>
				            </span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="index.php?page=logs"><i class="fa fa-search"></i><span>Search Logs</span></a>
							</li>
							<li>
								<a href="index.php?page=disputes"><i class="fa fa-check-circle-o"></i><span>Disputes</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>

		<div class="content-wrapper">
			<?php
				if (isset($_GET["page"])) {
					$page = $_GET["page"];
					include("pages/" .$page. ".php");
				}
			?>
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0.0   
			</div>
			<strong>Copyright &copy; 2017 <a href="#">Dev Team</a>.</strong> All rights reserved.
		</footer>

		<div class="control-sidebar-bg"></div>
	</div>

	<div id="loader" style="display: none; position: absolute; top: 1px; width: 100%; min-height: 1000px; text-align: center; z-index: 999">
        <div id="container" style="margin-top: 20%;">
            <div class="overlay" style="font-size: 100px;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>

	<!-- Bootstrap 3.3.6 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>

	<script src="js/index.js"></script>

	<script src="plugins/bootstrap-table/bootstrap-table.js"></script>
	<script src="plugins/bootstrap-table/bootstrap-table-export.js"></script>
	<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="plugins/select2/select2.full.min.js"></script>
	<script src="plugins/iCheck/iCheck.js"></script>
	<script src="plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('.datepicker').datepicker({
				showInputs: false
			});

			$('.datetimepicker').datetimepicker();
		});

		<?php
			if (isset($_GET["page"])) {
				$page = $_GET["page"];
				include("js/" .$page. ".js");
			}
		?>
	</script>

</body>
</html>