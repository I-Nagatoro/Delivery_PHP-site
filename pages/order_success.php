<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style_order.css" rel="stylesheet" type="text/css" />
    <title>Успешное оформление заказа</title>
</head>
<body>
<div class="container">
    <h1>Ваш заказ успешно оформлен!</h1>
    <p>Спасибо, что воспользовались нашим сервисом доставки еды.</p>
    <p>Мы начали готовить ваш заказ. Ожидайте доставку!</p>

    <?php
    include '../config.php';
    if (isset($_SESSION['order_id'])) {
        $order_id = $_SESSION['order_id'];

        $query = "
            SELECT 
                o.order_id, 
                d.dish_name, 
                o.count, 
                d.price,
                o.order_time, 
                CONCAT(a.street, ', д. ', a.house, ', подъезд ', a.entrance, ', этаж ', a.floor, ', кв. ', a.apartment) AS full_address,
                IF(a.comment IS NOT NULL AND a.comment <> '', CONCAT('Комментарий к заказу: ', a.comment), '') AS order_comment
            FROM 
                new_delivery.orders o
            JOIN 
                new_delivery.dishes d ON o.dish_id = d.id
            JOIN 
                new_delivery.address_and_comment a ON o.address_id = a.id
            WHERE 
                o.order_id = ?;
        ";

        if ($stmt = $con->prepare($query)) {
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<h2>Ваш заказ:</h2>";
                echo "<table>";
                echo "<tr><th>Блюдо</th><th>Количество</th><th>Цена за единицу</th><th>Общая цена</th></tr>";
                $total_price = 0;
                while ($row = $result->fetch_assoc()) {
                    $dish_total_price = $row['count'] * $row['price'];
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['dish_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['count']) . " шт.</td>";
                    echo "<td>" . htmlspecialchars(number_format($row['price'], 2)) . " руб.</td>";
                    echo "<td>" . htmlspecialchars(number_format($dish_total_price, 2)) . " руб.</td>";
                    echo "</tr>";
                    $total_price += $dish_total_price;
                    $_SESSION['full_address'] = $row['full_address'];
                    $_SESSION['comm'] = $row['order_comment'];
                }
                echo "<tr class='total'><td colspan='3'>Общая сумма:</td><td>" . htmlspecialchars(number_format($total_price, 2)) . " руб.</td></tr>";
                echo "</table>";
                
                echo "<div class='address'><h3>Адрес доставки:</h3><p>" . htmlspecialchars($_SESSION['full_address']) . "</p></div>";
                
                if (!empty($_SESSION['comm'])) {
                    echo "<div class='comment'><h3>Комментарий к заказу:</h3><p>" . htmlspecialchars($_SESSION['comm']) . "</p></div>";
                }
            } else {
                echo "<p>Нет записей с таким order_id.</p>";
            }
            $stmt->close();
        } else {
            echo "Ошибка при подготовке запроса: " . $con->error;
        }
    } else {
        echo "<p>order_id не найден в сессии.</p>";
    }
    $con->close();
    ?>
    <form action="menu.php" method="post">
        <input name="back_to_menu" type="submit" value="Вернуться к меню" class="back-button">
    </form>
    </div>
</body>
</html>
