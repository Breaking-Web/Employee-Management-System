<?php 

	include '../../includes/db.inc.php'; // cwd = dashboard/admin

	//  gourp filter,  userid filter( from xxx to yyy ) , splitnum

    $groupfilter = $viewusersplitnum = array();
	
	$viewusersplitnum[] = 10;
	$viewusersplitnum[] = 20;
	$viewusersplitnum[] = 30;

	// set group filter
	try
	{
		$sql = 'SELECT * FROM group_info ORDER BY groupid ASC';  	
      	$s = $pdo->prepare($sql);
      	$s->execute();

	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../../includes/error.html.php");
		exit(); 
	}
	$groupfilter[] = array("all","all");
	while($onegroup = $s->fetch()){
		$groupfilter[]= array($onegroup["groupid"],$onegroup["gname"]);
	}

	// get filter 
	$pagesize = $_SESSION["viewusersplitnum"];
	$targetgroup = $_SESSION["targetgroup"];
	$beginuserid = $_SESSION["beginuserid"];
	$enduserid = $_SESSION["enduserid"];

	// reset MAX, MIN value
	if($beginuserid == "Cxxxxxxxx"){
		try
		{
			$sql = 'SELECT MIN(userid) AS userid FROM user_info';  	
	      	$s = $pdo->prepare($sql);
	      	$s->execute();

		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../../includes/error.html.php");
			exit(); 
		}
		$temp = $s->fetch();
		$beginuserid = $temp['userid'];
		// $beginuserid = $s->fetch();
	}
	if($enduserid == "Cxxxxxxxx"){
		try
		{
			$sql = 'SELECT MAX(userid) AS userid FROM user_info';  	
	      	$s = $pdo->prepare($sql);
	      	$s->execute();

		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../../includes/error.html.php");
			exit(); 
		}
		$temp = $s->fetch();
		$enduserid = $temp['userid'];
		// $enduserid = $s->fetch();
	}

	// split into pages
	try
	{
		if($targetgroup == "all"){
			$sql = 'SELECT count(*) AS cnt FROM user_info WHERE userid >= :beginuserid AND userid <= :enduserid ORDER BY userid ASC';
	      	$s = $pdo->prepare($sql);
   		}else{
			$sql = 'SELECT count(*) AS cnt FROM user_info WHERE userid >= :beginuserid AND userid <= :enduserid AND groupid = :groupid ORDER BY userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':groupid', $targetgroup);
   		}
		$s->bindValue(':beginuserid', $beginuserid);
      	$s->bindValue(':enduserid', $enduserid);
		$s->execute();
	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ../../includes/error.html.php");
		exit(); 
	}

	$myrow = $s->fetch();
	$numrows=$myrow['cnt'];

	$pages = intval($numrows/$pagesize);
	if($numrows%$pagesize) $pages++;		// reminding need one more page



   	$page = $_SESSION['currentpage'];

	$offset = $pagesize*($page - 1);

	$first=1;
	$prev=$page-1;
	$next=$page+1;
	$last=$pages;

	if($targetgroup == "all"){
		try
		{
			$sql = 'SELECT * FROM user_info WHERE userid >= ? AND userid <= ? ORDER BY userid ASC LIMIT ?,?';
	      	$s = $pdo->prepare($sql);
			$s->bindValue(1, $beginuserid, PDO::PARAM_STR);
   			$s->bindValue(2, $enduserid, PDO::PARAM_STR);
   			$s->bindValue(3, intval($offset), PDO::PARAM_INT);
   			$s->bindValue(4, intval($pagesize), PDO::PARAM_INT);
   			$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../../includes/error.html.php");
			exit(); 
		}
	}else{
		try
		{
			$sql = 'SELECT * FROM user_info WHERE userid >= ? AND userid <= ? AND groupid = ? ORDER BY userid ASC LIMIT ?,?';
	      	$s = $pdo->prepare($sql);
			$s->bindValue(1, $beginuserid, PDO::PARAM_STR);
   			$s->bindValue(2, $enduserid, PDO::PARAM_STR);
   			$s->bindValue(3, intval($targetgroup), PDO::PARAM_INT);
   			$s->bindValue(4, intval($offset), PDO::PARAM_INT);
   			$s->bindValue(5, intval($pagesize), PDO::PARAM_INT);
   			$s->execute();
		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: ../../includes/error.html.php");
			exit(); 
		}
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
			
			//update user_info table
			if(isset($_POST[$oneuser['userid'].'userpwd'])){  //reset psw
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
			      $s->bindValue(':userid', $oneuser['userid']);
			      $s->bindValue(':username', $_POST[$oneuser['userid'].'username']);
			      $s->bindValue(':userpwd', "123456");
			      $s->bindValue(':phone', $_POST[$oneuser['userid'].'phone']);
			      $s->bindValue(':email', $_POST[$oneuser['userid'].'email']);
			      $s->bindValue(':address', $_POST[$oneuser['userid'].'address']);
			      $s->execute();
			      
			    }
			    catch (PDOException $e)
			    {
			      $error = 'Error updating submitted user.';
			      include '../includes/error.html.php';
			      exit();
			    }

			}else{
			    try
			    {
			      $sql = 'UPDATE user_info SET
			          username = :username,
			          phone = :phone,
			          email = :email,
			          address = :address
			          WHERE userid = :userid';
			      $s = $pdo->prepare($sql);
			      $s->bindValue(':userid', $oneuser['userid']);
			      $s->bindValue(':username', $_POST[$oneuser['userid'].'username']);
			      $s->bindValue(':phone', $_POST[$oneuser['userid'].'phone']);
			      $s->bindValue(':email', $_POST[$oneuser['userid'].'email']);
			      $s->bindValue(':address', $_POST[$oneuser['userid'].'address']);
			      $s->execute();
			      
			    }
			    catch (PDOException $e)
			    {
			      $error = 'Error updating submitted user.';
			      include '../includes/error.html.php';
			      exit();
			    }
			}
			header("Location: viewuserinfo.php");
	    }
	}
  
	include "viewuserinfo.html.php";

?>