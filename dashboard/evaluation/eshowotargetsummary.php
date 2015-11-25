<?php
	// echo "success"."<br>";


   	if(isset($_GET['path'])){

		$summary = file_get_contents($_GET['path']);

   	}else{
   		header("Location: /includes/error.html.php");
		exit(); 
   	}

   	include "eshowotargetsummary.html.php";
?>