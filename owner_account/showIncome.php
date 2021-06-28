<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>

<?php
		$begin_date = $_POST['begin_date'];
		$end_date = $_POST['end_date'];
		$search = $mysqli->query(  "SELECT order_id, order_date, SUM(selling_price*order_list.quantity) AS summa, 
										SUM((selling_price-purchase_price)*order_list.quantity) AS income 
									FROM `order` 
										JOIN order_list USING (order_id) 
										JOIN items USING (item_id) 
										JOIN supply USING (item_id) 
										JOIN supplier USING (supplier_id)
									WHERE order_date BETWEEN CAST('$begin_date' AS DATE) AND CAST('$end_date' AS DATE)
									GROUP BY order_id, order_date");
		$orders_res = $mysqli->query(  "SELECT COUNT(order_id)
										FROM `order` 
											JOIN order_list USING (order_id) 
											JOIN items USING (item_id) 
											JOIN supply USING (item_id) 
											JOIN supplier USING (supplier_id)
										WHERE order_date BETWEEN CAST('$begin_date' AS DATE) AND CAST('$end_date' AS DATE)
										GROUP BY order_id");
		$ord_num = $orders_res->fetch_array();
		$order_number = intval($ord_num[0]);
		$income_res = $mysqli->query(  "SELECT SUM((selling_price-purchase_price)*order_list.quantity)
										FROM `order` 
											JOIN order_list USING (order_id) 
											JOIN items USING (item_id) 
											JOIN supply USING (item_id) 
											JOIN supplier USING (supplier_id)
										WHERE order_date BETWEEN CAST('$begin_date' AS DATE) AND CAST('$end_date' AS DATE)");
		$inc_num = $income_res->fetch_array();
		$income = intval($inc_num[0]);
?>
</br>

	<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">ID заказа</th>
					<th scope="col">Дата заказа</th>
					<th scope="col">Сумма заказа</th>
					<th scope="col">Прибыль от заказа</th>
				</tr>
			</thead>
			<tbody>		
<?php		
	$orders = array();
	for ($i=0; $i<$order_number; $i++){
		$row = $search->fetch_assoc(); 
		$orders[] = $row;
	}
			foreach ($orders as $order): {
?>
				  <tr>
					<td><?php echo $order['order_id']; ?></td>
					<td><?php echo $order['order_date']; ?></td>
					<td><?php echo $order['summa']; ?></td>
					<td><?php echo $order['income']; ?></td>	
				  </tr>
<?php
			}
?><?php endforeach; ?>
			</tbody>
		</table>
		<div class="total-price">Прибыль за указанный период: <?php echo $income?> руб.</div>
	</div>
</div>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>