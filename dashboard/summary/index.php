<?php
	session_start();

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

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

