<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
	require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<?php
    if(isset($_POST["take_order"])){
		$order_id = $_SESSION['order_id'];
		$m_email = $_SESSION['emp_email'];
		$res_m_id = $mysqli->query("SELECT employee_id FROM employee JOIN `order` ON employee.employee_id=`order`.manager_id WHERE email='$m_email'");
		$num = $res_m_id->fetch_array();
		$m_id = intval($num[0]);
		$result = $mysqli->query("UPDATE `order` SET `manager_id`='$m_id' WHERE `order_id` = '$order_id'");
		if(!$result){
			echo '<script>alert("Ошибка добавления записи в БД");location.href="/free_orders.php"</script>';
			exit();
		}else{
			echo '<script>alert("Приступайте к сбору заказа!");location.href="/change_status.php"</script>'; 
			exit();
		}
		$mysqli->close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>