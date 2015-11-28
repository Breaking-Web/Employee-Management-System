<?php 
// session_start();
	include '../includes/db.inc.php';


if($_SESSION["position"] == "leader")
{
	$pagesize1 = 6;		// only show 6 history
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

	$myrow1 = $s->fetch();
	$numrows1=$myrow1['cnt'];

	$pages1 = intval($numrows1/$pagesize1);
	if($numrows1%$pagesize1) $pages1++;		// reminding need one more page

   	if(isset($_GET['apphis'])){
		$page1 =	$_GET['apphis'];
   	}else{
   		$page1 = 1;
   	}

	
	$offset1 = $pagesize1*($page1 - 1);

	if($pages1 == 1){
		$prev1 = 1; $next1 = 1;
	}else{
		if($page1 == 1) $prev1 = $pages1;
		else $prev1=$page1-1;

		if($page1 == $pages1) $next1 = 1;
		else $next1=$page1+1;
	}

	// select application user of the same group
	try
	{
		$sql = 'SELECT * FROM user_info inner join application on user_info.userid=application.userid 
		inner join time_info on time_info.timeid=application.timeid WHERE user_info.groupid = ? 
		ORDER BY user_info.userid ASC LIMIT ?,?';
		$s = $pdo->prepare($sql);
		$s->bindValue(1, $_SESSION['groupid'], PDO::PARAM_INT);
		$s->bindValue(2, intval($offset1), PDO::PARAM_INT);
		$s->bindValue(3, intval($pagesize1), PDO::PARAM_INT);
		$s->execute();
	}
	catch (PDOException $e){
		echo $e;
		header("Location: ../includes/error.html.php");
		exit(); 
	}
	
	$applicationinfo = array();
	while($result = $s->fetch()){
		$applicationinfo[] = array($result['username'],$result['timedate'],$result['reason'],$result['state']);
	}
	
	
	include 'history.html.php';
}



?>
