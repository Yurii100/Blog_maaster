<!DOCTYPE html>
<html lang="ru">
<head>
    <?php 
        $website_title = "Авторизация";
        require 'blocks/head.php' 
    ?>
</head>
<body>
    <?php require 'blocks/header.php' ?>
    <main>
        <?php if (!isset($_COOKIE['log'])) : ?>
            <h1>Авторизация</h1>
            <form> 
                <label for="login">Логин: </label>
                <input type="login" name="login" id="login">

                <label for="password">Пароль: </label>
                <input type="password" name="password" id="password">

                <div class="error-mess" id="error-block"></div>

                <button type="button" id="login_user">Войти</button>
            </form>
        <?php else : ?>
            <h2><?= $_COOKIE['log'] ?></h2>
            <form>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif; ?>
    </main>
    <?php require 'blocks/aside.php' ?>
    <?php require 'blocks/footer.php' ?>
    <script>
        $('#login_user').click(function() {
            let login = $('#login').val();
            let pass = $('#password').val();

            $.ajax({
                url: 'ajax/login.php',
                type: 'POST',
                cache: false,
                data: {
                    'login': login,
                    'password': pass
                },
                dataType: 'html',
                success: (data) => {
                    if (data === 'Done') {
                        $('#login_user').text('Всё готово.');
                        $('#error-block').hide();
                        document.location.reload(true);
                    }else {
                        $('#error-block').show();
                        $('#error-block').text(data);
                    }
                }
            });
        });

        $('#exit_user').click(function() {
            $.ajax({
                url: 'ajax/exit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: (data) => {
                    document.location.reload(true);
                }
            });
        });
    </script>
</body>
</html>