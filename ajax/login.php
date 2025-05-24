<?php 
$login = trim(filter_var($_POST["login"],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST["password"],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($login) < 3) {
    $error = 'Введите логин';
} else if (mb_strlen($password) < 5) {
    $error = 'Введите пароль';
};

if ($error != '') {
    echo $error;
    exit();
};

require_once '../lib/mysql.php';

$salt = 'l;xikjg|gfdsgsdgsdfg';
$pass = md5($salt.$password);

$sql = "SELECT id FROM users_2 WHERE `login` = ? AND `password` = ?";
$query = $pdo->prepare($sql);
$query->execute([$login, $pass]);

if ($query->rowCount() == 0) {
    echo "Такого пользовател нет.";
} else {
    setcookie('log', $login, time() + 3600 * 24 * 30, "/");
    echo 'Done';
};