<?php
	include '../includes/db.inc.php';
	if($_SESSION["position"]=="leader")
	{
		try{
			$sql = 'SELECT user_info.userid,user_info.username, avg(evale) as mean FROM user_info LEFT JOIN (SELECT * FROM evaluation 
				WHERE datediff(last_day(curdate()),time)<31 AND datediff(last_day(curdate() ),time )>0 ) AS T1 ON T1.userid = 
				user_info.userid WHERE groupid = 1 GROUP BY user_info.userid';
			$s = $pdo->prepare($sql);
			$s->bindValue(':userid',$_SESSION["userid"]);	
			$s->bindValue(':groupid',$_SESSION["groupid"]);	
			$s->execute();
		}
		catch (PDOException $e){
			echo $e;
			// $error = 'Error select.';
			// header("Location: ../includes/error.html.php");
			exit(); 
		}

		$groupeva = array();
		while(	$row = $s->fetch() ){	
			if($row['mean'] == NULL) $groupeva[] = array($row['userid'],$row['username'],"N/A");
			else $groupeva[] = array($row['userid'],$row['username'],$row['mean']);
		}
		include "evaluation_of_this_month.html.php";
	}
?>