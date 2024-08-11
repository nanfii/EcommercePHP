 <h2 class="recent-order">all orders</h2>
 <?php 
  $select_order = "SELECT * FROM `user_order`";
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
            <th>due amount</th>
            <th>invoice</th>
            <th>total product</th>
            <th>order date</th>
            <th>status</th>
           
        </tr>
    </thead>
    <tbody>
";
      $number = 1;
      while($row = mysqli_fetch_array($result)){
          $order_id = $row['order_id'];
          $amount_due = $row['amount_due'];
          $invoice_number = $row['invoice_number'];
          $total_product = $row['total_product'];
          $order_date = $row['order_date'];
          $order_status = $row['order_status'];
          ?>
 <tr>
     <td><?php echo $number?></td>
     <td><?php echo $amount_due ?></td>
     <td><?php echo $invoice_number ?></td>
     <td><?php echo $total_product ?></td>
     <td><?php echo $order_date ?></td>
     <?php   if($order_status == 'complete'){
            echo "<td class = 'accepted'>paid</td>";
        } else {
            echo "<td class='pending'><a href='confirm_payment.php?order_id=$order_id'>confirm</a></td>";
        }
        echo "</tr>"; ?>
     <!-- <td class="discarded"><a href="">delete</a></td> -->
 </tr>
 <?php
      $number++;
    }
}
    ?>
 </tbody>
 </table>