<table>

    <thead>
        <tr>
            <th>s no</th>
            <th>product name</th>
            <th>price</th>
            <th>status</th>
            <th>total in cart</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $select_products = "SELECT * FROM `products`";
        $result = mysqli_query($con,$select_products);
        $number = 1;
        while($row_product = mysqli_fetch_assoc($result)){
            $product_id = $row_product['product_id'];
            $product_title = $row_product['product_title'];
            $product_image1 = $row_product['product_image1'];
            $product_price = $row_product['product_price'];
            $product_status = $row_product['status'];
            $number++;
            ?>

        <tr>
            <td><?php echo $number?></td>
            <td><?php echo $product_title?></td>
            <td><?php echo  $product_price?></td>
            <td><?php echo $product_status?></td>
            <td>

                <?php
            $get_count = "SELECT * FROM `order_pending` where product_id=$product_id";
            $result_count = mysqli_query($con,$get_count);
            $rows_count=mysqli_num_rows($result_count);
            echo $rows_count;
            ?>
            </td>
            <td><a class=" ditale" href="index.php?edit_products=<?php echo $product_id ?>"><i
                        class="fas fa-edit"></i></a></td>
            <td><a class="discarded" href="index.php?delete_product=<?php echo $product_id ?>"><i
                        class="fas fa-trash"></i></a></td>
        </tr>
        <?php 
  
        
    }
        ?>


    </tbody>
</table>