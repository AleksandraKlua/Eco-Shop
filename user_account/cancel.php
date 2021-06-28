<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
	if(isset($_POST["btn_delete"])){
		$id = $_POST['id'];
		$result = $mysqli->query("DELETE FROM `order` where `order_id` = '$id'");
		if(!$result){
			echo '<script>alert("Ошибка отмены заказа");location.href="/order_archive.php"</script>';
			exit();
		}else{
			echo '<script>alert("Заказ отменен");location.href="/order_archive.php"</script>';
			exit();
		}
		$mysql -> close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>