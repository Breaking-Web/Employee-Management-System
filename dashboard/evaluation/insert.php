<?php
	session_start();

  include '../../includes/db.inc.php';

	if(isset($_POST['action']) and $_POST['action'] == 'Submitevaluation'){



    	$time = time();
    	$date = date("y-m-d h:i:s",$time);
        try
        {
          $sql = 'SELECT MAX(eid) AS maxeid FROM evaluation'; 
          $s = $pdo->prepare($sql);
          $s->execute();
          
        }
        catch (PDOException $e)
        {
          echo $e;
          $error = 'Error updating submitted user.';
          include '../../includes/error.html.php';
          exit();
        }
        if($temp = $s->fetch()){
          $neweid = $temp['maxeid'] +1;
        }else{
          $neweid = 1;
        }
        // echo $neweid;
        try
        {
          $sql = 'INSERT INTO evaluation SET
                    eid = :eid,
                    userid = :userid,
                    evale = :evale,
                    userid2 = :userid2,
                    time = :time'; 
          $s = $pdo->prepare($sql);
          $s->bindValue(':eid', $neweid);
          $s->bindValue(':userid', $_POST['evaluatedone']);
          $s->bindValue(':evale', $_POST['evalue']);
          $s->bindValue(':userid2', $_SESSION["userid"]);
          $s->bindValue(':time', $date);
          $s->execute();
        }
        catch (PDOException $e)
        {
          echo $e;
          $error = 'Error updating submitted user.';
          include '../../includes/error.html.php';
          exit();
        }


	}	
	header("Location: ../page-evaluation.html.php");
?>