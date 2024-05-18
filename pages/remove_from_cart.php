<?php
session_start();

if(isset($_POST['remove']) && $_POST['remove'] == 'true') {
    $dish_id = $_POST['dish_id'];
    
    if(isset($_SESSION['cart'][$dish_id])) {
        if($_SESSION['cart'][$dish_id]['quantity'] > 1) {
            $_SESSION['cart'][$dish_id]['quantity']--;
        } else {
            unset($_SESSION['cart'][$dish_id]);
        }
    }
}

header("Location: menu.php");
exit;
?>
