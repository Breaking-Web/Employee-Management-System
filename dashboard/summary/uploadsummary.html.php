<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>upload summary page</title>
  </head>
  <body>
    <h4>Summary Upload</h4>


    <!-- upload file form -->
    <?php echo $_SESSION["states1"]; $_SESSION["states1"] = ""; ?>
    <form class="form-inline"action="summary/upload_file.php" method="post"
    enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <div class="form-group">
		<input type="file" name="file" id="file" /> 
		<div class="form-group" >
			<input type="submit" name="submit" value="Submit" class="btn btn-primary hidden-xs" />
		</div>
    </div>
    </form>


    <!-- back form -->

  </body>
</html>

