<?php
    require_once("C:\Server\OpenServer\domains\localhost\shop\database\dbconnect.php");
    require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?> 
<?php
	$product = array();
	if (isset($_POST["btn_srch"])){
		$searching = trim($_POST['search']);
		if(!empty($searching)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description FROM items JOIN category on items.category_id = category.category_id WHERE items.name='$searching' OR manufacturer='$searching'");
			if($search->num_rows == 0){
				$naming = explode(" ", $searching);
				for($i=0; $i<count($naming); $i++){
					$it_name = $mysqli->query("SELECT name FROM items WHERE name='$naming[$i]'");
					$i_name = $naming[$i];
					if ($it_name->num_rows==1) break;
				}
				for($i=0; $i<count($naming); $i++){
					$man_name = $mysqli->query("SELECT DISTINCT manufacturer FROM items WHERE manufacturer='$naming[$i]'");
					$m_name = $naming[$i];
					if ($man_name->num_rows==1) break;
				}
				if ($it_name->num_rows==1 AND $man_name->num_rows==1){
					$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description FROM items JOIN category on items.category_id = category.category_id WHERE items.name='$i_name' AND manufacturer='$m_name'");
				} 
			} 
		}else $search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description FROM items JOIN category on items.category_id = category.category_id");
	} else 	if (isset($_POST['btn_filter'])){
		if(isset($_POST['category'])){
			$filt_category = $_POST['category'];
		}else $filt_category = "";
		if(isset($_POST['manufacturer'])){
			$filt_manufacturer=$_POST['manufacturer'];
		}else $filt_manufacturer="";
		if(isset($_POST['from'])){
			$from=$_POST['from'];
		}else $from="";
		if(isset($_POST['to'])){
			$to=$_POST['to'];
		}else $to="";
		if(!empty($filt_category) AND !empty($filt_manufacturer) AND !empty($from) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND manufacturer='$filt_manufacturer' AND selling_price>='$from' AND selling_price=<'$to'");
		}
		else if(!empty($filt_category) AND !empty($from) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND selling_price>='$from' AND selling_price=<'$to'");
		}
		else if(!empty($filt_category) AND !empty($filt_manufacturer) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND manufacturer='$filt_manufacturer' AND selling_price=<'$to'");
		}
		else if(!empty($filt_category) AND !empty($filt_manufacturer) AND !empty($from)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND manufacturer='$filt_manufacturer' AND selling_price>='$from'");
		}
		else if(!empty($filt_category) AND !empty($filt_manufacturer)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND manufacturer='$filt_manufacturer'");
		}
		else if(!empty($filt_category) AND !empty($from)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND selling_price>='$from'");
		}
		else if(!empty($filt_category) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category' AND selling_price=<'$to'");
		}
		else if(!empty($filt_category)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE category.name='$filt_category'");
		}
		else if(!empty($filt_manufacturer) AND !empty($from) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE manufacturer='$filt_manufacturer' AND selling_price>='$from' AND selling_price=<'$to'");
		}
		else if(!empty($filt_manufacturer) AND !empty($from)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE manufacturer='$filt_manufacturer' AND selling_price>='$from'");
		}
		else if(!empty($filt_manufacturer) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE manufacturer='$filt_manufacturer' AND selling_price=<'$to'");
		}
		else if(!empty($filt_manufacturer)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE manufacturer='$filt_manufacturer'");
		}
		else if(!empty($from) AND !empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE selling_price>='$from' AND selling_price=<'$to'");
		}
		else if(!empty($from)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE selling_price>='$from'");
		}
		else if(!empty($to)){
			$search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description 
									FROM items JOIN category on items.category_id = category.category_id 
									WHERE selling_price=<'$to'");
		}
		
	}else $search = $mysqli->query("SELECT item_id, items.name AS item_name, image, selling_price, category.name AS category_name, manufacturer, rating, stock, description FROM items JOIN category on items.category_id = category.category_id");
	while($row = $search->fetch_assoc()){ 
		$product[] = $row;
	}
	$cat_res=$mysqli->query("SELECT name FROM category");
	while($row = $cat_res->fetch_assoc()){ 
		$category[] = $row;
	}
	$man_res=$mysqli->query("SELECT DISTINCT manufacturer FROM items");
	while($row = $man_res->fetch_assoc()){ 
		$manufacturer[] = $row;
	}

?>
	<div class="container">
		<div class="row">
		<form method="POST" action="catalog.php">
			<div class="col-md-2">
				<div class = "card-columns-fluid">
				</br>
				    <h5 class="card-title">Фильтры</h5>
					<h6 class="card-title">Категория</h6>
					<select>
						<option></option>
<?			
						foreach ($category as $cat): {
?>
							<option name="category"><?php echo $cat['name'];?></option>
<?						}
						endforeach; 
?>
					</select>
					<p>
					<h6 class="card-title">Производитель</h6></p>
					<select>
						<option></option>
<?			
						foreach ($manufacturer as $man): {
?>
							<option name="manufacturer"><?php echo $man['manufacturer'];?></option>
<?						}
						endforeach; 
?>
					</select>
					<p>
					<h6 class="card-title">Цена</h6></p>
					<input id="num" class="space" name="from" placeholder="От" size="3">
					<input id="num" name="to" placeholder="До" size="3">
					<button id="filt" name="btn_filter" type="submit" class="btn btn-primary btn-sm">Показать</button>
					</form>
				</div>
			</div>	
<?			
			foreach ($product as $item): {
?>
				<div class="col-4 p-4">
					<div class="card-columns-fluid">
						<div class="card bg-light" style = "width: 22rem; ">
							<div class="card-body">
								<h5 class="card-title"><?php echo $item['item_name']; ?></h5>
								<img class="card-img-top" src="<?php echo $item['image']; ?>">
								<h5 class="card-title"><?php echo $item['selling_price']; ?> руб.</h5>
								<p class="card-text"><strong>Категория: </strong><?php echo $item['category_name']; ?></p>
								<p class="card-text"><strong>Производитель:</strong> <?php echo $item['manufacturer']; ?></p>
								<p class="card-text"><strong>Описание: </strong><?php echo $item['description']; ?></p>
								<div class="row">
									<div class="col-6">
										<div class="card-footer text-muted">Осталось: <?php echo $item['stock']; ?> шт.
										</div>
									</div>
									<div class="col-6">
										<div class="card-footer text-muted">Рейтинг: <?php echo $item['rating']; ?></div>
									</div>
								</div>
								<hr>
									<a href="#" id="<?php echo $item['item_id']; ?>" onclick='addToCard(<?php echo  json_encode($item) ?>)' class="btn btn-primary">В корзину</a>
							</div>
						</div>
					</div>
				</div>
<?			}
 endforeach; ?>
		</div>
	</div>
	<script>
    let cart = {}
    let item = {}
    let final = []
    function addToCard(val) {
        const id = val.item_id
        if (cart[id] == undefined) {
            cart[id] = 1
            item[id] = val
        } else {
            cart[id]++
        }
        final = {
            id: cart,
            about: item
        }
        saveCard();
    }
    function saveCard(){
        localStorage.setItem('cart', JSON.stringify(final))
    }

	</script>
<?php
	 require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>