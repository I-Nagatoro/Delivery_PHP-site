<?php session_start();
include "../config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Chicken</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="../css/style_index.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <header>
    <div style="display: inline-block">
    <h2>Пользователь:<?php echo $_SESSION['user_name']; ?></h2>
    <form style="display: inline-block;" action="logout.php" method="POST">
        <input style="text-align:left" class="logout-button" name="exit" type="submit" value='Выйти из аккаунта'>
    </form><br>
    <?php if ($_SESSION['user_name'] == 'admin'): ?>
        <a href="admin_panel.php" class="admin-button">Панель администратора</a>
    <?php endif; ?>
    </div><br><br>
<?php include "code_swiper.php"; ?>

<button id="cart-toggle">🛒</button>
<div id="cart-dropdown" class="cart-dropdown">
    <div id='cart' class="cart-content">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $dish_id => $item): ?>
                <div class="cart-item">
                    <strong><span class="dish-name"><?php echo $item['dish_name']; ?></span></strong>
                    <span class="price"><?php echo $item['price']; ?> руб.</span>
                    <span class="quantity">Количество: <?php echo $item['quantity']; ?></span>
                    
                    <form action="remove_from_cart.php" method="POST" style="display: inline;">
                        <input type="hidden" name="dish_id" value="<?php echo $dish_id; ?>">
                        <button type="submit" name="remove" value="true">Удалить</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="cart-item">Корзина пуста</div>
        <?php endif; ?>
    </div>
    <form id="checkout-form" action="save_to_session.php" method="POST">
        <button type="submit" id="check" class="checkout-button">Перейти к оформлению</button>
    </form>
</div>
</header>
    <section class="menu">
    <?php include "code_dishes.php" ?>
</section>
    
    
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
                var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3.5,
            spaceBetween: 10,
            freeMode: true,
            allowTouchMove: true,
        });

        document.getElementById('cart-toggle').addEventListener('click', function() {
            var cartDropdown = document.getElementById('cart-dropdown');
            if (cartDropdown.classList.contains('active')) {
                cartDropdown.classList.remove('active');
            } else {
                cartDropdown.classList.add('active');
            }
        });
    </script>
</body>

</html>