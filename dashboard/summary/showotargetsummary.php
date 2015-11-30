<?php
	// echo "success"."<br>";

   	if(isset($_GET['path'])){

		$summary = file_get_contents(substr($_GET['path'],8) );

   	}else{
   		header("Location: ../../includes/error.html.php");
		exit(); 
   	}

   	include "showotargetsummary.html.php";
?>