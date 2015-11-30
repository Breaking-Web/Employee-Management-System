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
			// y1 groupid y2 userid
			// echo $_POST['y1']." ".$_POST['y2'];
			// first  delete future work  ( like swith this staff to another group)
			// second delete all suspend switch info


			if($_POST['y1'] && $_POST['y2'])
			{		

			  	// first delete all future work time  1. increase the group_time requestvalue 2. delete all work_info with userid future work_time
			  	try
				{

					$sql2 = 'UPDATE group_time, ( SELECT work_info.timeid FROM time_info INNER JOIN work_info ON work_info.timeid = time_info.timeid 
							WHERE timedate > curdate() AND work_info.userid = :userid ) AS timetable SET requestvalue = requestvalue + 1 
							WHERE group_time.timeid = timetable.timeid AND group_time.groupid = :groupid';  	
			      	$s2 = $pdo->prepare($sql2);
			      	$s2->bindValue(':groupid',$_POST['y1']);	// original group
			      	$s2->bindValue(':userid',$_POST['y2']);
			      	$s2->execute();

				}
				catch (PDOException $e){
					$error = 'Error select.';
					header("Location: ../includes/error.html.php");
					exit(); 
				}

			  	try
				{

					$sql2 = 'DELETE work_info FROM work_info INNER JOIN ( SELECT work_info.timeid AS tid FROM time_info INNER JOIN work_info ON 
							work_info.timeid = time_info.timeid WHERE timedate > curdate() AND work_info.userid = :userid ) AS timetable ON 
							work_info.timeid = timetable.tid WHERE work_info.userid = :userid';  	
			      	$s2 = $pdo->prepare($sql2);
			      	$s2->bindValue(':userid',$_POST['y2']);
			      	$s2->execute();

				}
				catch (PDOException $e){
					$error = 'Error select.';
					header("Location: ../includes/error.html.php");
					exit(); 
				}


				// delete all suspend switch info ( state1 == NULL)
			  	try
				{

					$sql2 = 'DELETE FROM switch WHERE userid2 = :userid AND state1 is NULL';  	
			      	$s2 = $pdo->prepare($sql2);
			      	$s2->bindValue(':userid',$_POST['y2']);
			      	$s2->execute();

				}
				catch (PDOException $e){
					$error = 'Error select.';
					header("Location: ../includes/error.html.php");
					exit(); 
				}
				// delete userinfo
			  	try
				{

					$sql2 = 'DELETE FROM user_info WHERE userid = :userid ';  	
			      	$s2 = $pdo->prepare($sql2);
			      	$s2->bindValue(':userid',$_POST['y2']);
			      	$s2->execute();

				}
				catch (PDOException $e){
					$error = 'Error select.';
					header("Location: ../includes/error.html.php");
					exit(); 
				}

			}else{
				//error, some input is empty
				if(!$_POST['y1'])	$_SESSION["error1"] = "This field can't be empty!";
				if(!$_POST['y2'])	$_SESSION["error2"] = "This field can't be empty!";
			}

		}


		include "delete_employee.html.php";
	}
?>