<?php
	session_start();
	$_SESSION["viewusersplitnum"] = $_POST['viewusersplitnum'];
	$_SESSION["targetgroup"] = $_POST['groupfilter'];

	
	if($_POST['beginuserid'] && $_POST['beginuserid'] != "Cxxxxxxxx"){
		$_SESSION["beginuserid"] = $_POST['beginuserid'];
	}
	if($_POST['enduserid'] && $_POST['enduserid'] != "Cxxxxxxxx"){
		$_SESSION["enduserid"] = $_POST['enduserid'];
	}

	header("Location: viewuserinfo.php");
?>