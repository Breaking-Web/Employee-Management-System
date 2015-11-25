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
		header("Location: /home/jingyam/public_html/662/project/includes/error.html.php");
		exit(); 
	}
	$summarypreview = array();
	while($eachtitle = $s->fetch()){
		$summarypreview[] = searchFileinsum($target_dir, $eachtitle["title"] ); 
	}


	include 'selfsummaries.html.php';




	function searchFileinsum($dir, $keyword) {
	  $sFile = getFileinsum($dir);
	  if (count($sFile) <= 0) {
	    return false;
	  }
	  // $sResult = array();
	  foreach ($sFile as $file) {
	    if(strstr($file, $keyword) !== false ){
	      	// $sResult[] = $file;
	    	$sResult = $file;
	    }
	  }
	  if (count($sResult) <= 0) {
	    return false;
	  } else {
	    return $sResult;
	  }

	}

	function getFileinsum($dir){
	  $dp = opendir($dir);
	  $fileArr = array();
	  while (!false == $curFile = readdir($dp)) {
	    if ($curFile!="." && $curFile!=".." && $curFile!="") {
	      if (is_dir($curFile)) {
	        $fileArr = getFileinsum($dir."/".$curFile);
	      } else {
	        $fileArr[] = $dir."/".$curFile;
	      }
	    }
	  }
	  return $fileArr;
	}


?>
