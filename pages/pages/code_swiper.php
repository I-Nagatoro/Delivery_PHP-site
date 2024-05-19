<?php
include '../config.php';

$query = "SELECT * FROM category";
$result = mysqli_query($con, $query);

if ($result) {
    $category = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $category[] = array($row['id'], $row['category']);
    }
} else {
    echo "Ошибка при выполнении запроса: " . mysqli_error($con);
}

mysqli_close($con);
?>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($category as $cat): ?>
        <div class="swiper-slide category-slide" data-target="#category_<?php echo $cat[0]; ?>">
            <a href="#category_<?php echo $cat[0]; ?>" class="category-link"><?php echo $cat[1]; ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>