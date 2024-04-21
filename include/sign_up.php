<?php
session_start();
require_once 'connect.php';
$user_tel_number = $_POST['user_tel_number'];
$user_email = $_POST['user_email'];
$user_login = $_POST['user_login'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$check_user = mysqli_query($connect, "SELECT * FROM test WHERE user_tel_number = '$user_tel_number' OR user_email = '$user_email' OR user_login = '$user_login'");
if(mysqli_num_rows($check_user)<1)
{
    if ($password === $repassword) {
        mysqli_query($connect, "INSERT INTO `test` (`newid`, `id`, `user_tel_number`, `user_login`, `user_email`, `password`) VALUES (NULL, NULL, '$user_tel_number', '$user_login', '$user_email', '$password')");
        header('Location: ../index.php');
    }else{
        $_SESSION['massage'] = 'Пароли не совпадают';
        header('Location: ../registration.php');
    }
}else{
    $_SESSION['massage'] = 'Этот номер телефона, почта или логин уже используются';
    header('Location: ../registration.php');
}