<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>group summaries page</title>
  </head>
  <body>
    <br><br><br>
    <p>group summaries page</p>


    <form action="setfilter.php" method="post">
      <select  style="height:40px;width:300px" name = "timefilter", id = "timefilter">

        <?php foreach ($timefilter as $tf): ?>
        <option value="<?=$tf[0]?>"  <?php if($_SESSION["timefilter"] == $tf[0]) echo "selected";?> ><?=$tf[1]?></option>
        <?php endforeach; ?>
      </select>

      <select  style="height:40px;width:300px" name = "namefilter", id = "namefilter">
        <?php foreach ($namefilter as $nf): ?>
        <option value="<?=$nf[0]?>" <?php if($_SESSION["namefilter"] == $nf[0]) echo "selected";?> ><?=$nf[1]?></option>
        <?php endforeach; ?>
      </select>

      <select  style="height:40px;width:300px" name = "splitnum", id = "splitnum">
        <?php foreach ($splitnum as $sn): ?>
        <option value="<?=$sn?>" <?php if($_SESSION["splitnum"] == $sn) echo "selected";?> ><?=$sn?></option>
        <?php endforeach; ?>
      </select>

      <input type="submit" name="changefilter" value="changefilter" />
    </form>


    <?php foreach ($groupsummarypreview as $onesummary): ?>

      <div style=cursor:pointer; onmouseover="this.style.cursor='hand'"; onclick="window.location.href= 'showotargetsummary.php?path=<?php echo $onesummary[3]; ?>';return false">
      <p><?php 

      // [0] username [1] year [2] month [3] path

      echo "User: ".$onesummary[0]."<br>Year ".$onesummary[1]."  Month ".$onesummary[2]."<br>";
      $fp = fopen($onesummary[3], 'r'); $content = fread($fp, 30);
      echo "Preview: ".$content."<br>";     // read limited bytes

      ?></p>
      </div>
    <?php endforeach; ?>


    <?php echo "<div align='center'>Total " . $page . " pages (" . $page."/".$pages.")";

    if($page > 1){
      echo "<a href='index.php?page=" . $first ."'>[first]</a> ";
      echo "<a href='index.php?page=" . $prev ."'>[prev]</a> ";
    }
    if($page < $pages){
      echo "<a href='index.php?page=" . $next ."'>[next]</a> ";
      echo "<a href='index.php?page=" . $last ."'>[last]</a> ";
    }
    ?>


  </body>
</html>
