<!DOCTYPE html>
<html lang="en">
  <head>
    <script language="JavaScript">
    function confirm_info(){
      return confirm("Confirm submission?");
    }
    </script>

    <meta charset="utf-8">
    <title>evaluation page</title>
  </head>
  <body>
    <p>evaluation page</p>

    <form action=".." method="post">
    <button type="submit"  name="action" value="Back">Back</button>
    </form>


    <?php foreach ($names as $name): ?>
    <?php echo $name[0]; $fp = fopen($name[1], 'r'); $content = fread($fp, 30); ?>
    <?php 

    if($content == ""){
      echo "<div>";
      $content = " No summary yet.";
    }else{
      echo "<div style=cursor:pointer; onmouseover=\"this.style.cursor='hand'\"; onclick=\"window.location.href= 'eshowotargetsummary.php?path=" .$name[1] . "';return false\">";
    }
    ?>
    <p><?php 
    
      echo "Preview: ".$content."<br>";     // read limited bytes

      ?></p>
    </div>

    <form name = "evaluationform" action="insert.php" method="post" onsubmit="return confirm_info()">
    <input hidden name = "evaluatedone" id = "evaluatedone" value = "<?php echo $name[0];?>">
    <input name="evaluation" type="text" id="evaluation" value="evaluation" size="30"   
          onmouseover=this.focus();this.select();   
          onclick="if(value==defaultValue){value='';this.style.color='#000'}"   
          onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999" />

    <button type="submit"  value="Submitevaluation" name="action">Submit</button>
    </form>

    <?php endforeach; ?>

  </body>
</html>


