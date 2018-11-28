

<?php 
include('header.php');
?>

<body>
    <br>
    <br>
    <div class="container">
    	<div class="alert alert-success">Sum the Numbers in a Column</div>
    	<br />
    	<table  class="table table-striped table-bordered">
    		<thead>
    			<tr>
    				<th>Product Name</th>
    				<th>Quantity</th>
    				<th>Price</th>
    				<th>Amount</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
                $query=mysql_query("select * from product")or die(mysql_error());
                while($row=mysql_fetch_array($query)){
                    $id=$row['product_id'];
                    ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['Price'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            $result = mysql_query("SELECT sum(amount) FROM product") or die(mysql_error());
            while ($rows = mysql_fetch_array($result)) {
               ?>
               <div class="pull-right">
                  <div class="span">
                     <div class="alert alert-success"><i class="icon-credit-card icon-large"></i>&nbsp;Total:&nbsp;<?php echo $rows['sum(amount)']; ?></div>
                 </div>
             </div>
             <?php }
             
             $result1 = mysql_query("SELECT sum(qty) FROM product") or die(mysql_error());
             while ($rows1 = mysql_fetch_array($result1)) {
               ?>	
               <div class="pull-right">
                  <div class="span">
                     <div class="alert alert-info"><i class="icon-credit-card icon-large"></i>&nbsp;Total number of Items:&nbsp;<?php echo $rows1['sum(qty)']; ?></div>
                 </div>
             </div>
             <?php } ?>
         </div>
     </body>
     </html>