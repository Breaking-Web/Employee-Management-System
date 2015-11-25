<?php
    //session_start();
	$_SESSION["namefilter"] = $_POST['namefilter'];
	$_SESSION["timefilter"] = $_POST['timefilter'];
	$_SESSION["splitnum"] = $_POST['splitnum'];
	header("Location: .");
?>


