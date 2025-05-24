<?php
require_once '../lib/mysql.php'; 

$sql = "SELECT message FROM chat";
$query = $pdo->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($result)) {
    echo "<p id='chat' class='chat_light_beige'>Пока сообщений нет</p>";
} else {
    foreach ($result as $row) {
        echo "<p id='chat' class='chat_light_blue'>$row[message]</p>";
    }
}
