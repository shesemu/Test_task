<?php
session_start();
require_once('connect.php');
define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_fPXWjXQJ2KgzRhpA1Oj5H7HcJrkgynzpZDbBMz2o891313d2');
function check_captcha($token) {
    $ch = curl_init();
    $args = http_build_query([
        "secret" => SMARTCAPTCHA_SERVER_KEY,
        "token" => $token,
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);

    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

$token = $_POST['smart-token'];
$user_tel_or_email = $_POST['user_tel_or_email'];
$password = $_POST['password'];
$check_user_login = mysqli_query($connect, "SELECT * FROM test WHERE user_tel_number = '$user_tel_or_email' OR user_email = '$user_tel_or_email'");
$check_password = mysqli_query($connect, "SELECT * FROM test WHERE password = '$password' OR (user_tel_number = '$user_tel_or_email' OR user_email = '$user_tel_or_email')");
if (check_captcha($token)) {
    if(mysqli_num_rows($check_user_login)>0 ){
        if(mysqli_num_rows($check_password)>0)
        {
                $user = mysqli_fetch_assoc($check_password);
                $_SESSION['user'] = [
                "newid" => $user['newid'],
                "id" => $user['id'],
                "user_login" => $user['user_login'],
                "user_tel_number" => $user['user_tel_number'],
                "user_email" => $user['user_email'],
                "password" => $user['password']];
                header('Location: ../page.php');
        }else{
            $_SESSION['massage'] = 'Неверный пароль';
            header('Location: ../index.php');
        }
        
    }else{
        $_SESSION['massage'] = 'Неверная почта, либо номер телефона';
        header('Location: ../index.php');
    }
}else{
    $_SESSION['massage'] = 'Пройдите captcha';
        header('Location: ../index.php');
}
