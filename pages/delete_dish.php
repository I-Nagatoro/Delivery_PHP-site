<?php
include "../config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dish_id = $_POST['dish_id'];
    $sql = "DELETE FROM dishes WHERE id = $dish_id";
    if ($con->query($sql) === TRUE) {
        header("Location: admin_panel.php");
        exit();
    } else {
        header("Location: admin_panel.php");
        exit();
    }
}
?>
