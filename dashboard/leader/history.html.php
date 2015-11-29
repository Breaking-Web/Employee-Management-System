<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

  </head>
  <body>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Time</th>
					<th>Reason</th>
					<th>State</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($applicationinfo as $one): ?>
					<tr>
						<td><?php echo $one['0'];?></td>
						<td><?php echo $one['1'];?></td>
						<td><?php echo $one['2'];?></td>
						<td><?php echo $one['3'];?></td>                           
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


  </body>
</html>


