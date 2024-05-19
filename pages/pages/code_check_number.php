<?php
$phoneError = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enter_reg'])) {
    $phoneNumber = $_POST['phone_number'];
    $cleanedPhoneNumber = preg_replace('/[^\d+]/', '', $phoneNumber);
    $phoneRegex = '/^(\+7|8)\d{10}$/';
    if (!preg_match($phoneRegex, $cleanedPhoneNumber)) {
        $phoneError = "Введите правильный номер телефона в формате +7(XXX)-XXX-XX-XX или 8(XXX)-XXX-XX-XX";
    } else {}
}
?>
