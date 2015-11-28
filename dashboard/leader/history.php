<?php 
// session_start();
	include '../includes/db.inc.php';


if($_SESSION["position"] == "leader")
{
	$pagesize = 6;		// only show 6 history
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

	try
	{
		$sql = 'SELECT * FROM user_info WHERE groupid = ? AND userid != ?';
		$s = $pdo->prepare($sql);

		$s->bindValue(1, $_SESSION['groupid'], PDO::PARAM_INT);
		$s->bindValue(2, $_SESSION['userid'], PDO::PARAM_STR);
		$s->execute();
	}
	catch (PDOException $e){
		echo $e;
		header("Location: ../includes/error.html.php");
		exit(); 
	}

	$memberinfo = array();
	while($result = $s->fetch()){
		$memberinfo[] = array($result['userid']);
	}
	// select application user of the same group
	try
	{
		$sql = 'SELECT * FROM application WHERE userid = ? ORDER BY userid ASC LIMIT ?,?';
		$s = $pdo->prepare($sql);

		$s->bindValue(1, $memberinfo[], PDO::PARAM_INT);
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
	
	$applicationinfo = array();
	while($result = $s->fetch()){
		$applicationinfo[] = array($result['userid'],$result['reason'],$reason['state']);
	}
	
	
	include 'history.html.php';
}



?>
