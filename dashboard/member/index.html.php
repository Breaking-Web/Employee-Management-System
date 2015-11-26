<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
	<div class="col-lg-4 col-md-12">
		<div class="panel bk-widget bk-border-off bk-noradius">
			<div class="panel-heading bk-bg-primary">
				<div class="row">
					<div class="col-xs-8 text-left bk-vcenter">
						<h6 class="bk-margin-off">MEMBER ONLINE</h6>
					</div>
					<div class="col-xs-4 bk-vcenter text-right">
						<i class="fa fa-users"></i>
					</div>
				</div>
			</div>
			<div class="panel-body bk-bg-white bk-padding-off-top bk-padding-off-bottom">


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

			</div>
			<div class="panel-body bk-bg-very-light-gray bk-padding-top-5 bk-padding-bottom-5 ">
				<div class="row">
					<div class="col-xs-6">
						<a href="index.php?page=<?php echo $prev;?>" class="bk-fg-textcolor"><small><i class="fa fa-angle-left"></i> PREVIOUS</small></a>
					</div>
					<div class="col-xs-6 text-right">
						<a href="index.php?page=<?php echo $next;?>" class="bk-fg-textcolor"><small>NEXT <i class="fa fa-angle-right"></i></small></a>
					</div>
				</div>
			</div>
		</div>
	</div>	




  </body>
</html>


