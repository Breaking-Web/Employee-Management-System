<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>target summaries page</title>
  </head>
  <body>
    <p>target summaries page</p>
    <?php echo getcwd() . " here " ; ?>
    <form action="." method="post">
	<button type="submit"  name="action" value="Back">Back</button>
	</form>


    <p> <?=$summary?></p>



  </body>
</html>
