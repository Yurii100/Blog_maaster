<?php 
$username = trim(filter_var($_POST["username"],FILTER_SANITIZE_SPECIAL_CHARS));
$message = trim(filter_var($_POST["message"],FILTER_SANITIZE_SPECIAL_CHARS));
$id = trim(filter_var($_POST["id"],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($username) < 2) {
    $error = 'Введите имя';
} else if (mb_strlen($message) < 5) {
    $error = 'Введите комментарий';
} 

if ($error != '') {
    echo $error;
    exit();
}

require_once '../lib/mysql.php';

$sql = 'INSERT INTO comments(name, message, article_id) VALUES(?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$username, $message, $id]);

echo 'Done';