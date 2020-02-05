<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title> Добавление поста </title>
</head>

<body>
    @foreach($posts as $post)
    <div>
        <h1> {{ $post->getTitle() }} </h1>
    </div>
    <div> {{ $post->getText() }}</div>
    <hr>
    @endforeach
    <form action="" method="post">
        @foreach ($errors->get('title') as $error)
        <li> {{ $error }}</li>
        @endforeach
        Заголовок:
        <input type="text" name="title"></input>
        <br>
        @foreach ($errors->get('text') as $error)
        <li> {{ $error }}</li>
        @endforeach
        Текст:
        <input type="text" name="text"></input>
        <input type="hidden" name="_token" value={{ csrf_token() }}>
        <button>опубликовать</button>
    </form>
</body>

</html>