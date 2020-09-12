<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JobForTranslators</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="/css/bootstrap.css" rel="stylesheet">

    <style>
        body {
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="container">
    <form id="message-form">
        <div class="alert alert-success" id="success" style="display:none" role="alert">
            Сообщение успешно отправлено
        </div>
        <div class="alert alert-danger" id="error" style="display:none" role="alert">
            Вы превысили лимит на отправку сообщений. Попробуйте позднее
        </div>
        <div class="form-group">
            <label for="message">Введите сообщение</label>
            <textarea required class="form-control" name="message" rows="5"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2">Отправить</button>
        </div>
    </form>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $('#message-form').submit(function(e){
        e.preventDefault();
        $.post('/api/send-message', $(this).serializeArray())
        .always(function(data, status){
            console.log(status);
            $('#' + status).show();
            setTimeout(() => {
                $('#' + status).hide();
            }, 3000);
        });
    })
</script>
</html>
