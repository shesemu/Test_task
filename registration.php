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
</head>
<body>
    <form action="include/sign_up.php" method="POST">
    <h2>Регистрация</h2>
    <input class="Authorization" type="tel" name="user_tel_number" placeholder="Номер телефона без 8"> <br>
    <input class="Authorization" type="email  " name="user_email" placeholder="Почта"> <br>
    <input class="Authorization" type="text" name="user_login" placeholder="Логин"> <br>
    <input class="Authorization" type="password" name="password" placeholder="Пароль"> <br>
    <input class="Authorization" type="password" name="repassword" placeholder="Повторите пароль"> <br>
    <button type="submit">Зарегистрироваться</button>
    <p>
        Уже есть аккаунт? - <a href="/">Войти</a>
    </p>
    <p class="msg">
        <?php
        echo $_SESSION['massage'];
        unset($_SESSION['massage']);
        ?>
    </p>
    </form>
</body>
</html>