<header>
    <span class="logo">Blog Master</span>
    <nav>
        <a href="/Blog_master/index.php">Главная</a>
        <a href="/Blog_master/contacts.php">Контакты</a>
        <?php if (isset($_COOKIE['log'])) : ?>
            <a href="/Blog_master/add-article.php">Добавить статью</a>
            <a href="/Blog_master/list_of_users.php" class="btn">Список пользователей</a>
            <a href="/Blog_master/authorization.php" class="btn">Кабинет пользователя</a>
        <?php else : ?>
            <a href="/Blog_master/authorization.php" class="btn">Войти</a>
            <a href="/Blog_master/register.php" class="btn">Регистрация</a>
        <?php endif; ?>
    </nav>
</header>