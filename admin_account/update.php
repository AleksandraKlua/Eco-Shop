<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Название</th>
						<th scope="col" width="50px">Изображение</th>
						<th scope="col">Категория</th>
						<th scope="col">Цена продажи</th>
						<th scope="col">Производитель</th>
						<th scope="col">Рейтинг</th>
						<th scope="col">Наличие</th>
						<th scope="col">Описание</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
				<?
				$product = array();
				$search = $mysqli->query("SELECT * FROM items");
				while($row = $search->fetch_assoc()){ 
					$product[] = $row;
				}
				foreach ($product as $item): {
					?>
					<form 	id="form<?php echo $item['item_id']; ?>"
							name="form<?php echo $item['item_id']; ?>"
							action="editProduct.php"
							method="post" enctype="multipart/form-data"
							class="up">
					<tr>
					<th scope="row"><?php echo $item['item_id']; ?></th>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="name<?php echo $item['item_id']; ?>"
						name="name<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['name']; ?>"
						size="5"
						readonly
						>
					</td>
					<td width="50px">
					<a href="<?php echo $item['image'];?>" target="_blank">Изображение товара</a>
                    <input
                        form="form<?php echo $item['item_id'];?>"
                        id="image<?php echo $item['item_id'];?>"
						name="file<?php echo $item['item_id'];?>"
                        type="file"
						>	
					</td>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="category<?php echo $item['item_id']; ?>"
						name="category<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['category_id']; ?>"
						size="2"
						readonly
						>
					</td>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="price<?php echo $item['item_id']; ?>"
						name="price<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['selling_price']; ?>"
						size="3"
						readonly
						>
					</td>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="manufacturer<?php echo $item['item_id']; ?>"
						name="manufacturer<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['manufacturer']; ?>"
						readonly
						>
					</td>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="rating<?php echo $item['item_id']; ?>"
						name="rating<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['rating']; ?>"
						size="2"
						readonly
						>
					</td>
					<td>
                    <input
                        form="form<?php echo $item['item_id']; ?>"
                        id="stock<?php echo $item['item_id']; ?>"
						name="stock<?php echo $item['item_id']; ?>"
                        type="text"
                        value="<?php echo $item['stock']; ?>"
						size="2"
						readonly
						>
					</td>
					<td >
                    <textarea 
                        form="form<?php echo $item['item_id']; ?>"
                        id="description<?php echo $item['item_id']; ?>"
						name="description<?php echo $item['item_id']; ?>"
						readonly
						><?php echo $item['description']; ?></textarea>
					</td>
					<td>
						<button
                            type="button"
							name="editBtn"
                            class="btn btn-primary  btn-sm"
                            onclick="enable(val = <?php echo $item['item_id']; ?>)"
						>
                        <i class="fa fa-pencil"></i>
						</button>
						<button 
							name="btn_save"
                            form="form<?php echo $item['item_id']; ?>"
                            type="submit"
                            class="btn btn-primary btn-sm"
						>
						<i class="fa fa-floppy-o"></i>
						</button>
						<button
                            data-toggle="modal" data-target="#Modal<?php echo $item['item_id']; ?>"
                            type="button"
                            class="btn btn-danger btn-sm"
						>
                        <i class="fa fa-window-close"></i>
						</button>
						<div class="modal fade" id="Modal<?php echo $item['item_id']; ?>" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Вы точно хотите удалить?</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
										<input type="hidden" name="id" id="id" value="<?php echo $item['item_id']; ?>">
										<div class="modal-body">
											ID: <?php echo $item['item_id']; ?><br>
											Название: <?php echo $item['name']; ?><br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
											<button type="submit" name="btn_delete" class="btn btn-primary">Да</button>
										</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				</form>
				<?}
				?>
			<?php endforeach; ?>
			</table>
        </div>
    </div>
	<script>
			function deleteProduct(val) {
				alert()
			}
			function enable(val) {
				document.getElementById("name" + val).readOnly = false;
				document.getElementById("image" + val).readOnly = false;
				document.getElementById("category" + val).readOnly = false;
				document.getElementById("price" + val).readOnly = false;
				document.getElementById("manufacturer" + val).readOnly = false;
				document.getElementById("rating" + val).readOnly = false;
				document.getElementById("stock" + val).readOnly = false;
				document.getElementById("description" + val).readOnly = false;
			}
			function disable(val) {
				let name = document.getElementById("name" + val);
				let image = document.getElementById("image" + val);
				let category = document.getElementById("category" + val)
				let price = document.getElementById("price" + val);
				let manufacturer = document.getElementById("manufacturer" + val);
				let rating = document.getElementById("rating" + val);
				let stock = document.getElementById("stock" + val);
				let description = document.getElementById("description" + val);

				name.readOnly = true;
				image.readOnly = true;
				category.readOnly = true;
				price.readOnly = true;
				manufacturer.readOnly = true;
				rating.readOnly = true;
				count.readOnly = true;
				description.readOnly = true;
			}
		</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>