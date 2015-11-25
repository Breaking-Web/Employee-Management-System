<?php

    //session_start();
    include '/home/jingyam/public_html/662/project/includes/db.inc.php';

    $target_dir =  "uploadfile";

  	// $summ = searchFile($target_dir, $_SESSION["userid"] ); 

  	// search in summary find all titles; then searchFile

	try
	{
		$sql = 'SELECT * FROM summary WHERE userid = :userid ORDER BY time DESC';  	
      	$s = $pdo->prepare($sql);
      	$s->bindValue(':userid', $_SESSION["userid"]);
      	$s->execute();

	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: /includes/error.html.php");
		exit(); 
	}
	$summarypreview = array();
	while($eachtitle = $s->fetch()){
		$summarypreview[] = searchFile($target_dir, $eachtitle["title"] ); 
	}


	include 'selfsummaries.html.php';





?>
