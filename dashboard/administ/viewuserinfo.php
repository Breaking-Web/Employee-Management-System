<?php 
	include '../../includes/db.inc.php'; // cwd = ?
	try
	{
		$sql = 'SELECT * FROM user_info ORDER BY userid ASC';
		$s = $pdo->prepare($sql);
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../includes/error.html.php");
		exit(); 
	}
	
	$allusers = array();
	while(	$oneuser = $s->fetch() ){	
		$allusers[] = $oneuser;
	}

?>