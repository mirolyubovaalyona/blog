<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('post.create')}}">Создать пост</a>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <?php
            echo '<script>alert("'.$error.'")</script>'; 
            ?>  
        @endforeach
    @endif

    @if (session('success'))
        <?php
        echo '<script>alert("'.session('success').'")</script>'; 
        ?> 
    @endif
    
    @yield('content')
</body>
</html>