<?php
	session_start();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Магазин эко-товаров</title>
        <meta charset="UTF-8">
		<meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="/css/bootstrap-4.0.0/dist/css/bootstrap.css">
		<link href="css/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="/css/style.css" type="text/css">
		<link rel="stylesheet" href="/css/panel.css" type="text/css">
		<link rel="stylesheet" href="/css/cart.css" type="text/css">
		<style>
		textarea {
			width: 400px; 
			height: 100px;
		} 
		.card-block{
		  text-align: right;
		  margin: -80px  80px 30px 0px;
		}
		#auth_btn {
			text-align: justify;
			padding: 5px 20px 5px 20px;
			font-size: 1.0rem;
			margin: 30px -0px 10px 100px;
		}
		#rat{
			margin-top: 20px;
		}
		.buy_btn {
			text-align: justify;
			padding: 5px 20px 5px 20px;
			font-size: 1.0rem;
			margin: auto;
		}
		.ch_rat{
			border: 1px solid #cccccc;
			text-align: center;
		}
		.space{
			margin-right:20px;
		}
		#filt{
			margin-top: 20px;
		}
		.up{
			margin: -100px -10px -100px -100px;
		}
		</style>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="/scripts/js/bootstrap.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
			<!--Скрипт проверки на ввод только цифр-->
		<script>
			$(document).on('keypress', '#num', function (event) {
				var regex = new RegExp("^[0-9]+$");
				var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
				if (!regex.test(key)) {
					event.preventDefault();
					return false;
				}
			});
		</script>
    </head>
	
    <body>
        <div id="header">
            <nav class="top-menu">
				<a href="/index.php"><img class="logo" src="img/logo.png"></a>
				<ul class="menu-main">
					<div class="card-block">
						<li><a href="/index.php" class="current">Главная</a></li>
						<li><a href="/catalog.php">Каталог товаров</a></li>
						<li><a href="" class="current">О нас</a></li>
						<li>
						<!--Скрипт проверки авторизации пользователя: в зависимости от этого будет различаться главная страница-->
<?php
							//Проверка авторизации пользователя
							if((!isset($_SESSION['email']) && !isset($_SESSION['password'])) XOR (!isset($_SESSION['emp_email']) && !isset($_SESSION['emp_password'])) XOR (!isset($_SESSION['own_email']) && !isset($_SESSION['own_password']))){
								//если авторизации нет, то выводится блок с ссылками на страницу регистрации и авторизации
?>
									<a href="/form_auth.php">Личный кабинет</a>
<?php
							}else{
								//Если пользователь авторизован, то выводится ссылка "Выход"
?> 
								<a href="/logout.php">Выход</a>
<?php
							}
?>
							
						</li>
						<li> <a href="/basket.php">Корзина</a></li>
					</div>
				</ul>
			</nav>
		</div>
		<div class="container">
			<div class="row">
<?php
	if(isset($_SESSION['own_email']) && isset($_SESSION['own_password'])){
?>
    <div class="breadcrumbs">
		<ul class="breadcrumb" id="panel">
			<li><a href="owner_pa.php">Главная панель</a></li>
			<li><a href="add_admin.php">Добавить нового менеджера</a></li>
			<li><a href="items_rating.php">Просмотр рейтинга товаров</li>
			<li><a href="income.php">Просмотр прибыли за выбранный период</a></li>
		</ul>
	</div>
<?
	}else if (isset($_SESSION['emp_email'])&& isset($_SESSION['emp_password'])){
?>
		 <div class="breadcrumbs">
            <ul class="breadcrumb" id="panel">
				<li><a href="admin_pa.php">Админпанель</a></li>
				<li><a href="admin_product.php">Добавить товар</a></li>
				<li><a href="update.php">Редактирование и удаление товаров</li>
				<li><a href="change_status.php">Изменение статуса заказа</a></li>
				<li><a href="free_orders.php">Неназначенные заказы</a></li>
               </ul>
          </div>
<?php
	}else if (isset($_SESSION['email'])&& isset($_SESSION['password'])){
?>
		<div class="breadcrumbs">
            <ul class="breadcrumb" id="panel">
				<li><a href="user_pa.php">Личный кабинет</a></li>
				<li><a href="order_archive.php">Мои заказы</a></li>
			</ul>
		</div>	
<?php	
	} else {
	}
?>
	<form name="searching" action="catalog.php" method="POST">
		<input id="search" name="search" size="140"  placeholder="Поиск..." value="">
		<button name="btn_srch" type="submit" class="btn btn-primary btn-sm">Искать</button>
	</form>
		