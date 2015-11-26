<!DOCTYPE html>
<html lang="en">
  <head>
    <script language="JavaScript">
    function confirm_info(){
      return confirm("Confirm submission?");
    }
    </script>

    <meta charset="utf-8">
  </head>
  <body>
    <h4>evaluation page</h4>


    <?php foreach ($names as $name): ?>
    <?php 
    echo "<h3>".$name[1]."<h3>"; 
    if($name[2] == ""){
      echo "<div>";
      $content = " No summary yet.";
    }else{
      $fp = fopen($name[2], 'r'); $content = fread($fp, 30);
      echo "<div style=cursor:pointer; onmouseover=\"this.style.cursor='hand'\"; onclick=\"window.location.href= 'evaluation/eshowotargetsummary.php?path=" .$name[2] . "';return false\">";
    }
    ?>
    <p><?php echo "Preview: ".$content."<br>"; ?></p>
    </div>

    <form name = "evaluationform" action="evaluation/insert.php" method="post" onsubmit="return confirm_info()">
    <input hidden name = "evaluatedone" id = "evaluatedone" value = "<?php echo $name[0];?>" class="btn btn-primary hidden-xs">
    <br/>
<!--     <input name="evaluation" type="text" id="evaluation" value="evaluation 0-10" size="30"   
          onmouseover=this.focus();this.select();   
          onclick="if(value==defaultValue){value='';this.style.color='#000'}"   
          onBlur="if(!value){value=defaultValue;this.style.color='#999'}" style="color:#999" /> -->


    <input type="radio" name="evalue" value="1" /> 1
    <input type="radio" name="evalue" value="2" /> 2
    <input type="radio" name="evalue" value="3" /> 3
    <input type="radio" name="evalue" value="4" /> 4
    <input type="radio" name="evalue" value="5" /> 5
    <input type="radio" name="evalue" value="6" /> 6
    <input type="radio" name="evalue" value="7" /> 7
    <input type="radio" name="evalue" value="8" /> 8
    <input type="radio" name="evalue" value="9" /> 9
    <input type="radio" name="evalue" value="10" /> 10

    <button type="submit"  value="Submitevaluation" name="action">Submit</button>
    </form>

    <?php endforeach; ?>

  </body>
</html>


