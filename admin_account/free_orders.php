<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
	require_once("C:\Server\OpenServer\domains\localhost\shop\main_pageheader.php");
?>
			<form action="take_order.php" method="POST" name="take_order">
				<table class="table table-bordered" align="center">
					<thead>
						<tr>
							<th scope="col">ID заказа</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$search = $mysqli->query("SELECT order_id FROM `order` WHERE manager_id IS NULL");
							$orders= array();
							while($row = $search->fetch_assoc()){ 
								$orders[] = $row;
							}
							foreach ($orders as $order): {
						?>
								<tr>
								<th scope="row">
								<?php $_SESSION['order_id']=$order['order_id']; echo $order['order_id']; ?>
									</th>
								<td>
									<input
										type="submit"
										id="but"
										class="btn btn-primary btn-sm"
										value="Взять заказ"
										name="take_order"
									>
								</td>
								</tr>
						<?}
						?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</form>
		</div>
	</div>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>