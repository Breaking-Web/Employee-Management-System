
<?php 
    session_start();
    include '/home/jingyam/public_html/662/project/includes/db.inc.php';

	$UID = $_SESSION["userid"];
	try
	{
	$sql = 'SELECT * FROM work_info INNER JOIN time_info ON time_info.timeid = work_info.timeid WHERE userid = :userid';
	$s = $pdo->prepare($sql);
	$s->bindValue(':userid',$UID);	
	$s->execute();
	}
	catch (PDOException $e){
	$error = 'Error select.';
	header("Location: /home/jingyam/public_html/662/project/includes/error.html.php");
	exit(); 
	}
	while($row = $s->fetch()){
		echo $row['timedate'] . " " . $row['starttime'] . "-" . $row['endtime'] . "<br>";
	}

?>	
