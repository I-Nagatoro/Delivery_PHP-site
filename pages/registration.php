<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="../css/style_index.css" rel="stylesheet" type="text/css" />
    <title>Куриная доставка еды - Регистрация</title>
</head>
<body>

<h1>Куриная доставка еды</h1>
<h2>Регистрация</h2>
<?php include 'code_check_number.php'; ?>

<form id='reg' method='POST'>
    <strong><abcv style="font-size:14px; display: inline-block;">Введите имя:</abcv></strong><br>
    <input name="user_name" type="text" value='' placeholder="Ваше имя" required><br><br>
    <strong><abcv style="font-size:14px; display: inline-block;">Введите номер телефона:</abcv><br>
    <input name="phone_number" type="text" value='' placeholder="+7(987)-654-32-10" required><br>
    <span style="color:red;"><?php echo $phoneError; ?></span><br>
    <strong><abcv style="font-size:14px; display: inline-block;">Введите пароль:</abcv><br>
    <input name="password" type="text" value='' placeholder="Ваш пароль" required><br><br>
    <input name="enter_reg" type="submit" value='Зарегистрироваться'><br>
</form>
<div>
    <h4 style="font-size:12px; display: inline-block;">Уже есть аккаунт?</h4>
    <form action="../index.php" method="GET" style="display: inline-block;">
        <input type="submit" value='Войти'>
    </form>
</div>

<?php
include '../config.php';
include 'code_check_number.php';

if (isset($_POST['enter_reg']) && empty($phoneError)) {
    $name = $_POST['user_name'];
    $password = $_POST['password'];

    $phoneNumber = preg_replace('/[^\d+]/', '', $_POST['phone_number']);

    $check_query = "SELECT * FROM users WHERE phone_number='$phoneNumber'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Такой аккаунт уже существует!";
    } else {
        $query = "INSERT INTO users (user_name, phone_number, password) VALUES ('$name', '$phoneNumber', '$password')";
        if (mysqli_query($con, $query)) {
            session_start();
            $_SESSION['user_name'] = $name;
            $_SESSION['phone_number'] = $phoneNumber;
            header("Location: menu.php");
            exit();
        } else {
            echo "Ошибка при регистрации!";
        }
    }
}


if(isset($_POST['go_log'])){
    header("Location: ../index.php");
}

mysqli_close($con);
?>

</body>
</html>
