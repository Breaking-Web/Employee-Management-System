<?php
	include '../includes/db.inc.php';
	try{
		$sql = 'SELECT user_info.userid,user_info.username, avg(evale) as mean FROM user_info LEFT JOIN evaluation ON user_info.userid = evaluation.userid 
		WHERE groupid = :groupid AND user_info.userid !=:userid AND datediff(last_day(curdate()),time)<31 AND 
		datediff(last_day(curdate() ),time )>0) GROUP BY user_info.userid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':userid',$_SESSION["userid"]);	
		$s->bindValue(':groupid',$_SESSION["groupid"]);	
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../includes/error.html.php");
		exit(); 
	}

	$groupeva = array();
	while(	$row = $s->fetch() ){	
		if($row['mean'] == NULL) $groupeva[] = array($row['userid'],$row['username'],"N/A");
		else $groupeva[] = array($row['userid'],$row['username'],$row['mean']);
	}

?>