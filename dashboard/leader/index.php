<?php
    // session_start(); // getcwd=dashboard
    include '../includes/db.inc.php';

    try
	{
		$sql = 'SELECT application.userid, user_info.username, application.timeid,reason,timedate, starttime, endtime FROM application INNER JOIN user_info ON 
		application.userid = user_info.userid INNER JOIN time_info on application.timeid = time_info.timeid WHERE 
		groupid = :groupid AND state is NULL ORDER BY application.timeid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':groupid',$_SESSION["groupid"]);	
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../includes/error.html.php");
		exit(); 
	}
	
	$leaveapps = array();
	while(	$leaveapp = $s->fetch() ){	
		$leaveapps[] = $leaveapp;
	}

//switch requset check
    try
	{

		$sql = 'SELECT switch.userid1, u1.username AS un1, switch.userid2, u2.username AS un2, switch.usertime1,t1.timedate AS td1, t1.starttime AS ts1, 
		t1.endtime AS te1, switch.usertime2,t2.timedate AS td2, t2.starttime AS ts2, t2.endtime AS te2,reason FROM switch INNER JOIN user_info AS u1 ON 
		switch.userid1 = u1.userid INNER JOIN user_info AS u2 ON switch.userid2 = u2.userid INNER JOIN time_info AS t1 on switch.usertime1 = t1.timeid 
		INNER JOIN time_info AS t2 on switch.usertime2 = t2.timeid WHERE u1.groupid = :groupid AND state1 ="Y"  AND state2 is NULL ORDER BY switch.usertime1';

		$s = $pdo->prepare($sql);
		$s->bindValue(':groupid',$_SESSION["groupid"]);	
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../includes/error.html.php");
		exit(); 
	}
	
	$switchapps = array();
	while(	$switchapp = $s->fetch() ){	
		$switchapps[] = $switchapp;
	}
