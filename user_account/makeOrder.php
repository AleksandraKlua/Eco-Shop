<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<?php
	if(isset($_POST["buy_btn"])){
		$email = $_SESSION['email'];
		$res_id = $mysqli->query("SELECT buyer_id FROM buyer WHERE `email`='$email'");
		$num = $res_id->fetch_array();
		$buyer_id = intval($num[0]);
		$result = $mysqli->query("INSERT INTO `order` (buyer_id, order_date) VALUES  ('$buyer_id', CURRENT_DATE())");
		$order_res_id = $mysqli->query("SELECT order_id FROM `order` WHERE order_id=(SELECT MAX(order_id) FROM `order`)");
		$ord_num = $order_res_id->fetch_array();
		$order_id = intval($ord_num[0]);
		
		if(!empty($_POST['item_id']) and !empty($_POST['item_count'])){
			$request = http_build_query($_POST['item_id']);
			$size = strlen($request);
			$item_arr=$_POST['item_id'];
			$q_arr=$_POST['item_count'];
			for ($i=0; $i<$size; $i++){
				$stock_res = $mysqli->query("SELECT stock FROM `items` WHERE item_id='$item_arr[$i]'");
				$stock_num = $stock_res->fetch_array();
				$stock = intval($stock_num[0]);
				$balance= $stock - $q_arr[$i];
				if ($stock == 0 OR $balance < 0) {
					echo '<script>alert("Увы! Товар закончился");location.href="/basket.php"</script>';
					exit();
				}
				$res_orderlist = $mysqli->query("INSERT INTO `order_list` (`order_id`, `item_id`, `quantity`) VALUES ('$order_id', '$item_arr[$i]', '$q_arr[$i]')");
				$res_stock = $mysqli->query("UPDATE `items` SET stock='$balance' WHERE item_id='$item_arr[$i]'");
			}
		}
		if (!$res_orderlist and !$result) {
			echo '<script>alert("Ошибка оформления заказа");location.href="/basket.php"</script>';
			exit();
		} else {
			echo '<script>alert("Заказ успешно оформлен");location.href="/basket.php"</script>';
			exit();
		}
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>