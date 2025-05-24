<?php 
$title = trim(filter_var($_POST["title"],FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST["anons"],FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST["full_text"],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($title) < 5) {
    $error = 'Введите название статьи';
} else if (mb_strlen($anons) < 10) {
    $error = 'Введите анонс статьи';
} else if (mb_strlen($full_text) < 10) {
    $error = 'Введите основной текст статьи';
} 

if ($error != '') {
    echo $error;
    exit();
}

require_once '../lib/mysql.php';

$sql = 'INSERT INTO articles(title, anons, full_text, date,	author) VALUES(?, ?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $anons, $full_text, time(), $_COOKIE['log']]);

echo 'Done';