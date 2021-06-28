<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">ID заказа</th>
						<th scope="col">Дата заказа</th>
						<th scope="col">Дата оплаты и получения</th>
						<th scope="col">Статус</th>
						<th scope="col">Покупатель</th>
						<th scope="col">Контакты для связи</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				
				<?
				$man_id = $_SESSION['emp_email'];
				$orders = array();
				$search = $mysqli->query("SELECT order_id, order_date, payment_date, CONCAT(buyer.lastname, ' ', buyer.name, ' ', buyer.patronymic) buyer, CONCAT(buyer.email, ' ', IFNULL(phone_number, '')) contacts FROM `order` JOIN `buyer` ON `order`.buyer_id=`buyer`.buyer_id JOIN employee ON `order`.manager_id=employee.employee_id WHERE employee.email='$man_id' ORDER BY order_date ASC");
				while($row = $search->fetch_assoc()){ 
					$orders[] = $row;
				}
				foreach ($orders as $order): {
					?>
				<form 	id="form<?php echo $order['order_id']; ?>"
						name="form<?php echo $order['order_id']; ?>"
						action="change.php"
						method="POST">
					<tr>
					<th scope="row"><a href="orderlist.php?result=<?php echo $order['order_id']?>"><?php echo $order['order_id']; ?></a></th>
					<td>
                        <?php echo $order['order_date']; ?>
					</td>
					<td>
						<?php
							$id = $order['order_id'];
							$str = $mysqli->query("SELECT payment_date FROM `order` WHERE order_id='$id'");
							$arr = mysqli_fetch_assoc($str);
							$date = $arr['payment_date'];
							if (!empty($date)) echo $order['payment_date']; 
						?>
					</td>
					<td>
					    <?php
							$str = $mysqli->query("SELECT payment_date FROM `order` WHERE order_id='$id'");
							$arr = mysqli_fetch_assoc($str);
							$date = $arr['payment_date'];
							if (empty($date)) {echo "Оформлен";
							echo '
								<input
									type="submit"
									class="btn btn-primary btn-sm"
									value="Оплачен"
									name="paym_btn"
								>';}
							else {echo "Оплачен";}
						?>
					</td>
					<td>
                        <?php echo $order['buyer']; ?>
					</td>
					<td>
                        <?php echo $order['contacts']; ?>
					</td>
					<td>
						<input
                            data-toggle="modal" data-target="#Modal<?php echo $order['order_id']; ?>"
                            type="button"
                            class="btn btn-danger btn-sm"
							name="btn_delete"
							value="Аннулировать заказ"
						>
						<div class="modal fade" id="Modal<?php echo $order['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Вы точно хотите аннулировать заказ?<br>Это действие необратимо<h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<input type="hidden" name="id" id="id" value="<?php echo $order['order_id']; ?>">
									<div class="modal-body">
										ID заказа: <?php echo $order['order_id']; ?><br>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
										<button type="submit" name="btn_delete" class="btn btn-primary">Да</button>
									</div>
								</div>
							</div>
						</div>
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
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>