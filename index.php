<?php
// echo session_save_path();
// ini_set('session.save_path', '/tmp');
session_start();
//setcookie("userid",NULL,time()-3600,"/");
//$_SESSION["userid"]=0;
unset($_SESSION["userid"]);
unset($_SESSION["edit"]);

	include '/home/jingyam/public_html/662/project/includes/db.inc.php';



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
		header("Location: /includes/error.html.php");
		exit(); 
		}
		$row = $s->fetch();


		if(!$row['userid']){
			$_SESSION["logintimes"] = "Account doesn't exist!";
			header("Location: .");
		}else{
			try
			{

			$sql = 'SELECT userid FROM user_info WHERE userid = :userid AND userpwd = :userpwd';
			$s = $pdo->prepare($sql);
			$s->bindValue(':userid',$_POST['login_name']);	
			$s->bindValue(':userpwd',$_POST['login_psw']);	
			$s->execute();
			}
			catch (PDOException $e){
			$error = 'Error select.';
			header("Location: /includes/error.html.php");
			exit(); 
			}
			$row = $s->fetch();
			$_SESSION["groupid"] = $dashrow['groupid'] ;
			$_SESSION["position"] = $dashrow['position'] ;
			switch ($dashrow['position'])
				{
					case 'admin':
					header("Location: ./dashboard/administ");
					break;  
					default:
					if($row['userid']){
					$_SESSION["userid"] = $row['userid'];
					$_SESSION["namefilter"] = "all";
					$_SESSION["timefilter"] = "36500";
					$_SESSION["splitnum"] = 10;
					$_SESSION["pagenum"] = 1;
				
					if(test_input($_POST['login_psw']) == '123456'){
					$_SESSION["firstlogin"] = "You need to edit your information first!";
					header("Location: ./editinfo/newuser.php");
						}else header("Location: ./dashboard");

						}else{
					$_SESSION["logintimes"] = "Password isn't correct!";
					header("Location: .");
					break;
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





