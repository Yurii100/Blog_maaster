<?php 
$username = trim(filter_var($_POST["username"],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST["email"],FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST["login"],FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST["password"],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($username) < 2) {
    $error = 'Введите имя';
} else if (mb_strlen($email) < 5) {
    $error = 'Введите email';
} else if (mb_strlen($login) < 3) {
    $error = 'Введите логин';
} else if (mb_strlen($password) < 5) {
    $error = 'Введите пароль';
}

if ($error != '') {
    echo $error;
    exit();
}

require_once '../lib/mysql.php';

$salt = 'l;xikjg|gfdsgsdgsdfg';
$pass = md5($salt.$password);

$sql = 'INSERT INTO users_2(name, email, login, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $pass]);

echo 'Done';