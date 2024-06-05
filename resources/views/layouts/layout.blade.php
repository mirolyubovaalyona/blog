<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{route('post.create')}}">Создать пост</a>

    @if (session('success'))
    <?php
     $msg = session('success');
    echo '<script>alert("'.$msg.'")</script>'; 
    ?> 
    @endif
    
    @yield('content')
</body>
</html>