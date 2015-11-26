<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>evaluation page</title>
  <style> 
  .div-a{ float:left;width:120px; height:120px; border-radius:50%; overflow:hidden; align: center;border:1px solid #F00} 
  .div-d{ float:right;width:49%;border:1px solid #000} 
  </style> 


  </head>
  <body>
    <p>memberinfo page</p>


    <?php foreach ($memberinfo as $one): ?>
    
                  <div class="row">
                    <div class="col-xs-3 bk-vcenter text-center bk-padding-top-10 bk-padding-bottom-10">
                      <a href="#" class="bk-avatar">
                        <img src="<?php echo $one[3]; ?>" alt="" class="img-circle bk-img-60 bk-border-primary bk-border-2x bk-border-darken">
                      </a>
                    </div>
                    <div class="col-xs-9 bk-vcenter">
                      <h5 class="bk-fg-primary bk-margin-off-bottom"><div class="point point-success point-lg"></div><?php echo $one[1];?></h5>
                      <p>
                        <?php echo "email: ".$one[2];?>                                    
                      </p>
                    </div>
                  </div>

    <?php endforeach; ?>

  </body>
</html>


