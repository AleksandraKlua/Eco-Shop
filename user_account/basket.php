<?php
	require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\header.php");
?>
<div>
    <div class="title">
		</br>
		<h2>Корзина</h2>
		</br>
    </div>
	<div id="shopping-cart" class="shopping-cart">
		<div id="cart" class="cart"></div>
		<div class="link" id="end"></div>	
	</div>	
	<div id="full" class="total-price"></div>	
<?php
    if ($_SESSION['email'] == '' ){
 ?>
		<form id="form" action="form_auth.php">
			<button id="auth_btn" class="btn btn-primary" onclick="error()">Оформить заказ</button>
		</form>
<? 
	}else{
?>
        <form id="form" action="makeOrder.php" method="POST">
            <button id="auth_btn" name="buy_btn" class="btn btn-primary" type="submit" onclick="buy()">Оформить заказ</button>
        </form>
<? 
	} 
?>	
</div>

	<script>
    let local = JSON.parse(localStorage.getItem('cart'));
    let out = document.getElementById('cart')
    let outFull = document.getElementById('full')
    let end = document.getElementById('end')
    let form = document.getElementById('form')

    function cards() {
        let fullprice = 0;
        let full = document.createElement('div')

        for(let i in local.id){
            for (let j in local.about) {
                if (i == local.about[j].item_id) {
                    fullprice = fullprice + (local.about[j].selling_price) * (local.id[i])
                    let item = document.createElement('h5')
                    let img = document.createElement('img')
                    let price = document.createElement('h6')
                    let del = document.createElement('button')
					let btn_minus = document.createElement('button')
                    let count = document.createElement('input')
					let btn_plus = document.createElement('button')
					let space = document.createElement('p')

                    let element = document.createElement('input');
                    element.type = 'hidden';
                    element.value = local.id[j];
                    element.setAttribute("name", 'item_count[]');
                    form.appendChild(element);

                    let pr = local.about[j].item_id;
                    let element2 = document.createElement('input');
                    element2.type = 'hidden';
                    element2.value = pr;
                    element2.setAttribute ("name", 'item_id[]')
                    form.appendChild(element2);

                    item.textContent = local.about[j].item_name
					item.className="card-title"

                    img.setAttribute("src", local.about[j].image);
                    img.setAttribute("width", "20%");
					img.className="child";

                    price.textContent = local.about[j].selling_price + " руб. "   
					//price.className="card-title"
					price.className="child"
					
					del.className="delete-btn";
					del.innerHTML= '<img src="delete.svg" alt="">'
                    del.onclick = function() {
                        delete local.about[j]
                        delete local.id[j]
                        localStorage.setItem('cart', JSON.stringify(local))
                        location.reload()
                    }
					
					count.value=local.id[j];
					count.className = "quan";
					count.id = "num";
					
					btn_minus.className="minus-btn"
					btn_minus.innerHTML= '<img src="minus.svg" alt="">'
					btn_minus.onclick = function() {
						local.id[j]--;
                        localStorage.setItem('cart', JSON.stringify(local))
                        location.reload()
                    }
					
					btn_plus.className="plus-btn"
					btn_plus.innerHTML= '<img src="plus.svg" alt="">'
					btn_plus.onclick = function() {
						local.id[j]++;
                        localStorage.setItem('cart', JSON.stringify(local))
                        location.reload()
                    }
					
					space.className="child2"
					
                    out.appendChild(item)
                    out.appendChild(img)
                    out.appendChild(price)
					out.appendChild(btn_minus)
					out.appendChild(count)
					out.appendChild(btn_plus)
					out.appendChild(space)
                    out.appendChild(del)
                }
            }
        }

        full.textContent = 'Итоговая сумма: ' + fullprice + " руб.";
        outFull.appendChild(full)
		$('.main-cart').html(out);
		
    }
	
    function error() {
        alert('Вы не авторизованы! Для оформления заказа вам нужно авторизоваться')
    }
    function buy(){
        localStorage.removeItem('cart');
    }
	
    window.onload = cards()
</script>

<?php
	require_once("C:\Server\OpenServer\domains\localhost\shop\main_page\footer.php");
?>