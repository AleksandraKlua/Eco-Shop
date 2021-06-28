<?php
    session_start();
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
	/* Проверка, была ли отправлена форма, т.е. была ли нажата кнопка "Войти". 
	Если да, то идём дальше, если нет, то выводится сообщение об ошибке, о том что он зашёл на эту страницу напрямую.*/
	if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){
		$email = trim($_POST["email"]);
		if(isset($_POST["email"])){
			if(empty($email)){
				echo '<script>alert("Поле для ввода email не должно быть пустым");location.href="/form_auth.php"</script>';
				exit();
			}
		}else{
			header("Location: form_auth.php");
			exit();
		}
 
		if(isset($_POST["password"])){
			$password = trim($_POST["password"]);
			if(!empty($password)){
				$password = md5($password."23hfh89shO");//Шифруем пароль
			}else{
				echo '<script>alert("Укажите Ваш пароль");location.href="/form_auth.php"</script>';
				exit();
			}
		}else{
			header("Location: form_auth.php");
			exit();
		}
		$result_query_select = $mysqli->query("SELECT `email`, `password` FROM `buyer` WHERE email = '".$email."' AND password = '".$password."'"); //выборка из таблицы покупателей
		$result_query_select_emps = $mysqli->query("SELECT `email`, `password` FROM `employee` WHERE email = '".$email."' AND password = '".$password."' AND role_id=3"); //выборка из таблицы сотрудников
		$result_query_select_owner = $mysqli->query("SELECT `email`, `password` FROM `employee` WHERE email = '".$email."' AND password = '".$password."' AND role_id=1");
		if(!$result_query_select){
			echo '<script>alert("Ошибка запроса на выборке пользователя из БД");location.href="/form_auth.php"</script>';
			exit();
		}else if(!$result_query_select_emps) {
			echo '<script>alert("Ошибка запроса на выборке пользователя из БД");location.href="/form_auth.php"</script>';
			exit();
		}else{
			//Проверка, есть ли в базе пользователь с такими данными, если нет, то выводится сообщение об ошибке
			if($result_query_select->num_rows == 1){
				// Если введенные данные совпадают с данными из базы, то сохраняется логин и пароль в массив сессий.
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $password;
				header("Location: user_pa.php");
			}else if($result_query_select_emps->num_rows == 1) {
				$_SESSION['emp_email'] = $email;
				$_SESSION['emp_password'] = $password;
				header("Location: admin_pa.php"); 
			}else if($result_query_select_owner->num_rows == 1) {
				$_SESSION['own_email'] = $email;
				$_SESSION['own_password'] = $password;
				header("Location: owner_pa.php"); 
			}else{
				echo '<script>alert("Неправильный логин и/или пароль");location.href="/form_auth.php"</script>';
				exit();
			}
		}
	}else{
		exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки</a>.</p>");
	}
	$mysqli->close();
?>