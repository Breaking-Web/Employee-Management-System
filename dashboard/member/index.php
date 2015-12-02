<?php 
// session_start();
	include '../includes/db.inc.php';



	$target_dir =  "icon";
	$pagesize = 6;		// only show 6 icons
	//In warden dashboard, show leaders
	if($_SESSION["position"] == 'warden'){
		try
		{
			$sql = 'SELECT count(*) AS cnt FROM user_info WHERE groupid = :groupid AND userid != :userid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':userid',$_SESSION['userid']);	
			$s->bindValue(':groupid',$_SESSION['groupid']);	
			$s->execute();
		}
		catch (PDOException $e){
			echo $e;
			header("Location: ../includes/error.html.php");
			exit(); 
		}
	}else{
		// In leader dashboard, show group members
		try
		{
			$sql = 'SELECT count(*) AS cnt FROM user_info WHERE position = "leader"';
			$s = $pdo->prepare($sql);
			$s->execute();
		}
		catch (PDOException $e){
			echo $e;
			header("Location: ../includes/error.html.php");
			exit(); 
		}
	}


	$myrow = $s->fetch();
	$numrows=$myrow['cnt'];

	$pages = intval($numrows/$pagesize);
	if($numrows%$pagesize) $pages++;		// reminding need one more page

   	if(isset($_GET['page'])){
		$page =	$_GET['page'];
   	}else{
   		$page = 1;
   	}

	
	$offset = $pagesize*($page - 1);

	if($pages == 1){
		$prev = 1; $next = 1;
	}else{
		if($page == 1) $prev = $pages;
		else $prev=$page-1;

		if($page == $pages) $next = 1;
		else $next=$page+1;
	}
	if($_SESSION["position"] == 'warden'){
		try
		{
			$sql = 'SELECT * FROM user_info WHERE position = "leader" ORDER BY userid ASC LIMIT ?,?';
			$s = $pdo->prepare($sql);

			$s->bindValue(1, intval($offset), PDO::PARAM_INT);
			$s->bindValue(2, intval($pagesize), PDO::PARAM_INT);

			$s->execute();
		}
		catch (PDOException $e){
			echo $e;
			header("Location: ../includes/error.html.php");
			exit(); 
		}
	}else{
		try
		{
			$sql = 'SELECT * FROM user_info WHERE groupid = ? AND userid != ? ORDER BY userid ASC LIMIT ?,?';
			$s = $pdo->prepare($sql);

			$s->bindValue(1, $_SESSION['groupid'], PDO::PARAM_INT);
			$s->bindValue(2, $_SESSION['userid'], PDO::PARAM_STR);
			$s->bindValue(3, intval($offset), PDO::PARAM_INT);
			$s->bindValue(4, intval($pagesize), PDO::PARAM_INT);

			$s->execute();
		}
		catch (PDOException $e){
			echo $e;
			header("Location: ../includes/error.html.php");
			exit(); 
		}
	}


	$memberinfo = array();
	while($result = $s->fetch()){
		$memberinfo[] = array($result['userid'], $result['username'], $result['email'], searchFileinmem($target_dir, $result["userid"]), $result['phone']);
	}
	include 'index.html.php';

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