<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
	<div class="col-lg-4 col-md-12">
		<div class="panel bk-widget bk-border-off bk-noradius">
			<div class="panel-body bk-bg-white bk-padding-off-top bk-padding-off-bottom">
				<div class="row">
					<div class="col-xs-9 bk-vcenter">
						<h5 class="bk-fg-primary bk-margin-off-bottom"></h5>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Mean evaluation</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($groupeva as $personeva): ?>
										<tr>
											<td><?php echo $personeva['1'];?></td>
											
											<td><?php echo $personeva['2'];?></td>										                                
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	




  </body>
</html>


