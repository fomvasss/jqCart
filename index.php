<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/jqcart.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <?php
                    echo "Hello world";
                ?>

                <div class="item_box">
                    <h3 class="item_title">Samsung Galaxy S10</h3>
                    <p>Цена: <span class="item_price">20</span>$</p>
                    <button class="add_item" data-id="7">Добавить в корзину</button>
                </div>
                <div class="item_box">
                    <h3 class="item_title">LG Optimus G E100500</h3>
                    <p>Цена: <span class="item_price">100</span>$</p>
                    <button class="add_item" data-id="2">Добавить в корзину</button>
                </div>
                <div class="item_box">
                    <h3 class="item_title">Nokia 2110</h3>
                    <p>Цена: <span class="item_price">1000</span>$</p>
                    <button class="add_item" data-id="5">Добавить в корзину</button>
                </div>
                <button id="checkout">Оформить заказ</button>
                <button id="clear_cart">Очистить корзину</button>
                <div id="cart_content"></div>
            </div>
        </div>
    </div>

</body>

<script>
    var d = document,
        itemBox = d.querySelectorAll('.item_box'), // блок каждого товара
        cartCont = d.getElementById('cart_content'); // блок вывода данных корзины
    // Функция кроссбраузерной установка обработчика событий
    function addEvent(elem, type, handler){
        if(elem.addEventListener){
            elem.addEventListener(type, handler, false);
        } else {
            elem.attachEvent('on'+type, function(){ handler.call( elem ); });
        }
        return false;
    }
    // Получаем данные из LocalStorage
    function getCartData(){
        return JSON.parse(localStorage.getItem('cart'));
    }
    // Записываем данные в LocalStorage
    function setCartData(o){
        localStorage.setItem('cart', JSON.stringify(o));
        return false;
    }
    // Добавляем товар в корзину
    function addToCart(e){
        this.disabled = true; // блокируем кнопку на время операции с корзиной
        var cartData = getCartData() || {}, // получаем данные корзины или создаём новый объект, если данных еще нет
            parentBox = this.parentNode, // родительский элемент кнопки "Добавить в корзину"
            itemId = this.getAttribute('data-id'), // ID товара
            itemTitle = parentBox.querySelector('.item_title').innerHTML, // название товара
            itemPrice = parentBox.querySelector('.item_price').innerHTML; // стоимость товара
        if(cartData.hasOwnProperty(itemId)){ // если такой товар уже в корзине, то добавляем +1 к его количеству
            cartData[itemId][2] += 1;
        } else { // если товара в корзине еще нет, то добавляем в объект
            cartData[itemId] = [itemTitle, itemPrice, 1];
        }
        if(!setCartData(cartData)){ // Обновляем данные в LocalStorage
            this.disabled = false; // разблокируем кнопку после обновления LS
        }
        return false;
    }
    // Устанавливаем обработчик события на каждую кнопку "Добавить в корзину"
    for(var i = 0; i < itemBox.length; i++){
        addEvent(itemBox[i].querySelector('.add_item'), 'click', addToCart);
    }
    // Открываем корзину со списком добавленных товаров
    function openCart(e){
        var cartData = getCartData(), // вытаскиваем все данные корзины
            totalItems = '';
        // если что-то в корзине уже есть, начинаем формировать данные для вывода
        if(cartData !== null){
            totalItems = '<table class="shopping_list"><tr><th>Наименование</th><th>Цена</th><th>Кол-во</th></tr>';
            for(var items in cartData){
                totalItems += '<tr>';
                for(var i = 0; i < cartData[items].length; i++){
                    totalItems += '<td>' + cartData[items][i] + '</td>';
                }
                totalItems += '</tr>';
            }
            totalItems += '</table>';
            cartCont.innerHTML = totalItems;
        } else {
            // если в корзине пусто, то сигнализируем об этом
            cartCont.innerHTML = 'В корзине пусто!';
        }
        return false;
    }
    /* Открыть корзину */
    addEvent(d.getElementById('checkout'), 'click', openCart);
    /* Очистить корзину */
    addEvent(d.getElementById('clear_cart'), 'click', function(e){
        localStorage.removeItem('cart');
        cartCont.innerHTML = 'Корзина очишена.';
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="js/jqcart.min.js"></script>

</html>