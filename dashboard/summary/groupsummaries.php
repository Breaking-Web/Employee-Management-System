<?php
    // session_start();
    include '/home/jingyam/public_html/662/project/includes/db.inc.php';

    $target_dir =  "uploadfile";

    $timefilter = $namefilter = $splitnum = array();


	$timefilter[] = array("36500","all");
    $timefilter[] = array("30","this month");
	$timefilter[] = array("91","last three months");
	$timefilter[] = array("182","last six months");
	$timefilter[] = array("365","this year");
	
	
	$splitnum[] = 10;
	$splitnum[] = 20;
	$splitnum[] = 30;

	try
	{
		$sql = 'SELECT * FROM user_info WHERE groupid = :groupid and userid != :userid ORDER BY userid DESC';  	
      	$s = $pdo->prepare($sql);
      	$s->bindValue(':groupid', $_SESSION["groupid"]);
      	$s->bindValue(':userid', $_SESSION["userid"]);
      	$s->execute();

	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: /home/jingyam/public_html/662/project/includes/error.html.php");
		exit(); 
	}
	$namefilter[] = array("all","all");
	while($auser = $s->fetch()){
		$namefilter[]= array($auser["userid"],$auser["username"]);
	}

	$pagesize = $_SESSION["splitnum"];
	try
	{
		if($_SESSION["namefilter"] == "all" && $_SESSION["timefilter"] == "36500"){
			$sql = 'SELECT count(*) AS cnt FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid != :userid
				ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':userid', $_SESSION["userid"]);
   		}else if ($_SESSION["namefilter"] == "all" ){
			$sql = 'SELECT count(*) AS cnt  FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid != :userid AND 
				datediff(  last_day(curdate() ), time ) < :timefilter ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':userid', $_SESSION["userid"]);
	      	$s->bindValue(':timefilter', $_SESSION["timefilter"]);
   		}else{
			$sql = 'SELECT count(*) AS cnt  FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid = :userid AND 
				datediff(  last_day(curdate() ), time ) < :timefilter ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':userid', $_SESSION["namefilter"]);
	      	$s->bindValue(':timefilter', $_SESSION["timefilter"]);
   		}
   		$s->bindValue(':groupid', $_SESSION["groupid"]);
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: /home/jingyam/public_html/662/project/includes/error.html.php");
		exit(); 
	}

	$myrow = $s->fetch();
	$numrows=$myrow['cnt'];

	$pages = intval($numrows/$pagesize);
	if($numrows%$pagesize) $pages++;		// reminding need one more page

	$page =	intval($_SESSION["pagenum"]);
	$offset = $pagesize*($page - 1);

	$first=1;
	$prev=$page-1;
	$next=$page+1;
	$last=$pages;

	try
	{

		if($_SESSION["namefilter"] == "all" && $_SESSION["timefilter"] == "36500"){
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = ? AND summary.userid != ?
				ORDER BY time DESC, summary.userid ASC LIMIT ?,?';  	
	      	$s = $pdo->prepare($sql);
			$s->bindValue(1, $_SESSION["groupid"], PDO::PARAM_INT);
   			$s->bindValue(2, $_SESSION["userid"], PDO::PARAM_STR);
   			$s->bindValue(3, intval($offset), PDO::PARAM_INT);
   			$s->bindValue(4, intval($pagesize), PDO::PARAM_INT);
   			$s->execute();
   		}else if ($_SESSION["namefilter"] == "all" ){
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = ? AND summary.userid != ? AND 
				datediff(  last_day(curdate() ), time ) < ? ORDER BY time DESC, summary.userid ASC LIMIT ?,?';  	
	      	$s = $pdo->prepare($sql);
			$s->bindValue(1, $_SESSION["groupid"], PDO::PARAM_INT);
   			$s->bindValue(2, $_SESSION["userid"], PDO::PARAM_STR);
   			$s->bindValue(3, $_SESSION["timefilter"], PDO::PARAM_INT);
   			$s->bindValue(4, intval($offset), PDO::PARAM_INT);
   			$s->bindValue(5, intval($pagesize), PDO::PARAM_INT);
			$s->execute();
   		}else{
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = ? AND summary.userid = ? AND 
				datediff(  last_day(curdate() ), time ) < ? ORDER BY time DESC, summary.userid ASC LIMIT ?,?';  	
	      	$s = $pdo->prepare($sql);
			$s->bindValue(1, $_SESSION["groupid"], PDO::PARAM_INT);
   			$s->bindValue(2, $_SESSION["namefilter"], PDO::PARAM_STR);
   			$s->bindValue(3, $_SESSION["timefilter"], PDO::PARAM_INT);
   			$s->bindValue(4, intval($offset), PDO::PARAM_INT);
   			$s->bindValue(5, intval($pagesize), PDO::PARAM_INT);
   			$s->execute();
   		}
		
	}
	catch (PDOException $e){
		echo $e;
		// header("Location: /includes/error.html.php");
		exit(); 
	}
	
	$groupsummarypreview = array();
	while($eachtitle = $s->fetch()){

		$path = searchFile($target_dir, $eachtitle["title"] ); 
      	$year = substr($path,21,4); 
      	$month = substr($path,strrpos($path,'_')+1,-4); 
      	$groupsummarypreview[] = array($eachtitle["username"],$year,$month,$path);
	}

	include 'groupsummaries.html.php';
?>
