<?php
	session_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	if(isset($_POST['action']) and $_POST['action'] == 'Submitevaluation'){

		// echo $_POST['evaluation']."<br>";
		// echo $_POST['evaluatedone']."<br>";
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
          $error = 'Error updating submitted user.';
          include '/includes/error.html.php';
          exit();
        }
        if($s->fetch())	$neweid = $s->fetch() +1;
        else $neweid = 1;
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
          $s->bindValue(':evale', $_POST['evaluation']);
          $s->bindValue(':userid2', $_SESSION["userid"]);
          $s->bindValue(':time', $date);
          $s->execute();
        }
        catch (PDOException $e)
        {
          $error = 'Error updating submitted user.';
          include '/includes/error.html.php';
          exit();
        }


	}	
	header("Location: .");
?>