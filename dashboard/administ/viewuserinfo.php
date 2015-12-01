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

	
    if(isset($_POST['action']) and $_POST['action'] == $file1)
        {
        //The values below are host address, username, password, name of database, charset respectively
        //$db->backup ('','','');
        $db->restore ( './backup/'.$file1);
        }
    }


	
	include "viewuserinfo.html.php";

?>