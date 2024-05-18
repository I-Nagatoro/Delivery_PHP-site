<?php
session_start();

$dish_id = $_POST['dish_id'];
$dish_name = $_POST['dish_name'];
$price = $_POST['price'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$found = false;
if (isset($_SESSION['cart'][$dish_id])) {
    $_SESSION['cart'][$dish_id]['quantity']++;
    $found = true;
} else {
    $_SESSION['cart'][$dish_id] = array(
        'dish_id' => $dish_id,
        'dish_name' => $dish_name,
        'price' => $price,
        'quantity' => 1
    );
}

$cart_content = '';
foreach ($_SESSION['cart'] as $dish_id => $item) {
    $cart_content .= '<div class="cart-item">';
    
    $cart_content .= '<span class="cart-item-name">' . $item['dish_name'] . '</span>';
    $cart_content .= '<span class="cart-item-price">' . $item['price'] . '</span>';
    $cart_content .= '<span class="cart-item-quantity">Количество: ' . $item['quantity'] . '</span>';
    
    $cart_content .= '<form action="remove_from_cart.php" method="POST" style="display: inline;">';
    $cart_content .= '<input type="hidden" name="dish_id" value="' . $dish_id . '">';
    $cart_content .= '<button type="submit" name="remove" value="true">Удалить</button>';
    $cart_content .= '</form>';
    
    $cart_content .= '</div>';
}

header("Location: menu.php");
exit;
?>
