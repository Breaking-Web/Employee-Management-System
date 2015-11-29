<?php
	include '../includes/db.inc.php';
	if($_SESSION["position"]=="warden")
	{
		//	select all group, all employees

	    try
		{
			$sql = 'SELECT * FROM group_info WHERE groupid != 0';
			$s = $pdo->prepare($sql);
			$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}
		
		$del_employee = array();
		while(	$del_group = $s->fetch() ){	
			$del_employee[] = array($del_group['groupid'],"root",$del_group['gname']);
		}

	    try
		{
			$sql = 'SELECT * FROM user_info WHERE groupid != 0 AND position = "staff"';
			$s = $pdo->prepare($sql);
			$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../includes/error.html.php");
			exit(); 
		}
		while(	$del_member = $s->fetch() ){	
			$del_employee[] = array($del_member['userid'],$del_member['groupid'],$del_member['username']);
		}

		if(isset($_POST['actiondel']) and $_POST['actiondel'] == 'Submit')
		{	
			// x1 groupid x2 userid
			// echo $_POST['x1']." ".$_POST['x2'];
			// first  delete future work  ( like swith this staff to another group)
			// second 

		}


		include "delete_employee.html.php";
	}
?>