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
		header("Location: ../../includes/error.html.php");
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
        	echo $_POST[$oneuser['userid'].'username']."<br>";
        	if(isset($_POST[$oneuser['userid'].'userpwd'])) echo "Reset"."<br>";
        	else echo "Don't reset"."<br>";
        	echo $_POST[$oneuser['userid'].'phone']."<br>";
        	echo $_POST[$oneuser['userid'].'email']."<br>";
        	echo $_POST[$oneuser['userid'].'address']."<br>";
			
			// update user_info table
		    try
		    {
		      $sql = 'UPDATE user_info SET
		          username = :username,
		          userpwd = :userpwd,
		          phone = :phone,
		          email = :email,
		          address = :address
		          WHERE userid = :userid';
		      $s = $pdo->prepare($sql);
		      $s->bindValue(':userid', $id);
		      $s->bindValue(':username', $_POST['username']);
		      $s->bindValue(':userpwd', $_POST['userpwd']);
		      $s->bindValue(':phone', $_POST['phone']);
		      $s->bindValue(':email', $_POST['email']);
		      $s->bindValue(':address', $_POST['address']);
		      $s->execute();
		      
		    }
		    catch (PDOException $e)
		    {
		      $error = 'Error updating submitted user.';
		      include '../includes/error.html.php';
		      exit();
		    }



	    }
	}
  



	include "viewuserinfo.html.php";

?>