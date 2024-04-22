<?php
session_start();
if(!$_SESSION['user']){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Логин: <?= $_SESSION['user']['user_login']?></h1>
    <h1>Номер телефона: <?= $_SESSION['user']['user_tel_number']?></h1>
    <h1>Почта: <?= $_SESSION['user']['user_email']?></h1>
    <h1>Пароль: <?= $_SESSION['user']['password']?></h1>
    <h1>Для изменения данных, введите все данные ниже</h1>
    <form action="include/edit_profile.php" method="POST">
    <input class="edit" type="text" name="login_edit" placeholder="Изменить логин">
    <input class="edit" type="tel" name="number_edit" placeholder="Изменить номер телефон">
    <input class="edit" type="email" name="email_edit" placeholder="Изменить почту">
    <input class="edit" type="text" name="password_edit" placeholder="Изменить пароль">
    <button type="submit">Подтвердить</button>
    </form>
    <br><p class="msg">
        <?php
        echo $_SESSION['massage'];
        unset($_SESSION['massage']);
        ?>
    </p></br>
    <a href="include/logout.php">Выйти</a>
</body>
</html>