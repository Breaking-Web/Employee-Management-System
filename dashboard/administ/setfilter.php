<?php
	session_start();
	$_SESSION["viewusersplitnum"] = $_POST['viewusersplitnum'];
	$_SESSION["targetgroup"] = $_POST['groupfilter'];

	// check the form of begin/end userid "Cxxxxxxxx"
	if(preg_match("/^[C][0-9]{8}$/",$_POST['beginuserid'])) $_SESSION["beginuserid"] = $_POST['beginuserid'];
	if(preg_match("/^[C][0-9]{8}$/",$_POST['enduserid'])) $_SESSION["enduserid"] = $_POST['enduserid'];

	header("Location: index2.php");
?>