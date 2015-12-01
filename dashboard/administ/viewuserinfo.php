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

	foreach( $allusers as $oneuser)
    {
	    if(isset($_POST['action']) and $_POST['action'] == $oneuser['userid']){
	    	
	        	echo $oneuser['userid']."<br>";
	        	echo $_POST['username']."<br>";
	        	echo $_POST['userpwd']."<br>";
	        	echo $_POST['phone']."<br>";
	        	echo $_POST['email']."<br>";
	        	echo $_POST['address']."<br>";

	    }
	}
  



	include "viewuserinfo.html.php";

?>