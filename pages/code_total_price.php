<?php

$total_price = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}
$_SESSION['total_price']=$total_price;
echo 'Стоимость заказа: '.$total_price . ' руб.';
?>
