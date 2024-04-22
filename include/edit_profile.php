<?php
session_start();
require_once 'connect.php';
if($_POST['login_edit']==0 || $_POST['number_edit']==0 || $_POST['email_edit']==0 || $_POST['password_edit']==0){
    
    $_SESSION['massage'] = 'Введите все даныые';
    header('Location: ../page.php');
}else{
    $login = $_SESSION['user']['user_login'];
$new_login = $_POST['login_edit'];
$new_number = $_POST['number_edit'];
$new_email = $_POST['email_edit'];
$new_password = $_POST['password_edit'];
$id = $_SESSION['user']['newid'];
$update_inf = "UPDATE test SET user_tel_number = '$new_number', user_login = '$new_login', user_email = '$new_email', password = '$new_password' WHERE user_login = '$login' ";
if($connect->query($update_inf) === true){
    $user_info=mysqli_query($connect, "SELECT * FROM test WHERE user_login = '$new_login'");
    if(mysqli_num_rows($user_info)>0){
    $user = mysqli_fetch_assoc($user_info);
    $_SESSION['user'] = [
    "newid" => $user['newid'],
    "id" => $user['id'],
    "user_login" => $user['user_login'],
    "user_tel_number" => $user['user_tel_number'],
    "user_email" => $user['user_email'],
    "password" => $user['password']];
    header('Location: ../page.php');
    }
    
}else{
    $_SESSION['massage'] = 'Введите все даныые';
    header('Location: ../page.php');
}
}
