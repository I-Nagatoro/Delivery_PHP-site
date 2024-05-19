<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_dish'])) {
    $dish_id = $_POST['dish_id'];
    $dish_name = $_POST['dish_name'];
    $category_id = $_POST['category_id'];
    $type_id = $_POST['type_id'];
    $caption = $_POST['caption'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];

    $sql = "UPDATE dishes 
            SET dish_name = '$dish_name', 
                category_id = $category_id, 
                type_id = $type_id, 
                caption = '$caption', 
                weight = $weight, 
                price = $price 
            WHERE id = $dish_id";

    if ($con->query($sql) === TRUE) {
        $_SESSION['notification'] = "Блюдо успешно обновлено.";
        header("Location: admin_panel.php");
        exit();
    } else {
        $_SESSION['notification'] = "Ошибка при обновлении блюда: " . $con->error;
        header("Location: admin_panel.php");
        exit();
    }
} else {
    $_SESSION['notification'] = "Ошибка: Неверный метод запроса или данные не отправлены.";
    header("Location: admin_panel.php");
    exit();
}
?>
