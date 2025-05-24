<aside>
    <div class="info">
        <h2>Интересные факты</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore rerum possimus dolor molestiae, at alias atque iusto magni animi quis praesentium delectus sunt voluptatibus incidunt laboriosam aperiam obcaecati excepturi repellendus?</p>
    </div>
    <img src="https://itproger.com/img/intensivs/back-end.svg" alt="back-end">
    <div id="messages"></div> <!-- Контейнер для сообщений -->
    <textarea name="message_2" id="message_2"></textarea>
    <button type="button" id="send_mess_chat">Отправить</button>
</aside>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $("#send_mess_chat").click(()=>{
        let message = $("#message_2").val();

        $.ajax({
            url: 'ajax/chat_msg.php',
            type: 'POST',
            cache: false,
            data: {
                'message': message
            },
            dataType: 'html',
            success: (data)=>{
                $("#message_2").val(''); // Очистка текстового поля после успешной отправки.
                loadMessages(); // Обновить список сообщений
            }
        })
    });

    function loadMessages() {
        $.ajax({
            url: 'ajax/load_chat.php',
            type: 'GET',
            cache: false,
            dataType: 'html',
            success: (data) => {
                $('#messages').html(data); // Обновление контейнера сообщений
            }
        });
    };

    loadMessages(); // Обновление сообщений при начальной загрузке страницы

    setInterval(loadMessages, 5000); // Обновление сообщений каждые 5 секунд
</script>