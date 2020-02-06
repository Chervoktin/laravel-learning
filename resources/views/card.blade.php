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
    <form action="/card" method="post">
        
        @csrf
        @foreach($errors->get('text') as $error)
        <div class="error">
        {{ $error}}
        @endforeach
        </div>
        <span>пример:</span>
        <input type="text"></input>
        <input type="submit" value="создать"></input>
    </form>
   
</body>

</html>