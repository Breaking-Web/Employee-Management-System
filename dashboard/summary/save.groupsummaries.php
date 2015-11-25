<?php

    //session_start();
    include '/home/jingyam/public_html/662/project/includes/db.inc.php';

    $target_dir =  "uploadfile";

    $timefilter = $namefilter = $splitnum = array();


	$timefilter[] = array("36500","all");
    $timefilter[] = array("30","this month");
	$timefilter[] = array("91","last three months");
	$timefilter[] = array("182","last six months");
	$timefilter[] = array("365","this year");
	
	
	$splitnum[] = "2"; //30
	$splitnum[] = "4"; //20
	$splitnum[] = "6"; //10 

	try
	{
		$sql = 'SELECT * FROM user_info WHERE groupid = :groupid and userid != :userid ORDER BY userid DESC';  	
      	$s = $pdo->prepare($sql);
      	$s->bindValue(':groupid', $_SESSION["groupid"]);
      	$s->bindValue(':userid', $_SESSION["userid"]);
      	$s->execute();

	}
	catch (PDOException $e){
		$error = 'Error select.';
		header("Location: /includes/error.html.php");
		exit(); 
	}
	$namefilter[] = array("all","all");
	while($auser = $s->fetch()){
		$namefilter[]= array($auser["userid"],$auser["username"]);
	}

   	// 	echo "hjaha";

	if($_SESSION["namefilter"] == "all" && $_SESSION["timefilter"] == "36500"){
   		echo "1123243"."<br>";
		try
		{
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid != :userid
				ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':groupid', $_SESSION["groupid"]);
	      	$s->bindValue(':userid', $_SESSION["userid"]);
	      	$s->execute();

		}
		catch (PDOException $e){
			$error = 'Error select.';
			header("Location: /includes/error.html.php");
			exit(); 
		}

   	}else if ($_SESSION["namefilter"] == "all" ){
   		echo "123444321"."<br>";
   		echo  $_SESSION["namefilter"]."<br>";
   		echo  $_SESSION["timefilter"]."<br>";
		try
		{
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid != :userid AND 
				datediff(  last_day(curdate() ), time ) < :timefilter ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':groupid', $_SESSION["groupid"]);
	      	$s->bindValue(':userid', $_SESSION["userid"]);
	      	$s->bindValue(':timefilter', $_SESSION["timefilter"]);
	      	$s->execute();

		}
		catch (PDOException $e){
			echo $e;
			// header("Location: /includes/error.html.php");
		}
   	}else{
   		echo "4442312"."<br>";
   		echo  $_SESSION["namefilter"]."<br>";
   		echo  $_SESSION["timefilter"]."<br>";
		try
		{
			$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid AND summary.userid = :userid AND 
				datediff(  last_day(curdate() ), time ) < :timefilter ORDER BY time DESC, summary.userid ASC';  	
	      	$s = $pdo->prepare($sql);
	      	$s->bindValue(':groupid', $_SESSION["groupid"]);

	      	$s->bindValue(':userid', $_SESSION["namefilter"]);
	      	$s->bindValue(':timefilter', $_SESSION["timefilter"]);
	      	$s->execute();

		}
		catch (PDOException $e){
			echo $e;
			// header("Location: /includes/error.html.php");
		}
   	}
	$groupsummarypreview = array();
	while($eachtitle = $s->fetch()){

		$path = searchFile($target_dir, $eachtitle["title"] ); 
      	$year = substr($path,21,4); 
      	$month = substr($path,strrpos($path,'_')+1,-4); 
      	$groupsummarypreview[] = array($eachtitle["username"],$year,$month,$path);
	}



   	// if(isset($_POST['action']) and $_POST['action']=='changefilter' and ($_POST['splitnum'] != '6' or $_POST['timefilter'] != 'all' or $_POST['namefilter'] != 'all')){
  //  	if(isset($_POST['action']) and $_POST['action']=='changefilter'){
		// echo $_POST['splitnum']." ". $_POST['namefilter']." ".$_POST['timefilter']."<br>";
  //  		// header("www.baidu.com");
  //  		echo "nothing";
  //  		// echo "hjaha";
  //  		// $_SESSION["splitnum"] = $_POST["splitnum"];
  //  		// $_SESSION["namefilter"] = $_POST["namefilter"];
  //  		// $_SESSION["timefilter"] = $_POST["timefilter"];

		// // try
		// // {
		// // 	$sql = 'SELECT * FROM summary INNER JOIN user_info ON summary.userid = user_info.userid WHERE groupid = :groupid ORDER BY time DESC, summary.userid ASC LIMIT 2';  	
	 // //      	$s = $pdo->prepare($sql);
	 // //      	$s->bindValue(':groupid', $_SESSION["groupid"]);
	 // //      	$s->execute();

		// // }
		// // catch (PDOException $e){
		// // 	$error = 'Error select.';
		// // 	header("Location: /includes/error.html.php");
		// // 	exit(); 
		// // }
		// // $groupsummarypreview = array();
		// // while($eachtitle = $s->fetch()){

		// // 	$path = searchFile($target_dir, $eachtitle["title"] ); 
	 // //      	$year = substr($path,21,4); 
	 // //      	$month = substr($path,strrpos($path,'_')+1,-4); 
	 // //      	$groupsummarypreview[] = array($eachtitle["username"],$year,$month,$path);
		// // }


		// // header("Location: .");	//return to login page
  //  	}

  //  	echo "11111";
	include 'groupsummaries.html.php';


?>
