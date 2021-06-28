<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
			<div id="form_create">
				<h2>Добавление нового менеджера</h2>
				</br>
				<form action="add.php" method="POST">
					<table>
						<tbody> <tr>
							<td> Фамилия: </td>
							<td>
								<input id="text" type="text" name="lastname" required="required">
							</td>
						</tr>
						<tr>
							<td> Имя: </td>
							<td>
								<input  id="text" type="text" name="firstname" required="required">
							</td>
						</tr>
						<tr>
							<td> Отчество: </td>
							<td>
								<input  id="text" type="text" name="patronymic">
							</td>
						</tr>
						<tr>
							<td> E-mail: </td>
							<td>
							   <input type="email" name="email" required="required"><br>
							   <span id="valid_email_message" class="mesage_error"></span>
							</td>
						</tr>
						<tr>
							<td> Пароль: </td>
							<td>
							<input type="password" name="password" placeholder="Минимум 6 символов" required="required"><br>
							<span id="valid_password_message" class="mesage_error"></span>
						</tr>
						<tr>
							<td colspan="2" align="center">
							<br>
								<input type="submit" name="btn_add" class="btn btn-primary btn-sm" value="Добавить">
							</td>
						</tr>
					</tbody></table>
				</form> 
			</div>
        </div>
    </div>
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
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>