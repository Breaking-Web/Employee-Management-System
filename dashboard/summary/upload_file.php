<?php

session_start();
include '/home/jingyam/public_html/662/project/includes/db.inc.php';

$target_dir =  "uploadfile/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
$target_file = $target_dir .$_SESSION["userid"] ."_". date('Y')."_".date('m')."." . $FileType;

// Check file size
if ($_FILES["file"]["size"] > 500000) {
    $_SESSION["states1"] = $_SESSION["states1"] . "<br>" . "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "txt" ) {
    $_SESSION["states1"] = $_SESSION["states1"] . "<br>" . "Sorry, only TXT is allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $_SESSION["states1"] = $_SESSION["states1"] . "<br>" ."Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
      chmod($target_file,0644);
        $_SESSION["states1"] = $_SESSION["states1"] . "<br>" . "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";

    } else {
      $_SESSION["states1"] = $_SESSION["states1"] . "<br>" . "Sorry, there was an error uploading your file.";
      $uploadOk == 0;
    }
}

// insert into table summary
if($uploadOk == 1){ 
    $time = time();
    $date = date("y-m-d h:i:s",$time);

    try
    {
      $sql = 'SELECT * FROM summary WHERE userid = :userid AND title = :title'; 
      $s = $pdo->prepare($sql);
      $s->bindValue(':userid', $_SESSION["userid"]);
      $s->bindValue(':title', $_SESSION["userid"] ."_". date('Y')."_".date('m')."." . $FileType);
      $s->execute();
    }
    catch (PDOException $e)
    {
      $error = 'Error updating submitted user.';
      include '/home/jingyam/public_html/662/project/includes/error.html.php';
      exit();
    }

    $result = $s->fetch();
    if($result){    // update original one's time

        try
        {
          $sql = 'UPDATE summary SET time = :time WHERE sid = :sid'; 
          $s = $pdo->prepare($sql);
          $s->bindValue(':sid', $result["sid"]);
          $s->bindValue(':time', $date);
          $s->execute();
          
        }
        catch (PDOException $e)
        {
          $error = 'Error updating submitted user.';
          include '/home/jingyam/public_html/662/project/includes/error.html.php';
          exit();
        }

    }else{    // not exist, insert a new one

        // $sql = "SELECT MAX(sid) AS maxsid FROM summary ";

        try
        {
          $sql = 'SELECT MAX(sid) AS maxsid FROM summary'; 
          $s = $pdo->prepare($sql);
          $s->execute();
          
        }
        catch (PDOException $e)
        {
          $error = 'Error updating submitted user.';
          include '/home/jingyam/public_html/662/project/includes/error.html.php';
          exit();
        }

        $maxsummaryid = $s->fetch();

        try
        {
          $sql = 'INSERT INTO summary SET
                    sid = :sid,
                    userid = :userid,
                    title = :title,
                    fileroad = :fileroad,
                    time = :time'; 
          $s = $pdo->prepare($sql);
          $s->bindValue(':sid', $maxsummaryid["maxsid"]+1);
          $s->bindValue(':userid', $_SESSION["userid"]);
          $s->bindValue(':title', $_SESSION["userid"] ."_". date('Y')."_".date('m')."." . $FileType);
          $s->bindValue(':fileroad', $target_dir);
          $s->bindValue(':time', $date);
          $s->execute();
        }
        catch (PDOException $e)
        {
          $error = 'Error updating submitted user.';
          include '/home/jingyam/public_html/662/project/includes/error.html.php';
          exit();
        }
    }

}

header('Location: ../page-summary.html.php');

?>


