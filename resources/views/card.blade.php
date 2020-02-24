<html>

<head>
    <title>
        добавление карточки
    </title>
    <style type="text/css">
    .error{
        color: red;    
    }
    
    
    </style>
</head>
<body>
    <form action="/card" enctype="multipart/form-data" method="post">
        
        @csrf
        @foreach($errors->get('text') as $error)
        <div class="error">
        {{ $error}}
        @endforeach
        </div>
        <span>пример:</span>
        <span>файл:</span>
            <input type="file" name="file"></input>
        <br>
        <input type="text" name="text"></input>
        <input type="submit" value="создать"></input>
    </form>
   
</body>

</html>