<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
?>
<?php
    /*
     Проверка была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. 
	 Если нет, то пользователю выводится сообщение об ошибке,что он зашёл на эту страницу напрямую.
    */
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
        /* Проверка, существует ли в глобальном массиве $_POST данные отправленные из формы.*/
		if(isset($_POST["first_name"])){
			$first_name = trim($_POST["first_name"]);
			//Проверка переменной на пустоту
			if(empty($first_name)){
				echo '<script>alert("Укажите ваше имя");location.href="/form_register.php"</script>';
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
		if(isset($_POST["last_name"])){
			$last_name = trim($_POST["last_name"]);
			if(empty($last_name)){
				echo '<script>alert("Укажите вашу фамилию");location.href="/form_register.php"</script>';
				exit();
			}else if (strlen($last_name) >= 50) {
				echo("Неправильные данные фамилии");
			}
		}
		if(isset($_POST["birthday"])){
			$birthday = date($_POST["birthday"]);
			$birthday = date (date_create($birthday) -> format ('Y-m-d'));
			if ($birthday >= date ('2010-12-31') || $birthday <= date ('1900-01-01')) {
				echo '<script>alert("Дата должная быть не раньше 01.01.1900 и не позже 31.12.2010");location.href="/form_register.php"</script>';
			}
		}
		if(isset($_POST["phone_number"])){
			$phone_number = str_replace([' ', '(', ')', '+', '-'], '', $_POST["phone_number"]);
			if (!empty($phone_number)){
				if (strlen($phone_number)<11){
					echo '<script>alert("Номер слишком короткий");location.href="/form_register.php"</script>';
					exit();
				}
			}
		}
		if(isset($_POST["email"])){
			$email = trim($_POST["email"]);
			if(!empty($email)){
				$reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
 
				//Если формат полученного почтового адреса не соответствует регулярному выражению
				if( !preg_match($reg_email, $email)){ 
					echo '<script>alert("Вы ввели неправильный email");location.href="/form_register.php"</script>';
					exit();
				}
				
				$result_query = $mysqli->query("SELECT `email` FROM `buyer` WHERE `email`='".$email."'");
 
				//Если кол-во полученных строк равно единице, значит пользователь с таким почтовым адресом уже зарегистрирован
				if($result_query->num_rows == 1){
 
					//Если полученный результат не равен false
					if(($row = $result_query->fetch_assoc()) != false){
						echo '<script>alert("Пользователь с таким почтовым адресом уже зарегистрирован");location.href="/form_register.php"</script>';
						exit();
					}else{
						echo '<script>alert("Ошибка в запросе к БД");location.href="/form_register.php"</script>';
						exit();
					}
					$result_query->close();// Закрытие выборки 
					exit();
				}
			$result_query->close();
 
			}else{ 
				echo '<script>alert("Укажите ваш email");location.href="/form_register.php"</script>';
				exit();
			}
 
		}
		if(isset($_POST["password"])){
			$password = trim($_POST["password"]);
			if(!empty($password)){
				$password = md5($password."23hfh89shO"); //Шифруем пароль
			}else{
				echo '<script>alert("Укажите ваш пароль");location.href="/form_register.php"</script>';
				exit();
			}
 
		}
		if($_POST['password2'] != $_POST['password']) {
			echo '<script>alert("Повторный пароль введен неверно!");location.href="/form_register.php"</script>';
			exit();
	}
		if(isset($_POST["mailing"])) {
			$mailing = 1;
		} else {
			$mailing = 0;
		}
		if ($birthday != NULL && $phone_number != NULL) {
			$result_query_insert = $mysqli->query("INSERT INTO `buyer` (`lastname`, `name`, `patronymic`, `phone_number`, `email`, `password`, `mailing`, `birthday`,  `registration_date`) VALUES ('$last_name','$first_name', '$patronymic', '$phone_number', '$email', '$password', '$mailing', '$birthday', CURRENT_DATE())");
		}
		else if ($birthday == NULL && $phone_number == NULL) {
			$result_query_insert = $mysqli->query("INSERT INTO `buyer` (`lastname`, `name`, `patronymic`, `email`, `password`, `mailing`, `registration_date`) VALUES ('$last_name','$first_name', '$patronymic', '$email', '$password', '$mailing', CURRENT_DATE())");
		} else if ($phone_number == NULL) {
			$result_query_insert = $mysqli->query("INSERT INTO `buyer` (`lastname`, `name`, `patronymic`, `email`, `password`, `mailing`, `birthday`,  `registration_date`) VALUES ('$last_name','$first_name', '$patronymic', '$email', '$password', '$mailing', '$birthday', CURRENT_DATE())");
		} else if ($birthday ==NULL) {
			$result_query_insert = $mysqli->query("INSERT INTO `buyer` (`lastname`, `name`, `patronymic`, `phone_number`, `email`, `password`, `mailing`,  `registration_date`) VALUES ('$last_name','$first_name', '$patronymic', '$phone_number', '$email', '$password', '$mailing', CURRENT_DATE())");
		}
		if(!$result_query_insert){
			echo '<script>alert("Ошибка запроса на добавления пользователя в БД");location.href="/form_register.php"</script>';
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