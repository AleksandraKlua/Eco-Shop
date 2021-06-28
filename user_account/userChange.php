<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
	require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<?php
	$reg_num = "/^[0-9]*/";

    if(isset($_POST["btn_save"])){
		$id = $_POST['id'];
		if(isset($_POST["name"])){
			$first_name = trim($_POST["name"]);
			//Проверка переменной на пустоту
			if(empty($first_name)){
				echo '<script>alert("Укажите ваше имя");location.href="/user_pa.php"</script>';
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
				echo '<script>alert("Укажите вашу фамилию");location.href="/user_pa.php"</script>';
				exit();
			}else if (strlen($last_name) >= 50) {
				echo("Неправильные данные фамилии");
			}
		}
		if(isset($_POST["birthday"])){
			$birth = trim($_POST["birthday"]);
			if (!empty($birth)){
				$birthday = date (date_create($birth) -> format ('Y-m-d'));
				if ($birthday >= date ('2010-12-31') || $birthday <= date ('1900-01-01')) {
					echo '<script>alert("Дата должная быть не раньше 01.01.1900 и не позже 31.12.2010");location.href="/user_pa.php"</script>';
				}
			}else{
				$birthday=NULL;
			}
		} 
		if(isset($_POST["phone"])){
			$phone_number = str_replace([' ', '(', ')', '+', '-'], '', $_POST["phone"]);
			if (!empty($phone_number)){
				if (strlen($phone_number)<11){
					echo '<script>alert("Номер слишком короткий");location.href="/user_pa.php"</script>';
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
					echo '<script>alert("Вы ввели неправильный email");location.href="/user_pa.php"</script>';
					exit();
				}
			}else{ 
				echo '<script>alert("Укажите ваш email");location.href="/user_pa.php"</script>';
				exit();
			}
		}
		if(isset($_POST["password"])){
			$password = trim($_POST["password"]);
			if(!empty($password)){
				$password = md5($password."23hfh89shO"); //Шифруем пароль
			}$password=$_SESSION['password'];
		}
		if($_POST['password2'] != $_POST['password']) {
			echo '<script>alert("Повторный пароль введен неверно!");location.href="/user_pa.php"</script>';
			exit();
	}
		if(isset($_POST["mailing"])) {
			$mailing = 1;
		} else {
			$mailing = 0;
		}
		if ($phone_number==NULL && $birthday==NULL){
			$result_query_update = $mysqli->query("UPDATE `buyer` SET `lastname`='$last_name', `name`='$first_name', `patronymic`='$patronymic', `phone_number`=NULL, `email`='$email', `password`='$password', `mailing`='$mailing', `birthday`=NULL WHERE buyer_id = '$id'");
		}
		else if ($phone_number==NULL){
			$result_query_update = $mysqli->query("UPDATE `buyer` SET `lastname`='$last_name', `name`='$first_name', `patronymic`='$patronymic', `phone_number`=NULL, `email`='$email', `password`='$password', `mailing`='$mailing', `birthday`='$birthday' WHERE buyer_id = '$id'");
		}
		else if ($birthday==NULL){
			$result_query_update = $mysqli->query("UPDATE `buyer` SET `lastname`='$last_name', `name`='$first_name', `patronymic`='$patronymic', `phone_number`='$phone_number', `email`='$email', `password`='$password', `mailing`='$mailing', `birthday`=NULL WHERE buyer_id = '$id'");
		}
		else{
			$result_query_update = $mysqli->query("UPDATE `buyer` SET `lastname`='$last_name', `name`='$first_name', `patronymic`='$patronymic', `phone_number`='$phone_number', `email`='$email', `password`='$password', `mailing`='$mailing', `birthday`='$birthday' WHERE buyer_id = '$id'");
		}
		if(!$result_query_update){
			echo $mysqli->error;
			echo '<script>alert("Ошибка обновления данных");location.href="/user_pa.php"</script>';
			exit();
		}else{
			echo '<script>alert("Данные обновлены!");location.href="/user_pa.php"</script>';
			exit();
		}
		$mysqli->close();
	} else if(isset($_POST["btn_delete"])){
		$id = $_POST['id'];
		$sql = ("DELETE FROM `buyers` where `buyer_id` = '$id'");
		$result = $mysqli->query($sql);
		if(!$result){
			echo '<script>alert("Ошибка удаления аккаунта из БД");location.href="/user_pa.php"</script>';
			exit();
		}else{
			echo '<script>alert("Аккаунт успешно удален");location.href="/index.php"</script>';
			exit();
		}
		$mysqli -> close();
	}else{
		exit("<p><strong>Ошибка!</strong>Вы зашли на эту страницу напрямую, поэтому нет данных для обработки.</a>.</p>");
	}
?>