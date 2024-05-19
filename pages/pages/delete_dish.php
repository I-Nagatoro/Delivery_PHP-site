<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con->query("SET FOREIGN_KEY_CHECKS = 0");

    $dish_id = $_POST['dish_id'];
    $sql = "DELETE FROM dishes WHERE id = $dish_id";
    if ($con->query($sql) === TRUE) {
        $con->query("SET FOREIGN_KEY_CHECKS = 1");
        header("Location: admin_panel.php");
        exit();
    } else {
        $con->query("SET FOREIGN_KEY_CHECKS = 1");
        header("Location: admin_panel.php");
        exit();
    }
}
?>
