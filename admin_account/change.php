<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\dbconnect.php");
?>
<?php
    if(isset($_POST["paym_btn"])){
		$id = $_POST['id'];
		$result = $mysqli->query("UPDATE `order` SET `payment_date`=CURRENT_DATE() WHERE `order_id` = '$id'");
		echo $id;
		if(!$result){
			echo '<script>alert("Ошибка обновления товара в БД");location.href="/change_status.php"</script>';
			exit();
		}else{
			echo '<script>alert("Статус обновлен");location.href="/change_status.php"</script>';
			exit();
		}
		$result->close();
		$mysqli->close();
	} else if(isset($_POST["btn_delete"])){
		$id = $_POST['id'];
		$result = $mysqli->query("DELETE FROM `order` where `order_id` = '$id'");
		if(!$result){
			echo '<script>alert("Ошибка аннулирования заказа");location.href="/change_status.php"</script>';
			exit();
		}else{
			echo '<script>alert("Заказ аннулирован");location.href="/change_status.php"</script>';
			exit();
		}
		$mysql -> close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>