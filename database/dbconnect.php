<?php
    header('Content-Type: text/html; charset=utf-8');
 
    $server = "localhost"; // имя хоста, используется локальный сервер
    $username = "admin"; // имя пользователя БД
    $password = "sasha99"; // пароль пользователя
    $database = "eco"; // имя базы данных
     
    //Подключение к базе данных через MySQLi
    $mysqli = new mysqli($server, $username, $password, $database);

    //Проверка успешности соединения
    if ($mysqli->connect_errno) { 
        die("<p><strong>Ошибка подключения к базе данных</strong></p><p><strong>Код ошибки: </strong> ". 
		$mysqli->connect_errno ." </p><p><strong>Описание ошибки:</strong> ".$mysqli->connect_error."</p>"); 
    }
    // Устанавливаем кодировку подключения
    $mysqli->set_charset('utf8');
?>