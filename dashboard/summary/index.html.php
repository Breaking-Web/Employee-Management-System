
<?php include_once '../includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="col-lg-12 col-md-13 col-sm-13">
			<div class="panel">
				<div class="panel-body">
					<div class="text-left bk-bg-white bk-padding-top-20 bk-padding-bottom-10">
					<?php include 'uploadsummary.php';?>
					</div>
					<hr class="bk-margin-off"></hr>
					<div class="panel-body">
					<div class="text-left bk-bg-white bk-padding-top-20 bk-padding-bottom-10">
					<?php include 'selfsummaries.php';?>
					</div></div>
					<hr class="bk-margin-off"></hr>
					<div class="panel-body">
					<div class="text-left bk-bg-white bk-padding-top-20 bk-padding-bottom-10">
					<?php include 'groupsummaries.php';?>
					</div></div>
				</div>
			</div>
		</div>
	</body>
</html>


