<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
			<div class="title">
				<h2>Личный кабинет</h2>
			</div>
<?php
			$user_email = $_SESSION['email'];
			$result = $mysqli->query("SELECT `buyer_id`, `lastname`, `name`, `patronymic`, `phone_number`, `email`, `password`, `mailing`, `birthday`, `registration_date` FROM `buyer` WHERE `email`='$user_email'");
			$user  = $result->fetch_assoc();
?>
			<h6 align="left"><strong>Дата регистрации: </strong> <?php echo $user['registration_date'];?></h6>
			<form id="form<?php echo $user['buyer_id']; ?>" name="form<?php echo $user['buyer_id']; ?>" action="userChange.php" method="POST" class="lk">
			<input name="id" value="<?php echo $user['buyer_id'];?>"  type="hidden">
                <table>
                    <tbody> 
					<tr>
                        <th scope="col">Фамилия: </th>
                        <td>
							<input
								id="lastname"
								name="lastname"
								type="text"
								value="<?php echo $user['lastname']; ?>"
								readonly
								required
							>
                        </td>
                    </tr>
					<tr>
                        <th scope="col"> Имя: </th>
                        <td>
                            <input
								id="name"
								name="name"
								type="text"
								value="<?php echo $user['name']; ?>"
								readonly
								required
							>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"> Отчество: </th>
                        <td>
                            <input
								id="patronymic"
								name="patronymic"
								type="text"
								value="<?php echo $user['patronymic']; ?>"
								readonly
							>
                        </td>
                    </tr>
					<tr>
                        <th scope="col"> Дата рождения: </th>
                        <td>
							<input
								id="birthday"
								name="birthday"
								type="text"
								value="<?php echo $user['birthday']; ?>"
								readonly
							>
                        </td>
                    </tr>
					<tr>
                        <th scope="col"> Номер телефона: </th>
                        <td>
							<input
								id="phone"
								name="phone"
								type="text"
								value="<?php echo $user['phone_number']; ?>"
								readonly
							>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"> E-mail: </th>
                        <td>
							<input
								id="email"
								name="email"
								type="email"
								value="<?php echo $user['email']; ?>"
								readonly
								required
							>
                            <span id="valid_email_message" class="mesage_error"></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col"> Изменить пароль: </th>
                        <td>
                            <input id="password" type="password" name="password" readonly><br>
                            <span id="valid_password_message" class="mesage_error"></span>
                        </td>
                    </tr>
					<tr>
                        <th scope="col"> Повторите пароль: </th>
                        <td>
                            <input id="password2" type="password" name="password2" readonly>
						</td>
                    </tr>
					<tr>
                        <th scope="col"> E-mail-рассылка: </th>
                        <td>
							<input id="mailing" type="checkbox" name="mailing" 						
<?php 
								if ($user['mailing']==1){
									?>
									checked
<?								
							} 
?>
							>
                        </td>
                    </tr>

					<tr>
						<td colspan="2">
							<button
								type="button"
								name="editBtn"
								class="btn btn-primary  btn-sm"
								onclick="enable(val = <?php echo $user['buyer_id']; ?>)"
							>
							<i class="fa fa-pencil"></i>
						</button>
						<button 
								form="form<?php echo $user['buyer_id']; ?>"
								name="btn_save"
								type="submit"
								class="btn btn-primary btn-sm"
							>
							<i class="fa fa-floppy-o"></i>
						</button>
						<button
								data-toggle="modal" data-target="#Modal<?php echo $user['buyer_id']; ?>"
								type="button"
								class="btn btn-danger btn-sm"
							>
							<i class="fa fa-window-close"></i>
							</button>
							<div class="modal fade" id="Modal<?php echo $user['buyer_id']; ?>" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Вы точно хотите удалить свой аккаунт?</br>Это действие необратимо</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="deleteUser.php" method="post">
											<input type="hidden" name="id" id="id" value="<?php echo $user['buyer_id']; ?>">
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
												<button type="submit" name="btn_delete" class="btn btn-primary">Да</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</td>
					</tr>
                </tbody>
				</table>

            </form>

        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$("#phone").mask("+7(999)999-99-99");
		});
	</script>
	<script>
		$(document).ready(function(){
			var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
			var mail = $('input[name=email]');
							 
			mail.blur(function(){
				//Проверка, соответствует ли введенный email регулярному выражению
				if(mail.val().search(pattern) == 0){
					$('#valid_email_message').text(''); // Убирается сообщение об ошибке
					$('input[type=submit]').attr('disabled', false); //Активвция кнопки отправки
				}else{
					$('#valid_email_message').text('Неправильный e-mail');
					$('input[type=submit]').attr('disabled', true); //Дезактивация кнопки отправки
				}
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			var password = $('input[name=password]');//Проверка длины пароля
			password.blur(function(){
				//Если длина введенного пароля меньше шести символов, то выводится сообщение об ошибке
				if(password.val().length < 6){
					$('#valid_password_message').text('Минимальная длина пароля 6 символов');
					$('input[type=submit]').attr('disabled', true);
				}else{
					$('#valid_password_message').text('');
					$('input[type=submit]').attr('disabled', false);
				}
			});
		});
	</script>
	<script>
			function deleteUser(val) {
				alert()
			}
			function enable(val) {
				document.getElementById("lastname").readOnly = false;
				document.getElementById("name").readOnly = false;
				document.getElementById("patronymic").readOnly = false;
				document.getElementById("birthday").readOnly = false;
				document.getElementById("phone").readOnly = false;
				document.getElementById("email").readOnly = false;
				document.getElementById("password").readOnly = false;
				document.getElementById("password2").readOnly = false;
				document.getElementById("mailing").readOnly = false;
			}
			function disable(val) {
				let lastname = document.getElementById("lastname");
				let name = document.getElementById("name");
				let patronymic = document.getElementById("patronymic")
				let birthday = document.getElementById("birthday");
				let phone = document.getElementById("phone");
				let email = document.getElementById("email");
				let password = document.getElementById("password");
				let password2 = document.getElementById("password2");
				let description = document.getElementById("mailing");

				lastname.readOnly = true;
				name.readOnly = true;
				patronymic.readOnly = true;
				birthday.readOnly = true;
				phone.readOnly = true;
				email.readOnly = true;
				password.readOnly = true;
				password2.readOnly = true;
				mailing.readOnly = true;
			}
		</script>
<?php
	 require_once("footer.php");
?>