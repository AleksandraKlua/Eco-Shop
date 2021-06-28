<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<div>
	<p align="center"><strong>Введите промежуток времени, за который необходимо посмотреть прибыль</strong></p>
	</br>
	<form action="showIncome.php" method="POST">
		<p align="center">Дата начала: <input type="date" name="begin_date" min="2020-01-01"> Дата конца: <input type="date" name="end_date" min="2020-01-01"></p>
		</br>
		<input class="btn" type="submit" name="autn_btn" class="btn btn-primary btn-sm" value="Показать">
	</form>
</div>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>