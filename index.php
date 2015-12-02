<?php
	session_start();		// open session
	unset($_SESSION["userid"]);	// make sure userid is unset
	unset($_SESSION["edit"]);	
	$_SESSION["states2"] = "";		// init state messages
	$_SESSION["firstlogin"] = "";
	$_SESSION["states"] = "";
	$_SESSION["states1"] = "";
	$_SESSION["error1"] = "";
	$_SESSION["error2"] = "";
	$_SESSION["error3"] = "";
	$_SESSION["error4"] = "";
	$_SESSION["error5"] = "";

	include './includes/db.inc.php';
	
	
	if (!isset($_SESSION["logintimes"])) {
    	$_SESSION["logintimes"] = "";
	}
	if(isset($_POST['action']) and $_POST['action'] == 'Signin'){
	  	try
		{
		$sql = 'SELECT userid FROM user_info WHERE userid = :userid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':userid',$_POST['login_name']);	
		$s->execute();
		}
		catch (PDOException $e){
		$error = 'Error select.';
		header("Location: ./includes/error.html.php");
		exit(); 
		}
		$row = $s->fetch();

		// check account exist or not
		if(!$row['userid']){
			$_SESSION["logintimes"] = "Account doesn't exist!";
			header("Location: .");
		}else{
			try
			{
				// check the pair of account and psw correct or not
				$sql = 'SELECT * FROM user_info WHERE userid = :userid AND userpwd = :userpwd';
				$s = $pdo->prepare($sql);
				$s->bindValue(':userid',$_POST['login_name']);	
				$s->bindValue(':userpwd',$_POST['login_psw']);	
				$s->execute();
			}
			catch (PDOException $e){
				$error = 'Error select.';
				header("Location: ./includes/error.html.php");
				exit(); 
			}
			$row = $s->fetch();
			if(!$row['userid']){
				$_SESSION["logintimes"] = "Password isn't correct!";
				header("Location: .");
			}else{
				$_SESSION["groupid"] = $row['groupid'] ;
				$_SESSION["position"] = $row['position'] ;
				switch ($row['position']){
					case 'admin':
						header("Location: ./dashboard/administ");
						break;  
					default:
						$_SESSION["userid"] = $row['userid'];	// init filter message
						$_SESSION["namefilter"] = "all";
						$_SESSION["timefilter"] = "36500";
						$_SESSION["splitnum"] = 10;
						$_SESSION["pagenum"] = 1;
						// check default psw for new user login
						if(test_input($_POST['login_psw']) == '123456'){
							$_SESSION["firstlogin"] = "You need to edit your information first!";
							header("Location: ./newuser.php");
						}else header("Location: ./dashboard");
				}
			}
		}
	}

include 'login.html.php';

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
