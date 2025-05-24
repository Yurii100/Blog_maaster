<?php
$id = trim($_POST["id"]);

require_once '../lib/mysql.php';

$res = $pdo->prepare("DELETE FROM users_2 WHERE id = ?");
$res->execute([$id]);

if ($res->rowCount() > 0) {
    echo "success";
} else "error";
