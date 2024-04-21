<?php
session_start();
if($_SESSION['user']){
    header('Location: page.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
<form action="include/log_in.php" method="POST">
    <h2>Вход</h2><br>
    <lable>Введите номер телефона/почту</lable><br>
    <input class="Authorization" type="text" name="user_tel_or_email" placeholder="Номер телефона/почта"> <br>
    <input class="Authorization" type="password" name="password" placeholder="Пароль"> <br>
    <p>
        Нет аккаунта? - <a href="registration.php">Зарегистрируйтесь</a>
    </p>

<br>
    <button type="submit">Войти</button>
    <p class="msg">
        <?php
        echo $_SESSION['massage'];
        unset($_SESSION['massage']);
        ?>
    </p>
<div 
  style="height: 100px"
  id="captcha-container"
  class="smart-captcha"
  data-sitekey="ysc1_fPXWjXQJ2KgzRhpA1Oj5m8xb1IunuoWkE1OPjzbp6aed5235"
><input type="hidden" name="smart-token" value="ysc1_fPXWjXQJ2KgzRhpA1Oj5m8xb1IunuoWkE1OPjzbp6aed5235"></div>
</form>
</body>
</html>