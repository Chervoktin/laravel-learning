<html>

<head>
    <title>
        добавление карточки
    </title>
    <style type="text/css">
    .word {
        display: inline-block;
        padding: 5px;
        border: 1px solid black;
        background-color: aqua;
    }
    .word input {
        border: 1px solid black;
        margin: 1px;
    }
    
    </style>
</head>

<body>
    <div>
    Фраза: {{ $card->text }}
    </div>
    <form action=" /card/{{ $id }}" method="post">
        @csrf
        
        @foreach($errors->get('word') as $error)
        <div>
        {{ $error }}
        </div>
        @endforeach
        <span>слово:</span>
        <input type="text" name="word"></input>
        <br>
        @foreach($errors->get('translation') as $error)
        <div>
        {{ $error }}
        </div>
        @endforeach
        <span>перевод:</span>
        <input type="text" name="translation"></input>
        <input type="submit" value="добавить слово"></input>
       
    </form>


</body>

</html>