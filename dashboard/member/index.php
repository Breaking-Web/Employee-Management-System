<?php 
	include '../includes/db.inc.php';

	$target_dir =  "icon";

	try
	{
		$sql = 'SELECT * FROM user_info WHERE groupid = :groupid AND userid != :userid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':userid',$_SESSION['userid']);	
		$s->bindValue(':groupid',$_SESSION['groupid']);	
		$s->execute();
	}
	catch (PDOException $e){
		echo $e;
		header("Location: /includes/error.html.php");
		exit(); 
	}

	$memberinfo = array();
	while($result = $s->fetch()){
		$memberinfo[] = array($result['userid'], $result['username'], $result['email'] searchFileinmem($target_dir, $result["userid"]));
	}

	function searchFileinmem($dir, $keyword) {
	  $sFile = getFileinmem($dir);
	  if (count($sFile) <= 0) {
	    return false;
	  }
	  $sResult = array();
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

	function getFileinmem($dir){
	  $dp = opendir($dir);
	  $fileArr = array();
	  while (!false == $curFile = readdir($dp)) {
	    if ($curFile!="." && $curFile!=".." && $curFile!="") {
	      if (is_dir($curFile)) {
	        $fileArr = getFileinmem($dir."/".$curFile);
	      } else {
	        $fileArr[] = $dir."/".$curFile;
	      }
	    }
	  }
	  return $fileArr;
	}


?>