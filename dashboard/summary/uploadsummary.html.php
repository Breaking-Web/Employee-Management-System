<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>upload summary page</title>
  </head>
  <body>
    <p>upload summary page</p>


    <!-- upload file form -->
    <?php echo $_SESSION["states1"]; $_SESSION["states1"] = ""; ?>
    <form action="summary/upload_file.php" method="post"
    enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file" /> 
    <br />
    <input type="submit" name="submit" value="Submit" />
    </form>


    <!-- back form -->
    <form action=" ../dashboard" method="post">
    <button type="submit"  name="action" value="0">Back to dashboard</button>
    </form>

  </body>
</html>

