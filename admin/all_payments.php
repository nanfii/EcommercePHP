 <h2 class="recent-order">all payments</h2>
 <?php 
  $select_order = "SELECT * FROM `user_payment`";
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
            <th>invoice</th>
            <th>amount</th>
            <th>payment mode</th>
            <th>order date</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
";
      $number = 1;
      while($row = mysqli_fetch_array($result)){
          $order_id = $row['order_id'];
          $invoice_number = $row['invoice_number'];
          $amount = $row['amount'];
          $payment_mode = $row['payment_mode'];
          $order_date = $row['date'];
          ?>
 <tr>
     <td><?php echo $number?></td>
     <td><?php echo $invoice_number ?></td>
     <td><?php echo $amount ?></td>
     <td><?php echo $payment_mode ?></td>
     <td><?php echo $order_date ?></td>
     <!-- <td class="discarded"><a href="">delete</a></td> -->
 </tr>
 <?php
      $number++;
    }
}
    ?>
 </tbody>
 </table>