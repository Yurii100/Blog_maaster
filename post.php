<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php 
            require_once './lib/mysql.php';
            $sql = 'SELECT * FROM articles WHERE `id` = ?';
            $query = $pdo->prepare($sql);
            $query->execute([$_GET['id']]);

            $article = $query->fetch(PDO::FETCH_OBJ);
            if ($article) {
                $website_title = $article->title;
            } else $website_title = "Статья не найдена.";

            require './blocks/head.php' 
        ?>
    </head>
    <body>
        <?php require './blocks/header.php' ?>
        <main>
            <?php 
                if ($article) {
                    echo "<div class='post'>
                        <h1>$article->title</h1>
                        <h4>$article->anons</h4>
                        <p>$article->full_text</p>
                        <p class='author'>Автор: <span>$article->author</span></p>
                        <p><b>Время публикации:</b> " . date('H:i:s', $article->date) . "</p>
                    </div>";
                } else echo "<p>Статья не найдена.</p>";
            ?>
            <form>
                <label for="username">Ваше имя:</label>
                <?php if (isset($_COOKIE['log'])) : ?>
                    <input type="text" name="username" id="username" value="<?=$_COOKIE['log'] ?>">
                <?php else: ?>
                    <input type="text" name="username" id="username">
                <?php endif; ?>

                <label for="message">Комментарий:</label>
                <textarea name="message" id="message"></textarea>

                <div class="error-mess" id="error-block"></div>

                <button type="button" id="mess_send">Добавить комментарий:</button>
            </form>

            <div class="comments">
                <?php 
                    $sql = 'SELECT * FROM comments WHERE `article_id` = ? ORDER BY id DESC';
                    $query = $pdo->prepare($sql);
                    $query->execute([$_GET["id"]]);

                    $comments = $query->fetchAll(PDO::FETCH_OBJ);
            
                    foreach ($comments as $comment) {
                        echo "<div class='comment'>
                        <h2>$comment->name</h2>
                        <p>$comment->message</p>
                        </div>";

                    }
                ?>
            </div>
        </main>
        <?php require './blocks/aside.php' ?>
        <?php require './blocks/footer.php' ?>
        <script>
            $('#mess_send').click(function() {
                let name = $('#username').val();
                let message = $('#message').val();
                
                $.ajax({
                    url: 'ajax/comment_add.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        'username': name,
                        'message': message,
                        'id': '<?=$_GET['id']?>',
                    },
                    dataType: 'html',
                    success: (data) => {
                        if (data === 'Done') {
                            $('.comments').prepend(`<div class='comment'
                                <h2>${name}</h2>
                                <p>${message}</p>                                                
                            </div>`);
                            $('#mess_send').text('Всё готово.');
                            $('#error-block').hide();
                            $('#message').val('');
                        }else {
                            $('#error-block').show();
                            $('#error-block').text(data);
                        }
                    }
                });
            });
        </script>
    </body>
</html>