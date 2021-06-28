<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
			</br>
			<div class="title">
				<h2>Заказы</h2>
			</div>
			</br>
						
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">ID заказа</th>
						<th scope="col">Дата заказа</th>
						<th scope="col">Дата оплаты и получения</th>
						<th scope="col">Статус</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				
				<?
				$buyer_email = $_SESSION['email'];
				$orders = array();
				$search = $mysqli->query("SELECT order_id, order_date, payment_date FROM `order` JOIN `buyer` ON `order`.buyer_id=`buyer`.buyer_id WHERE email='$buyer_email' ORDER BY order_date ASC");
				while($row = $search->fetch_assoc()){ 
					$orders[] = $row;
				}
				foreach ($orders as $order): {
					?>
				<form 	id="form<?php echo $order['order_id']; ?>"
						name="form<?php echo $order['order_id']; ?>"
						action="cancel.php"
						method="POST">
					<tr>
					<th scope="row"><a href="orderlist.php?result=<?php echo $order['order_id']?>"><?php echo $order['order_id']; ?></a></th>
					<td>
                        <?php echo $order['order_date']; ?>
					</td>
					<td>
						<?php echo $order['payment_date'];?>
					</td>
					<td>
					    <?php
							$id = $order['order_id'];
							$pay_str = $mysqli->query("SELECT payment_date FROM `order` WHERE order_id='$id'");
							$pay_arr = mysqli_fetch_assoc($pay_str);
							$pay_date = $pay_arr['payment_date'];
							$ord_str = $mysqli->query("SELECT order_date FROM `order` WHERE order_id='$id'");
							$ord_arr = mysqli_fetch_assoc($ord_str);
							$ord_date = $ord_arr['order_date'];
							if ($ord_date >= date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')))){
								echo 'Просрочен';
							} else if (empty($pay_date)) {
								echo "Оформлен";
							}else{echo "Оплачен";}
						?>
					</td>
					<td>
<?php
						if (empty($pay_date) && $ord_date < date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 7, date('Y')))) {
?>
							<input
								data-toggle="modal" data-target="#Modal<?php echo $order['order_id']; ?>"
								type="button"
								class="btn btn-danger btn-sm"
								name="btn_delete"
								value="Отменить заказ"
							>
							<div class="modal fade" id="Modal<?php echo $order['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Вы точно хотите отменить заказ?<br>Это действие необратимо<h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<input type="hidden" name="id" id="id" value="<?php echo $order['order_id']; ?>">
										<div class="modal-body">
											ID заказа: <?php echo $order['order_id']; ?><br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
											<button type="submit" name="btn_delete" class="btn btn-primary">Да</button>
										</div>
									</div>
								</div>
							</div>
<?
						;}
?>
					</td>
				</tr>
				</form>
				<?}
				?>
			<?php endforeach; ?>
			</table>
			
        </div>
    </div>
	<script>
		function deleteProduct(val) {
			alert()
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		</div>
	</div>
<?php
	require_once("footer.php");
?>