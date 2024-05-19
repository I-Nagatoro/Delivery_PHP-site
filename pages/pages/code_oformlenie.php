<?php
session_start();

$cart_items = '';
echo "<strong>Ваша корзина:</strong>";
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_items .= '<div class="cart-item">';
        $cart_items .= '<strong><span class="dish-name">' . $item['dish_name'] . ' </span></strong>';
        $cart_items .= '<span class="price">' . $item['price'] . ' руб.</span>';
        $cart_items .= '<span class="quantity">Количество: ' . $item['quantity'] . '</span>';
        $cart_items .= '</div>';
    }
}

echo $cart_items;
?>