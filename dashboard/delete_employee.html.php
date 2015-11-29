<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
  <title>JSDropdown</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <meta name="GENERATOR" content="Microsoft FrontPage 4.0">
  <meta name="ProgId" content="FrontPage.Editor.Document">
  <meta name="Originator" content="Microsoft Visual Studio .NET 7.1">

  </head>
  <body>


    <form action="" method="post">

    <select style="height:40px;width:300px" id="s1" name="s1"  >
    <option selected></option>
    </select>
    <span class="error"> * <?php echo $_SESSION["error2"]; $_SESSION["error2"] = ""; ?></span>
    <br>

    <select style="height:40px;width:300px" id="s2" name="s2"  >
    <option selected></option>
    </select>
    <span class="error"> * <?php echo $_SESSION["error3"]; $_SESSION["error3"] = ""; ?></span>
    <br><br><br>    

    <!-- <input style="height:40px;width:300px" type="text" name="reason"> -->
    <button type="submit"  name="action" value="Submit">Submit</button>
    </form>

  </body>

   

  <script language="javascript">

  var delarray = <?php echo json_encode($del_employee); ?>;
  document.write((delarray);
  var del_em=new CLASS_YAO(delarray)         // Set data array
  del_em.firstSelectChange("root","s1");      // Set first SELECT column
  del_em.subSelectChange("s1","s2");          // Set second level SELECT column
  </script>
</html>
