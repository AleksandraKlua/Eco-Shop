<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
</div>
 
<?php
    /*Проверка, если пользователь не авторизован, то выводится форма регистрации, 
    иначе выводится сообщение о том, что он уже зарегистрирован*/
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>	
		<!--Скрипт проверки на ввод только букв-->
		<script>
			$(document).on('keypress', '#textbox', function (event) {
			var regex = new RegExp("^[a-zA-Zа-яёА-ЯЁ-]+$");
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if (!regex.test(key)) {
				event.preventDefault();
				return false;
			}
		});
		</script>
		<script>
			$(document).ready(function(){
				//Регулярное выражение для проверки email
				var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
				var mail = $('input[name=email]');
				mail.blur(function(){
					if(mail.val() != ''){
						//Проверка, соответствует ли введенный email регулярному выражению
						if(mail.val().search(pattern) == 0){
							$('#valid_email_message').text(''); // Убираем сообщение об ошибке
							$('input[type=submit]').attr('disabled', false); //Активируем кнопку отправки
						}else{
							$('#valid_email_message').text('Неправильный e-mail');
							$('input[type=submit]').attr('disabled', true); //Дезактивируем кнопку отправки
						}
					}else{
						$('#valid_email_message').text('Введите Ваш e-mail');
					}
				});
			});
		</script>
		<script>
			$(document).ready(function(){
				var password = $('input[name=password]');//Проверка длины пароля
				password.blur(function(){
					if(password.val() != ''){
						//Если длина введенного пароля меньше шести символов, то выводится сообщение об ошибке
						if(password.val().length < 6){
							$('#valid_password_message').text('Минимальная длина пароля 6 символов');
							$('input[type=submit]').attr('disabled', true);
						}else{
							$('#valid_password_message').text('');
							$('input[type=submit]').attr('disabled', false);
						}
					}else{
						$('#valid_password_message').text('Введите пароль');
					}
				});
			});
		</script>
        <div id="form_register">
			</br>
            <h2>Регистрация</h2>
			</br>
            <form action="register.php" method="post" name="form_register"  class="forma">
                <table>
                    <tbody> <tr>
                        <td> Имя: </td>
                        <td>
                            <input id="textbox" type="text" name="first_name" placeholder="Введите имя" required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Отчество (при наличии): </td>
                        <td>
                            <input id="textbox" type="text" name="patronymic" placeholder="Введите отчество">
                        </td>
                    </tr>
                    <tr>
                        <td> Фамилия: </td>
                        <td>
                            <input id="textbox" type="text" name="last_name" placeholder="Введите фамилию" required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Дата рождения (при желании): </td>
                        <td>
                            <input type="date" name="birthday" min="1900-01-01" max="2010-12-31">
                        </td>
                    </tr>
					<tr>
                        <td> Номер телефона (при желании): </td>
                        <td>
                            <input id="phone" type="text" name="phone_number"  placeholder="Введите номер">
							<script>
								$(document).ready(function() {
								$("#phone").mask("+7(999)999-99-99");
							});
							</script>
                        </td>
                    </tr>
                    <tr>
                        <td> E-mail: </td>
                        <td>
                            <input type="email" name="email" placeholder="Введите e-mail" required="required"><br>
                            <span id="valid_email_message" class="mesage_error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td> Пароль: </td>
                        <td>
                            <input type="password" name="password" placeholder="Минимум 6 символов" required="required"><br>
                            <span id="valid_password_message" class="mesage_error"></span>
                        </td>
                    </tr>
					<tr>
                        <td> Повторите пароль: </td>
                        <td>
                            <input type="password" name="password2" placeholder="Повторите пароль" required="required">
						</td>
                    </tr>
					
					<tr>
                        <td> Хотите получать e-mail-рассылку? </td>
                        <td>
							<input type="checkbox" name="mailing" value = "1" checked>
                        </td>
                    </tr>
					
                    <tr>
                        <td colspan="2">
                            <input id="auth_btn" class="btn btn-primary btn-sm" type="submit" name="btn_submit_register" value="Зарегистрироваться!">
                        </td>
                    </tr>
                </tbody></table>
				<p align="center"><h5>Уже зарегистрированы? Войти в <a href="/form_auth.php">личный кабинет</a></h5></p>
            </form>
        </div>
<?php
    }else{
?>
        <div id="authorized">
            <h2>Вы уже зарегистрированы!</h2>
        </div>
		
<?php
    }
     //Подключение подвала
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>