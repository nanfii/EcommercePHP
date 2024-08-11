 <h2 class="recent-order">users list</h2>

 <?php 
    
  $select_order = "SELECT * FROM `user`";
  $result = mysqli_query($con,$select_order);
  $row_count = mysqli_num_rows($result);
  if ($row_count == 0) {
    echo "<h1>no order</h1>";
  }
  else{
echo "
<table>
    <thead>
        <tr>
            <th>s n</th>
            <th>name</th>
            <th>email</th>
            <th>address</th>
            <th>contact</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
";
      $number = 1;
      while($row = mysqli_fetch_array($result)){
          $user_id = $row['user_id'];
          $username = $row['username'];
          $user_email = $row['user_email'];
          $user_image = $row['user_image'];
          $user_address = $row['user_address'];
          $user_mobile = $row['user_mobile'];
          ?>
 <tr>
     <td><?php echo $number?></td>
     <td><?php echo $username ?></td>
     <td><?php echo $user_email ?></td>
     <!-- <td> <img src="../users/users_image/<?php echo $user_image ?>" alt="<?php echo $user_image ?>"></td> -->
     <td><?php echo  $user_address ?></td>
     <td><?php echo  $user_mobile ?></td>
     <!-- <td class="discarded"><a href='index.php?delete_users=<?php echo $user_id ?>'>delete</a></td> -->


 </tr>
 <?php
      $number++;
    }
}
    ?>
 </tbody>
 </table>