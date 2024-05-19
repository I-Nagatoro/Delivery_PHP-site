
<?php 
include '../config.php';


$query = "SELECT * FROM category";
$result = mysqli_query($con, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$dishes_by_category = array();
foreach ($categories as $category) {
    $category_id = $category['id'];
    $query_dishes = "SELECT * FROM dishes WHERE category_id = $category_id";
    $result_dishes = mysqli_query($con, $query_dishes);
    $dishes = mysqli_fetch_all($result_dishes, MYSQLI_ASSOC);
    $dishes_by_category[$category_id] = array_reverse($dishes);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<section class="menu">
    <?php foreach ($categories as $category): ?>
        <div class="category" id="category_<?php echo $category['id']; ?>">
            <h2><?php echo $category['category']; ?></h2>
            <div class="cards">
                <?php foreach ($dishes_by_category[$category['id']] as $dish): ?>
                    <div class="card" data-dish-id="<?php echo $dish['id']; ?>">
                        <h3 class="dish-name"><?php echo $dish['dish_name']; ?></h3>
                        <p><?php echo $dish['caption']; ?></p>
                        <p class="dish-price"><?php echo $dish['price']; ?> руб.</p>
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="dish_id" value="<?php echo $dish['id']; ?>">
                            <input type="hidden" name="dish_name" value="<?php echo $dish['dish_name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $dish['price']; ?>">
                            <button class="button add-to-cart" data-dish-id="<?php echo $dish['id']; ?>">Добавить в корзину</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<?php

?>
</body>
</html>
