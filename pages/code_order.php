<?php
session_start();
include "../config.php";

if (isset($_POST['submit'])) {
    if(isset($_POST['name'])) {
        $name = $_POST['name'];
        echo "Name: " . $name . "<br>";
    }
    $phone_number=$_SESSION['phone_number'];
    if(isset($_POST['street'])) {
        $street = $_POST['street'];
        echo "Street: " . $street . "<br>";
    }
    if(isset($_POST['house'])) {
        $house = $_POST['house'];
        echo "House: " . $house . "<br>";
    }
    if(isset($_POST['entrance'])) {
        $entrance = $_POST['entrance'];
        echo "Entrance: " . $entrance . "<br>";
    }
    if(isset($_POST['floor'])) {
        $floor = $_POST['floor'];
        echo "Floor: " . $floor . "<br>";
    }
    if(isset($_POST['apartment'])) {
        $apartment = $_POST['apartment'];
        echo "Apartment: " . $apartment . "<br>";
    }
    if(isset($_POST['comment'])) {
        $comment = $_POST['comment'];
        echo "Comment: " . $comment . "<br>";
    }

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
    $max_order_id_query = "SELECT MAX(order_id) + 1 AS next_order_id FROM new_delivery.orders";
    $max_order_id_result = mysqli_query($con, $max_order_id_query);
    $max_order_id_row = mysqli_fetch_assoc($max_order_id_result);
    $next_order_id = $max_order_id_row['next_order_id'];
    $_SESSION['order_id']=$next_order_id;

    foreach ($cart_items as $item) {
        echo $item['dish_id'];
        $dish_name = $item['dish_name'];
        echo $dish_name;
        $quantity = $item['quantity'];
        echo ' '.$quantity."<br>";
        $dish_id=$item['dish_id'];
        
        $insert_order_query = "INSERT INTO new_delivery.orders (order_id, dish_id, dish_name, `count`, user_id, address_id) 
                               VALUES ('$next_order_id', '$dish_id', '$dish_name', '$quantity', '$user_id', '$address_id')";
        mysqli_query($con, $insert_order_query);
        $order_id = mysqli_insert_id($con);
        $insert_status_query = "INSERT INTO orders_status (order_id, status) 
                            VALUES ('$order_id', 'готовится')";
        mysqli_query($con, $insert_status_query);
    }
    unset($_SESSION['cart']);
    header("Location: order_success.php");
    exit;
}
?>
