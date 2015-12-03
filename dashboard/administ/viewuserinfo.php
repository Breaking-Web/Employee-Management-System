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

        	// echo $oneuser['userid']."<br>";
        	// echo $_POST[$oneuser['userid'].'username']."<br>";
        	// if(isset($_POST[$oneuser['userid'].'userpwd'])) echo "Reset"."<br>";
        	// else echo "Don't reset"."<br>";
        	// echo $_POST[$oneuser['userid'].'phone']."<br>";
        	// echo $_POST[$oneuser['userid'].'email']."<br>";
        	// echo $_POST[$oneuser['userid'].'address']."<br>";
			

	    	// check input 

	    	if (empty($_POST[$oneuser['userid'].'username'])) {
			    $_SESSION["error1"] = "Username can't be empty!";
			}else{
				// $testusername = substr($_POST[$oneuser['userid'].'username'],10);
			    $testusername = test_input($_POST[$oneuser['userid'].'username']);
			    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$testusername)) // check if name only contains letters and whitespace
			      $_SESSION["error1"] = "Only letters, number and white space allowed!"; 
			    else $_SESSION["error1"] = ""; 
			}

			if (empty($_POST[$oneuser['userid'].'phone'])) {
			    $_SESSION["error2"] = "Phone can't be empty!";
			}else{
				// $testphone = substr($_POST[$oneuser['userid'].'phone'],10);
			    $testphone = test_input($_POST[$oneuser['userid'].'phone']);
			    if(!preg_match("/^[0-9]{10}$/",$testphone)) 
			      $_SESSION["error2"] = "Invalid phone number!"; 
			  	else $_SESSION["error2"] = ""; 
			}

			if (empty($_POST[$oneuser['userid'].'email'])) {
			    $_SESSION["error3"] = "Email can't be empty!";
			}else{
				// $testuseremail = substr($_POST[$oneuser['userid'].'email'],10);
			    $testuseremail = test_input($_POST[$oneuser['userid'].'email']);
			    if (!filter_var($testuseremail, FILTER_VALIDATE_EMAIL)) {
			      	$_SESSION["error3"] = "Invalid email format!"; 
			    }else{
			    	$_SESSION["error3"] = ""; 
			    }
			}


			if($_SESSION["error1"] || $_SESSION["error2"] || $_SESSION["error3"] )  // if something wrong
			    $_SESSION["states"] = "";
			else   $_SESSION["states"] = "Edit success! ";

			  
			if($_SESSION["error1"] || $_SESSION["error2"] || $_SESSION["error3"] ){  // if something wrong
			    $_SESSION["states"] = "";
			}
			
			if($_SESSION["states"]){ 
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
				      include '../../includes/error.html.php';
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
				      include '../../includes/error.html.php';
				      exit();
				    }
				}
			}
			// ob_start();
			// header("Location: index2.php");
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index2.php">';    
    		exit(); 
	    }
	}
	include "viewuserinfo.html.php";
	function test_input($data) {
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
?>