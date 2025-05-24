<?php 
$username = trim(filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
$mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';
if (mb_strlen($username) < 2) {
    $error = 'Введите имя';
} else if (mb_strlen($email) < 5) {
    $error = 'Введите email';
} else if (mb_strlen($mess) < 10) {
    $error = 'Введите cообщение';
} 

if ($error != '') {
    echo $error;
    exit();
}

$to = "yura.oksamytnyy@gmail.com";
$subject = "=?utf-8?B?" . base64_encode('Новое сообщение') . "?=";
$message = "Пользователь: $username.<br>$mess";
$headers = "From: $email\r\nReply to: $email\r\nContent type: text/html; charset=utf-8\r\n";

mail($to, $subject, $message, $headers);

echo 'Done';