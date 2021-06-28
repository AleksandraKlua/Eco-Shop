<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>

<?php
    /*Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    иначе выводим сообщение о том, что он уже авторизован*/
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
	<div id="form_auth">
		</br>
        <h2>Войти в личный кабинет</h2>
		</br>
        <form action="auth.php" method="post" name="form_auth" class="forma">
            <table>
                <tbody><tr>
                    <td> E-mail: </td>
                    <td>
                        <input type="email" name="email" placeholder="Введите e-mail" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
          
                <tr>
                    <td> Пароль: </td>
                    <td>
                        <input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" id="auth_btn">
                        <input  id="auth_btn" type="submit" name="btn_submit_auth" class="btn btn-primary btn-sm" value="Войти">
                    </td>
                </tr>
            </tbody></table>
			<p align="center"><h5>Ещё не зарегистрированы? Перейти к <a href="/form_register.php">регистрации</a></h5></p>
        </form>
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>
 
<?php
    }
?>
 
<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>