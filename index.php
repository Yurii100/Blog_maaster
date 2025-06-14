<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php 
            $website_title = "Blog Master";
            require './blocks/head.php' 
        ?>
    </head>
    <body>
        <?php require './blocks/header.php' ?>
        <main>
            <?php 
                require './lib/mysql.php';
        
                $sql = 'SELECT * FROM articles ORDER BY date DESC'; // ORDER BY это инструкция для сортировка, а инструкция DESC означает что сортировка будет происходить в порядке убывания.
                $query = $pdo->query($sql); // Тут функция query() зменяет связку функций prepare() и execute().
                while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                    echo "<div class='post'>
                        <h1>$row->title</h1>
                        <p>$row->anons</p>
                        <p class='author'>Автор: <span>$row->author</span></p>
                        <a href='./post.php?id=$row->id' title='$row->title'>Прочитать</a>
                    </div>";
                };
            ?>    
        </main>
        <?php require './blocks/aside.php' ?>
        <?php require './blocks/footer.php' ?>
    </body>
</html>