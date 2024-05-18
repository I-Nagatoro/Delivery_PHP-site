<?php
session_start();
if (!isset($_SESSION['user_name']) || $_SESSION['user_name'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../css/style_admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container" style="margin: 0 auto; max-width: 800px;" >
    <header>
        <h1>Панель администратора</h1>
        <div style="display: inline-block">
            <h2>Пользователь: <?php echo $_SESSION['user_name']; ?></h2>
            <form style="display: inline-block;" action="logout.php" method="POST">
                <input style="text-align:left" class="logout-button" name="exit" type="submit" value='Выйти из аккаунта'>
            </form>
        </div>
    </header>
    <main>
        <section>
    <h2>Добавить блюдо в меню</h2>
    <form action="add_dish.php" method="POST">
        <label for="dish_name">Название блюда:</label><br>
        <input type="text" id="dish_name" name="dish_name" required><br>

        <label for="category_id">Категория:</label><br>
        <select id="category_id" name="category_id" required>
            <?php
            $category_query = "SELECT * FROM category";
            $category_result = mysqli_query($con, $category_query);
            while ($row = mysqli_fetch_assoc($category_result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
            }
            ?>
        </select><br>

        <label for="type_id">Тип:</label><br>
        <select id="type_id" name="type_id" required>
            <?php
            $type_query = "SELECT * FROM type";
            $type_result = mysqli_query($con, $type_query);
            while ($row = mysqli_fetch_assoc($type_result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
            }
            ?>
        </select><br>

        <label for="caption">Описание:</label><br>
        <input type="text" id="caption" name="caption"><br>

        <label for="weight">Вес:</label><br>
        <input type="text" id="weight" name="weight" required><br>

        <label for="price">Цена:</label><br>
        <input type="text" id="price" name="price" required><br><br>

        <input type="submit" name="add_to_menu" value="Добавить в меню">
    </form>
</section>

        <h2>Удалить блюдо из меню</h2>
            <form action="delete_dish.php" method="POST">
                <label for="dish_id">Выберите блюдо:</label><br>
                <select id="dish_id" name="dish_id" required>
                    <?php
                    $dish_query = "SELECT * FROM dishes";
                    $dish_result = mysqli_query($con, $dish_query);
                    while ($row = mysqli_fetch_assoc($dish_result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['dish_name'] . "</option>";
                    }
                    ?>
                </select><br><br>

                <input type="submit" name="delete_dish" value="Удалить блюдо из меню">
            </form>
        <h2>Обновить блюдо в меню</h2>
<form action="update_dish.php" method="POST">
    <label for="dish_id">Выберите блюдо:</label><br>
    <select id="dish_id" name="dish_id">
        <?php
        $dishes_query = "SELECT * FROM dishes";
        $dishes_result = mysqli_query($con, $dishes_query);
        while ($row = mysqli_fetch_assoc($dishes_result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['dish_name'] . "</option>";
        }
        ?>
    </select><br><br>
    <label for="dish_name">Название блюда:</label><br>
    <input type="text" id="dish_name" name="dish_name" placeholder="Название блюда"><br><br>

    <label for="category_id">Категория:</label><br>
    <select id="category_id" name="category_id">
        <?php
        $category_query = "SELECT * FROM category";
        $category_result = mysqli_query($con, $category_query);
        while ($row = mysqli_fetch_assoc($category_result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
        }
        ?>
    </select><br><br>

    <label for="type_id">Тип:</label><br>
    <select id="type_id" name="type_id">
        <?php
        $type_query = "SELECT * FROM type";
        $type_result = mysqli_query($con, $type_query);
        while ($row = mysqli_fetch_assoc($type_result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
        }
        ?>
    </select><br><br>

    <label for="caption">Описание:</label><br>
    <input type="text" id="caption" name="caption" placeholder="Описание блюда"><br><br>

    <label for="weight">Вес:</label><br>
    <input type="text" id="weight" name="weight" placeholder="Вес блюда (г)"><br><br>

    <label for="price">Цена:</label><br>
    <input type="text" id="price" name="price" placeholder="Цена блюда"><br><br>

    <input type="submit" name="update_dish" value="Обновить блюдо"><br><br><br><br><br>
</form>
        </section>
    </main>
    </div>
</body>

</html>
