<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>evaluation page</title>
  </head>
  <body>
    <p>memberinfo page</p>


    <?php foreach ($memberinfo as $one): ?>
    <img src="<?php echo $one[3]; ?>" onload='if (this.width>120 || this.height>120) if (this.width/this.height<120/120) this.width=120; else this.height=120;'  alt = "<?php echo $one[1]."'s icon"; ?>"  />
    <?php endforeach; ?>

  </body>
</html>


