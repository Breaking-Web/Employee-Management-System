<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="panel bk-widget bk-webkit-fix">
								<div class="panel-heading bk-bg-primary bk-border-info">
									<div class="row">
										<div class="col-xs-8 text-left bk-vcenter">
											<h6 class="bk-margin-off">Evaluation of This Month</h6>
										</div>							
									</div>
								</div>
								<div class="panel-body bk-bg-white bk-border-white text-center bk-padding-off">
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
  </body>
</html>


