<?php
	//session_start();

	include '/home/jingyam/public_html/662/project/includes/db.inc.php';

	echo "summary"."<br>";
   	if(isset($_GET['page'])){

		$_SESSION["pagenum"] = $_GET['page'];
   	}else{
   		$_SESSION["pagenum"] = 1;
   	}
	include 'uploadsummary.php';
	include 'selfsummaries.php';
	include 'groupsummaries.php';

?>

