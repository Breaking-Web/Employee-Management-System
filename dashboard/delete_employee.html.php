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
<script language="javascript" >
    
  function CLASS_del(array)
  {
    // Get the data array
    this.array=array; 
    this.indexName='';
    this.obj='';
    // Set subSELECT :selectName1 is onchange SELECT ID , selectName2 is what will be SELECT
    this.subSelectChangedel=function(selectName1,selectName2)
    {

      var obj1=document.all[selectName1];
      var obj2=document.all[selectName2];
      var objName=this.toString();
      var me=this;
      obj2.options[0]=new Option("Please select time first",'');
      obj1.onchange=function()
      {
        me.optionChangedel(this.options[this.selectedIndex].value,obj2.id,2)
      }

    }
    // Set first SELECT column : indexName is what user SELECT , selectName is SELECT's ID
    this.firstSelectChangedel=function(indexName,selectName)  
    {
      this.obj=document.all[selectName];
      this.indexName=indexName;
      this.optionChangedel(this.indexName,this.obj.id,1)

    }
  
    // indexName is the value return from first select, selectName is SELECT's ID
    this.optionChangedel=function (indexName,selectName,type)
    {
      var obj1=document.all[selectName];
      var me=this;
      obj1.length=0;
      // type 1: time  type 2: people
      if(type == 1) obj1.options[0]=new Option("Please select your prefer time",'');
      else obj1.options[0]=new Option("Please select people",'');
        for(var i=0;i<this.array.length;i++)
        { 
          if(this.array[i][1]==indexName)
          {
          obj1.options[obj1.length]=new Option(this.array[i][2],this.array[i][0]);
          }
        }
    }
  }
  </script>
    <script language="JavaScript">
    function confirm_del(){
      return confirm("Confirm delete this employee?");
    }
    </script>

  </head>
  <body>
  <div class="col-lg-4 col-md-12">
    <div class="panel bk-widget bk-border-off bk-noradius">
      <div class="panel-heading bk-bg-warning">
        <div class="row">
          <div class="col-xs-8 text-left bk-vcenter">
            <h6 class="bk-margin-off">Fire Employee</h6>
          </div>
          <div class="col-xs-4 bk-vcenter text-right">
            <i class="fa fa-users"></i>
          </div>
        </div>
      </div>
      <div class="panel-body bk-bg-white bk-padding-off-top bk-padding-off-bottom">
        <div class="col-xs-8 bk-vcenter text-center bk-padding-top-10 bk-padding-bottom-10">
        <form action="" method="post" onsubmit="return confirm_del()">

        <select style="height:40px;width:300px" id="y1" name="y1"  >
        <option selected></option>
        </select>
        <span class="error"> * <?php echo $_SESSION["error2"]; $_SESSION["error2"] = ""; ?></span>
        <br>

        <select style="height:40px;width:300px" id="y2" name="y2"  >
        <option selected></option>
        </select>
        <span class="error"> * <?php echo $_SESSION["error3"]; $_SESSION["error3"] = ""; ?></span>
        <br><br><br>    
        <div align="center">
        <!-- <input style="height:40px;width:300px" type="text" name="reason"> -->
        <button type="submit"  name="actiondel" value="Submit" class="btn btn-primary hidden-xs">Submit</button>
      </div>
        </form>
        </div>
      </div>
    </div>
  </div>

    

  </body>

   

  <script language="javascript">

  var delarray = <?php echo json_encode($del_employee); ?>;
  var del_em=new CLASS_del(delarray);         // Set data array
  del_em.firstSelectChangedel("root","y1");      // Set first SELECT column
  del_em.subSelectChangedel("y1","y2");          // Set second level SELECT column
  </script>
</html>
