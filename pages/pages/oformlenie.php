<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_oformlenie.css" rel="stylesheet" type="text/css" />
    <title>Страница оформления заказа</title>
</head>
<body>
    <div class="container">
        <h1>Страница оформления заказа</h1>
        <div class="dish-container">
        <?php include "code_oformlenie.php" ?>
        </div>
        <div id="total-price"><?php include "code_total_price.php" ?></div><br>


    <form id="checkout-form" action="code_order.php" method="post">
    <?php $phone_number=$_SESSION['phone_number']; ?> 
    <label for="name">Имя:</label><br>
    <input type="text" id="name" name="name" required><br>
    
    <label for="phone">Телефон:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $_SESSION['phone_number']; ?>" readonly><br>


    <label for="street">Улица:</label><br>
    <input type="text" id="street" name="street" required><br>

    <label for="house">Дом:</label>
    <input type="text" id="house" name="house" required>

    <label for="entrance">Подъезд:</label>
    <input type="text" id="entrance" name="entrance" required><br>

    <label for="floor">Этаж:</label>
    <input type="text" id="floor" name="floor" required>

    <label for="apartment">Квартира:</label>
    <input type="text" id="apartment" name="apartment" required><br>

    <label for="comment">Комментарий:</label>
    <textarea id="comment" name="comment"></textarea><br>
    
    <input class="ord_suc" type="submit" name="submit" value="Оформить заказ">

</form>
</body>
</html>