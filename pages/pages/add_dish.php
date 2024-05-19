<?php
include "../config.php";

if (isset($_POST['add_to_menu'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dish_name = $_POST['dish_name'];
        $category_id = $_POST['category_id'];
        $type_id = $_POST['type_id'];
        $caption = $_POST['caption'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];
        $sql = "INSERT INTO dishes (dish_name, category_id, type_id, caption, weight, price) 
                VALUES ('$dish_name', $category_id, $type_id, '$caption', $weight, $price)";
        if ($con->query($sql) === TRUE) {
            $_SESSION['notification'] = "Блюдо успешно добавлено в меню.";
            header("Location: admin_panel.php");
            exit();
        } else {
            $_SESSION['notification'] = "Ошибка при добавлении блюда в меню: " . $con->error;
            header("Location: admin_panel.php");
            exit();
        }
    } else {
        $_SESSION['notification'] = "Ошибка: Неверный метод запроса.";
        header("Location: admin_panel.php");
        exit();
    }
}
?>
