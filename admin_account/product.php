<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
	$reg_num = "/^[0-9]*+/i";
    if(isset($_POST["btn_plus"]) && !empty($_POST["btn_plus"])){
		if(isset($_POST["name"])){
			$name = trim($_POST["name"]);
			if(empty($name)){
				echo '<script>alert("Введите действительное название товара");location.href="/admin_product.php"</script>';
				exit(); 
			}else if (strlen($name) >= 100) {
				echo '<script>alert("Слишком длинное название");location.href="/admin_product.php"</script>';
				exit();
			}
		}
		if(isset($_FILES['file'])) {
			if($_FILES['file']['name'] == ''){
				echo '<script>alert("Вы не выбрали файл");location.href="/admin_product.php"</script>';
				exit();
			}
			if($_FILES['file']['size'] == 0){
				echo '<script>alert("Файл слишком большой");location.href="/admin_product.php"</script>';
				exit();
			} 
			//проверка расширения
			$getMime = explode('.', $_FILES['file']['name']);
			$mime = strtolower(end($getMime));
			$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
			if(!in_array($mime, $types)){
				echo '<script>alert("Недопустимый тип файла");location.href="/admin_product.php"</script>';
				exit();
			} 
			$img_name = uniqid();
			copy($_FILES["file$id"]['tmp_name'], 'catalog/' . $img_name . '.jpg');
			$image = 'catalog/'.$img_name . '.jpg';
		}

		if(isset($_POST["category"])){
			$category = trim($_POST["category"]);
			if(empty($category)){
				echo '<script>alert("Укажите категорию");location.href="/admin_product.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $category)){ 
				echo '<script>alert("При вводе категории возможны только цифры");location.href="/admin_product.php"</script>';
				exit();
			}else if ($category != 1) {
				echo '<script>alert("Неверный идентификатор категории");location.href="/admin_product.php"</script>';
				exit();
			}
		}
		if(isset($_POST["price"])){
			$price = trim($_POST["price"]);
			if(empty($price)){
				echo '<script>alert("Укажите цену");location.href="/admin_product.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $category)){ 
				echo '<script>alert("При вводе цены возможны только цифры");location.href="/admin_product.php"</script>';
				exit();
			}
		}
		if(isset($_POST["manufacturer"])){
			$manufacturer = trim($_POST["manufacturer"]);
			if (empty($manufacturer)){
				echo '<script>alert("Укажите производителя");location.href="/admin_product.php"</script>';
				exit();
			}
			else{
				if (strlen($manufacturer)>100){
					echo '<script>alert("Слишком длинное название");location.href="/admin_product.php"</script>';
					exit();
				}
			}
		}
		if(isset($_POST["rating"])){
			$rating = trim($_POST["rating"]);
			if(empty(rating)){
				echo '<script>alert("Укажите рейтинг");location.href="/admin_product.php"</script>';
				exit();
			}else if(!preg_match($reg_num, $category)){ 
				echo '<script>alert("При вводе рейтинга возможны только цифры");location.href="/admin_product.php"</script>';
				exit();
			}else{
				if($rating!=0){
					echo '<script>alert("Неверный рейтинг");location.href="/form_register.php"</script>';
					exit();
				}
			}
		}
		if(isset($_POST["stock"])){
			$stock = trim($_POST["stock"]);
		}
		if(isset($_POST["description"])){
			$description = trim($_POST["description"]);
		}
		$result_query_insert = $mysqli->query("INSERT INTO `items` (`name`, `image`, `category_id`, `selling_price`, `manufacturer`, `rating`, `stock`, `description`) VALUES ('$name','$image', '$category', '$price', '$manufacturer', '$rating', '$stock', '$description')");
		
		if(!$result_query_insert){
			echo '<script>alert("Ошибка добавления товара в БД");location.href="/admin_product.php"</script>';
			exit();
		}else{
			echo '<script>alert("Товар добавлен");location.href="/admin_product.php"</script>';
			exit();
		}
		$result_query_insert->close();
		$mysqli->close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. </a>.</p>");
	}
?>