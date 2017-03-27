# Корзина покупателя на jQuery.

### Подключение:

```html
<link href="css/jqcart.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jqcart.min.js"></script>
```

### Использование:
```js
$(function() {
    'use strict';
    // инициализация плагина
    $.jqCart({
        buttons: '.add_item',        // селектор кнопок, аля "Добавить в корзину"
        handler: '/php/handler.php', // путь к обработчику
        visibleLabel: false,         // показывать/скрывать ярлык при пустой корзине (по умолчанию: false)
        openByAdding: false,         // автоматически открывать корзину при добавлении товара (по умолчанию: false)
        currency: '&euro;',          // валюта: строковое значение, мнемоники (по умолчанию "$")
        cartLabel: '.label-place'    /* селектор элемента, где будет размещен ярлык, 
                                        он же - "кнопка" для открытия корзины */
    });
    
    // дополнительные методы
    $.jqCart('openCart'); // открыть корзину
    $.jqCart('clearCart'); // очистить корзину
});
```

В кнопках ("Добавить в корзину"), должены быть прописаны следующие data-атрибуты:

- data-id - ID товара
- data-title - Наименование товара
- data-price - Цена товара
- data-img - URL фото товара (опционально)

Можно добавлять дополнительные data-атрибуты, значения которых будут отправлены с остальными данными в обработчик.

### Обработка и ответ от сервера:
```php
<?php
// какой-то код обработки заказа...

// Ответ на запрос
// !для версии PHP < 5.4, используйте традиционный синтаксис инициализации массивов array() вместо короткого []
$response = [
    'errors' => !$send_ok,
    'message' => $send_ok ? 'Заказ принят в обработку!' : 'Хьюстон! У нас проблемы!'
];
exit( json_encode($response) );
```

### Доп. материалы
- Оригинальная статья: https://incode.pro/jquery/korzina-pokupatelja-na-jquery-plagin-jqcart.html
- Обьяснение работы: https://incode.pro/javascript/sozdaem-korzinu-pokupatelja-na-chistom-javascript-i-localstorage.html
- Демо пример: https://incode.pro/demo/icp_example16/