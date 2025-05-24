<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $website_title = "Список пользователей";
        require 'blocks/head.php' 
    ?>
</head>
<body>
    <?php require 'blocks/header.php' ?>
    <main>
        <h1>Список пользователей</h1>
        <div>
            <?php
                require_once './lib/mysql.php';
                $sql = "SELECT id, name, login FROM users_2"; 
                $sql_data = $pdo->prepare($sql);
                $sql_data->execute();
                $users_2 = $sql_data->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users_2 as $user) {
                    echo "<div class='list-item'><p class='txt'>Имя: $user[name], Логин: $user[login]</p><button onclick='deleteUser($user[id])'>Удалить</button></div><br>";
                };
            ?>
        </div>
    </main>
    <?php require 'blocks/aside.php' ?>
    <?php require 'blocks/footer.php' ?>
    <script>
        function deleteUser(id) {
            $.ajax({
                url: "ajax/deleteUser.php",
                type: "POST",
                cache: false,
                data: {
                    "id": id
                },
                dataType: "html",
                success: (data) => {
                    if (data === 'success' || data === 'Done') {
                        $('div[data-id="' + id + '"]').remove();
                    } else {
                        alert(`Произошла ошибка: ${data}`);
                    }
                }
            });
        }
    </script>
</body>
</html>