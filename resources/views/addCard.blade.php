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
            table{
            
                border: 1px  black; /* Рамка вокруг таблицы */
                border-collapse: collapse;

            }
            td{
                padding: 5px; /* Поля вокруг содержимого ячеек */
                padding-right: 50px;
                border: 1px solid black; /* Граница вокруг ячеек */
            }

        </style>
    </head>

    <body>
        <div>
            Фраза: {{ $card->text }}
        </div>
        <div>
            <video src="{{ $url }}" controls="controls"></video> 
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
        <table class="words">
            @foreach($words as $word)
            <tr>
                 <td> <a href="/card/{{$id}}/{{ $word->id}}">удалить</a></td>
                <td>{{ $word->word }}</td>
                <td>{{ $word->translation }}</td>
            </tr>  

            @endforeach
        </table>    
    </body>

</html>