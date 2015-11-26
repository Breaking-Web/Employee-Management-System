<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>self summaries page</title>
  </head>
  <body>
    <h4>Self Summary</h4>



    <?php foreach ($summarypreview as $onesummary): ?>

      <div style=cursor:pointer; onmouseover="this.style.cursor='hand'"; onclick="window.location.href= 'summary/showotargetsummary.php?path=<?php echo $onesummary; ?>';return false">
      <p><?php 


      $year = substr($onesummary,29,4); 
      $month = substr($onesummary,strrpos($onesummary,'_')+1,-4); 

      echo "Year ".$year."  Month ".$month."<br>";
      $fp = fopen($onesummary, 'r'); $content = fread($fp, 30);
      echo "Preview: ".$content."<br>";     // read limited bytes


      ?></p>
      </div>
    <?php endforeach; ?>

  </body>
</html>