//check whether need to arrange time for staff
    try
	{

		//$sql = 'SELECT * FROM group_time INNER JOIN time_info ON group_time.timeid = time_info.timeid ';
		$sql = 'SELECT * FROM group_time INNER JOIN time_info ON group_time.timeid = time_info.timeid WHERE 
			timedate > curdate() AND requestvalue >0 AND groupid = :groupid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':groupid',$_SESSION["groupid"]);	
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../includes/error.html.php");
		exit(); 
	}
	


	$moreemployees = array();
	while(	$moreemployee = $s->fetch() ){
		try
		{

			$sql2 = 'SELECT userid,username FROM user_info WHERE user_info.groupid = :groupid AND userid NOT IN (SELECT DISTINCT work_info.userid FROM 
			work_info INNER JOIN group_time ON work_info.timeid=group_time.timeid AND group_time.groupid= :groupid AND group_time.timeid = :ttid 
			AND group_time.requestvalue>0 INNER JOIN user_info ON user_info.userid = work_info.userid WHERE user_info.groupid = :groupid)';	
			$s2 = $pdo->prepare($sql2);
			$s2->bindValue(':groupid',$_SESSION["groupid"]);	
			$s2->bindValue(':ttid',$moreemployee['timeid']);	
			$s2->execute();


		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}
		$moreemployees[] = array($moreemployee['timeid'],"root",$moreemployee['timedate']." ".$moreemployee['starttime']."-".$moreemployee['endtime']);
		while(	$freeemployee = $s2->fetch() ){	
			$moreemployees[] = array($freeemployee['userid'],$moreemployee['timeid'],$freeemployee['username']);
		}
	}


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
	
	




	if(isset($_POST['action3']) and $_POST['action3'] == 'apagree')
	{
		//first update the application table

		try
		{
	      	$sql = 'UPDATE application SET state = :state
	          	WHERE timeid = :timeid AND userid = :userid';
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':state', 'Y');
	      	$s->bindValue(':timeid', $_POST['leavetimeid']);
	      	$s->bindValue(':userid', $_POST['leaveuserid']);

	      	$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error UPDATE.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		//second delete the tuple in work_info
		try
		{
	        $sql = 'DELETE FROM work_info WHERE timeid = :timeid AND userid = :userid';
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':userid', $_POST['leaveuserid']);
	      	$s->bindValue(':timeid', $_POST['leavetimeid']);
	      	$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error DELETE.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		try
		{
	      	$sql2 = 'UPDATE group_time SET requestvalue = requestvalue + 1
	          	WHERE groupid = :groupid AND timeid = :timeid';
	      	$s2 = $pdo->prepare($sql2);
	      	$s2->bindValue(':groupid',$_SESSION["groupid"]);
	      	$s2->bindValue(':timeid',$_POST['leavetimeid']);
	      	$s2->execute();
		}

		catch (PDOException $e){
			$error = 'Error UPDATE.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}


	}

	if(isset($_POST['action3']) and $_POST['action3'] == 'apreject')
	{
		//first update the application table

		try
		{
			// echo $_POST['userid']."<br>";
			// echo $_POST['timeid']."<br>";
	      	$sql = 'UPDATE application SET state = :state
	          	WHERE timeid = :timeid AND userid = :userid';
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':state', 'N');
	      	$s->bindValue(':timeid', $_POST['leavetimeid']);
	      	$s->bindValue(':userid', $_POST['leaveuserid']);

	      	$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		//second do nothing


	}

	if(isset($_POST['action3']) and $_POST['action3'] == 'swagree')
	{
		//first update the switch table

		try
		{

	      	$sql = 'UPDATE switch SET state2 = :state2
	          	WHERE usertime1 = :usertime1 AND usertime2 = :usertime2 AND userid1 = :userid1 AND userid2 = :userid2';
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':state2', 'Y');
	      	$s->bindValue(':usertime1', $_POST['swtimeid1']);
	      	$s->bindValue(':userid1', $_POST['swuserid1']);
	      	$s->bindValue(':usertime2', $_POST['swtimeid2']);
	      	$s->bindValue(':userid2', $_POST['swuserid2']);

	      	$s->execute();
		}

		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		//second switch the tuples in work_info  -- use two update commands?

		try
		{
	      	$sql = 'UPDATE work_info SET timeid = :usertime2
	          	WHERE timeid = :usertime1 AND userid = :userid';
	      	$s = $pdo->prepare($sql);

	      	$s->bindValue(':userid', $_POST['swuserid1']);
	      	$s->bindValue(':usertime2', $_POST['swtimeid2']);
	      	$s->bindValue(':usertime1', $_POST['swtimeid1']);

	      	$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location:../includes/error.html.php");
			exit(); 
		}
		try
		{
	      	$sql = 'UPDATE work_info SET timeid = :usertime2
	          	WHERE timeid = :usertime1 AND userid = :userid';
	      	$s = $pdo->prepare($sql);

	      	$s->bindValue(':userid', $_POST['swuserid2']);
	      	$s->bindValue(':usertime2', $_POST['swtimeid1']);
	      	$s->bindValue(':usertime1', $_POST['swtimeid2']);

	      	$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

	}

	if(isset($_POST['action3']) and $_POST['action3'] == 'swreject')
	{

		//first update the switch table
		try
		{
	      	$sql = 'UPDATE switch SET state2 = :state2
	          	WHERE usertime1 = :usertime1 AND usertime2 = :usertime2 AND userid1 = :userid1 AND userid2 = :userid2';
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':state2', 'N');
	      	$s->bindValue(':usertime1', $_POST['swtimeid1']);
	      	$s->bindValue(':userid1', $_POST['swuserid1']);
	      	$s->bindValue(':usertime2', $_POST['swtimeid2']);
	      	$s->bindValue(':userid2', $_POST['swuserid2']);

	      	$s->execute();
		}

		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		//second do nothing

	}

	if(isset($_POST['action3']) and $_POST['action3'] == 'Addemployee')
	{
		// echo $_POST['s1']."<br>"; //timeid
		// echo $_POST['s2']."<br>"; //userid

		//first update the group_time table
		try
		{
	      	$sql2 = 'UPDATE group_time SET requestvalue = requestvalue - 1
	          	WHERE groupid = :groupid AND timeid = :timeid';
	      	$s2 = $pdo->prepare($sql2);
	      	$s2->bindValue(':groupid',$_SESSION["groupid"]);
	      	$s2->bindValue(':timeid',$_POST['s1']);
	      	$s2->execute();
		}

		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

		// Insert employee into work_info

		try
		{
	        $sql2 = 'INSERT INTO work_info SET
				userid = :userid,
				timeid = :timeid';  	
	      	$s2 = $pdo->prepare($sql2);
	      	$s2->bindValue(':userid',$_POST['s2']);
	      	$s2->bindValue(':timeid',$_POST['s1']);
	      	$s2->execute();
		}

		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}

	}	
	include 'leader.html.php';

?>
