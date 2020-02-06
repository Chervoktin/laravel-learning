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
    <form action="{{ $id }}/word" method="post">
        <span>слово:</span>
        <input type="text"></input>
        <br>
        <span>перевод:</span>
        <input type="text"></input>
        <input type="submit" value="добавить слово"></input>
    </form>


</body>

</html>