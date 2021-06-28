<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\database\dbconnect.php");
?>
<html>
    <head>
        <title>Состав заказа</title>
		<style type="text/css">
			td, tr {
				text-align: center; /* Выравнивание по правому краю */
			}
		</style>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="css\bootstrap-4.0.0\dist\css\bootstrap.css">
    </head>
	<body>
		<table class="table table-bordered" align="center">
			<thead>
				<tr>
					<th scope="col">ID товара</th>
					<th scope="col">Название товара</th>
					<th scope="col">Цена единицы товара</th>
					<th scope="col">Количество</th>
					<th scope="col">Стоимость</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$var = $_GET['result'];
					$search = $mysqli->query("SELECT `items`.item_id, name, selling_price, quantity, selling_price*quantity FROM `order_list` JOIN items ON order_list.item_id = items.item_id WHERE order_id = '$var'");
					$items = array();
					while($row = $search->fetch_assoc()){ 
						$items[] = $row;
					}
					foreach ($items as $item): {
				?>
						<tr>
						<th scope="row"><?php echo $item['item_id']; ?></th>
						<td>
							<?php echo $item['name']; ?>
						</td>
						<td>
							<?php echo $item['selling_price']; ?>
						</td>
						<td>
							<?php echo $item['quantity']; ?>
						</td>
						<td>
							<?php echo $item['selling_price*quantity']; ?>
						</td>
						</tr>
				<?}
				?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p> <h5> Итого: 
			<?php 
				$search=$mysqli->query("SELECT SUM(selling_price*quantity) FROM `order_list` JOIN items ON order_list.item_id = items.item_id WHERE order_id = '$var'");
				$search = $search->fetch_array();
				$quantity = intval($search[0]);
				echo $quantity;
			?> руб.</h5> </p>
	</body>
</html>