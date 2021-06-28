<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
    if(isset($_POST["btn_add"]) && !empty($_POST["btn_add"])){
        /* Проверка, существует ли в глобальном массиве $_POST данные отправленные из формы.*/
		if(isset($_POST["firstname"])){
			$first_name = trim($_POST["firstname"]);
			//Проверка переменной на пустоту
			if(empty($first_name)){
				echo '<script>alert("Укажите действительное имя");location.href="/add_admin.php"</script>';
				exit(); //Останавка скрипта
			}else if (strlen($first_name) >= 50) {
				echo("Неправильные данные имени");
			}
		}
		if(isset($_POST["patronymic"])){
			$patronymic = trim($_POST["patronymic"]);
			if (strlen($patronymic) >= 50) {
				echo("Неправильные данные отчества");
			}
		} 
		if(isset($_POST["lastname"])){
			$last_name = trim($_POST["lastname"]);
			if(empty($last_name)){
				echo '<script>alert("Укажите вашу фамилию");location.href="/add_admin.php"</script>';
				exit();
			}else if (strlen($last_name) >= 50) {
				echo("Неправильные данные фамилии");
			}
		}
		if(isset($_POST["email"])){
			$email = trim($_POST["email"]);
			if(!empty($email)){
				$reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
				//Если формат полученного почтового адреса не соответствует регулярному выражению
				if( !preg_match($reg_email, $email)){ 
					echo '<script>alert("Вы ввели неправильный email");location.href="/add_admin.php"</script>';
					exit();
				}
				$result_query = $mysqli->query("SELECT `email` FROM `buyer` WHERE `email`='".$email."'");
				//Если кол-во полученных строк равно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
				if($result_query->num_rows == 1){
					//Если полученный результат не равен false
					if(($row = $result_query->fetch_assoc()) != false){
						echo '<script>alert("Пользователь с таким почтовым адресом уже зарегистрирован");location.href="/add_admin.php"</script>';
						exit();
					}else{
						echo '<script>alert("Ошибка в запросе к БД");location.href="/add_admin.php"</script>';
						exit();
					}
					$result_query->close();// Закрытие выборки 
					exit();
				}
			$result_query->close();
			}else{ 
				echo '<script>alert("Укажите действительный email");location.href="/add_admin.php"</script>';
				exit();
			}
 
		}
		if(isset($_POST["password"])){
			$password = trim($_POST["password"]);
			if(!empty($password)){
				$password = md5($password."23hfh89shO"); //Шифруем пароль
			}else{
				echo '<script>alert("Укажите ваш пароль");location.href="/add_admin.php"</script>';
				exit();
			}
		}
		$result = $mysqli->query("INSERT INTO `employee` (`lastname`, `name`, `patronymic`, `email`, `password`, `role_id`) VALUES ('$last_name','$first_name', '$patronymic', '$email', '$password', '3')");
		
		if(!$result){
			echo '<script>alert("Ошибка запроса на добавления пользователя в БД");location.href="/add_admin.php"</script>';
			exit();
		}else{
			echo '<script>alert("Регистрация прошла успешно! Теперь вы можете авторизоваться, используя ваш логин и пароль");location.href="/form_auth.php"</script>';
			exit();
		}
		$result_query_insert->close();
		$mysqli->close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. </a>.</p>");
	}
?>