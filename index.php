<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="css/style_index.css" rel="stylesheet" type="text/css" />
    <title>Куриная доставка еды - Вход</title>
</head>
<body>

<h1>Куриная доставка еды</h1>
<h2>Вход</h2>
<form id='login' action="index.php" method='POST'>
<strong><abcv style="font-size:14px; display: inline-block;">Введите номер телефона:</abcv><br>
    <input name="phone_number" type="text" value='' placeholder="+7(987)-654-32-10"><br><br>
    <strong><abcv style="font-size:14px; display: inline-block;">Введите пароль:</abcv><br>
    <input name="password" type="text" value='' placeholder="Ваш пароль"><br><br>
    <input name="enter_login" type="submit" value='Войти'><br>
    <div>
        <h4 style="font-size: 12px; display: inline-block;">Ещё нет аккаунта?</h4>
        <input name="go_reg" type="submit" value='Зарегистрироваться' style="display: inline-block;">
    </div>
</form>

<?php
include 'config.php';

if(isset($_POST['enter_login'])){
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE phone_number='$phone_number' AND password='$password'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        session_start();
        $_SESSION['phone_number'] = $phone_number;
        $query_num = "SELECT user_name FROM users WHERE phone_number='$phone_number'";
        $result_num = mysqli_query($con, $query_num);
        
        if(mysqli_num_rows($result_num) > 0){
            $row = mysqli_fetch_assoc($result_num);
            $user_name = $row['user_name'];
            $_SESSION['user_name']=$user_name;
        }
        header("Location: pages/menu.php");
    } else {
        echo "Неверный номер телефона или пароль";
    }
}

if(isset($_POST['go_reg'])){
    header("Location: pages/registration.php");
}

mysqli_close($con);
?>

</body>
</html>
