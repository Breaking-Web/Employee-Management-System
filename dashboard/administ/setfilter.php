<?php
	session_start();
	$_SESSION["viewusersplitnum"] = $_POST['viewusersplitnum'];
	$_SESSION["targetgroup"] = $_POST['groupfilter'];


	// if($_POST['beginuserid'] == ""){
	// 	$_SESSION["beginuserid"] = "Cxxxxxxxx";
	// }
	// if($_POST['beginuserid'] && $_POST['beginuserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["beginuserid"] = $_POST['beginuserid'];
	// }
	if(preg_match("^[C][0-9]{8}$",$_POST['beginuserid'])) $_SESSION["beginuserid"] = $_POST['beginuserid'];
	if(preg_match("^[C][0-9]{8}$",$_POST['beginuserid'])) $_SESSION["beginuserid"] = $_POST['beginuserid'];
	// if($_POST['beginuserid'] && $_POST['beginuserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["beginuserid"] = $_POST['beginuserid'];
	// }
	// $_SESSION["beginuserid"] = $_POST['beginuserid'];

	// if($_POST['beginuserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["beginuserid"] = $_POST['beginuserid'];
	// }



	// if($_POST['enduserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["enduserid"] = $_POST['enduserid'];
	// }


	// if($_POST['beginuserid'] && $_POST['beginuserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["beginuserid"] = $_POST['beginuserid'];
	// }
	// if($_POST['enduserid'] == ""){
	// 	$_SESSION["enduserid"] = "Cxxxxxxxx";
	// }
	// if($_POST['enduserid'] && $_POST['enduserid'] != "Cxxxxxxxx"){
	// 	$_SESSION["enduserid"] = $_POST['enduserid'];
	// }

	header("Location: index2.php");
?>