<?php
    session_start();
 
    unset($_SESSION["email"]);
    unset($_SESSION["password"]);
	unset($_SESSION["emp_email"]);
    unset($_SESSION["emp_password"]);
	unset($_SESSION["own_email"]);
    unset($_SESSION["own_password"]);
    header("Location: C:\Server\OpenServer\domains\localhost\shop\main_page\index.php");
?>