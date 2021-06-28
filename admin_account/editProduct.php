<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
	$reg_num = "/^[0-9]*/";

    if(isset($_POST["btn_save"])){
		$id = trim($_POST['id']);
		if(isset($_POST["name$id"])){
			$name = trim($_POST["name$id"]);
			if(empty($name)){
				echo '<script>alert("Введите действительное название товара");location.href="/update.php"</script>';
				exit(); 
			}else if (strlen($name) >= 100) {
				echo '<script>alert("Название слишком длинное");location.href="/update.php"</script>';
			}
		}
		$str = $mysqli->query("SELECT `image` FROM `items` WHERE `item_id` = '$id'");
			$arr = mysqli_fetch_assoc($str);
			$img = $arr['image'];
		if(isset($_FILES["file$id"]) && $_FILES["file$id"]['size'] != 0) {
			
			if (file_exists("$img")) unlink("$img"); 
			if($_FILES["file$id"]['size'] == 0){
				echo '<script>alert("Файл слишком большой");location.href="/update.php"</script>';
				exit();
			}
			$getMime = explode('.', $_FILES["file$id"]['name']);
			$mime = strtolower(end($getMime));
			$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
			if(!in_array($mime, $types)){
				echo '<script>alert("Недопустимый тип файла");location.href="/update.php"</script>';
				exit();
			} 
			$img_name = uniqid();
			copy($_FILES["file$id"]['tmp_name'], 'catalog/' . $img_name . '.jpg');
			$image = 'catalog/'.$img_name . '.jpg';
		} else $image=$img;
		if(isset($_POST["category$id"])){
			$category = trim($_POST["category$id"]);
			if(empty($category)){
				echo '<script>alert("Укажите категорию");location.href="/update.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $category)){ 
				echo '<script>alert("При вводе категории возможны только цифры");location.href="/update.php"</script>';
				exit();
			}else if ($category != 1) {
				echo'<script>alert("Неверный идентификатор категории");location.href="/update.php"</script>';
				exit();
			}
		}
		if(isset($_POST["price$id"])){
			$price = trim($_POST["price$id"]);
			if(empty($price)){
				echo '<script>alert("Укажите цену");location.href="/update.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $category)){ 
				echo '<script>alert("При вводе цены возможны только цифры");location.href="/update.php"</script>';
				exit();
			}
		}
		if(isset($_POST["manufacturer$id"])){
			$manufacturer = trim($_POST["manufacturer$id"]);
			if (empty($manufacturer)){
				echo '<script>alert("Укажите производителя");location.href="/update.php"</script>';
				exit();
			}
			else{
				if (strlen($manufacturer)>100){
					echo '<script>alert("Слишком длинное название");location.href="/update.php"</script>';
					exit();
				}
			}
		}
		if(isset($_POST["rating$id"])){
			$rating = trim($_POST["rating$id"]);
			if(empty($rating)){
				echo '<script>alert("Укажите рейтинг");location.href="/update.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $rating)){ 
				echo '<script>alert("При вводе рейтинга возможны только цифры");location.href="/update.php"</script>';
				exit();
			}else{
				if($rating!=0){
					echo '<script>alert("Неверный рейтинг");location.href="/update.php"</script>';
					exit();
				}
			}
		}
		if(isset($_POST["stock$id"])){
			$stock = trim($_POST["stock$id"]);
		}
		if(isset($_POST["description$id"])){
			$description = trim($_POST["description$id"]);
		}
		$result = $mysqli->query("UPDATE `items` SET `name`='$name', `image`='$image', `category_id`='$category', `selling_price`='$price', `manufacturer`='$manufacturer',  `rating`='$rating', `stock`='$stock', `description`='$description' WHERE `item_id` = '$id'");
		
		if(!$result){
			echo '<script>alert("Ошибка обновления товара в БД");location.href="/update.php"</script>';
			exit();
		}else{
			echo '<script>alert("Товар успешно обновлен");location.href="/update.php"</script>';
			exit();
		}
		$result->close();
		$mysqli->close();
	} else if(isset($_POST["btn_delete"])){
		$id = filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING);
		$sql = ("DELETE FROM `items` where `item_id` = '$id'");
		$result = $mysqli->query($sql);
		if(!$result){
			echo '<script>alert("Ошибка удаления товара из БД");location.href="/update.php"</script>';
			exit();
		}else{
			echo '<script>alert("Товар успешно удален");location.href="/update.php"</script>';
			exit();
		}
		$mysql -> close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>