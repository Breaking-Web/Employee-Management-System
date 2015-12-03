<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
    
    <?php echo $_SESSION["error1"]." ".$_SESSION["error2"]." ".$_SESSION["error3"]." ".$_SESSION["states"];?>
    <h4>admin view</h4>


    <form action="setfilter.php" method="post">
      <select  style="height:40px;width:300px" name = "groupfilter", id = "groupfilter">

        <?php foreach ($groupfilter as $gf): ?>
        <option value="<?=$gf[0]?>"  <?php if($_SESSION["targetgroup"] == $gf[0]) echo "selected";?> ><?=$gf[1]?></option>
        <?php endforeach; ?>
      </select>

      Begin_WorkId:<input type="text" id="beginuserid" name="beginuserid" value="<?=$_SESSION["beginuserid"]?>" onfocus="javascript:if(this.value=='<?=$_SESSION["beginuserid"]?>')this.value='';">
      End_WorkId:<input type="text" id="enduserid" name="enduserid" value="<?=$_SESSION["enduserid"]?>" onfocus="javascript:if(this.value=='<?=$_SESSION["enduserid"]?>')this.value='';">

      <select  style="height:40px;width:300px" name = "viewusersplitnum", id = "viewusersplitnum">
        <?php foreach ($viewusersplitnum as $vsn): ?>
        <option value="<?=$vsn?>" <?php if($_SESSION["viewusersplitnum"] == $vsn) echo "selected";?> ><?=$vsn?></option>
        <?php endforeach; ?>
      </select>

      <input type="submit" name="changefilter" value="changefilter" class="btn btn-primary hidden-xs" />
    </form>



    <form action="?" method="post">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Userid</th>
            <th>UserName</th>
            <th>UserPassword</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Modify</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($allusers as $oneuser): ?>
            <tr>
              <td><?php echo $oneuser['userid'];?></td>
              <td> <input type="text" id="username" name="<?php echo $oneuser['userid']."username"?>" value="<?php echo $oneuser['username'];?>"></td>
              
              <td> <input type="radio" name="<?php echo $oneuser['userid']."userpwd"?>" value="resetpsw">Reset password</td>
              <td> <input type="text" id="phone" name="<?php echo $oneuser['userid']."phone"?>" value="<?php echo $oneuser['phone'];?>"></td>
              <td> <input type="text" id="email" name="<?php echo $oneuser['userid']."email"?>" value="<?php echo $oneuser['email'];?>"></td>
              <td> <input type="text" id="address" name="<?php echo $oneuser['userid']."address"?>" value="<?php echo $oneuser['address'];?>"></td>   
              <td><button type='submit'  name='action' value='<?php echo $oneuser['userid']; ?>' class='btn btn-primary hidden-xs'>Modify</button></td>
          
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </form>

    <?php echo "<div align='center'>Total " . $page . " pages (" . $page."/".$pages.")";
    if($page > 1){
      echo "<h4><a href='index2.php?page=" . $first ."' style='color: #CC0000' >[first]</a> ";
      echo "<a href='index2.php?page=" . $prev ."' style='color: #CC0000'>[prev]</a></h4>  ";
    }
    if($page < $pages){
      echo "<h4><a href='index2.php?page=" . $next ."' style='color: #CC0000'>[next]</a>  ";
      echo "<a href='index2.php?page=" . $last ."' style='color: #CC0000'>[last]</a></h4>  ";
    }
    ?>


  </body>
</html>
