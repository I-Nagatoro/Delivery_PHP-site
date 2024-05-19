<?php
session_start();
include "../config.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone_number = $_SESSION['phone_number'];
    $street = $_POST['street'];
    $house = $_POST['house'];
    $entrance = $_POST['entrance'];
    $floor = $_POST['floor'];
    $apartment = $_POST['apartment'];
    $comment = $_POST['comment'];

    $find_user_query = "SELECT id FROM users WHERE phone_number='$phone_number'";
    $user_result = mysqli_query($con, $find_user_query);
    if(mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row['id'];
        echo "User ID: " . $user_id . "<br>";
    }

    $insert_address_query = "INSERT INTO address_and_comment (street, house, entrance, floor, apartment, comment) 
                            VALUES ('$street', '$house', '$entrance', '$floor', '$apartment', '$comment')";
    mysqli_query($con, $insert_address_query);
    $address_id = mysqli_insert_id($con);
    echo "Address ID: ".$address_id."<br>";

$cart_items = $_SESSION['cart'];
$max_order_id_query = "SELECT COALESCE(MAX(order_id), 0) + 1 AS next_order_id FROM orders";
$max_order_id_result = mysqli_query($con, $max_order_id_query);

if ($max_order_id_result) {
    $max_order_id_row = mysqli_fetch_assoc($max_order_id_result);
    $next_order_id = $max_order_id_row['next_order_id'];
    $_SESSION['order_id'] = $next_order_id;
} else {
    echo "Ошибка при выполнении запроса: " . mysqli_error($con);
}


    foreach ($cart_items as $item) {
        echo $item['dish_id'];
        $dish_name = $item['dish_name'];
        echo $dish_name;
        $quantity = $item['quantity'];
        echo ' '.$quantity."<br>";
        $dish_id=$item['dish_id'];
        $dish_price=$item['price'];
        
        $insert_order_query = "INSERT INTO orders (order_id, dish_id, dish_name, `count`, user_id, address_id) 
                               VALUES ('$next_order_id', '$dish_id', '$dish_name', '$quantity', '$user_id', '$address_id')";
        mysqli_query($con, $insert_order_query);
        $insert_status_query = "INSERT INTO orders_status (order_id, status) 
                            VALUES ('$next_order_id', 'готовится')";
        mysqli_query($con, $insert_status_query);

        $total_price = $quantity * $dish_price;
        $insert_order_check_query = "INSERT INTO order_check (order_id, user_id, dish_id, `count`, address_id, price) 
                                     VALUES ('$next_order_id', '$user_id', '$dish_id', '$quantity', '$address_id', '$total_price')";
        mysqli_query($con, $insert_order_check_query);
    }
    unset($_SESSION['cart']);
    header("Location: order_success.php");
    exit;
}
?>
