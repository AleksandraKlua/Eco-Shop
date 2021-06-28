<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>

			<div id="form_create">
            <h2>Добавление товара</h2>
            <form action="product.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tbody> <tr>
                        <td> Название: </td>
                        <td>
                            <input type="text" name="name" required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Изображение: </td>
                        <td>
							<input type="file" name="file" required="required">
						</td>
                    </tr>
                    <tr>
                        <td> Категория: </td>
                        <td>
                            <input id="num" type="number_format" name="category" required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Цена: </td>
                        <td>
                            <input id="num" type="number_format" name="price" required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Производитель: </td>
                        <td>
                            <input id="textbox" type="text" name="manufacturer"  required="required">
                        </td>
                    </tr>
                    <tr>
                        <td> Рейтинг: </td>
                        <td>
                            <input id="num" type="number_format" name="rating"  required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Наличие: </td>
                        <td>
                            <input id="num" type="number_format" name="stock"  required="required">
                        </td>
                    </tr>
					<tr>
                        <td> Описание: </td>
                        <td>
							<textarea  name="description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
						<br>
                            <input type="submit" name="btn_plus" class="btn btn-primary btn-sm" value="Добавить!">
                        </td>
                    </tr>
                </tbody></table>
            </form> 

        </div>
    </div>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>