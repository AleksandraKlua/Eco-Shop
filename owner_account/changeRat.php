<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
    if(isset($_POST["changeBtn"])){
		$id = trim($_POST['id']);
		if(isset($_POST["rating$id"])){
			$rating = trim($_POST["rating$id"]);
			if(empty($rating)){
				echo '<script>alert("Укажите рейтинг");location.href="/rating.php"</script>';
				exit();
			}
		}
		if(isset($_POST["rating$id"])){
			$rating = $_POST["rating$id"];
		}
		$result = $mysqli->query("UPDATE `items` SET `rating`='$rating' WHERE `item_id` = '$id'");
		if(!$result){
			echo '<script>alert("Ошибка обновления рейтинга в БД");location.href="/rating.php"</script>';
			exit();
		}else{
			echo '<script>alert("Рейтинг успешно обновлен");location.href="/rating.php"</script>';
			exit();
		}
		$mysqli->close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>