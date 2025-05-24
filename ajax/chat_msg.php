<?php
require_once '../lib/mysql.php';

if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS));

    // Подготовка и выполнение SQL-запроса на вставку нового сообщения
    $sql = "INSERT INTO chat (message) VALUES (?)";
    $query = $pdo->prepare($sql);
    $query->execute([$message]);

    // Проверка успешности вставки
    if ($query->rowCount() > 0) {
        echo 'Done';
    } else {
        echo 'Error';
    }
} else {
    echo 'Введите сообщение.';
}