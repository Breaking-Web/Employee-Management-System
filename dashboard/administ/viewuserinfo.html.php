<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>admin view</title>
  </head>
  <body>
    <h4>admin view</h4>

    <form action="?" method="post">

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Userid</th>
            <th>UserName</th>
            <th>UserPassword</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Modify</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($allusers as $oneuser): ?>
            <tr>
              <td><?php echo $oneuser['userid'];?></td>
              <td> <input type="text" name="username" value="<?php echo $oneuser['username'];?>"></td>
              <td> <input type="text" name="userpwd" value="<?php echo $oneuser['userpwd'];?>"></td>
              <td> <input type="text" name="phone" value="<?php echo $oneuser['phone'];?>"></td>
              <td> <input type="text" name="email" value="<?php echo $oneuser['email'];?>"></td>
              <td> <input type="text" name="address" value="<?php echo $oneuser['address'];?>"></td>   
              <td><button type='submit'  name='action' value='<?php echo $oneuser['userid']; ?>' class='btn btn-primary hidden-xs'>Modify</button></td>
              <!-- <td><button class="btn btn-primary hidden-xs" type="submit"  name="Request" value="Submit">Modify</button></td>                                              -->
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </form>




  </body>
</html>
