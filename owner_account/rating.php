<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<?php
		$begin_date = $_POST['begin_date'];
		$end_date = $_POST['end_date'];
		$search = $mysqli->query(  "SELECT DISTINCT item_id AS id, name, image, selling_price, rating, (
										SELECT SUM(selling_price*quantity) 
										FROM `items` JOIN order_list USING (item_id)
										JOIN `order` USING (order_id)
										WHERE item_id=id) AS profit
									FROM `items` JOIN `order_list` USING (item_id) JOIN `order` USING (order_id)
									WHERE order_date BETWEEN CAST('$begin_date' AS DATE) AND CAST('$end_date' AS DATE)
									ORDER BY profit DESC;");
?>
</br>
	<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Название</th>
					<th scope="col">Изображение</th>
					<th scope="col">Цена продажи</th>
					<th scope="col">Продажи на сумму</th>
					<th scope="col">Текущий рейтинг</th>
					<th scope="col">Изменить рейтинг</th>
				</tr>
			</thead>
			<tbody>		
<?php		
	$items = array();
	for ($i=0; $i<10; $i++){
		$row = $search->fetch_assoc(); 
		$items[] = $row;
	}
			foreach ($items as $item): {
?>
				<form id="form<?php echo $item['id']; ?>" name="form<?php echo $item['id']; ?>" action="changeRat.php" method="POST">
				  <tr>
					<td><input class="quan" name="id" value="<?php echo $item['id']; ?>" size="1" readonly></td>
					<td><?php echo $item['name']; ?></td>
					<td width="200"><img class="image" src="<?php echo $item['image']; ?>" width=60%></td>
					<td><?php echo $item['selling_price']; ?></td>
					<td><?php echo $item['profit']; ?></td>					
					<td><?php echo $item['rating']; ?></td>
					<td>
						<input
							form="form<?php echo $item['id']; ?>"
							name="rating<?php echo $item['id']; ?>"
							id="num"
							type="text"
							size="5"
							value=""
							class="ch_rat"
						>
						</br>
						<input 
							name="changeBtn"
							form="form<?php echo $item['id']; ?>"
                            type="submit"
							id="rat"
                            class="btn btn-primary  btn-sm"
							value="Изменить"
						>
					</td>
					
				  </tr>
				</form>
<?php
			}
?><?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>