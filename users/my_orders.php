<?php 
if (isset($_SESSION['username'])) {
    # code...
    $username = $_SESSION['username'];
    $get_user = "select * from `user` where username = '$username'";
    
    $result = mysqli_query($con,$get_user);
    $row_fetch=mysqli_fetch_array($result);
    $user_id = $row_fetch['user_id'];
    ?>


<div class="order">
    <p class="recent-order">order</p>
    <div class="about-course">
        <table>
            <thead>
                <tr>
                    <th>s no</th>
                    <th>amount</th>
                    <th>products</th>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Comp/Incomp</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>

                <?php 
    $get_order_details = "select * from `user_order` where user_id=$user_id";
    $result_order_details = mysqli_query($con,$get_order_details);
    $number= 1;
    while ($row_orders=mysqli_fetch_assoc($result_order_details)) {
        $order_id = $row_orders['order_id'];
        $amount_due = $row_orders['amount_due'];
        $total_product = $row_orders['total_product'];
        $invoice_number = $row_orders['invoice_number'];
        $order_date = $row_orders['order_date'];
        $order_status = $row_orders['order_status'];
        if($order_status == 'pending'){
            $order_status = 'incomplete';
        } else {
            $order_status = 'complete';
        }
        
        echo "<tr>
        <td>$number</td>
        <td>$amount_due</td>
        <td>$total_product</td>
        <td>$invoice_number</td>
        <td>$order_date</td>
        
                <td>$order_status</td>";
        if($order_status == 'complete'){
            echo "<td class = 'accepted'>paid</td>";
        } else {
            echo "<td class='pending'><a href='confirm_payment.php?order_id=$order_id'>confirm</a></td>";
        }
        echo "</tr>";
        $number++;
    }
    echo "</table>";
?>
            </tbody>
        </table>

    </div>

</div>
<?php
}
?>